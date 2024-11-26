<?php
/**
* Preloader Options.
*
* @package Multi Blog
*/

$multi_blog_default = multi_blog_get_default_theme_options();

$wp_customize->add_section( 'preloader_setting',
	array(
	'title'      => esc_html__( 'Preloader Settings', 'multi-blog' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_preloader',
    array(
        'default' => $multi_blog_default['ed_preloader'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'multi_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_preloader',
    array(
        'label' => esc_html__('Enable Preloader', 'multi-blog'),
        'section' => 'preloader_setting',
        'type' => 'checkbox',
    )
);


// Cursor Section.
$wp_customize->add_section('cursor_section',
    array(
        'title'      => esc_html__('Cursor Options', 'multi-blog'),
        'priority'   => 10,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

// Setting ed_cursor_option.
$wp_customize->add_setting('ed_cursor_option',
    array(
        'default' => $multi_blog_default['ed_cursor_option'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'multi_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_cursor_option',
    array(
        'label' => esc_html__('Enable Custom Cursor', 'multi-blog'),
        'section' => 'cursor_section',
        'type' => 'checkbox',
    )
);


