<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Multi Blog
 * @since 1.0.0
 */

if( !is_paged() && ( is_home() || is_front_page() ) ){

    multi_blog_main_carousel();
    
}

/**
 * Toogle Contents
 * @hooked multi_blog_header_toggle_search - 10
 * @hooked multi_blog_content_offcanvas - 30
*/

do_action('multi_blog_before_footer_content_action'); ?>

</div>

<footer id="site-footer" role="contentinfo">

    <?php
    /**
     * Footer Content
     * @hooked multi_blog_footer_content_widget - 10
     * @hooked multi_blog_footer_content_info - 20
    */

    do_action('multi_blog_footer_content_action'); ?>

    

</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
