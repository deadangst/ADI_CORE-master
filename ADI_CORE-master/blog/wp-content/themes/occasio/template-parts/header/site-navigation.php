<?php
/**
 * Main Navigation
 *
 * @version 1.1
 * @package Occasio
 */
?>

<?php if ( has_nav_menu( 'primary' ) ) : ?>

	<button class="primary-menu-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false" <?php occasio_amp_menu_toggle(); ?>>
		<?php
		echo occasio_get_svg( 'menu' );
		echo occasio_get_svg( 'close' );
		?>
		<span class="menu-toggle-text"><?php esc_html_e( 'Menu', 'occasio' ); ?></span>
	</button>

	<div class="primary-navigation">

		<nav id="site-navigation" class="main-navigation" <?php occasio_amp_menu_is_toggled(); ?> role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'occasio' ); ?>">

			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'container'      => false,
				)
			);
			?>
		</nav><!-- #site-navigation -->

	</div><!-- .primary-navigation -->

<?php endif; ?>

<?php do_action( 'occasio_after_navigation' ); ?>
