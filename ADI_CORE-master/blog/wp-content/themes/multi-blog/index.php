<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Multi Blog
 * @since 1.0.0
 */
get_header();
$multi_blog_default = multi_blog_get_default_theme_options();
$global_sidebar_layout = esc_html( get_theme_mod( 'global_sidebar_layout',$multi_blog_default['global_sidebar_layout'] ) );
$sidebar_column_class = 'column-order-2';
if ($global_sidebar_layout == 'right-sidebar') {
    $sidebar_column_class = 'column-order-1';
}

global $multi_blog_archive_first_class; ?>
    <div class="archive-main-block">
        <div class="wrapper">
            <div class="column-row">

                <div id="primary" class="content-area <?php echo $sidebar_column_class; ?>">
                    <main id="site-content" role="main">

                        <?php

                        if( !is_front_page() ) {
                            multi_blog_breadcrumb();
                        }

                        if( have_posts() ): ?>

                            <div class="article-wraper article-wraper-archive">
                                <?php
                                $post_count = 1;
                                while( have_posts() ):
                                    the_post();

                                    if( $post_count == 1 ){
                                        $multi_blog_archive_first_class = 'article-first-post';
                                    }else{
                                        $multi_blog_archive_first_class = '';
                                    }

                                    get_template_part( 'template-parts/content', get_post_format() );

                                    $post_count++;
                                endwhile; ?>
                            </div>

                            <?php
                            if( is_search() ){
                                the_posts_pagination();
                            }else{
                                do_action('multi_blog_archive_pagination');
                            }

                        else :

                            get_template_part('template-parts/content', 'none');

                        endif; ?>
                    </main><!-- #main -->
                </div>
                <?php get_sidebar();?>
            </div>
        </div>
    </div>
<?php
get_footer();
