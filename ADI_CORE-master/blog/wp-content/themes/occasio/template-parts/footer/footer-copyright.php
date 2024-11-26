<?php
/**
 * Footer Copyright
 *
 * @version 1.0
 * @package Occasio
 */


// Check if there is footer content available.
if ( is_active_sidebar( 'footer-copyright' ) || true === occasio_get_option( 'credit_link' ) || '' !== occasio_get_option( 'footer_text' ) ) :
	?>

	<div id="footer-line" class="site-info">

		<?php dynamic_sidebar( 'footer-copyright' ); ?>
		<?php occasio_footer_text(); ?>
		<?php occasio_credit_link(); ?>

	</div>

	<?php
endif;
