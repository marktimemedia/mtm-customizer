<?php
/*
	Plugin Name: Site Customizer
	Description: Customizer Settings for your base theme
	Author: Marktime Media
	Version: 1.0
	Author URI: http://marktimemedia.com
 */

define( 'MTM_OPTIONS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Enqueue scripts and styles.
 * Our sample Social Icons are using Font Awesome icons so we need to include the FA CSS when viewing our site
 * The Single Accordion Control is also displaying some FA icons in the Customizer itself, so we need to enqueue FA CSS in the Customizer too
 *
 * @return void
 */
if ( ! function_exists( 'mtm_scripts_styles' ) ) {
	function mtm_scripts_styles() {
		// Register and enqueue our icon font
		// We're using the awesome Font Awesome icon font. http://fortawesome.github.io/Font-Awesome
		wp_register_style( 'fontawesome', MTM_OPTIONS_PLUGIN_DIR . 'css/fontawesome-all.min.css' , array(), '5.8.2', 'all' );
		wp_enqueue_style( 'fontawesome' );
	}
}
add_action( 'wp_enqueue_scripts', 'mtm_scripts_styles' );
add_action( 'customize_controls_print_styles', 'mtm_scripts_styles' );

/**
 * Enqueue scripts for our Customizer preview
 *
 * @return void
 */
if ( ! function_exists( 'mtm_customizer_preview_scripts' ) ) {
	function mtm_customizer_preview_scripts() {
		wp_enqueue_script( 'mtm-customizer-preview', MTM_OPTIONS_PLUGIN_DIR . 'js/customizer-preview.js', array( 'customize-preview', 'jquery' ) );
	}
}
add_action( 'customize_preview_init', 'mtm_customizer_preview_scripts' );


/** Block Editor Assets **/
function mtm_add_block_editor_assets() {
	wp_enqueue_style( 'customizer-styles', MTM_OPTIONS_PLUGIN_DIR . 'css/customizer-style.css', false );
}
add_action( 'enqueue_block_editor_assets', 'mtm_add_block_editor_assets' );

/** WP Head **/
function mtm_add_wp_head_assets() {
	echo mtm_customizer_css_styles();
}
add_action( 'wp_head', 'mtm_add_wp_head_assets' );
add_action( 'admin_head', 'mtm_add_wp_head_assets' );

/**
* Load all our Customizer options
*/
require_once( MTM_OPTIONS_PLUGIN_DIR . 'lib/config.php' );
require_once( MTM_OPTIONS_PLUGIN_DIR . 'lib/helpers.php' );
require_once( MTM_OPTIONS_PLUGIN_DIR . 'lib/custom-controls.php' );
require_once( MTM_OPTIONS_PLUGIN_DIR . 'lib/customizer.php' );
// require_once( MTM_OPTIONS_PLUGIN_DIR . 'lib/customizer-demos.php' );
require_once( MTM_OPTIONS_PLUGIN_DIR . 'lib/block-templates.php' );
