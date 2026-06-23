<?php
/**
 * PHPUnit bootstrap for unit tests.
 *
 * These tests cover pure PHP logic and do not require a WordPress install.
 * ABSPATH is defined so the plugin source files (guarded against direct
 * access) can be autoloaded.
 *
 * @package UniqueQueryLoopExtension
 */

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require dirname( __DIR__ ) . '/vendor/autoload.php';
