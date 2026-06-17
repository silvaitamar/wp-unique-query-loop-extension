<?php
/**
 * Plugin Name:       Unique Query Loop Extension
 * Plugin URI:        https://github.com/silvaitamar/wp-unique-query-loop-extension
 * Description:       Estende o bloco Query Loop com exclusão de posts duplicados na mesma página.
 * Version:           1.0.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            Itamar Silva
 * Author URI:        https://github.com/silvaitamar
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       unique-query-loop-extension
 * Domain Path:       /languages
 *
 * @package UniqueQueryLoopExtension
 */

defined( 'ABSPATH' ) || exit;

define( 'UQLE_VERSION', '1.0.0' );
define( 'UQLE_PLUGIN_FILE', __FILE__ );
define( 'UQLE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'UQLE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

$uqle_autoloader = UQLE_PLUGIN_DIR . 'vendor/autoload.php';

if ( is_readable( $uqle_autoloader ) ) {
	require_once $uqle_autoloader;
} else {
	spl_autoload_register(
		static function ( $class ) {
			$prefix  = 'UniqueQueryLoopExtension\\';
			$base_dir = UQLE_PLUGIN_DIR . 'src/';

			if ( 0 !== strpos( $class, $prefix ) ) {
				return;
			}

			$relative = substr( $class, strlen( $prefix ) );
			$file     = $base_dir . str_replace( '\\', '/', $relative ) . '.php';

			if ( is_readable( $file ) ) {
				require_once $file;
			}
		}
	);
}

\UniqueQueryLoopExtension\Plugin::init();
