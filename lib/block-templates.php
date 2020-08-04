<?php
/**
* Register Blocks
*/
function mtm_register_acf_block_types() {
	/**
	 * Headline
	 */
	acf_register_block_type(
		array(
			'name'            => 'spring-headline',
			'title'           => 'Page Headline',
			'description'     => 'Display the WordPress page title in a block.',
			'render_template' => MTM_OPTIONS_PLUGIN_DIR . 'templates/wrapper-headline-block.php',
			'category'        => 'text',
			'icon'            => 'megaphone',
			'keywords'        => array( 'title', 'heading' ),
		)
	);

	/**
	 * Featured Image
	 */
	acf_register_block_type(
		array(
			'name'            => 'spring-featured-image',
			'title'           => 'Featured Image',
			'description'     => 'Display the WordPress featured image in a block.',
			'render_template' => MTM_OPTIONS_PLUGIN_DIR . 'templates/wrapper-featured-image-block.php',
			'category'        => 'text',
			'icon'            => 'image',
			'align'           => array( 'left', 'right', 'center' ),
			'keywords'        => array( 'image' ),
		)
	);
}
if ( function_exists( 'acf_register_block_type' ) ) {
		add_action( 'acf/init', 'mtm_register_acf_block_types' );
}

/**
* Custom Block Categories
*/
function mtm_block_categories( $categories ) {
		return array_merge(
			$categories,
			array(
				array(
					'slug'  => 'mtm-custom',
					'title' => 'Custom Blocks',
					'icon'  => 'screenoptions',
				),
			)
		);
}
// add_filter('block_categories', 'spring_block_categories', 10, 1);
