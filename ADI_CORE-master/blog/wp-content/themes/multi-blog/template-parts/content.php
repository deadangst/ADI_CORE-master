<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Multi Blog
 * @since 1.0.0
 */
$multi_blog_default = multi_blog_get_default_theme_options();
$ed_post_read_later = get_theme_mod('ed_post_read_later',$multi_blog_default['ed_post_read_later']);
$image_size = 'large';
global $multi_blog_archive_first_class; 
$archive_classes = [
    'theme-article-post',
    'theme-article-animate',
    $multi_blog_archive_first_class
];?>

<article id="post-<?php the_ID(); ?>" <?php post_class($archive_classes); ?>>

    <div class="theme-article-image">
       
            <div class="entry-thumbnail">

                <?php
                if (is_search() || is_archive() || is_front_page()) {

                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                    $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>
                    <div class="post-thumbnail data-bg data-bg-big"
                         data-background="<?php echo esc_url( $featured_image ); ?>">
                        <a href="<?php the_permalink(); ?>" class="theme-image-responsive" tabindex="0"></a>
                    </div>

                    <?php
                } else {

                    multi_blog_post_thumbnail($image_size);

                }
                multi_blog_post_format_icon(); ?>
            </div>

    </div>

    <div class="theme-article-details">

        <div class="entry-meta-top">
            <div class="entry-meta">
                <?php multi_blog_entry_footer($cats = true, $tags = false, $edits = false); ?>
            </div>
        </div>

        <header class="entry-header">

            <h2 class="entry-title entry-title-medium">

                <a href="<?php the_permalink(); ?>" rel="bookmark">
                    <span><?php the_title(); ?></span>
                </a>


            </h2>

        </header>


        <div class="entry-content">

            <?php
            if (has_excerpt()) {

                the_excerpt();

            } else {

                echo '<p>';
                echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                echo '</p>';
            }

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'multi-blog'),
                'after' => '</div>',
            )); ?>

        </div>


        <a href="<?php the_permalink(); ?>" rel="bookmark" class="theme-btn-link">
          <span> <?php esc_html_e('Continue Reading', 'multi-blog'); ?> </span>
          <span class="topbar-info-icon"><?php multi_blog_the_theme_svg('arrow-right-1'); ?></span>
        </a>

    </div>

</article>