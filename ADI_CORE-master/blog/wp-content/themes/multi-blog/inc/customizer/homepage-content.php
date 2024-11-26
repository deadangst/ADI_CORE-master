<?php
/**
* Header Banner Options.
*
* @package Multi Blog
*/

$multi_blog_default = multi_blog_get_default_theme_options();
$multi_blog_post_category_list = multi_blog_post_category_list();

$wp_customize->add_section( 'header_banner_setting',
    array(
    'title'      => esc_html__( 'Slider Banner Settings', 'multi-blog' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_home_pannel',
    )
);

$wp_customize->add_setting('ed_header_banner',
    array(
        'default' => $multi_blog_default['ed_header_banner'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'multi_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_banner',
    array(
        'label' => esc_html__('Enable Slider Banner', 'multi-blog'),
        'section' => 'header_banner_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'multi_blog_header_banner_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'multi_blog_sanitize_select',
    )
);
$wp_customize->add_control( 'multi_blog_header_banner_cat',
    array(
    'label'       => esc_html__( 'Slider Post Category', 'multi-blog' ),
    'section'     => 'header_banner_setting',
    'type'        => 'select',
    'choices'     => $multi_blog_post_category_list,
    )
);

$wp_customize->add_section( 'header_carousel_setting',
    array(
    'title'      => esc_html__( 'You may have missed section Settings', 'multi-blog' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_home_pannel',
    )
);

$wp_customize->add_setting('ed_carousel_section',
    array(
        'default' => $multi_blog_default['ed_carousel_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'multi_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_carousel_section',
    array(
        'label' => esc_html__('Enable Section', 'multi-blog'),
        'section' => 'header_carousel_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'multi_blog_carousel_section_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'multi_blog_sanitize_select',
    )
);
$wp_customize->add_control( 'multi_blog_carousel_section_cat',
    array(
    'label'       => esc_html__( ' Section Post Category', 'multi-blog' ),
    'section'     => 'header_carousel_setting',
    'type'        => 'select',
    'choices'     => $multi_blog_post_category_list,
    )
);

$wp_customize->add_setting('multi_blog_carousel_section_title',
    array(
        'default' => $multi_blog_default['multi_blog_carousel_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('multi_blog_carousel_section_title',
    array(
        'label' => esc_html__('Section Title', 'multi-blog'),
        'section' => 'header_carousel_setting',
        'type' => 'text',
    )
);

$wp_customize->add_section( 'header_category_setting',
    array(
    'title'      => esc_html__( 'Category Carousel Settings', 'multi-blog' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_home_pannel',
    )
);

$wp_customize->add_setting('ed_category_section',
    array(
        'default' => $multi_blog_default['ed_category_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'multi_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_category_section',
    array(
        'label' => esc_html__('Enable Category Section', 'multi-blog'),
        'section' => 'header_category_setting',
        'type' => 'checkbox',
    )
);

for ($x = 1; $x <= 15; $x++) {

    $wp_customize->add_setting( 'multi_blog_category_cat_'.$x,
        array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'multi_blog_sanitize_select',
        )
    );
    $wp_customize->add_control( 'multi_blog_category_cat_'.$x,
        array(
        'label'       => esc_html__( 'Category ', 'multi-blog' ).$x,
        'section'     => 'header_category_setting',
        'type'        => 'select',
        'choices'     => $multi_blog_post_category_list,
        )
    );

}