<?php
/**
 * The sidebar containing the widget area on blog pages.
 *
 * @package Occasio
 */

// Check if Sidebar should be displayed.
if ( occasio_has_sidebar() ) : ?>

	<section id="secondary" class="sidebar widget-area" role="complementary">

		<?php dynamic_sidebar( 'sidebar-1' ); ?>

	</section><!-- #secondary -->

	<?php
endif;
