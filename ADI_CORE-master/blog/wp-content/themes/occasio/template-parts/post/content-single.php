<?php
/**
 * The template for displaying single posts
 *
 * @version 1.0
 * @package Occasio
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php occasio_post_image_single(); ?>

	<header class="post-header entry-header">

		<?php the_title( '<h1 class="post-title entry-title">', '</h1>' ); ?>

		<?php occasio_entry_meta(); ?>

		<?php occasio_entry_categories(); ?>

	</header><!-- .entry-header -->

	<?php get_template_part( 'template-parts/entry/entry', 'single' ); ?>

</article>
