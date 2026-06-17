<?php
/**
 * Filtra argumentos da WP_Query do Query Loop no front-end.
 *
 * @package UniqueQueryLoopExtension
 */

namespace UniqueQueryLoopExtension\Frontend;

use UniqueQueryLoopExtension\Registry\Rendered_Posts_Registry;

defined( 'ABSPATH' ) || exit;

/**
 * Aplica post__not_in com IDs já renderizados em outros Query Loops únicos.
 */
class Query_Filter {

	/**
	 * Registra o filtro oficial do Query Loop.
	 *
	 * @return void
	 */
	public static function register(): void {
		// Prioridade 20: executar após extensões comuns (ex.: Advanced Query Loop em 10).
		\add_filter( 'query_loop_block_query_vars', array( self::class, 'filter_query_vars' ), 20, 3 );
	}

	/**
	 * Mescla IDs já exibidos em post__not_in da query atual.
	 *
	 * Só atua quando um bloco core/query com uniqueOnPage está em renderização
	 * (ver Render_Tracker::pre_render_block).
	 *
	 * @param array<string, mixed> $query  Argumentos da WP_Query.
	 * @param \WP_Block            $block  Instância do bloco (post-template).
	 * @param int                  $page   Página atual da query.
	 * @return array<string, mixed>
	 */
	public static function filter_query_vars( array $query, \WP_Block $block, int $page ): array {
		unset( $page );

		if ( ! Rendered_Posts_Registry::is_tracking() ) {
			return $query;
		}

		$rendered_ids = Rendered_Posts_Registry::get_ids();

		/**
		 * Permite que plugins de extensão do Query Loop ajustem os IDs excluídos.
		 *
		 * @param int[]               $rendered_ids IDs já renderizados na página.
		 * @param array<string,mixed> $query        Argumentos atuais da WP_Query.
		 * @param \WP_Block           $block        Instância do bloco post-template.
		 */
		$rendered_ids = \apply_filters( 'uqle_query_loop_post__not_in', $rendered_ids, $query, $block );

		if ( empty( $rendered_ids ) ) {
			return $query;
		}

		$existing = isset( $query['post__not_in'] ) ? (array) $query['post__not_in'] : array();

		$query['post__not_in'] = array_values(
			array_unique(
				array_map(
					'intval',
					array_merge( $existing, $rendered_ids )
				)
			)
		);

		return $query;
	}
}
