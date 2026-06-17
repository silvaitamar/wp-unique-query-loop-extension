<?php
/**
 * Rastreia posts efetivamente renderizados por Query Loops com uniqueOnPage.
 *
 * @package UniqueQueryLoopExtension
 */

namespace UniqueQueryLoopExtension\Frontend;

use UniqueQueryLoopExtension\Registry\Rendered_Posts_Registry;

defined( 'ABSPATH' ) || exit;

/**
 * Coordena início/fim do rastreamento e captura postId via block context.
 */
class Render_Tracker {

	/**
	 * Registra hooks de renderização.
	 *
	 * @return void
	 */
	public static function register(): void {
		\add_filter( 'pre_render_block', array( self::class, 'pre_render_block' ), 10, 3 );
		\add_filter( 'render_block', array( self::class, 'render_block' ), 10, 3 );
		\add_filter( 'render_block_context', array( self::class, 'track_post_context' ), 2, 3 );
	}

	/**
	 * Ativa rastreamento antes da renderização de um Query Loop único.
	 *
	 * @param string|null      $pre_render   Conteúdo pré-renderizado ou null.
	 * @param array            $parsed_block Bloco parseado.
	 * @param \WP_Block|null   $parent_block Bloco pai (null no bloco raiz).
	 * @return string|null
	 */
	public static function pre_render_block( $pre_render, array $parsed_block, ?\WP_Block $parent_block ) {
		unset( $parent_block );

		if ( 'core/query' !== ( $parsed_block['blockName'] ?? '' ) ) {
			return $pre_render;
		}

		if ( empty( $parsed_block['attrs']['uniqueOnPage'] ) ) {
			return $pre_render;
		}

		/**
		 * Permite que integrações condicionem o rastreamento (ex.: variações de Query Loop).
		 *
		 * @param bool  $track        Se o loop deve participar do registro de IDs.
		 * @param array $parsed_block Bloco parseado do core/query.
		 */
		if ( ! \apply_filters( 'uqle_should_track_query_block', true, $parsed_block ) ) {
			return $pre_render;
		}

		Rendered_Posts_Registry::begin_tracking();

		return $pre_render;
	}

	/**
	 * Desativa rastreamento após a renderização do Query Loop único.
	 *
	 * @param string           $block_content  HTML renderizado.
	 * @param array            $parsed_block   Bloco parseado.
	 * @param \WP_Block|null   $block_instance Instância do bloco.
	 * @return string
	 */
	public static function render_block( string $block_content, array $parsed_block, ?\WP_Block $block_instance ): string {
		unset( $block_instance );

		if ( 'core/query' !== ( $parsed_block['blockName'] ?? '' ) ) {
			return $block_content;
		}

		if ( empty( $parsed_block['attrs']['uniqueOnPage'] ) ) {
			return $block_content;
		}

		Rendered_Posts_Registry::end_tracking();

		return $block_content;
	}

	/**
	 * Captura postId do contexto durante a iteração do Post Template.
	 *
	 * O core/post-template define postId no contexto com prioridade 1;
	 * este filtro roda em prioridade 2 para registrar apenas posts exibidos.
	 *
	 * @param array<string, mixed> $context       Contexto do bloco.
	 * @param array                $parsed_block  Bloco parseado.
	 * @param \WP_Block|null       $parent_block  Bloco pai.
	 * @return array<string, mixed>
	 */
	public static function track_post_context( array $context, array $parsed_block, $parent_block ): array {
		unset( $parsed_block, $parent_block );

		if ( ! Rendered_Posts_Registry::is_tracking() ) {
			return $context;
		}

		if ( ! isset( $context['postId'] ) ) {
			return $context;
		}

		Rendered_Posts_Registry::register( (int) $context['postId'] );

		return $context;
	}
}
