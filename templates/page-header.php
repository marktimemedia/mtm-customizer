<?php
global $classes; // from ACF custom block
?>
<header class="page--header "<?php echo esc_attr( $classes ); ?>>
	<h1 class="page--title">
		<?php
		if ( function_exists( 'spring_title' ) ) {
			echo esc_html( spring_title() );
		} else {
			echo esc_html( get_the_title() );
		}
		?>
	</h1>
</header>
