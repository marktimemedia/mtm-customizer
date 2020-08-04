<?php
/*
	Plugin Name: Site Customizer
	Description: Customizer Settings for your base theme
	Author: Marktime Media
	Version: 1.0.4
	Author URI: http://marktimemedia.com
 */

// Plugin directory
define( 'MTM_OPTIONS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Plugin File URL
define( 'MTM_OPTIONS_FILE_URL', plugin_dir_url( __FILE__ ) );

/**
 * Enqueue scripts and styles.
 * Our sample Social Icons are using Font Awesome icons so we need to include the FA CSS when viewing our site
 * The Single Accordion Control is also displaying some FA icons in the Customizer itself, so we need to enqueue FA CSS in the Customizer too
 *
 * @return void
 */
if ( ! function_exists( 'mtm_scripts_styles' ) ) {
	function mtm_scripts_styles() {
		// Register and enqueue our icon font styles
		wp_enqueue_style( 'fontawesome', MTM_OPTIONS_FILE_URL . 'css/fontawesome-all.min.css', '', 1 );
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
		wp_enqueue_script( 'mtm-customizer-preview', MTM_OPTIONS_FILE_URL . 'js/customizer-preview.js', array( 'customize-preview', 'jquery' ), 1, false );
	}
}
add_action( 'customize_preview_init', 'mtm_customizer_preview_scripts' );


/** Block Editor Assets **/
function mtm_add_block_editor_assets() {
	wp_enqueue_style( 'customizer-styles', MTM_OPTIONS_FILE_URL . 'css/customizer-style.css', '', 1 );
}
add_action( 'enqueue_block_editor_assets', 'mtm_add_block_editor_assets' );


/** WP Head & Admin Head for Google Fonts **/
function mtm_add_wp_head_assets() {
	echo mtm_customizer_css_styles();
}
add_action( 'wp_head', 'mtm_add_wp_head_assets' );
add_action( 'admin_head', 'mtm_add_wp_head_assets' );


/**
 * Additional post label for 404 page
 */
function mtm_display_post_states( $states ) {
	$post = get_post();

	if ( 'page' !== $post->post_type ) {
		return $states;
	}

	$is_error = get_theme_mod( 'custom_error_page' );
	if ( $is_error === $post->ID ) {
		$states['custom_error_page'] = __( '404 Page', 'mtm' );
	}

	return $states;
}
add_filter( 'display_post_states', 'mtm_display_post_states' );

/**
* Load all our Customizer options
*/
require_once MTM_OPTIONS_PLUGIN_DIR . 'lib/config.php';
require_once MTM_OPTIONS_PLUGIN_DIR . 'lib/helpers.php';
require_once MTM_OPTIONS_PLUGIN_DIR . 'lib/custom-controls.php';
require_once MTM_OPTIONS_PLUGIN_DIR . 'lib/customizer.php';
// require_once MTM_OPTIONS_PLUGIN_DIR . 'lib/customizer-demos.php'; // demo customizer items for testing
require_once MTM_OPTIONS_PLUGIN_DIR . 'lib/block-templates.php';
