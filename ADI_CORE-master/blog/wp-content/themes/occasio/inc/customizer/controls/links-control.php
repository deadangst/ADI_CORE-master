<?php
/**
 * Theme Links Control for the Customizer
 *
 * @package Occasio
 */

/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Displays the theme links in the Customizer.
	 */
	class Occasio_Customize_Links_Control extends WP_Customize_Control {
		/**
		 * Render Control
		 */
		public function render_content() {
			?>

			<div class="theme-links">

				<span class="customize-control-title"><?php esc_html_e( 'Theme Links', 'occasio' ); ?></span>

				<p>
					<a href="<?php echo esc_url( __( 'https://themezee.com/themes/occasio/', 'occasio' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=occasio&utm_content=theme-page" target="_blank">
						<?php esc_html_e( 'Theme Page', 'occasio' ); ?>
					</a>
				</p>

				<p>
					<a href="http://preview.themezee.com/?demo=occasio&utm_source=customizer&utm_campaign=occasio" target="_blank">
						<?php esc_html_e( 'Theme Demo', 'occasio' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://themezee.com/docs/occasio-documentation/', 'occasio' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=occasio&utm_content=documentation" target="_blank">
						<?php esc_html_e( 'Theme Documentation', 'occasio' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://themezee.com/changelogs/?action=themezee-changelog&type=theme&slug=occasio/', 'occasio' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Theme Changelog', 'occasio' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://wordpress.org/support/theme/occasio/reviews/', 'occasio' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Rate this theme', 'occasio' ); ?>
					</a>
				</p>

			</div>

			<?php
		}
	}

endif;
