<?php
/**
 * The template for displaying the full content of a post
 *
 * @version 1.0
 * @package Occasio
 */
?>

<div class="entry-content">

	<?php the_content( esc_html( occasio_get_option( 'read_more_link' ) ) ); ?>

</div><!-- .entry-content -->
