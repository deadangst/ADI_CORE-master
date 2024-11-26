<?php
/**
 * Header Layout 1
 *
 * @package Multi Blog
 */
$multi_blog_default = multi_blog_get_default_theme_options();
?>
<header id="site-header" class="site-header-layout header-layout-1" role="banner">
    <div class="header-navbar <?php if( get_header_image() ){ ?>data-bg data-bg-header<?php } ?>" <?php if( get_header_image() ){ ?> data-background="<?php echo esc_url(get_header_image()); ?>" <?php } ?>>
        <div class="wrapper header-wrapper">
            <div class="theme-header-areas header-areas-center">
                <div class="header-titles">
                    <?php
                    multi_blog_site_logo();
                    multi_blog_site_description();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="site-navigation">
        <div class="wrapper header-wrapper">
            <div class="theme-header-areas header-areas-center">
                <div class="main-nav-controls twp-hide-js">
                    <button type="button" class="navbar-control navbar-control-offcanvas">
                         <span class="navbar-control-trigger" tabindex="-1">
                            <?php multi_blog_the_theme_svg('menu'); ?>
                         </span>
                    </button>
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'multi-blog'); ?>" role="navigation">
                        <ul class="primary-menu theme-menu">
                            <?php
                            if (has_nav_menu('multi-blog-primary-menu')) {
                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'multi-blog-primary-menu',
                                        'walker' => new multiblog\Multi_Blog_Walkernav(),
                                    )
                                );
                            } else {
                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' => false,
                                        'walker' => new Multi_Blog_Walker_Page(),
                                    )
                                );
                            } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>