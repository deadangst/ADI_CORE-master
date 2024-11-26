<?php
/**
* Single Post Options.
*
* @package Multi Blog
*/

$multi_blog_default = multi_blog_get_default_theme_options();

$wp_customize->add_section( 'single_post_setting',
	array(
	'title'      => esc_html__( 'Single Post Settings', 'multi-blog' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('multi_blog_single_post_layout',
    array(
        'default' => $multi_blog_default['multi_blog_single_post_layout'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'multi_blog_sanitize_select',
    )
);
$wp_customize->add_control('multi_blog_single_post_layout',
    array(
        'label' => esc_html__('Appearance Layout', 'multi-blog'),
        'section' => 'single_post_setting',
        'type' => 'select',
        'choices' => array(
                'layout-1' => esc_html__('Simple Layout','multi-blog' ),
                'layout-2' => esc_html__('Banner Layout','multi-blog' ),
            ),
    )
);

$wp_customize->add_setting('ed_related_post',
    array(
        'default' => $multi_blog_default['ed_related_post'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'multi_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_related_post',
    array(
        'label' => esc_html__('Enable Related Posts', 'multi-blog'),
        'section' => 'single_post_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'related_post_title',
    array(
    'default'           => $multi_blog_default['related_post_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'related_post_title',
    array(
    'label'    => esc_html__( 'Related Posts Section Title', 'multi-blog' ),
    'section'  => 'single_post_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting('twp_navigation_type',
    array(
        'default' => $multi_blog_default['twp_navigation_type'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'multi_blog_sanitize_single_pagination_layout',
    )
);
$wp_customize->add_control('twp_navigation_type',
    array(
        'label' => esc_html__('Single Post Navigation Type', 'multi-blog'),
        'section' => 'single_post_setting',
        'type' => 'select',
        'choices' => array(
                'no-navigation' => esc_html__('Disable Navigation','multi-blog' ),
                'theme-normal-navigation' => esc_html__('Next Previous Navigation','multi-blog' ),
                'ajax-next-post-load' => esc_html__('Ajax Load Next 3 Posts Contents','multi-blog' )
            ),
    )
);

$wp_customize->add_setting('ed_floating_next_previous_nav',
    array(
        'default' => $multi_blog_default['ed_floating_next_previous_nav'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'multi_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_floating_next_previous_nav',
    array(
        'label' => esc_html__('Enable Fixed Next/Previous Article', 'multi-blog'),
        'section' => 'single_post_setting',
        'type' => 'checkbox',
    )
);
