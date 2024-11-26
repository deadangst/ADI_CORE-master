<?php
/**
 * Default Values.
 *
 * @package Multi Blog
 */

if ( ! function_exists( 'multi_blog_get_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function multi_blog_get_default_theme_options() {

		$multi_blog_defaults = array();
		
		// Options.
        $multi_blog_defaults['logo_width_range']                       = 300;
		$multi_blog_defaults['global_sidebar_layout']					= 'right-sidebar';
        $multi_blog_defaults['multi_blog_pagination_layout']                = 'numeric';
		$multi_blog_defaults['footer_column_layout'] 						= 3;
		$multi_blog_defaults['footer_copyright_text'] 						= esc_html__( 'All rights reserved.', 'multi-blog' );
        $multi_blog_defaults['ed_preloader']                                = 1;
        $multi_blog_defaults['ed_cursor_option']                            = 1;
        $multi_blog_defaults['ed_cursor_option']                            = 1;
        $multi_blog_defaults['multi_blog_header_top_ed'] 				    = 1;
        $multi_blog_defaults['ed_related_post']                				= 1;
        $multi_blog_defaults['related_post_title']             				= esc_html__('Similar Articles','multi-blog');
        $multi_blog_defaults['multi_blog_single_post_layout']               = 'layout-1';

        $multi_blog_defaults['multi_blog_carousel_section_title']           = esc_html__('You may have missed','multi-blog');
        $multi_blog_defaults['twp_navigation_type']              			= 'theme-normal-navigation';
        $multi_blog_defaults['ed_post_author']                				= 1;
        $multi_blog_defaults['ed_post_date']                				= 1;
        $multi_blog_defaults['ed_post_category']                			= 1;
        $multi_blog_defaults['ed_post_tags']                				= 1;
        $multi_blog_defaults['ed_floating_next_previous_nav']               = 1;
        $multi_blog_defaults['ed_header_banner']               				= 0;
        $multi_blog_defaults['ed_carousel_section']               			= 0;
        $multi_blog_defaults['ed_category_section']               			= 0;
        $multi_blog_defaults['multi_blog_background_color']               	= '#fff';
        $multi_blog_defaults['multi_blog_default_text_color']               = '#000';
        $multi_blog_defaults['multi_blog_border_color']               		= '#ededed';
        $multi_blog_defaults['ed_post_read_later']                          = 1;

		// Pass through filter.
		$multi_blog_defaults = apply_filters( 'multi_blog_filter_default_theme_options', $multi_blog_defaults );

		return $multi_blog_defaults;

	}

endif;
