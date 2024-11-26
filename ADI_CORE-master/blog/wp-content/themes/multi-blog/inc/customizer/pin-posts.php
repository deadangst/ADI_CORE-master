<?php
/**
* Read Later Options.
*
* @package Multi Blog
*/

$multi_blog_default = multi_blog_get_default_theme_options();

// Header Advertise Area Section.
$wp_customize->add_section( 'post_pp_section',
	array(
	'title'      => esc_html__( 'Read Later Post Settings', 'multi-blog' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_post_read_later',
    array(
        'default' => $multi_blog_default['ed_post_read_later'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'multi_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_read_later',
    array(
        'label' => esc_html__('Enable Read Later Bookmark', 'multi-blog'),
        'section' => 'post_pp_section',
        'type' => 'checkbox',
    )
);