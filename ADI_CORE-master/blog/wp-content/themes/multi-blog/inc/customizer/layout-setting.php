<?php
/**
* Layouts Settings.
*
* @package Multi Blog
*/

$multi_blog_default = multi_blog_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'layout_setting',
	array(
	'title'      => esc_html__( 'Global Layout Settings', 'multi-blog' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);


$wp_customize->add_setting( 'global_sidebar_layout',
    array(
    'default'           => $multi_blog_default['global_sidebar_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'multi_blog_sanitize_sidebar_option',
    )
);
$wp_customize->add_control( 'global_sidebar_layout',
    array(
    'label'       => esc_html__( 'Global Sidebar Layout', 'multi-blog' ),
    'section'     => 'layout_setting',
    'type'        => 'select',
    'choices'     => array(
        'right-sidebar' => esc_html__( 'Right Sidebar', 'multi-blog' ),
        'left-sidebar'  => esc_html__( 'Left Sidebar', 'multi-blog' ),
        'no-sidebar'    => esc_html__( 'No Sidebar', 'multi-blog' ),
        ),
    )
);
