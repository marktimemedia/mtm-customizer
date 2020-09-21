<?php
/**
 * Customizer Setup and Custom Controls
 * @see https://github.com/maddisondesigns/customizer-custom-controls
 */

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class Mtm_Initialise_Customizer_Settings {
	// Get our default values
	private $defaults;

	public function __construct() {
		// Get our Customizer defaults
		$this->defaults = mtm_generate_defaults();
		$font_option    = ( '1' !== get_option( 'options_mtm_customizer_google_fonts' ) ) ? get_option( 'options_mtm_customizer_google_fonts' ) : true;

		add_action( 'customize_register', 'mtm_customize_register' );

		// Register our Panels
		add_action( 'customize_register', array( $this, 'mtm_add_customizer_panels' ) );

		// Register our sections
		add_action( 'customize_register', array( $this, 'mtm_add_customizer_sections' ) );

		// Register our visual controls
		add_action( 'customize_register', array( $this, 'mtm_register_visual_controls' ) );

		if ( $font_option ) {
			// Register our font controls
			add_action( 'customize_register', array( $this, 'mtm_register_font_controls' ) );
		}

		// Register our social media controls
		add_action( 'customize_register', array( $this, 'mtm_register_social_controls' ) );

		// Register our text controls
		add_action( 'customize_register', array( $this, 'mtm_register_text_controls' ) );

		// Register our search controls
		add_action( 'customize_register', array( $this, 'mtm_register_search_controls' ) );

		// Register our special page controls
		add_action( 'customize_register', array( $this, 'mtm_register_special_page_controls' ) );

	}

	/**
	 * Register the Customizer panels
	 */
	public function mtm_add_customizer_panels( $wp_customize ) {
		/**
		 * Add our Header & Navigation Panel
		 */
		$wp_customize->add_panel(
			'header_navigation_panel',
			array(
				'title'       => __( 'Site Text & Sharing', 'mtm' ),
				'description' => esc_html__( 'Adjust your Header and Navigation sections.', 'mtm' ),
				'priority'    => 59,
			)
		);
	}

	/**
	 * Register the Customizer sections
	 */
	public function mtm_add_customizer_sections( $wp_customize ) {
		/**
		* Add our Social Icons Section to the Header & Navigation Panel
		*/
		$wp_customize->add_section(
			'type_section',
			array(
				'title'    => __( 'Typography', 'mtm' ),
				'panel'    => 'site_branding_panel',
				'priority' => 10,
			)
		);

		$wp_customize->add_section(
			'social_icons_section',
			array(
				'title'       => __( 'Social Icons', 'mtm' ),
				'description' => esc_html__( 'Add your social media links and we\'ll automatically match them with the appropriate icons. Drag and drop the URLs to rearrange their order.', 'mtm' ),
				'panel'       => 'header_navigation_panel',
			)
		);

		/**
		 * Add our Header & Footer Section to the Header & Navigation Panel
		 */
		$wp_customize->add_section(
			'header_footer_section',
			array(
				'title'       => __( 'Header & Footer', 'mtm' ),
				'description' => esc_html__( 'Add supplemental text to the header and footer', 'mtm' ),
				'panel'       => 'header_navigation_panel',
			)
		);

		/**
		 * Add our Special Pages Section
		 */
		$wp_customize->add_section(
			'special_pages_section',
			array(
				'title'       => __( 'Special Pages', 'mtm' ),
				'description' => esc_html__( 'Special page settings', 'mtm' ),
				'priority'    => 62,
			)
		);

	}

	public function mtm_register_font_controls( $wp_customize ) {
		// Google Font Heading Control
		$wp_customize->add_setting(
			'heading_font_select',
			array(
				'default'           => $this->defaults['heading_font_select'],
				'sanitize_callback' => 'mtm_google_font_sanitization',
			)
		);
		$wp_customize->add_control(
			new Mtm_Google_Font_Select_Custom_Control(
				$wp_customize,
				'heading_font_select',
				array(
					'label'       => __( 'Heading Font', 'mtm' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'mtm' ),
					'section'     => 'type_section',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
					'priority'    => 10,
				)
			)
		);

		// Google Font Subheading Control
		$wp_customize->add_setting(
			'subheading_font_select',
			array(
				'default'           => $this->defaults['heading_font_select'],
				'sanitize_callback' => 'mtm_google_font_sanitization',
			)
		);
		$wp_customize->add_control(
			new Mtm_Google_Font_Select_Custom_Control(
				$wp_customize,
				'subheading_font_select',
				array(
					'label'       => __( 'Subheading Font', 'mtm' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'mtm' ),
					'section'     => 'type_section',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
					'priority'    => 10,
				)
			)
		);

		// Google Font Body Control
		$wp_customize->add_setting(
			'body_font_select',
			array(
				'default'           => $this->defaults['body_font_select'],
				'sanitize_callback' => 'mtm_google_font_sanitization',
			)
		);
		$wp_customize->add_control(
			new Mtm_Google_Font_Select_Custom_Control(
				$wp_customize,
				'body_font_select',
				array(
					'label'       => __( 'Body Font', 'mtm' ),
					'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'mtm' ),
					'section'     => 'type_section',
					'input_attrs' => array(
						'font_count' => 'all',
						'orderby'    => 'alpha',
					),
					'priority'    => 10,
				)
			)
		);
	}

	/**
	* Register Visual Controls
	*/

	public function mtm_register_visual_controls( $wp_customize ) {
		$custom_logo_args = get_theme_support( 'custom-logo' );

		// Mobile Logo
		$wp_customize->add_setting(
			'mtm_mobile_logo',
			array(
				'default'   => '',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'mtm_mobile_logo',
				array(
					'label'       => 'Mobile Logo',
					'settings'    => 'mtm_mobile_logo',
					'section'     => 'title_tagline',
					'height'      => 300,
					'width'       => 600,
					'flex_height' => true,
					'flex_width'  => true,
				)
			)
		);

		// Footer Logo
		$wp_customize->add_setting(
			'mtm_footer_logo',
			array(
				'default'   => '',
				'transport' => 'refresh',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'mtm_footer_logo',
				array(
					'label'       => 'Footer Logo',
					'settings'    => 'mtm_footer_logo',
					'section'     => 'title_tagline',
					'height'      => 300,
					'width'       => 600,
					'flex_height' => true,
					'flex_width'  => true,
				)
			)
		);

		// Default Image
		$wp_customize->add_setting(
			'mtm_default_image',
			array(
				'default'   => '',
				'transport' => 'refresh',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'mtm_default_image',
				array(
					'label'       => __( 'Default Featured Image' ),
					'description' => esc_html__( "Choose a default featured image to show if there isn't one selected" ),
					'settings'    => 'mtm_default_image',
					'section'     => 'header_image',
					'height'      => [300]['height'],
					'width'       => [600]['width'],
					'flex_height' => true,
					'flex_width'  => true,
					'priority'    => 62,
				)
			)
		);
	}

	/**
	 * Register our social media controls
	 */
	public function mtm_register_social_controls( $wp_customize ) {

		// Add our Checkbox switch setting and control for opening URLs in a new tab
		$wp_customize->add_setting(
			'social_newtab',
			array(
				'default'           => $this->defaults['social_newtab'],
				'transport'         => 'postMessage',
				'sanitize_callback' => 'mtm_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Mtm_Toggle_Switch_Custom_Control(
				$wp_customize,
				'social_newtab',
				array(
					'label'   => __( 'Open in new browser tab', 'mtm' ),
					'section' => 'social_icons_section',
				)
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'social_newtab',
			array(
				'selector'            => '.social',
				'container_inclusive' => false,
				'render_callback'     => function() {
					echo wp_kses_post( mtm_get_social_media() );
				},
				'fallback_refresh'    => true,
			)
		);

		// Add our Sortable Repeater setting and Custom Control for Social media URLs
		$wp_customize->add_setting(
			'social_urls',
			array(
				'default'           => $this->defaults['social_urls'],
				'transport'         => 'postMessage',
				'sanitize_callback' => 'mtm_url_sanitization',
			)
		);
		$wp_customize->add_control(
			new Mtm_Sortable_Repeater_Custom_Control(
				$wp_customize,
				'social_urls',
				array(
					'label'         => __( 'Social URLs', 'mtm' ),
					'description'   => esc_html__( 'Add your social media links.', 'mtm' ),
					'section'       => 'social_icons_section',
					'button_labels' => array(
						'add' => __( 'Add Icon', 'mtm' ),
					),
				)
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'social_urls',
			array(
				'selector'            => '.social',
				'container_inclusive' => false,
				'render_callback'     => function() {
					echo wp_kses_post( mtm_get_social_media() );
				},
				'fallback_refresh'    => true,
			)
		);

		// Add our Single Accordion setting and Custom Control to list the available Social Media icons
		$social_icons_list = array(
			'Behance'        => __( '<i class="fab fa-behance"></i>', 'mtm' ),
			'Bitbucket'      => __( '<i class="fab fa-bitbucket"></i>', 'mtm' ),
			'CodePen'        => __( '<i class="fab fa-codepen"></i>', 'mtm' ),
			'DeviantArt'     => __( '<i class="fab fa-deviantart"></i>', 'mtm' ),
			'Discord'        => __( '<i class="fab fa-discord"></i>', 'mtm' ),
			'Dribbble'       => __( '<i class="fab fa-dribbble"></i>', 'mtm' ),
			'Etsy'           => __( '<i class="fab fa-etsy"></i>', 'mtm' ),
			'Facebook'       => __( '<i class="fab fa-facebook-f"></i>', 'mtm' ),
			'Flickr'         => __( '<i class="fab fa-flickr"></i>', 'mtm' ),
			'Foursquare'     => __( '<i class="fab fa-foursquare"></i>', 'mtm' ),
			'GitHub'         => __( '<i class="fab fa-github"></i>', 'mtm' ),
			'Google+'        => __( '<i class="fab fa-google-plus-g"></i>', 'mtm' ),
			'Instagram'      => __( '<i class="fab fa-instagram"></i>', 'mtm' ),
			'Kickstarter'    => __( '<i class="fab fa-kickstarter-k"></i>', 'mtm' ),
			'Last.fm'        => __( '<i class="fab fa-lastfm"></i>', 'mtm' ),
			'LinkedIn'       => __( '<i class="fab fa-linkedin-in"></i>', 'mtm' ),
			'Medium'         => __( '<i class="fab fa-medium-m"></i>', 'mtm' ),
			'Patreon'        => __( '<i class="fab fa-patreon"></i>', 'mtm' ),
			'Pinterest'      => __( '<i class="fab fa-pinterest-p"></i>', 'mtm' ),
			'Reddit'         => __( '<i class="fab fa-reddit-alien"></i>', 'mtm' ),
			'Slack'          => __( '<i class="fab fa-slack-hash"></i>', 'mtm' ),
			'SlideShare'     => __( '<i class="fab fa-slideshare"></i>', 'mtm' ),
			'Snapchat'       => __( '<i class="fab fa-snapchat-ghost"></i>', 'mtm' ),
			'SoundCloud'     => __( '<i class="fab fa-soundcloud"></i>', 'mtm' ),
			'Spotify'        => __( '<i class="fab fa-spotify"></i>', 'mtm' ),
			'Stack Overflow' => __( '<i class="fab fa-stack-overflow"></i>', 'mtm' ),
			'Tumblr'         => __( '<i class="fab fa-tumblr"></i>', 'mtm' ),
			'Twitch'         => __( '<i class="fab fa-twitch"></i>', 'mtm' ),
			'Twitter'        => __( '<i class="fab fa-twitter"></i>', 'mtm' ),
			'Vimeo'          => __( '<i class="fab fa-vimeo-v"></i>', 'mtm' ),
			'Weibo'          => __( '<i class="fab fa-weibo"></i>', 'mtm' ),
			'YouTube'        => __( '<i class="fab fa-youtube"></i>', 'mtm' ),
		);
		$wp_customize->add_setting(
			'social_url_icons',
			array(
				'default'           => $this->defaults['social_url_icons'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'mtm_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Mtm_Single_Accordion_Custom_Control(
				$wp_customize,
				'social_url_icons',
				array(
					'label'       => __( 'View list of available icons', 'mtm' ),
					'description' => $social_icons_list,
					'section'     => 'social_icons_section',
				)
			)
		);

		// Add our Checkbox switch setting and Custom Control for displaying an RSS icon
		$wp_customize->add_setting(
			'social_rss',
			array(
				'default'           => $this->defaults['social_rss'],
				'transport'         => 'postMessage',
				'sanitize_callback' => 'mtm_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Mtm_Toggle_Switch_Custom_Control(
				$wp_customize,
				'social_rss',
				array(
					'label'   => __( 'Display RSS icon', 'mtm' ),
					'section' => 'social_icons_section',
				)
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'social_rss',
			array(
				'selector'            => '.social',
				'container_inclusive' => false,
				'render_callback'     => function() {
					echo wp_kses_post( mtm_get_social_media() );
				},
				'fallback_refresh'    => true,
			)
		);
	}

	/**
	 * Register our Text controls
	 */
	public function mtm_register_text_controls( $wp_customize ) {
		// Add our Text field setting and Control for displaying the phone number
		$wp_customize->add_setting(
			'contact_phone',
			array(
				'default'           => $this->defaults['contact_phone'],
				'transport'         => 'postMessage',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			)
		);
		$wp_customize->add_control(
			'contact_phone',
			array(
				'label'   => __( 'Phone number', 'mtm' ),
				'type'    => 'text',
				'section' => 'header_footer_section',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'contact_phone',
			array(
				'selector'            => '.phone',
				'container_inclusive' => false,
				'render_callback'     => function() {
					echo wp_kses_post( mtm_get_phone_number() );
				},
				'fallback_refresh'    => true,
			)
		);

		// Header Text
		$wp_customize->add_setting(
			'header_extra_text',
			array(
				'default'           => $this->defaults['header_extra_text'],
				'transport'         => 'postMessage',
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Mtm_TinyMCE_Custom_control(
				$wp_customize,
				'header_extra_text',
				array(
					'label'       => __( 'Header Text', 'mtm' ),
					'description' => __( 'Extra text or other information to show in the header. If none is entered, this field will be ignored in the layout.', 'mtm' ),
					'section'     => 'header_footer_section',
					'input_attrs' => array(
						'toolbar1'     => 'bold italic bullist numlist alignleft aligncenter alignright link',
						'mediaButtons' => false,
					),
				)
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'header_extra_text',
			array(
				'selector'            => '.header--extra-text',
				'container_inclusive' => false,
				'render_callback'     => 'get_mtm_header_text',
				'fallback_refresh'    => false,
			)
		);

		// Add our Text field setting and Control for displaying the phone number
		$wp_customize->add_setting(
			'copyright_text',
			array(
				'default'           => $this->defaults['copyright_text'],
				'transport'         => 'postMessage',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			)
		);
		$wp_customize->add_control(
			'copyright_text',
			array(
				'label'       => __( 'Copyright Text', 'mtm' ),
				'description' => __( 'Text that will show up next to the copyright year. If none is entered, this field will be ignored in the layout.', 'mtm' ),
				'type'        => 'text',
				'section'     => 'header_footer_section',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'copyright_text',
			array(
				'selector'            => '.footer--copyright',
				'container_inclusive' => false,
				'render_callback'     => 'the_mtm_footer_copyright',
				'fallback_refresh'    => true,
			)
		);

		// Footer Text
		$wp_customize->add_setting(
			'footer_text',
			array(
				'default'           => $this->defaults['footer_text'],
				'transport'         => 'postMessage',
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			new Mtm_TinyMCE_Custom_control(
				$wp_customize,
				'footer_text',
				array(
					'label'       => __( 'Footer Text', 'mtm' ),
					'description' => __( 'Extra text or other information to show in the footer. If none is entered, this field will be ignored in the layout.', 'mtm' ),
					'section'     => 'header_footer_section',
					'input_attrs' => array(
						'toolbar1'     => 'bold italic bullist numlist alignleft aligncenter alignright link',
						'mediaButtons' => false
					),
				)
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'footer_text',
			array(
				'selector'            => '.footer--extra-text',
				'container_inclusive' => false,
				'render_callback'     => 'get_mtm_footer_text',
				'fallback_refresh'    => false,
			)
		);
	}

	/**
	 * Register our Search controls
	 */
	public function mtm_register_search_controls( $wp_customize ) {
		// Add our Checkbox switch setting and control for opening URLs in a new tab
		$wp_customize->add_setting(
			'header_search_bar',
			array(
				'default'           => $this->defaults['header_search_bar'],
				'transport'         => 'postMessage',
				'sanitize_callback' => 'mtm_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Mtm_Toggle_Switch_Custom_Control(
				$wp_customize,
				'header_search_bar',
				array(
					'label'       => __( 'Display Search Bar', 'mtm' ),
					'description' => esc_html__( 'Show the search bar in the header', 'mtm' ),
					'section'     => 'header_footer_section',
					'priority'    => 1
				)
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'header_search_bar',
			array(
				'selector'            => '.header-main .search-form',
				'container_inclusive' => false,
				'render_callback'     => 'spring_search_bar',
				'fallback_refresh'    => false,
			)
		);
	}

	/**
	* Register Special Page Controls
	*/
	public function mtm_register_special_page_controls( $wp_customize ) {
		// Test of Dropdown Posts Control
		$wp_customize->add_setting(
			'custom_error_page',
			array(
				'default'           => $this->defaults['custom_error_page'],
				'transport'         => 'postMessage',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Mtm_Dropdown_Posts_Custom_Control(
				$wp_customize,
				'custom_error_page',
				array(
					'label'       => __( 'Custom Error Page', 'mtm' ),
					'description' => esc_html__( 'Select a custom 404 error page', 'mtm' ),
					'section'     => 'special_pages_section',
					'input_attrs' => array(
						'posts_per_page' => -1,
						'post_type'      => 'page',
						'orderby'        => 'name',
						'order'          => 'ASC',
					),
				)
			)
		);

		// Add our Checkbox switch setting and Custom Control for displaying search bar
		$wp_customize->add_setting(
			'error_page_search_bar',
			array(
				'default'           => $this->defaults['error_page_search_bar'],
				'transport'         => 'postMessage',
				'sanitize_callback' => 'mtm_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Mtm_Toggle_Switch_Custom_Control(
				$wp_customize,
				'error_page_search_bar',
				array(
					'label'       => __( 'Display search bar', 'mtm' ),
					'description' => esc_html__( 'Show the search bar on the error page', 'mtm' ),
					'section'     => 'special_pages_section',
				)
			)
		);
	}

}

/**
 * Initialise our Customizer settings
 */
$mtm_settings = new Mtm_Initialise_Customizer_Settings();
