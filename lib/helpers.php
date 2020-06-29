<?php

/**
 * Check if WooCommerce is active
 * Use in the active_callback when adding the WooCommerce Section to test if WooCommerce is activated
 *
 * @return boolean
 */
function mtm_is_woocommerce_active() {
	if ( class_exists( 'woocommerce' ) ) {
		return true;
	}
	return false;
}

/**
* Check Block Registry if a block exists
*/
if( !function_exists( 'mtm_check_block_registry' ) ) {
	function mtm_check_block_registry( $name ) { // return 1 or nothing
	  return WP_Block_Type_Registry::get_instance()->is_registered( $name );
	}
}

/**
* Output mobile logo inside image tag, with link to homepage
* Optionally specify image size and class
*/
if( !function_exists( 'the_mtm_mobile_logo' ) ) {
	function the_mtm_mobile_logo( $path = '', $class = 'header-logo-mobile', $size = 'medium' ) {

		if ( get_theme_mod( 'mtm_mobile_logo') ) : // make sure mobile logo exists

			$alt2 = get_bloginfo( 'name' );
			$custom_logo_id2 = get_theme_mod( 'mtm_mobile_logo' );
			$thumb2 = wp_get_attachment_image_src( $custom_logo_id2 , $size );
			?>

			<a href="<?php echo esc_url( home_url( $path ) ); ?>"><img class="<?php echo $class; ?>" src="<?php echo esc_url( $thumb2[0] ); ?>" alt="<?php echo esc_attr( $alt2 ); ?>" /></a>

		<?php endif;
	}
}

/**
* Output header logo inside image tag, with link to homepage
* Optionally specify image size and class
*/
if( !function_exists( 'the_mtm_header_logo' ) ) {
	function the_mtm_header_logo( $path = '', $class = 'header-logo', $size = 'large' ) {

			if ( has_custom_logo() ) { // make sure field value exists

				$alt = get_bloginfo( 'name' );
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$thumb = wp_get_attachment_image_src( $custom_logo_id , $size );

				if ( get_theme_mod( 'mtm_mobile_logo') ) {
					$class = 'header-logo hide-mobile';
				}
				?>

				<a href="<?php echo esc_url( home_url( $path ) ); ?>"><img class="<?php echo $class ?>" src="<?php echo esc_url( $thumb[0] ); ?>" alt="<?php echo esc_attr( $alt ); ?>" /></a>
				<?php the_mtm_mobile_logo() ?>

			<?php } else { // If nothing else is entered, show the blog name as usual ?>

				<a href="<?php echo esc_url( home_url( $path ) ); ?>"><?php bloginfo( 'name' ); ?></a>

			<?php }

	}
}

/**
* Outputs footer logo inside image tag, with link to homepage
*/
if( !function_exists( 'the_mtm_footer_logo' ) ) {
	function the_mtm_footer_logo(  $path = '', $class = 'footer-logo', $size = 'large'  ) {

			if ( get_theme_mod( 'mtm_footer_logo' ) ) { // make sure field value exists

				$alt = get_bloginfo( 'name' );
				$custom_logo_id = get_theme_mod( 'mtm_footer_logo' );
				$thumb = wp_get_attachment_image_src( $custom_logo_id , $size );
				?>

				<a href="<?php echo esc_url( home_url( $path ) ); ?>"><img class="<?php echo $class ?>" src="<?php echo esc_url( $thumb[0] ); ?>" alt="<?php echo esc_attr( $alt ); ?>" /></a>

			<?php }
	}
}

/**
* Outputs additional header text
*/
if( !function_exists( 'get_mtm_header_text' ) ) {
	function get_mtm_header_text() {
		// wpautop this so that it acts like the new visual text widget, since we're using the same TinyMCE control
		return wpautop( get_theme_mod( 'header_extra_text', $defaults['header_extra_text'] ) );
	}
}



/**
* Outputs copyright text with year and date
*/
if( !function_exists( 'the_mtm_footer_copyright' ) ) {
	function the_mtm_footer_copyright() {

		$html = '';

			if ( get_theme_mod( 'copyright_text' ) ) { // make sure field value exists

				$html .= '&copy; ' . date( 'Y' ) . ' ' . esc_html( get_theme_mod( 'copyright_text', $defaults['copyright_text'] ) );

			} else { // Show copyright year and site name

				$html .= '&copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' );

			}

			echo '<p>' . $html . '</p>';

	}
}

/**
* Outputs additional footer text
*/
if( !function_exists( 'get_mtm_footer_text' ) ) {
	function get_mtm_footer_text() {
		// wpautop this so that it acts like the new visual text widget, since we're using the same TinyMCE control
		return wpautop( get_theme_mod( 'footer_text', $defaults['footer_text'] ) );
	}
}



/**
* Outputs the post thumbnail with fallback for the default image
*/
if( !function_exists( 'the_mtm_post_thumbnail' ) ) {
	function the_mtm_post_thumbnail( $size = 'full', $class = '', $link = true, $attr ='' ) {
		$linkOpen = $link ? '<a aria-hidden="true" tabindex="-1" href="' . get_the_permalink() . '">':'';
    $linkClose = $link ? '</a>':'';
		if ( false !== mtm_acf_check() ) :
			if ( has_post_thumbnail() ) :
				echo $linkOpen . '<figure class="post--thumbnail bla ' . $class . '">'; the_post_thumbnail( $size, $attr ); echo '</figure>' . $linkClose;
			elseif ( get_theme_mod('mtm_default_image') ) : // make sure field value exists
				$image = get_theme_mod('mtm_default_image');
				$url = wp_get_attachment_image_src( $image, 'medium' )[0];
				$alt = '';
				echo $linkOpen . '<figure class="post--thumbnail default-thumbnail ' . $class . '"><img src="' . esc_url( $url ) .'" alt="' . esc_html( $alt ) . '" /></figure>' . $linkClose;
			endif;
		endif;
	}
}


/**
* Outputs the post thumbnail with fallback for the first inline image, then the default image
*/
if( !function_exists( 'the_mtm_post_thumbnail_inline' ) ) {
	function the_mtm_post_thumbnail_inline( $post_ID = '', $size = 'full', $class = '', $link = true, $attr ='' ) {
		$attachments = get_children( 'post_parent='. $post_ID .'&post_type=attachment&post_mime_type=image' );
    $linkOpen = $link ? '<a aria-hidden="true" tabindex="-1" href="' . get_the_permalink() . '">':'';
    $linkClose = $link ? '</a>':'';
		if ( false !== mtm_acf_check() ) :
			if ( has_post_thumbnail() ) : // is there a post thumbnail?
				echo $linkOpen . '<figure class="post--thumbnail bla ' . $class . '">'. get_the_post_thumbnail( $post_ID, $size, $attr ) . '</figure>' . $linkClose;
			elseif ( $attachments ) : // is there an inline image?
				$keys = array_reverse( array_keys ( $attachments ) );
				$image = wp_get_attachment_image( $keys[0], $size, true ); // first attachment image
				echo $linkOpen . '<figure class="post--thumbnail ' .$class . '">' . $image . '</figure>' . $linkClose;
			elseif ( get_theme_mod('mtm_default_image') ) : // make sure field value exists
				$image = get_theme_mod('mtm_default_image');
				$url = wp_get_attachment_image_src( $image, 'medium' )[0];
				$alt = '';
				echo $linkOpen . '<figure class="post--thumbnail default-thumbnail ' . $class . '"><img src="' . esc_url( $url ) .'" alt="' . esc_html( $alt ) . '" /></figure>' . $linkClose;
			endif;
		endif;
	}
};



/**
 * Return an unordered list of linked social media icons, based on the urls provided in the Customizer Sortable Repeater
 * This is a sample function to display some social icons on your site.
 * This sample function is also used to show how you can call a PHP function to refresh the customizer preview.
 * Add the following code to header.php if you want to see the sample social icons displayed in the customizer preview and your theme.
 * Before any social icons display, you'll also need to add the relevent URL's to the Header Navigation > Social Icons section in the Customizer.
 * <div class="social">
 *	 <?php echo mtm_get_social_media(); ?>
 * </div>
 *
 * @return string Unordered list of linked social media icons
 */
if ( ! function_exists( 'mtm_get_social_media' ) ) {
	function mtm_get_social_media() {
		$defaults = mtm_generate_defaults();
		$output = array();
		$social_icons = mtm_generate_social_urls();
		$social_urls = explode( ',', get_theme_mod( 'social_urls', $defaults['social_urls'] ) );
		$social_newtab = get_theme_mod( 'social_newtab', $defaults['social_newtab'] );



		foreach( $social_urls as $key => $value ) {
			if ( !empty( $value ) ) {
				$domain = str_ireplace( 'www.', '', parse_url( $value, PHP_URL_HOST ) );
				$index = array_search( strtolower( $domain ), array_column( $social_icons, 'url' ) );
				if( false !== $index ) {
					$output[] = sprintf( '<a class="button button-social %1$s %5$s" href="%2$s" title="%3$s"%4$s aria-label="%3$s"></a>',
						$social_icons[$index]['class'],
						esc_url( $value ),
						$social_icons[$index]['title'],
						( !$social_newtab ? '' : ' target="_blank"' ),
						$social_icons[$index]['icon']
					);
				}
				else {
					$output[] = sprintf( '<a class="button button-social nosocial %4$s" href="%2$s"%3$s></a>',
						$social_icons[$index]['class'],
						esc_url( $value ),
						( !$social_newtab ? '' : ' target="_blank"' ),
						'fas fa-globe'
					);
				}
			}
		}

		if( get_theme_mod( 'social_rss', $defaults['social_rss'] ) ) {
			$output[] = sprintf( '<a class="button button-social %1$s %5$s" href="%2$s" title="%3$s"%4$s aria-label="%3$s"></a>',
				'rss',
				home_url( '/feed' ),
				'Subscribe to my RSS feed',
				( !$social_newtab ? '' : ' target="_blank"' ),
				'fas fa-rss'
			);
		}

		if ( !empty( $output ) ) {
			$output = apply_filters( 'mtm_social_icons_list', $output );
			array_unshift( $output, '<nav class="social-icons" aria-label-"Social Networks">' );
			$output[] = '</nav>';
		}

		return implode( '', $output );
	}
}

/**
* Phone Number
*/
if ( ! function_exists( 'mtm_get_phone_number' ) ) {
	function mtm_get_phone_number() {
		$contact_phone = get_theme_mod( 'contact_phone', $defaults['contact_phone'] );
		if( !empty( $contact_phone ) ) {
			return sprintf( '<span class="%1$s"><a href="tel:%3$s" aria-label="Phone Number"><i class="%2$s"></i>%3$s</a></span>',
				'button-phone',
				'fas fa-phone fa-flip-horizontal',
				$contact_phone
			);
		}
	}
}

/**
* Social Icons Shortcode for use in content or widgets
*/
function mtm_social_icon_shortcode( $atts ) {
  $a = shortcode_atts( array(), $atts );
  ob_start();
  echo mtm_get_social_media();
  return ob_get_clean();
}
add_shortcode( 'show_social_icons', 'mtm_social_icon_shortcode' );

/**
 * Append a search icon to the primary menu
 * This is a sample function to show how to append an icon to the menu based on the customizer search option
 * The search icon wont actually do anything
 */
if ( ! function_exists( 'mtm_add_search_menu_item' ) ) {
	function mtm_add_search_menu_item( $items, $args ) {
		$defaults = mtm_generate_defaults();

		if( get_theme_mod( 'search_menu_icon', $defaults['search_menu_icon'] ) ) {
			if( $args->theme_location == 'primary' ) {
				$items .= '<li class="menu-item menu-item-search"><a href="#" class="nav-search"><i class="fa fa-search"></i></a></li>';
			}
		}
		return $items;
	}
}
add_filter( 'wp_nav_menu_items', 'mtm_add_search_menu_item', 10, 2 );
