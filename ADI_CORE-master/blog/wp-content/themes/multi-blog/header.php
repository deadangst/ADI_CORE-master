<?php
/**
 * Header file for the Multi Blog WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Multi Blog
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
if( function_exists('wp_body_open') ){
    wp_body_open();
}
$multi_blog_default = multi_blog_get_default_theme_options();
$ed_preloader = get_theme_mod( 'ed_preloader', $multi_blog_default['ed_preloader'] );
$ed_cursor_option = get_theme_mod( 'ed_cursor_option', $multi_blog_default['ed_cursor_option'] ); ?>

<?php if( $ed_preloader ){ ?>
    <div class="preloader hide-no-js">
        <div class="preloader-wrapper">
            <div class="theme-loader">
                <div class="theme-loading">
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($ed_cursor_option) { ?>
    <div class="theme-custom-cursor theme-cursor-primary"></div>
    <div class="theme-custom-cursor theme-cursor-secondary"></div>
<?php } ?>

<div id="multi-blog-page" class="multi-blog-hfeed multi-blog-site">
<a class="skip-link screen-reader-text" href="#site-content"><?php esc_html_e('Skip to the content', 'multi-blog'); ?></a>
    <div class="theme-main-progressbar">
    <div id="theme-progressbar" class="twp-progress-bar"></div>
    </div>

<?php
$multi_blog_header_top_ed = get_theme_mod( 'multi_blog_header_top_ed', $multi_blog_default['multi_blog_header_top_ed'] );
if( $multi_blog_header_top_ed ){
    get_template_part( 'template-parts/header/header', 'top' );
}

if( !is_paged() && ( is_home() || is_front_page() ) ){
    get_template_part( 'template-parts/header/header', 'layout-1' );
    multi_blog_main_slider();
    multi_blog_category_carousel();
} else{
    get_template_part( 'template-parts/header/header', 'layout-2' );
}?>

<div id="content" class="site-content">
    <?php 
    $multi_blog_single_layout = get_post_meta(get_the_ID(), 'multi_blog_single_layout', true);
    if (empty ($multi_blog_single_layout)) {
        $multi_blog_single_layout = get_theme_mod( 'multi_blog_single_post_layout',$multi_blog_default['multi_blog_single_post_layout'] );
    }
    if (!is_front_page() && ($multi_blog_single_layout == 'layout-2') && (!is_page()) && (!is_archive())) { ?>
        <?php
        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        $featured_image = isset($featured_image[0]) ? $featured_image[0] : '';
        ?>
        <div class="single-featured-banner">
            <div class="data-bg" data-background="<?php echo esc_url($featured_image); ?>">
                <div class="wrapper">
                    <div class="column-row">
                        <div class="column column-11">
                        <?php multi_blog_breadcrumb(); ?>
                        <div class="featured-banner-content">
                            <header class="entry-header">
                                <h1 class="entry-title">
                                    <?php the_title(); ?>
                                </h1>
                            </header>
                            <?php if (!is_page()) {  ?>
                                <div class="entry-meta">
                                    <?php global $post;
                                    $author_id = $post->post_author;?>
                                    <div class="entry-meta-item entry-meta-author">
                                        <div class="entry-meta-wrapper">
                                            <span class="entry-meta-icon author-icon"> 
                                            <?php multi_blog_the_theme_svg('user'); ?>
                                            </span>
                                            <?php $byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) . '">' . esc_html( get_the_author_meta( 'nicename', $author_id )) . '</a></span>'; ?>
                                            <span class="byline"> <?php echo wp_kses_post($byline); ?></span> 
                                        </div>
                                    </div>
                                    <?php
                                    multi_blog_posted_on();
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    <?php }