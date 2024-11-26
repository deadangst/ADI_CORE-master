<?php
/**
* Widget FUnctions.
*
* @package Multi Blog
*/

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function multi_blog_widgets_init(){

	register_sidebar(array(
	    'name' => esc_html__('Main Sidebar', 'multi-blog'),
	    'id' => 'sidebar-1',
	    'description' => esc_html__('Add widgets here.', 'multi-blog'),
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h3 class="widget-title"><span>',
	    'after_title' => '</span></h3>',
	));


    $multi_blog_default = multi_blog_get_default_theme_options();
    $footer_column_layout = absint( get_theme_mod( 'footer_column_layout',$multi_blog_default['footer_column_layout'] ) );

    for( $i = 0; $i < $footer_column_layout; $i++ ){
    	
    	if( $i == 0 ){ $count = esc_html__('One','multi-blog'); }
    	if( $i == 1 ){ $count = esc_html__('Two','multi-blog'); }
    	if( $i == 2 ){ $count = esc_html__('Three','multi-blog'); }

	    register_sidebar( array(
	        'name' => esc_html__('Footer Widget ', 'multi-blog').$count,
	        'id' => 'multi-blog-footer-widget-'.$i,
	        'description' => esc_html__('Add widgets here.', 'multi-blog'),
	        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget' => '</div>',
	        'before_title' => '<h2 class="widget-title">',
	        'after_title' => '</h2>',
	    ));
	}

}

add_action('widgets_init', 'multi_blog_widgets_init');

require get_template_directory() . '/inc/widgets/widget-base.php';
require get_template_directory() . '/inc/widgets/author.php';
require get_template_directory() . '/inc/widgets/category.php';
require get_template_directory() . '/inc/widgets/recent-post.php';
require get_template_directory() . '/inc/widgets/social-link.php';
require get_template_directory() . '/inc/widgets/tab-posts.php';