<?php
/**
* Posts Settings.
*
* @package Multi Blog
*/

$multi_blog_default = multi_blog_get_default_theme_options();

// Single Post Section.
$wp_customize->add_section( 'posts_settings',
	array(
	'title'      => esc_html__( 'Metainformation Settings', 'multi-blog' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_post_author',
    array(
        'default' => $multi_blog_default['ed_post_author'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'multi_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_author',
    array(
        'label' => esc_html__('Enable Posts Author', 'multi-blog'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_date',
    array(
        'default' => $multi_blog_default['ed_post_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'multi_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_date',
    array(
        'label' => esc_html__('Enable Posts Date', 'multi-blog'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_category',
    array(
        'default' => $multi_blog_default['ed_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'multi_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'multi-blog'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_tags',
    array(
        'default' => $multi_blog_default['ed_post_tags'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'multi_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_tags',
    array(
        'label' => esc_html__('Enable Posts Tags', 'multi-blog'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);