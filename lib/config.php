<?php
/**
 * Set our Social Icons URLs.
 * Only needed for our sample customizer preview refresh
 *
 * @return array Multidimensional array containing social media data
 */
if ( ! function_exists( 'mtm_generate_social_urls' ) ) {
	function mtm_generate_social_urls() {
		$social_icons = array(
			array( 'url' => 'behance.net', 'icon' => 'fab fa-behance', 'title' => esc_html__( 'Follow me on Behance', 'mtm' ), 'class' => 'behance' ),
			array( 'url' => 'bitbucket.org', 'icon' => 'fab fa-bitbucket', 'title' => esc_html__( 'Fork me on Bitbucket', 'mtm' ), 'class' => 'bitbucket' ),
			array( 'url' => 'codepen.io', 'icon' => 'fab fa-codepen', 'title' => esc_html__( 'Follow me on CodePen', 'mtm' ), 'class' => 'codepen' ),
			array( 'url' => 'deviantart.com', 'icon' => 'fab fa-deviantart', 'title' => esc_html__( 'Watch me on DeviantArt', 'mtm' ), 'class' => 'deviantart' ),
			array( 'url' => 'discord.gg', 'icon' => 'fab fa-discord', 'title' => esc_html__( 'Join me on Discord', 'mtm' ), 'class' => 'discord' ),
			array( 'url' => 'dribbble.com', 'icon' => 'fab fa-dribbble', 'title' => esc_html__( 'Follow me on Dribbble', 'mtm' ), 'class' => 'dribbble' ),
			array( 'url' => 'etsy.com', 'icon' => 'fab fa-etsy', 'title' => esc_html__( 'favorite me on Etsy', 'mtm' ), 'class' => 'etsy' ),
			array( 'url' => 'facebook.com', 'icon' => 'fab fa-facebook-f', 'title' => esc_html__( 'Like me on Facebook', 'mtm' ), 'class' => 'facebook' ),
			array( 'url' => 'flickr.com', 'icon' => 'fab fa-flickr', 'title' => esc_html__( 'Connect with me on Flickr', 'mtm' ), 'class' => 'flickr' ),
			array( 'url' => 'foursquare.com', 'icon' => 'fab fa-foursquare', 'title' => esc_html__( 'Follow me on Foursquare', 'mtm' ), 'class' => 'foursquare' ),
			array( 'url' => 'github.com', 'icon' => 'fab fa-github', 'title' => esc_html__( 'Fork me on GitHub', 'mtm' ), 'class' => 'github' ),
			array( 'url' => 'instagram.com', 'icon' => 'fab fa-instagram', 'title' => esc_html__( 'Follow me on Instagram', 'mtm' ), 'class' => 'instagram' ),
			array( 'url' => 'kickstarter.com', 'icon' => 'fab fa-kickstarter-k', 'title' => esc_html__( 'Back me on Kickstarter', 'mtm' ), 'class' => 'kickstarter' ),
			array( 'url' => 'last.fm', 'icon' => 'fab fa-lastfm', 'title' => esc_html__( 'Follow me on Last.fm', 'mtm' ), 'class' => 'lastfm' ),
			array( 'url' => 'linkedin.com', 'icon' => 'fab fa-linkedin-in', 'title' => esc_html__( 'Connect with me on LinkedIn', 'mtm' ), 'class' => 'linkedin' ),
			array( 'url' => 'medium.com', 'icon' => 'fab fa-medium-m', 'title' => esc_html__( 'Follow me on Medium', 'mtm' ), 'class' => 'medium' ),
			array( 'url' => 'patreon.com', 'icon' => 'fab fa-patreon', 'title' => esc_html__( 'Support me on Patreon', 'mtm' ), 'class' => 'patreon' ),
			array( 'url' => 'pinterest.com', 'icon' => 'fab fa-pinterest-p', 'title' => esc_html__( 'Follow me on Pinterest', 'mtm' ), 'class' => 'pinterest' ),
			array( 'url' => 'plus.google.com', 'icon' => 'fab fa-google-plus-g', 'title' => esc_html__( 'Connect with me on Google+', 'mtm' ), 'class' => 'googleplus' ),
			array( 'url' => 'reddit.com', 'icon' => 'fab fa-reddit-alien', 'title' => esc_html__( 'Join me on Reddit', 'mtm' ), 'class' => 'reddit' ),
			array( 'url' => 'slack.com', 'icon' => 'fab fa-slack-hash', 'title' => esc_html__( 'Join me on Slack', 'mtm' ), 'class' => 'slack.' ),
			array( 'url' => 'slideshare.net', 'icon' => 'fab fa-slideshare', 'title' => esc_html__( 'Follow me on SlideShare', 'mtm' ), 'class' => 'slideshare' ),
			array( 'url' => 'snapchat.com', 'icon' => 'fab fa-snapchat-ghost', 'title' => esc_html__( 'Add me on Snapchat', 'mtm' ), 'class' => 'snapchat' ),
			array( 'url' => 'soundcloud.com', 'icon' => 'fab fa-soundcloud', 'title' => esc_html__( 'Follow me on SoundCloud', 'mtm' ), 'class' => 'soundcloud' ),
			array( 'url' => 'spotify.com', 'icon' => 'fab fa-spotify', 'title' => esc_html__( 'Follow me on Spotify', 'mtm' ), 'class' => 'spotify' ),
			array( 'url' => 'stackoverflow.com', 'icon' => 'fab fa-stack-overflow', 'title' => esc_html__( 'Join me on Stack Overflow', 'mtm' ), 'class' => 'stackoverflow' ),
			array( 'url' => 'tumblr.com', 'icon' => 'fab fa-tumblr', 'title' => esc_html__( 'Follow me on Tumblr', 'mtm' ), 'class' => 'tumblr' ),
			array( 'url' => 'twitch.tv', 'icon' => 'fab fa-twitch', 'title' => esc_html__( 'Follow me on Twitch', 'mtm' ), 'class' => 'twitch' ),
			array( 'url' => 'twitter.com', 'icon' => 'fab fa-twitter', 'title' => esc_html__( 'Follow me on Twitter', 'mtm' ), 'class' => 'twitter' ),
			array( 'url' => 'vimeo.com', 'icon' => 'fab fa-vimeo-v', 'title' => esc_html__( 'Follow me on Vimeo', 'mtm' ), 'class' => 'vimeo' ),
			array( 'url' => 'weibo.com', 'icon' => 'fab fa-weibo', 'title' => esc_html__( 'Follow me on weibo', 'mtm' ), 'class' => 'weibo' ),
			array( 'url' => 'youtube.com', 'icon' => 'fab fa-youtube', 'title' => esc_html__( 'Subscribe to me on YouTube', 'mtm' ), 'class' => 'youtube' ),
		);

		return apply_filters( 'mtm_social_icons', $social_icons );
	}
}

/**
* Set our Customizer default options
*/
if ( ! function_exists( 'mtm_generate_defaults' ) ) {
	function mtm_generate_defaults() {
		$customizer_defaults = array(
			'social_newtab' => 0,
			'social_urls' => '',
			'social_rss' => 0,
			'social_url_icons' => '',
			'contact_phone' => '',
      'header_extra_text' => '',
      'footer_text' => '',
      'copyright_text' => '',
			'search_menu_icon' => 0,
      'heading_font_select' => json_encode(
 				array(
 					'font' => 'Hind',
 					'regularweight' => '500',
 					'boldweight' => '700',
 					'category' => 'sans-serif'
 				)
 			),
      'subheading_font_select' => json_encode(
 				array(
 					'font' => 'Roboto Slab',
 					'regularweight' => '100',
 					'boldweight' => '500',
 					'category' => 'sans-serif'
 				)
 			),
      'body_font_select' => json_encode(
 				array(
 					'font' => 'Roboto',
 					'regularweight' => 'regular',
 					'boldweight' => '700',
 					'category' => 'sans-serif'
 				)
 			),
		);

		return apply_filters( 'mtm_customizer_defaults', $customizer_defaults );
	}
}

/**
 * Output our Customizer styles in the site header
 *
 *
 * @return string	css styles
 */
function mtm_customizer_css_styles() {
	$defaults = mtm_generate_defaults();
	$sheet = '';
	$styles = '';
  $vars = ':root {';
	$bodyFont = json_decode( get_theme_mod( 'body_font_select', $defaults['body_font_select'] ), true );
	$headerFont = json_decode( get_theme_mod( 'heading_font_select', $defaults['heading_font_select'] ), true );
  $subheaderFont = json_decode( get_theme_mod( 'subheading_font_select', $defaults['subheading_font_select'] ), true );

	// General Header styles
  $vars .= "--heading-font-family:" . $headerFont['font'] ."; ";
  $vars .= "--heading-font-weight:" . ( $headerFont["regularweight"] == "regular" ? "normal" : $headerFont["regularweight"] ) . "; ";
	$vars .= "--heading-font-weight-bold:" . ( $headerFont["boldweight"] == "regular" ? "normal" : $headerFont["boldweight"] ) . "; ";
	// $styles .= "h1, h2, h3 {";
	// $styles .= "font-family:'" . $headerFont['font'] . "'," . $headerFont["category"] . ";";
	// $styles .= "font-weight:" . ( $headerFont["regularweight"] == "regular" ? "normal" : $headerFont["regularweight"] ) . ";";
	// $styles .= "}";

  // General SubHeader styles
  $vars .= "--subheading-font-family:" . $subheaderFont['font'] ."; ";
  $vars .= "--subheading-font-weight:" . ( $subheaderFont["regularweight"] == "regular" ? "normal" : $subheaderFont["regularweight"] ) . "; ";
	$vars .= "--subheading-font-weight-bold:" . ( $subheaderFont["boldweight"] == "regular" ? "normal" : $subheaderFont["boldweight"] ) . "; ";
	// $styles .= "h4, h5, h6 {";
	// $styles .= "font-family:'" . $subheaderFont['font'] . "'," . $subheaderFont["category"] . ";";
	// $styles .= "font-weight:" . ( $subheaderFont["regularweight"] == "regular" ? "normal" : $subheaderFont["regularweight"] ) . ";";
	// $styles .= "}";

	// Body Text styles
  $vars .= "--body-font-family:" . $bodyFont['font'] ."; ";
  $vars .= "--body-font-weight:" . ( $bodyFont["regularweight"] == "regular" ? "normal" : $bodyFont["regularweight"] ) . "; ";
  $vars .= "--body-font-weight-bold:" . ( $bodyFont["boldweight"] == "regular" ? "normal" : $bodyFont["boldweight"] ) . "; ";
  $vars .= "}";
	// $styles .= "body, p {";
	// $styles .= "font-family:'" . $bodyFont['font'] . "'," . $bodyFont["category"] . ";";
	// $styles .= "font-weight:" . ( $bodyFont["regularweight"] == "regular" ? "normal" : $bodyFont["regularweight"] ) . ";";
  // $styles .= "}";
	// $styles .= "em {";
	// $styles .= "font-style:" . $bodyFont['italicweight'] . ";";
  // $styles .= "}";
	// $styles .= "b,strong {";
	// $styles .= "font-weight:" . $bodyFont['boldweight'] . ";";
	// $styles .= "}";

	$sheet .= '<script src="https://kit.fontawesome.com/18602cfc5f.js" crossorigin="anonymous"></script>'; // Font Awesome via Site Customizer Kit
  $sheet .= '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family='.$headerFont['font'].':ital,wght@'.$headerFont["regularweight"].';'.$headerFont['boldweight'].'&display=swap">';
  $sheet .= '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family='.$subheaderFont['font'].':ital,wght@'.$subheaderFont["regularweight"].';'.$subheaderFont['boldweight'].'&display=swap">';
  $sheet .= '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family='.$bodyFont['font'].':ital,wght@'.$bodyFont["regularweight"].';'.$bodyFont['boldweight'].'&display=swap">';
  $sheet .= '<style id="customizer-font-variables"> ' . $vars . ' </style>';
  // $sheet .= '<style id="customizer-font-css" type="text/css"> ' . $styles . ' </style>';

	return $sheet;
}
