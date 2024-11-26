<?php
/**
 * Pagination Settings
 *
 * @package Multi Blog
 */

$multi_blog_default = multi_blog_get_default_theme_options();

// Pagination Section.
$wp_customize->add_section( 'multi_blog_pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Settings', 'multi-blog' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'		 => 'theme_option_panel',
	)
);

// Pagination Layout Settings
$wp_customize->add_setting( 'multi_blog_pagination_layout',
	array(
	'default'           => $multi_blog_default['multi_blog_pagination_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'multi_blog_pagination_layout',
	array(
	'label'       => esc_html__( 'Pagination Method', 'multi-blog' ),
	'section'     => 'multi_blog_pagination_section',
	'type'        => 'select',
	'choices'     => array(
		'next-prev' => esc_html__('Next/Previous Method','multi-blog'),
		'numeric' => esc_html__('Numeric Method','multi-blog'),
		'load-more' => esc_html__('Ajax Load More Button','multi-blog'),
		'auto-load' => esc_html__('Ajax Auto Load','multi-blog'),
	),
	)
);