<?php
global $classes;
$classes = 'wp-block-' . sanitize_title( $block['name'] );

if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$classes .= ' align' . $block['align'];
}
$url = has_post_thumbnail() ? get_the_post_thumbnail_url() : wp_get_attachment_image_src( get_theme_mod( 'mtm_default_image' ), 'medium' )[0]; ?>
<section class="mtm-grid--image <?php echo esc_attr( $classes ); ?>">
	<a aria-hidden="true" tabindex="-1" href="<?php the_permalink(); ?>"><figure class="post--thumbnail mtm-post-thumbnail has-background-image cropped" style="background-image:url(<?php echo esc_url( $url ); ?>)"></figure></a>
</section>
