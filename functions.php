<?php

/**
 * uicore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uicore-theme
 */
defined('ABSPATH') || exit;

//Global Constants
define('UICORE_THEME_VERSION', '2.0.0');
define('UICORE_THEME_NAME', 'PageBolt');
define('UICORE_FRAMEWORK_VERSION', '5.0.0');

$uicore_includes = array(
	'/setup.php',
	'/default.php',
	'/template-tags.php',
	'/plugin-activation.php'
);

foreach ($uicore_includes as $file) {
	require_once get_template_directory() . '/inc' . $file;
}

function uicore_theme_setup() {
    define( 'UICORE_THEME_SLUG', 'lumi' );
}
add_action( 'after_setup_theme', 'uicore_theme_setup' );

//Required
if ( ! isset( $content_width ) ) {
	$content_width = 1000;
}
if ( is_singular() && !class_exists('\UiCore\Core')) {
	wp_enqueue_script( "comment-reply" );
}


//disable element pack self update
function uicore_disable_plugin_updates( $value ) {

    $pluginsToDisable = [
        'bdthemes-element-pack/bdthemes-element-pack.php',
        'metform-pro/metform-pro.php'
    ];

    if ( isset($value) && is_object($value) ) {
        foreach ($pluginsToDisable as $plugin) {
            if ( isset( $value->response[$plugin] ) ) {
                unset( $value->response[$plugin] );
            }
        }
    }
    return $value;
}
add_filter( 'site_transient_update_plugins', 'uicore_disable_plugin_updates' );
