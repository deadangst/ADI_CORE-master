<?php
/**
 * The template for displaying the full content of a single post
 *
 * @version 1.0
 * @package Occasio
 */
?>

<div class="entry-content">

	<?php the_content(); ?>
	<?php wp_link_pages(); ?>

</div><!-- .entry-content -->

<?php do_action( 'occasio_after_posts' ); ?>
<?php do_action( 'occasio_author_bio' ); ?>
<?php occasio_entry_tags(); ?>
