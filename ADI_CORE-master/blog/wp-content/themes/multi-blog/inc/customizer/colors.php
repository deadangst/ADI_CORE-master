<?php
/**
* Color Settings.
*
* @package Multi Blog
*/

$multi_blog_default = multi_blog_get_default_theme_options();

$wp_customize->add_setting( 'multi_blog_default_text_color',
    array(
    'default'           => $multi_blog_default['multi_blog_default_text_color'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'multi_blog_default_text_color',
    array(
        'label'      => esc_html__( 'Text Color', 'multi-blog' ),
        'section'    => 'colors',
        'settings'   => 'multi_blog_default_text_color',
    ) ) 
);

$wp_customize->add_setting( 'multi_blog_border_color',
    array(
    'default'           => $multi_blog_default['multi_blog_border_color'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'multi_blog_border_color',
    array(
        'label'      => esc_html__( 'Border Color', 'multi-blog' ),
        'section'    => 'colors',
        'settings'   => 'multi_blog_border_color',
    ) ) 
);