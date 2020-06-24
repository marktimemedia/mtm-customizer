<?php
global $classes; // from ACF custom block
?>
<header class="page--header "<?php echo $classes; ?>>
    <h1 class="page--title">
        <?php if( function_exists('spring_title') ) {
          echo spring_title();
        } else {
          echo get_the_title();
        } ?>
    </h1>
</header>
