<?php
/**
 * Footer Settings
 *
 * Register Footer Settings section, settings and controls for Theme Customizer
 *
 * @package Occasio
 */

/**
 * Adds Footer settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function occasio_customize_register_footer_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'occasio_section_footer', array(
		'title'    => esc_html__( 'Footer Settings', 'occasio' ),
		'priority' => 90,
		'panel'    => 'occasio_options_panel',
	) );

	// Get Default Settings.
	$default = occasio_default_options();

	// Add Footer Text setting.
	$wp_customize->add_setting( 'occasio_theme_options[footer_text]', array(
		'default'           => '',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'occasio_sanitize_footer_text',
	) );

	$wp_customize->add_control( 'occasio_theme_options[footer_text]', array(
		'label'    => esc_html__( 'Footer Text', 'occasio' ),
		'section'  => 'occasio_section_footer',
		'settings' => 'occasio_theme_options[footer_text]',
		'type'     => 'textarea',
		'priority' => 10,
	) );

	// Add selective refresh for footer text.
	$wp_customize->selective_refresh->add_partial( 'occasio_theme_options[footer_text]', array(
		'selector'         => '.site-info .footer-text',
		'render_callback'  => 'occasio_customize_partial_footer_text',
		'fallback_refresh' => false,
	) );

	// Add Credit Link setting.
	$wp_customize->add_setting( 'occasio_theme_options[credit_link]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'occasio_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'occasio_theme_options[credit_link]', array(
		'label'    => esc_html__( 'Display credit link on footer line', 'occasio' ),
		'section'  => 'occasio_section_footer',
		'settings' => 'occasio_theme_options[credit_link]',
		'type'     => 'checkbox',
		'priority' => 20,
	) );

}
add_action( 'customize_register', 'occasio_customize_register_footer_settings' );


/**
 * Render the footer text for the selective refresh partial.
 */
function occasio_customize_partial_footer_text() {
	echo do_shortcode( wp_kses_post( occasio_get_option( 'footer_text' ) ) );
}
