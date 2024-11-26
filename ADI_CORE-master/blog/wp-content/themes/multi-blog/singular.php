<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Multi Blog
 * @since 1.0.0
 */
get_header();

    $multi_blog_default = multi_blog_get_default_theme_options();
    $twp_navigation_type = esc_attr( get_post_meta( get_the_ID(), 'twp_disable_ajax_load_next_post', true ) );
    global $post;
    $single_layout_class = '';

    if( $twp_navigation_type == '' || $twp_navigation_type == 'global-layout' ){
        $twp_navigation_type = get_theme_mod('twp_navigation_type', $multi_blog_default['twp_navigation_type']);
    }
    $global_sidebar_layout = esc_html( get_theme_mod( 'global_sidebar_layout',$multi_blog_default['global_sidebar_layout'] ) );
    $multi_blog_post_sidebar = esc_html( get_post_meta( $post->ID, 'multi_blog_post_sidebar_option', true ) );
    $sidebar_column_class = 'column-order-1';

    if (!empty($multi_blog_post_sidebar)) {
        $global_sidebar_layout = $multi_blog_post_sidebar;
    }

    if ($global_sidebar_layout == 'left-sidebar') {
        $sidebar_column_class = 'column-order-2';
    }


    $multi_blog_ed_post_rating = esc_html( get_post_meta( $post->ID, 'multi_blog_ed_post_rating', true ) ); ?>

    <div class="singular-main-block">
        <div class="wrapper">
            <div class="column-row">

                <div id="primary" class="content-area <?php echo $sidebar_column_class; ?>">
                    <main id="site-content" class="<?php if( $multi_blog_ed_post_rating ){ echo 'multi-blog-no-comment'; } ?>" role="main">

                        <?php

                        $multi_blog_single_layout = get_post_meta(get_the_ID(), 'multi_blog_single_layout', true);
                        if (empty ($multi_blog_single_layout)) {
                            $multi_blog_single_layout = esc_html( get_theme_mod( 'multi_blog_single_post_layout',$multi_blog_default['multi_blog_single_post_layout'] ) );
                        }
                        if ($multi_blog_single_layout == 'layout-1') {
                            multi_blog_breadcrumb();
                        }


                        if( have_posts() ): ?>

                            <div class="article-wraper <?php echo esc_attr($single_layout_class); ?>">

                                <?php while (have_posts()) :
                                    the_post();

                                    get_template_part('template-parts/content', 'single');

                                    /**
                                     *  Output comments wrapper if it's a post, or if comments are open,
                                     * or if there's a comment number – and check for password.
                                    **/

                                    if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && !post_password_required() ) { ?>

                                        <div class="comments-wrapper">
                                            <?php comments_template(); ?>
                                        </div><!-- .comments-wrapper -->

                                    <?php
                                    }

                                endwhile; ?>

                            </div>

                        <?php
                        else :

                            get_template_part('template-parts/content', 'none');

                        endif;

                        /**
                         * Navigation
                         * 
                         * @hooked multi_blog_post_floating_nav - 10
                         * @hooked multi_blog_related_posts - 20  
                         * @hooked multi_blog_single_post_navigation - 30  
                        */

                        do_action('multi_blog_navigation_action'); ?>

                    </main><!-- #main -->
                </div>
                <?php get_sidebar();?>
            </div>
        </div>
    </div>

<?php
get_footer();
