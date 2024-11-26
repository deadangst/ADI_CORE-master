<?php
/**
* Top Header Options.
*
* @package Multi Blog
*/

$multi_blog_default = multi_blog_get_default_theme_options();

// Header Advertise Area Section.
$wp_customize->add_section( 'top_header_setting',
	array(
	'title'      => esc_html__( 'Top Header Settings', 'multi-blog' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Enable Disable Search.
$wp_customize->add_setting('multi_blog_header_top_ed',
    array(
        'default' => $multi_blog_default['multi_blog_header_top_ed'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'multi_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('multi_blog_header_top_ed',
    array(
        'label' => esc_html__('Enable Header Top', 'multi-blog'),
        'section' => 'top_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('header_ad_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control( new WP_Customize_Image_Control(
    $wp_customize,
    'header_ad_image',
        array(
            'label'      => esc_html__( 'Top Header AD Image', 'multi-blog' ),
            'section'    => 'top_header_setting',
        )
    )
);

$wp_customize->add_setting('header_ad_image_link',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('header_ad_image_link',
    array(
        'label' => esc_html__('AD Image Link Search', 'multi-blog'),
        'section' => 'top_header_setting',
        'type' => 'text',
    )
);
