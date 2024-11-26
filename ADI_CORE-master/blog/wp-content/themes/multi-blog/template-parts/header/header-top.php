<?php
/**
 * Header Top
 *
 * @package Multi Blog
 */
$multi_blog_default = multi_blog_get_default_theme_options();
?>

<?php
$header_ad_image = get_theme_mod('header_ad_image');
$header_ad_image_link = get_theme_mod('header_ad_image_link');

if ($header_ad_image) { ?>
    <div class="site-top-banner">
        <div class="wrapper-fluid header-wrapper">
            <div class="theme-header-areas header-areas-center">
                <a href="<?php echo esc_url($header_ad_image_link); ?>">
                    <img src="<?php echo esc_url($header_ad_image); ?>"
                         alt="<?php esc_attr_e('Header Image', 'multi-blog'); ?>"
                         title="<?php esc_attr_e('Header Image', 'multi-blog'); ?>">
                </a>
            </div>
        </div>
    </div>
<?php } ?>

<div class="site-topbar">

    <div class="wrapper-fluid header-wrapper">

        <div class="theme-header-areas header-areas-left">
            <?php if (has_nav_menu('multi-blog-top-menu')) { ?>

                <div id="top-nav-header" class="header-item header-top-navigation">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'multi-blog-top-menu',
                        'container' => 'div',
                        'container_class' => 'top-menu',
                        'depth' => 1,
                    )); ?>
                </div>

            <?php } ?>
        </div>

        <div class="theme-header-areas header-areas-right">
            <?php
            $multi_blog_default = multi_blog_get_default_theme_options();
            if (has_nav_menu('multi-blog-social-menu')) { ?>
                <div id="main-social-nav" class="main-social-navigation">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'multi-blog-social-menu',
                        'link_before' => '<span class="screen-reader-text">',
                        'link_after' => '</span>',
                        'container' => 'div',
                        'container_class' => 'social-menu',
                        'depth' => 1,
                    )); ?>
                </div>
            <?php } ?>

            <div class="navbar-controls twp-hide-js">
                <button type="button" class="navbar-control navbar-control-search">
                    <span class="navbar-control-trigger" tabindex="-1">
                        <?php multi_blog_the_theme_svg('search'); ?>
                        <?php echo esc_html__('Search', 'multi-blog'); ?>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
