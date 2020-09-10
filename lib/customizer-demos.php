<?php
/**
 * Demo Customizer Controls
 * @author Anthony Hortin <http://maddisondesigns.com>
 * @see https://github.com/maddisondesigns/customizer-custom-controls
 */

 /**
 * Set our Customizer default options
 */
 if ( ! function_exists( 'mtm_generate_demo_defaults' ) ) {
	function mtm_generate_demo_defaults() {
		$customizer_defaults = array(
			'woocommerce_shop_sidebar' => 1,
			'woocommerce_product_sidebar' => 0,
			'sample_toggle_switch' => 0,
			'sample_slider_control' => 48,
			'sample_slider_control_small_step' => 2,
			'sample_sortable_repeater_control' => '',
			'sample_image_radio_button' => 'sidebarright',
			'sample_text_radio_button' => 'right',
			'sample_image_checkbox' => 'stylebold,styleallcaps',
			'sample_single_accordion' => '',
			'sample_alpha_color' => 'rgba(209,0,55,0.7)',
			'sample_wpcolorpicker_alpha_color' => 'rgba(55,55,55,0.5)',
			'sample_wpcolorpicker_alpha_color2' => 'rgba(33,33,33,0.8)',
			'sample_pill_checkbox' => 'tiger,elephant,hippo',
			'sample_pill_checkbox2' => 'captainmarvel,msmarvel,squirrelgirl',
			'sample_pill_checkbox3' => 'author,categories,comments',
			'sample_simple_notice' => '',
			'sample_dropdown_select2_control_single' => 'vic',
			'sample_dropdown_select2_control_multi' => 'Antarctica/McMurdo,Australia/Melbourne,Australia/Broken_Hill',
			'sample_dropdown_select2_control_multi2' => 'Atlantic/Stanley,Australia/Darwin',
			'sample_dropdown_posts_control' => '',
			'sample_tinymce_editor' => '',
			'sample_google_font_select' => json_encode(
				array(
					'font' => 'Open Sans',
					'regularweight' => 'regular',
					'italicweight' => 'italic',
					'boldweight' => '700',
					'category' => 'sans-serif'
				)
			),
			'sample_default_text' => '',
			'sample_email_text' => '',
			'sample_url_text' => '',
			'sample_number_text' => '',
			'sample_hidden_text' => '',
			'sample_date_text' => '',
			'sample_default_checkbox' => 0,
			'sample_default_select' => 'jet-fuel',
			'sample_default_radio' => 'spider-man',
			'sample_default_dropdownpages' => '1548',
			'sample_dropdown_category_control' => '1',
			'sample_default_textarea' => '',
			'sample_default_color' => '#333',
			'sample_default_media' => '',
			'sample_default_image' => '',
			'sample_default_cropped_image' => '',
			'sample_date_only' => '2017-08-28',
			'sample_date_time' => '2017-08-28 16:30:00',
			'sample_date_time_no_past_date' => date( 'Y-m-d' ),
		);

		return apply_filters( 'mtm_customizer_defaults', $customizer_defaults );
	}
 }


/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class mtm_initialise_customizer_demo_settings extends mtm_initialise_customizer_settings {
	// Get our default values
	private $defaults;

	public function __construct() {
		// Get our Customizer defaults
		$this->defaults = mtm_generate_demo_defaults();

		add_action( 'customize_register', array( $this, 'mtm_add_customizer_demo_sections' ) );

		// Register our sample Custom Control controls
		add_action( 'customize_register', array( $this, 'mtm_register_sample_custom_controls' ) );

		// Register our sample default controls
		add_action( 'customize_register', array( $this, 'mtm_register_sample_default_controls' ) );

	}



	/**
	 * Register the Customizer sections
	 */
	public function mtm_add_customizer_demo_sections( $wp_customize ) {
		/**
		 * Add our WooCommerce Layout Section, only if WooCommerce is active
		 */
		$wp_customize->add_section( 'woocommerce_layout_section',
			array(
				'title' => __( 'WooCommerce Layout', 'mtm' ),
				'description' => esc_html__( 'Adjust the layout of your WooCommerce shop.', 'mtm' ),
				'active_callback' => 'mtm_is_woocommerce_active'
			)
		);

		/**
		 * Add our section that contains examples of our Custom Controls
		 */
		$wp_customize->add_section( 'sample_custom_controls_section',
			array(
				'title' => __( 'Sample Custom Controls', 'mtm' ),
				'description' => esc_html__( 'These are an example of Customizer Custom Controls.', 'mtm'  ),
				'priority' => 1,
			)
		);

		/**
		 * Add our section that contains examples of the default Core Customizer Controls
		 */
		$wp_customize->add_section( 'default_controls_section',
			array(
				'title' => __( 'Sample Default Controls', 'mtm' ),
				'description' => esc_html__( 'These are an example of the default Customizer Controls.', 'mtm'  ),
				'priority' => 1,
			)
		);

		/**
		 * Add our Upsell Section
		 */
		$wp_customize->add_section( new Mtm_Upsell_Section( $wp_customize, 'upsell_section',
			array(
				'title' => __( 'Test Upsell Section', 'mtm' ),
				'url' => 'https://marktimemedia.com',
				'backgroundcolor' => '#de1e7e',
				'textcolor' => '#fff',
				'priority' => 0,
			)
		) );
	}




	/**
	 * Register our sample custom controls
	 */
	public function mtm_register_sample_custom_controls( $wp_customize ) {

		// Test of Toggle Switch Custom Control
		$wp_customize->add_setting( 'sample_toggle_switch',
			array(
				'default' => $this->defaults['sample_toggle_switch'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Toggle_Switch_Custom_Control( $wp_customize, 'sample_toggle_switch',
			array(
				'label' => __( 'Toggle switch', 'mtm' ),
				'section' => 'sample_custom_controls_section'
			)
		) );

		// Test of Slider Custom Control
		$wp_customize->add_setting( 'sample_slider_control',
			array(
				'default' => $this->defaults['sample_slider_control'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( new Mtm_Slider_Custom_Control( $wp_customize, 'sample_slider_control',
			array(
				'label' => __( 'Slider Control (px)', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'min' => 10,
					'max' => 90,
					'step' => 1,
				),
			)
		) );

		// Another Test of Slider Custom Control
		$wp_customize->add_setting( 'sample_slider_control_small_step',
			array(
				'default' => $this->defaults['sample_slider_control_small_step'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_range_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Slider_Custom_Control( $wp_customize, 'sample_slider_control_small_step',
			array(
				'label' => __( 'Slider Control With a Small Step', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'min' => 0,
					'max' => 4,
					'step' => .5,
				),
			)
		) );

		// Add our Sortable Repeater setting and Custom Control for Social media URLs
		$wp_customize->add_setting( 'sample_sortable_repeater_control',
			array(
				'default' => $this->defaults['sample_sortable_repeater_control'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_url_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Sortable_Repeater_Custom_Control( $wp_customize, 'sample_sortable_repeater_control',
			array(
				'label' => __( 'Sortable Repeater', 'mtm' ),
				'description' => esc_html__( 'This is the control description.', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'button_labels' => array(
					'add' => __( 'Add Row', 'mtm' ),
				)
			)
		) );

		// Test of Image Radio Button Custom Control
		$wp_customize->add_setting( 'sample_image_radio_button',
			array(
				'default' => $this->defaults['sample_image_radio_button'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_radio_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Image_Radio_Button_Custom_Control( $wp_customize, 'sample_image_radio_button',
			array(
				'label' => __( 'Image Radio Button Control', 'mtm' ),
				'description' => esc_html__( 'Sample custom control description', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'choices' => array(
					'sidebarleft' => array(
						'image' => MTM_OPTIONS_PLUGIN_DIR . 'images/sidebar-left.png',
						'name' => __( 'Left Sidebar', 'mtm' )
					),
					'sidebarnone' => array(
						'image' => MTM_OPTIONS_PLUGIN_DIR . 'images/sidebar-none.png',
						'name' => __( 'No Sidebar', 'mtm' )
					),
					'sidebarright' => array(
						'image' => MTM_OPTIONS_PLUGIN_DIR . 'images/sidebar-right.png',
						'name' => __( 'Right Sidebar', 'mtm' )
					)
				)
			)
		) );

		// Test of Text Radio Button Custom Control
		$wp_customize->add_setting( 'sample_text_radio_button',
			array(
				'default' => $this->defaults['sample_text_radio_button'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_radio_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Text_Radio_Button_Custom_Control( $wp_customize, 'sample_text_radio_button',
			array(
				'label' => __( 'Text Radio Button Control', 'mtm' ),
				'description' => esc_html__( 'Sample custom control description', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'choices' => array(
					'left' => __( 'Left', 'mtm' ),
					'centered' => __( 'Centered', 'mtm' ),
					'right' => __( 'Right', 'mtm'  )
				)
			)
		) );

		// Test of Image Checkbox Custom Control
		$wp_customize->add_setting( 'sample_image_checkbox',
			array(
				'default' => $this->defaults['sample_image_checkbox'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_text_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Image_checkbox_Custom_Control( $wp_customize, 'sample_image_checkbox',
			array(
				'label' => __( 'Image Checkbox Control', 'mtm' ),
				'description' => esc_html__( 'Sample custom control description', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'choices' => array(
					'stylebold' => array(
						'image' => MTM_OPTIONS_PLUGIN_DIR . 'images/Bold.png',
						'name' => __( 'Bold', 'mtm' )
					),
					'styleitalic' => array(
						'image' => MTM_OPTIONS_PLUGIN_DIR . 'images/Italic.png',
						'name' => __( 'Italic', 'mtm' )
					),
					'styleallcaps' => array(
						'image' => MTM_OPTIONS_PLUGIN_DIR . 'images/AllCaps.png',
						'name' => __( 'All Caps', 'mtm' )
					),
					'styleunderline' => array(
						'image' => MTM_OPTIONS_PLUGIN_DIR . 'images/Underline.png',
						'name' => __( 'Underline', 'mtm' )
					)
				)
			)
		) );

		// Test of Single Accordion Control
		$sampleIconsList = array(
			'Behance' => __( '<i class="fab fa-behance"></i>', 'mtm' ),
			'Bitbucket' => __( '<i class="fab fa-bitbucket"></i>', 'mtm' ),
			'CodePen' => __( '<i class="fab fa-codepen"></i>', 'mtm' ),
			'DeviantArt' => __( '<i class="fab fa-deviantart"></i>', 'mtm' ),
			'Discord' => __( '<i class="fab fa-discord"></i>', 'mtm' ),
			'Dribbble' => __( '<i class="fab fa-dribbble"></i>', 'mtm' ),
			'Etsy' => __( '<i class="fab fa-etsy"></i>', 'mtm' ),
			'Facebook' => __( '<i class="fab fa-facebook-f"></i>', 'mtm' ),
			'Flickr' => __( '<i class="fab fa-flickr"></i>', 'mtm' ),
			'Foursquare' => __( '<i class="fab fa-foursquare"></i>', 'mtm' ),
			'GitHub' => __( '<i class="fab fa-github"></i>', 'mtm' ),
			'Google+' => __( '<i class="fab fa-google-plus-g"></i>', 'mtm' ),
			'Instagram' => __( '<i class="fab fa-instagram"></i>', 'mtm' ),
			'Kickstarter' => __( '<i class="fab fa-kickstarter-k"></i>', 'mtm' ),
			'Last.fm' => __( '<i class="fab fa-lastfm"></i>', 'mtm' ),
			'LinkedIn' => __( '<i class="fab fa-linkedin-in"></i>', 'mtm' ),
			'Medium' => __( '<i class="fab fa-medium-m"></i>', 'mtm' ),
			'Patreon' => __( '<i class="fab fa-patreon"></i>', 'mtm' ),
			'Pinterest' => __( '<i class="fab fa-pinterest-p"></i>', 'mtm' ),
			'Reddit' => __( '<i class="fab fa-reddit-alien"></i>', 'mtm' ),
			'Slack' => __( '<i class="fab fa-slack-hash"></i>', 'mtm' ),
			'SlideShare' => __( '<i class="fab fa-slideshare"></i>', 'mtm' ),
			'Snapchat' => __( '<i class="fab fa-snapchat-ghost"></i>', 'mtm' ),
			'SoundCloud' => __( '<i class="fab fa-soundcloud"></i>', 'mtm' ),
			'Spotify' => __( '<i class="fab fa-spotify"></i>', 'mtm' ),
			'Stack Overflow' => __( '<i class="fab fa-stack-overflow"></i>', 'mtm' ),
			'Tumblr' => __( '<i class="fab fa-tumblr"></i>', 'mtm' ),
			'Twitch' => __( '<i class="fab fa-twitch"></i>', 'mtm' ),
			'Twitter' => __( '<i class="fab fa-twitter"></i>', 'mtm' ),
			'Vimeo' => __( '<i class="fab fa-vimeo-v"></i>', 'mtm' ),
			'Weibo' => __( '<i class="fab fa-weibo"></i>', 'mtm' ),
			'YouTube' => __( '<i class="fab fa-youtube"></i>', 'mtm' ),
		);
		$wp_customize->add_setting( 'sample_single_accordion',
			array(
				'default' => $this->defaults['sample_single_accordion'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_text_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Single_Accordion_Custom_Control( $wp_customize, 'sample_single_accordion',
			array(
				'label' => __( 'Single Accordion Control', 'mtm' ),
				'description' => $sampleIconsList,
				'section' => 'sample_custom_controls_section'
			)
		) );

		// Test of Alpha Color Picker Control
		$wp_customize->add_setting( 'sample_alpha_color',
			array(
				'default' => $this->defaults['sample_alpha_color'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'mtm_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Customize_Alpha_Color_Control( $wp_customize, 'sample_alpha_color',
			array(
				'label' => __( 'Alpha Color Picker Control', 'mtm' ),
				'description' => esc_html__( 'Sample custom control description', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'show_opacity' => true,
				'palette' => array(
					'#000',
					'#fff',
					'#df312c',
					'#df9a23',
					'#eef000',
					'#7ed934',
					'#1571c1',
					'#8309e7'
				)
			)
		) );

		// Test of WPColorPicker Alpha Color Picker Control
		$wp_customize->add_setting( 'sample_wpcolorpicker_alpha_color',
			array(
				'default' => $this->defaults['sample_wpcolorpicker_alpha_color'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Alpha_Color_Control( $wp_customize, 'sample_wpcolorpicker_alpha_color',
			array(
				'label' => __( 'WP ColorPicker Alpha Color Picker', 'mtm' ),
				'description' => esc_html__( 'Sample color control with Alpha channel', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'palette' => array(
						'#000000',
						'#ffffff',
						'#dd3333',
						'#dd9933',
						'#eeee22',
						'#81d742',
						'#1e73be',
						'#8224e3',
					)
				),
			)
		) );

		// Another Test of WPColorPicker Alpha Color Picker Control
		$wp_customize->add_setting( 'sample_wpcolorpicker_alpha_color2',
			array(
				'default' => $this->defaults['sample_wpcolorpicker_alpha_color2'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Alpha_Color_Control( $wp_customize, 'sample_wpcolorpicker_alpha_color2',
			array(
				'label' => __( 'WP ColorPicker Alpha Color Picker', 'mtm' ),
				'description' => esc_html__( 'Sample color control with Alpha channel', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'resetalpha' => false,
					'palette' => array(
						'rgba(99,78,150,1)',
						'rgba(67,78,150,1)',
						'rgba(34,78,150,.7)',
						'rgba(3,78,150,1)',
						'rgba(7,110,230,.9)',
						'rgba(234,78,150,1)',
						'rgba(99,78,150,.5)',
						'rgba(190,120,120,.5)',
					),
				),
			)
		) );

		// Test of Pill Checkbox Custom Control
		$wp_customize->add_setting( 'sample_pill_checkbox',
			array(
				'default' => $this->defaults['sample_pill_checkbox'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_text_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Pill_Checkbox_Custom_Control( $wp_customize, 'sample_pill_checkbox',
			array(
				'label' => __( 'Pill Checkbox Control', 'mtm' ),
				'description' => esc_html__( 'This is a sample Pill Checkbox Control', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'sortable' => false,
					'fullwidth' => false,
				),
				'choices' => array(
					'tiger' => __( 'Tiger', 'mtm' ),
					'lion' => __( 'Lion', 'mtm' ),
					'giraffe' => __( 'Giraffe', 'mtm'  ),
					'elephant' => __( 'Elephant', 'mtm'  ),
					'hippo' => __( 'Hippo', 'mtm'  ),
					'rhino' => __( 'Rhino', 'mtm'  ),
				)
			)
		) );

		// Test of Pill Checkbox Custom Control
		$wp_customize->add_setting( 'sample_pill_checkbox2',
			array(
				'default' => $this->defaults['sample_pill_checkbox2'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_text_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Pill_Checkbox_Custom_Control( $wp_customize, 'sample_pill_checkbox2',
			array(
				'label' => __( 'Pill Checkbox Control', 'mtm' ),
				'description' => esc_html__( 'This is a sample Sortable Pill Checkbox Control', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'sortable' => true,
					'fullwidth' => false,
				),
				'choices' => array(
					'captainamerica' => __( 'Captain America', 'mtm' ),
					'ironman' => __( 'Iron Man', 'mtm' ),
					'captainmarvel' => __( 'Captain Marvel', 'mtm'  ),
					'msmarvel' => __( 'Ms. Marvel', 'mtm'  ),
					'Jessicajones' => __( 'Jessica Jones', 'mtm'  ),
					'squirrelgirl' => __( 'Squirrel Girl', 'mtm'  ),
					'blackwidow' => __( 'Black Widow', 'mtm'  ),
					'hulk' => __( 'Hulk', 'mtm'  ),
				)
			)
		) );

		// Test of Pill Checkbox Custom Control
		$wp_customize->add_setting( 'sample_pill_checkbox3',
			array(
				'default' => $this->defaults['sample_pill_checkbox3'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_text_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Pill_Checkbox_Custom_Control( $wp_customize, 'sample_pill_checkbox3',
			array(
				'label' => __( 'Pill Checkbox Control', 'mtm' ),
				'description' => esc_html__( 'This is a sample Sortable Fullwidth Pill Checkbox Control', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'sortable' => true,
					'fullwidth' => true,
				),
				'choices' => array(
					'date' => __( 'Date', 'mtm' ),
					'author' => __( 'Author', 'mtm' ),
					'categories' => __( 'Categories', 'mtm'  ),
					'tags' => __( 'Tags', 'mtm'  ),
					'comments' => __( 'Comments', 'mtm'  ),
				)
			)
		) );

		// Test of Simple Notice control
		$wp_customize->add_setting( 'sample_simple_notice',
			array(
				'default' => $this->defaults['sample_simple_notice'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'mtm_text_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Simple_Notice_Custom_control( $wp_customize, 'sample_simple_notice',
			array(
				'label' => __( 'Simple Notice Control', 'mtm' ),
				'description' => __( 'This Custom Control allows you to display a simple title and description to your users. You can even include <a href="http://google.com" target="_blank">basic html</a>.', 'mtm' ),
				'section' => 'sample_custom_controls_section'
			)
		) );

		// Test of Dropdown Select2 Control (single select)
		$wp_customize->add_setting( 'sample_dropdown_select2_control_single',
			array(
				'default' => $this->defaults['sample_dropdown_select2_control_single'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_text_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Dropdown_Select2_Custom_Control( $wp_customize, 'sample_dropdown_select2_control_single',
			array(
				'label' => __( 'Dropdown Select2 Control', 'mtm' ),
				'description' => esc_html__( 'Sample Dropdown Select2 custom control (Single Select)', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'placeholder' => __( 'Please select a state...', 'mtm' ),
					'multiselect' => false,
				),
				'choices' => array(
					'nsw' => __( 'New South Wales', 'mtm' ),
					'vic' => __( 'Victoria', 'mtm' ),
					'qld' => __( 'Queensland', 'mtm' ),
					'wa' => __( 'Western Australia', 'mtm' ),
					'sa' => __( 'South Australia', 'mtm' ),
					'tas' => __( 'Tasmania', 'mtm' ),
					'act' => __( 'Australian Capital Territory', 'mtm' ),
					'nt' => __( 'Northern Territory', 'mtm' ),
				)
			)
		) );

		// Test of Dropdown Select2 Control (Multi-Select)
		$wp_customize->add_setting( 'sample_dropdown_select2_control_multi',
			array(
				'default' => $this->defaults['sample_dropdown_select2_control_multi'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_text_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Dropdown_Select2_Custom_Control( $wp_customize, 'sample_dropdown_select2_control_multi',
			array(
				'label' => __( 'Dropdown Select2 Control', 'mtm' ),
				'description' => esc_html__( 'Sample Dropdown Select2 custom control  (Multi-Select)', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'multiselect' => true,
				),
				'choices' => array(
					__( 'Antarctica', 'mtm' ) => array(
						'Antarctica/Casey' => __( 'Casey', 'mtm' ),
						'Antarctica/Davis' => __( 'Davis', 'mtm' ),
						'Antarctica/DumontDurville' => __( 'DumontDUrville', 'mtm' ),
						'Antarctica/Macquarie' => __( 'Macquarie', 'mtm' ),
						'Antarctica/Mawson' => __( 'Mawson', 'mtm' ),
						'Antarctica/McMurdo' => __( 'McMurdo', 'mtm' ),
						'Antarctica/Palmer' => __( 'Palmer', 'mtm' ),
						'Antarctica/Rothera' => __( 'Rothera', 'mtm' ),
						'Antarctica/Syowa' => __( 'Syowa', 'mtm' ),
						'Antarctica/Troll' => __( 'Troll', 'mtm' ),
						'Antarctica/Vostok' => __( 'Vostok', 'mtm' ),
					),
					__( 'Atlantic', 'mtm' ) => array(
						'Atlantic/Azores' => __( 'Azores', 'mtm' ),
						'Atlantic/Bermuda' => __( 'Bermuda', 'mtm' ),
						'Atlantic/Canary' => __( 'Canary', 'mtm' ),
						'Atlantic/Cape_Verde' => __( 'Cape Verde', 'mtm' ),
						'Atlantic/Faroe' => __( 'Faroe', 'mtm' ),
						'Atlantic/Madeira' => __( 'Madeira', 'mtm' ),
						'Atlantic/Reykjavik' => __( 'Reykjavik', 'mtm' ),
						'Atlantic/South_Georgia' => __( 'South Georgia', 'mtm' ),
						'Atlantic/Stanley' => __( 'Stanley', 'mtm' ),
						'Atlantic/St_Helena' => __( 'St Helena', 'mtm' ),
					),
					__( 'Australia', 'mtm' ) => array(
						'Australia/Adelaide' => __( 'Adelaide', 'mtm' ),
						'Australia/Brisbane' => __( 'Brisbane', 'mtm' ),
						'Australia/Broken_Hill' => __( 'Broken Hill', 'mtm' ),
						'Australia/Currie' => __( 'Currie', 'mtm' ),
						'Australia/Darwin' => __( 'Darwin', 'mtm' ),
						'Australia/Eucla' => __( 'Eucla', 'mtm' ),
						'Australia/Hobart' => __( 'Hobart', 'mtm' ),
						'Australia/Lindeman' => __( 'Lindeman', 'mtm' ),
						'Australia/Lord_Howe' => __( 'Lord Howe', 'mtm' ),
						'Australia/Melbourne' => __( 'Melbourne', 'mtm' ),
						'Australia/Perth' => __( 'Perth', 'mtm' ),
						'Australia/Sydney' => __( 'Sydney', 'mtm' ),
					)
				)
			)
		) );

		// Test of Dropdown Select2 Control (Multi-Select) with single array choice
		$wp_customize->add_setting( 'sample_dropdown_select2_control_multi2',
			array(
				'default' => $this->defaults['sample_dropdown_select2_control_multi2'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_text_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Dropdown_Select2_Custom_Control( $wp_customize, 'sample_dropdown_select2_control_multi2',
			array(
				'label' => __( 'Dropdown Select2 Control', 'mtm' ),
				'description' => esc_html__( 'Another Sample Dropdown Select2 custom control (Multi-Select)', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'multiselect' => true,
				),
				'choices' => array(
					'Antarctica/Casey' => __( 'Casey', 'mtm' ),
					'Antarctica/Davis' => __( 'Davis', 'mtm' ),
					'Antarctica/DumontDurville' => __( 'DumontDUrville', 'mtm' ),
					'Antarctica/Macquarie' => __( 'Macquarie', 'mtm' ),
					'Antarctica/Mawson' => __( 'Mawson', 'mtm' ),
					'Antarctica/McMurdo' => __( 'McMurdo', 'mtm' ),
					'Antarctica/Palmer' => __( 'Palmer', 'mtm' ),
					'Antarctica/Rothera' => __( 'Rothera', 'mtm' ),
					'Antarctica/Syowa' => __( 'Syowa', 'mtm' ),
					'Antarctica/Troll' => __( 'Troll', 'mtm' ),
					'Antarctica/Vostok' => __( 'Vostok', 'mtm' ),
					'Atlantic/Azores' => __( 'Azores', 'mtm' ),
					'Atlantic/Bermuda' => __( 'Bermuda', 'mtm' ),
					'Atlantic/Canary' => __( 'Canary', 'mtm' ),
					'Atlantic/Cape_Verde' => __( 'Cape Verde', 'mtm' ),
					'Atlantic/Faroe' => __( 'Faroe', 'mtm' ),
					'Atlantic/Madeira' => __( 'Madeira', 'mtm' ),
					'Atlantic/Reykjavik' => __( 'Reykjavik', 'mtm' ),
					'Atlantic/South_Georgia' => __( 'South Georgia', 'mtm' ),
					'Atlantic/Stanley' => __( 'Stanley', 'mtm' ),
					'Atlantic/St_Helena' => __( 'St Helena', 'mtm' ),
					'Australia/Adelaide' => __( 'Adelaide', 'mtm' ),
					'Australia/Brisbane' => __( 'Brisbane', 'mtm' ),
					'Australia/Broken_Hill' => __( 'Broken Hill', 'mtm' ),
					'Australia/Currie' => __( 'Currie', 'mtm' ),
					'Australia/Darwin' => __( 'Darwin', 'mtm' ),
					'Australia/Eucla' => __( 'Eucla', 'mtm' ),
					'Australia/Hobart' => __( 'Hobart', 'mtm' ),
					'Australia/Lindeman' => __( 'Lindeman', 'mtm' ),
					'Australia/Lord_Howe' => __( 'Lord Howe', 'mtm' ),
					'Australia/Melbourne' => __( 'Melbourne', 'mtm' ),
					'Australia/Perth' => __( 'Perth', 'mtm' ),
					'Australia/Sydney' => __( 'Sydney', 'mtm' ),
				)
			)
		) );

		// Test of Dropdown Posts Control
		$wp_customize->add_setting( 'sample_dropdown_posts_control',
			array(
				'default' => $this->defaults['sample_dropdown_posts_control'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( new Mtm_Dropdown_Posts_Custom_Control( $wp_customize, 'sample_dropdown_posts_control',
			array(
				'label' => __( 'Dropdown Posts Control', 'mtm' ),
				'description' => esc_html__( 'Sample Dropdown Posts custom control description', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'posts_per_page' => -1,
					'orderby' => 'name',
					'order' => 'ASC',
				),
			)
		) );

		// Test of Dropdown Category Control
		$wp_customize->add_setting(
			'sample_dropdown_category_control',
			array(
				'default'           => $this->defaults['sample_dropdown_category_control'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Mtm_Dropdown_Category_Custom_Control(
				$wp_customize,
				'sample_dropdown_category_control',
				array(
					'label'         => __( 'Dropdown Category Control', 'mtm' ),
					'description'   => esc_html__( 'Sample Dropdown Category custom control description', 'mtm' ),
					'section'       => 'sample_custom_controls_section',
					'dropdown_args' => array(
						'taxonomy'   => 'category',
						'orderby'    => 'id',
						'order'      => 'ASC',
						'hide_empty' => 1,
					),
				)
			)
		);

		// Test of TinyMCE control
		$wp_customize->add_setting( 'sample_tinymce_editor',
			array(
				'default' => $this->defaults['sample_tinymce_editor'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'wp_kses_post'
			)
		);
		$wp_customize->add_control( new Mtm_TinyMCE_Custom_control( $wp_customize, 'sample_tinymce_editor',
			array(
				'label' => __( 'TinyMCE Control', 'mtm' ),
				'description' => __( 'This is a TinyMCE Editor Custom Control', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
					'mediaButtons' => true,
				)
			)
		) );
		$wp_customize->selective_refresh->add_partial( 'sample_tinymce_editor',
			array(
				'selector' => '.footer-credits',
				'container_inclusive' => false,
				'render_callback' => 'mtm_get_credits_render_callback',
				'fallback_refresh' => false,
			)
		);

		// Test of Google Font Select Control
		$wp_customize->add_setting( 'sample_google_font_select',
			array(
				'default' => $this->defaults['sample_google_font_select'],
				'sanitize_callback' => 'mtm_google_font_sanitization'
			)
		);
		$wp_customize->add_control( new Mtm_Google_Font_Select_Custom_Control( $wp_customize, 'sample_google_font_select',
			array(
				'label' => __( 'Google Font Control', 'mtm' ),
				'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'mtm' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'font_count' => 'all',
					'orderby' => 'alpha',
				),
			)
		) );
	}

	/**
	 * Register our sample default controls
	 */
	public function mtm_register_sample_default_controls( $wp_customize ) {

		// Test of Text Control
		$wp_customize->add_setting( 'sample_default_text',
			array(
				'default' => $this->defaults['sample_default_text'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_text_sanitization'
			)
		);
		$wp_customize->add_control( 'sample_default_text',
			array(
				'label' => __( 'Default Text Control', 'mtm' ),
				'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'mtm' ),
				'section' => 'default_controls_section',
				'type' => 'text',
				'input_attrs' => array(
					'class' => 'my-custom-class',
					'style' => 'border: 1px solid rebeccapurple',
					'placeholder' => __( 'Enter name...', 'mtm' ),
				),
			)
		);

		// Test of Email Control
		$wp_customize->add_setting( 'sample_email_text',
			array(
				'default' => $this->defaults['sample_email_text'],
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_email'
			)
		);
		$wp_customize->add_control( 'sample_email_text',
			array(
				'label' => __( 'Default Email Control', 'mtm' ),
				'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'mtm' ),
				'section' => 'default_controls_section',
				'type' => 'email'
			)
		);

		// Test of URL Control
		$wp_customize->add_setting( 'sample_url_text',
			array(
				'default' => $this->defaults['sample_url_text'],
				'transport' => 'refresh',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		$wp_customize->add_control( 'sample_url_text',
			array(
				'label' => __( 'Default URL Control', 'mtm' ),
				'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'mtm' ),
				'section' => 'default_controls_section',
				'type' => 'url'
			)
		);

		// Test of Number Control
		$wp_customize->add_setting( 'sample_number_text',
			array(
				'default' => $this->defaults['sample_number_text'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_sanitize_integer'
			)
		);
		$wp_customize->add_control( 'sample_number_text',
			array(
				'label' => __( 'Default Number Control', 'mtm' ),
				'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'mtm' ),
				'section' => 'default_controls_section',
				'type' => 'number'
			)
		);

		// Test of Hidden Control
		$wp_customize->add_setting( 'sample_hidden_text',
			array(
				'default' => $this->defaults['sample_hidden_text'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_text_sanitization'
			)
		);
		$wp_customize->add_control( 'sample_hidden_text',
			array(
				'label' => __( 'Default Hidden Control', 'mtm' ),
				'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'mtm' ),
				'section' => 'default_controls_section',
				'type' => 'hidden'
			)
		);

		// Test of Date Control
		$wp_customize->add_setting( 'sample_date_text',
			array(
				'default' => $this->defaults['sample_date_text'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_text_sanitization'
			)
		);
		$wp_customize->add_control( 'sample_date_text',
			array(
				'label' => __( 'Default Date Control', 'mtm' ),
				'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'mtm' ),
				'section' => 'default_controls_section',
				'type' => 'text'
			)
		);

		 // Test of Standard Checkbox Control
		$wp_customize->add_setting( 'sample_default_checkbox',
			array(
				'default' => $this->defaults['sample_default_checkbox'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_switch_sanitization'
			)
		);
		$wp_customize->add_control( 'sample_default_checkbox',
			array(
				'label' => __( 'Default Checkbox Control', 'mtm' ),
				'description' => esc_html__( 'Sample Checkbox description', 'mtm' ),
				'section' => 'default_controls_section',
				'type' => 'checkbox'
			)
		);

		// Test of Standard Select Control
		$wp_customize->add_setting( 'sample_default_select',
			array(
				'default' => $this->defaults['sample_default_select'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_radio_sanitization'
			)
		);
		$wp_customize->add_control( 'sample_default_select',
			array(
				'label' => __( 'Standard Select Control', 'mtm' ),
				'section' => 'default_controls_section',
				'type' => 'select',
				'choices' => array(
					'wordpress' => __( 'WordPress', 'mtm' ),
					'hamsters' => __( 'Hamsters', 'mtm' ),
					'jet-fuel' => __( 'Jet Fuel', 'mtm' ),
					'nuclear-energy' => __( 'Nuclear Energy', 'mtm' )
				)
			)
		);

		// Test of Standard Radio Control
		$wp_customize->add_setting( 'sample_default_radio',
			array(
				'default' => $this->defaults['sample_default_radio'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_radio_sanitization'
			)
		);
		$wp_customize->add_control( 'sample_default_radio',
			array(
				'label' => __( 'Standard Radio Control', 'mtm' ),
				'section' => 'default_controls_section',
				'type' => 'radio',
				'choices' => array(
					'captain-america' => __( 'Captain America', 'mtm' ),
					'iron-man' => __( 'Iron Man', 'mtm' ),
					'spider-man' => __( 'Spider-Man', 'mtm' ),
					'thor' => __( 'Thor', 'mtm' )
				)
			)
		);

		// Test of Dropdown Pages Control
		$wp_customize->add_setting( 'sample_default_dropdownpages',
			array(
				'default' => $this->defaults['sample_default_dropdownpages'],
				'transport' => 'refresh',
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( 'sample_default_dropdownpages',
			array(
				'label' => __( 'Default Dropdown Pages Control', 'mtm' ),
				'section' => 'default_controls_section',
				'type' => 'dropdown-pages'
			)
		);

		// Test of Textarea Control
		$wp_customize->add_setting( 'sample_default_textarea',
			array(
				'default' => $this->defaults['sample_default_textarea'],
				'transport' => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
		);
		$wp_customize->add_control( 'sample_default_textarea',
			array(
				'label' => __( 'Default Textarea Control', 'mtm' ),
				'section' => 'default_controls_section',
				'type' => 'textarea',
				'input_attrs' => array(
					'class' => 'my-custom-class',
					'style' => 'border: 1px solid #999',
					'placeholder' => __( 'Enter message...', 'mtm' ),
				),
			)
		);

		// Test of Color Control
		$wp_customize->add_setting( 'sample_default_color',
			array(
				'default' => $this->defaults['sample_default_color'],
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control( 'sample_default_color',
			array(
				'label' => __( 'Default Color Control', 'mtm' ),
				'section' => 'default_controls_section',
				'type' => 'color'
			)
		);

		// Test of Media Control
		$wp_customize->add_setting( 'sample_default_media',
			array(
				'default' => $this->defaults['sample_default_media'],
				'transport' => 'refresh',
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'sample_default_media',
			array(
				'label' => __( 'Default Media Control', 'mtm' ),
				'description' => esc_html__( 'This is the description for the Media Control', 'mtm' ),
				'section' => 'default_controls_section',
				'mime_type' => 'image',
				'button_labels' => array(
					'select' => __( 'Select File', 'mtm' ),
					'change' => __( 'Change File', 'mtm' ),
					'default' => __( 'Default', 'mtm' ),
					'remove' => __( 'Remove', 'mtm' ),
					'placeholder' => __( 'No file selected', 'mtm' ),
					'frame_title' => __( 'Select File', 'mtm' ),
					'frame_button' => __( 'Choose File', 'mtm' ),
				)
			)
		) );

		// Test of Image Control
		$wp_customize->add_setting( 'sample_default_image',
			array(
				'default' => $this->defaults['sample_default_image'],
				'transport' => 'refresh',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sample_default_image',
			array(
				'label' => __( 'Default Image Control', 'mtm' ),
				'description' => esc_html__( 'This is the description for the Image Control', 'mtm' ),
				'section' => 'default_controls_section',
				'button_labels' => array(
					'select' => __( 'Select Image', 'mtm' ),
					'change' => __( 'Change Image', 'mtm' ),
					'remove' => __( 'Remove', 'mtm' ),
					'default' => __( 'Default', 'mtm' ),
					'placeholder' => __( 'No image selected', 'mtm' ),
					'frame_title' => __( 'Select Image', 'mtm' ),
					'frame_button' => __( 'Choose Image', 'mtm' ),
				)
			)
		) );

		// Test of Cropped Image Control
		$wp_customize->add_setting( 'sample_default_cropped_image',
			array(
				'default' => $this->defaults['sample_default_cropped_image'],
				'transport' => 'refresh',
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'sample_default_cropped_image',
			array(
				'label' => __( 'Default Cropped Image Control', 'mtm' ),
				'description' => esc_html__( 'This is the description for the Cropped Image Control', 'mtm' ),
				'section' => 'default_controls_section',
				'flex_width' => false,
				'flex_height' => false,
				'width' => 800,
				'height' => 400
			)
		) );

		// Test of Date/Time Control
		$wp_customize->add_setting( 'sample_date_only',
			array(
				'default' => $this->defaults['sample_date_only'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_date_time_sanitization',
			)
		);
		$wp_customize->add_control( new WP_Customize_Date_Time_Control( $wp_customize, 'sample_date_only',
			array(
				'label' => __( 'Default Date Control', 'mtm' ),
				'description' => esc_html__( 'This is the Date Time Control but is only displaying a date field. It also has Max and Min years set.', 'mtm' ),
				'section' => 'default_controls_section',
				'include_time' => false,
				'allow_past_date' => true,
				'twelve_hour_format' => true,
				'min_year' => '2016',
				'max_year' => '2025',
			)
		) );

		// Test of Date/Time Control
		$wp_customize->add_setting( 'sample_date_time',
			array(
				'default' => $this->defaults['sample_date_time'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_date_time_sanitization',
			)
		);
		$wp_customize->add_control( new WP_Customize_Date_Time_Control( $wp_customize, 'sample_date_time',
			array(
				'label' => __( 'Default Date Control', 'mtm' ),
				'description' => esc_html__( 'This is the Date Time Control. It also has Max and Min years set.', 'mtm' ),
				'section' => 'default_controls_section',
				'include_time' => true,
				'allow_past_date' => true,
				'twelve_hour_format' => true,
				'min_year' => '2010',
				'max_year' => '2020',
			)
		) );

		// Test of Date/Time Control
		$wp_customize->add_setting( 'sample_date_time_no_past_date',
			array(
				'default' => $this->defaults['sample_date_time_no_past_date'],
				'transport' => 'refresh',
				'sanitize_callback' => 'mtm_date_time_sanitization',
			)
		);
		$wp_customize->add_control( new WP_Customize_Date_Time_Control( $wp_customize, 'sample_date_time_no_past_date',
			array(
				'label' => __( 'Default Date Control', 'mtm' ),
				'description' => esc_html__( "This is the Date Time Control but is only displaying a date field. Past dates are not allowed.", 'mtm' ),
				'section' => 'default_controls_section',
				'include_time' => false,
				'allow_past_date' => false,
				'twelve_hour_format' => true,
				'min_year' => '2016',
				'max_year' => '2099',
			)
		) );
	}
}

/**
 * Initialise our Customizer settings
 */
$mtm_settings = new mtm_initialise_customizer_demo_settings();
