<?php
/**
 * Layout Settings
 *
 * Register Layout Settings section, settings and controls for Theme Customizer
 *
 * @package Occasio
 */

/**
 * Adds Layout settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function occasio_customize_register_layout_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'occasio_section_layout', array(
		'title'    => esc_html__( 'Layout Settings', 'occasio' ),
		'priority' => 10,
		'panel'    => 'occasio_options_panel',
	) );

	// Get Default Settings.
	$default = occasio_default_options();

	// Add Settings and Controls for Theme Layout.
	$wp_customize->add_setting( 'occasio_theme_options[theme_layout]', array(
		'default'           => $default['theme_layout'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'occasio_sanitize_select',
	) );

	$wp_customize->add_control( 'occasio_theme_options[theme_layout]', array(
		'label'    => esc_html__( 'Theme Layout', 'occasio' ),
		'section'  => 'occasio_section_layout',
		'settings' => 'occasio_theme_options[theme_layout]',
		'type'     => 'select',
		'priority' => 10,
		'choices'  => array(
			'centered' => esc_html__( 'Centered Layout', 'occasio' ),
			'wide'     => esc_html__( 'Wide Layout', 'occasio' ),
		),
	) );

	// Add Settings and Controls for Sidebar Position.
	$wp_customize->add_setting( 'occasio_theme_options[sidebar_position]', array(
		'default'           => 'right-sidebar',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'occasio_sanitize_select',
	) );

	$wp_customize->add_control( 'occasio_theme_options[sidebar_position]', array(
		'label'    => esc_html__( 'Sidebar Position', 'occasio' ),
		'section'  => 'occasio_section_layout',
		'settings' => 'occasio_theme_options[sidebar_position]',
		'type'     => 'radio',
		'priority' => 20,
		'choices'  => array(
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'occasio' ),
			'right-sidebar' => esc_html__( 'Right Sidebar', 'occasio' ),
		),
	) );
}
add_action( 'customize_register', 'occasio_customize_register_layout_settings' );
