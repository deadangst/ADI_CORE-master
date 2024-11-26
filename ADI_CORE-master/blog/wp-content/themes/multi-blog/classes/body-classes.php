<?php
/**
* Body Classes.
*
* @package Multi Blog
*/
 
 if (!function_exists('multi_blog_body_classes')) :

    function multi_blog_body_classes($classes) {

        $multi_blog_default = multi_blog_get_default_theme_options();
        global $post;
        // Adds a class of hfeed to non-singular pages.
        if ( !is_singular() ) {
            $classes[] = 'hfeed';
        }

        // Adds a class of no-sidebar when there is no sidebar present.
        if ( !is_active_sidebar( 'sidebar-1' ) ) {
            $classes[] = 'no-sidebar';
        }

        $global_sidebar_layout = esc_html( get_theme_mod( 'global_sidebar_layout',$multi_blog_default['global_sidebar_layout'] ) );

        if ( is_active_sidebar( 'sidebar-1' ) ) {
            if( is_single() || is_page() ){
                $multi_blog_post_sidebar = esc_html( get_post_meta( $post->ID, 'multi_blog_post_sidebar_option', true ) );
                if (empty($multi_blog_post_sidebar) || ($multi_blog_post_sidebar == 'global-sidebar')) {
                    $classes[] = esc_attr( $global_sidebar_layout );
                } else{
                    $classes[] = esc_attr( $multi_blog_post_sidebar );
                }
            }else{
                $classes[] = esc_attr( $global_sidebar_layout );
            }
            
        }
        
        return $classes;
    }

endif;

add_filter('body_class', 'multi_blog_body_classes');