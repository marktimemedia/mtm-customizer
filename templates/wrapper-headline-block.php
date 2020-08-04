<?php // Headline Block
global $classes;
$spring_headline = get_the_title( $post_id );
$classes         = 'wp-block-' . sanitize_title( $block['name'] );

if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$classes .= ' align' . $block['align'];
}
?>
<header class="page--header <?php echo esc_attr( $classes ); ?>">
		<h1 class="page--title">
			<?php
			if ( function_exists( 'spring_title' ) ) :
				echo esc_html( spring_title( get_the_ID() ) );
			else :
				echo esc_html( get_the_title( get_the_ID() ) );
			endif;
			?>
		</h1>
</header>
