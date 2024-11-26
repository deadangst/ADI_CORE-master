<?php
/**
 * Custom Functions.
 *
 * @package Multi Blog
 */

if( !function_exists( 'multi_blog_fonts_url' ) ) :

    //Google Fonts URL
    function multi_blog_fonts_url(){

        $font_families = array(
            'DM Sans:wght@400;500;700',
            'EB Garamond:wght@400;500;600;700;800'

        );

        $fonts_url = add_query_arg( array(
            'family' => implode( '&family=', $font_families ),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2' );

        return esc_url_raw($fonts_url);

    }

endif;

if( !function_exists( 'multi_blog_social_menu_icon' ) ) :

    function multi_blog_social_menu_icon( $item_output, $item, $depth, $args ) {

        // Add Icon
        if ( isset( $args->theme_location ) && 'multi-blog-social-menu' === $args->theme_location ) {

            $svg = Multi_Blog_SVG_Icons::get_theme_svg_name( $item->url );

            if ( empty( $svg ) ) {
                $svg = multi_blog_the_theme_svg( 'link',$return = true );
            }

            $item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
        }

        return $item_output;
    }

endif;

add_filter( 'walker_nav_menu_start_el', 'multi_blog_social_menu_icon', 10, 4 );

if ( ! function_exists( 'multi_blog_sub_menu_toggle_button' ) ) :

    function multi_blog_sub_menu_toggle_button( $args, $item, $depth ) {

        // Add sub menu toggles to the main menu with toggles
        if ( $args->theme_location == 'multi-blog-primary-menu' && isset( $args->show_toggles ) ) {
            
            // Wrap the menu item link contents in a div, used for positioning
            $args->before = '<div class="submenu-wrapper">';
            $args->after  = '';

            // Add a toggle to items with children
            if ( in_array( 'menu-item-has-children', $item->classes ) ) {

                $toggle_target_string = '.menu-item.menu-item-' . $item->ID . ' > .sub-menu';

                // Add the sub menu toggle
                $args->after .= '<button type="button" class="theme-aria-button submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . esc_html__( 'Show sub menu', 'multi-blog' ) . '</span>' . multi_blog_get_theme_svg( 'chevron-down' ) . '</span></button>';

            }

            // Close the wrapper
            $args->after .= '</div><!-- .submenu-wrapper -->';
            // Add sub menu icons to the main menu without toggles (the fallback menu)

        }elseif( $args->theme_location == 'multi-blog-primary-menu' ) {

            if ( in_array( 'menu-item-has-children', $item->classes ) ) {

                $args->before = '<div class="link-icon-wrapper">';
                $args->after  = multi_blog_get_theme_svg( 'chevron-down' ) . '</div>';

            } else {

                $args->before = '';
                $args->after  = '';

            }

        }

        return $args;

    }

endif;

add_filter( 'nav_menu_item_args', 'multi_blog_sub_menu_toggle_button', 10, 3 );

/**
 * Multi Blog SVG Icon helper functions
 *
 * @package Multi Blog
 * @since 1.0.0
 */
if ( ! function_exists( 'multi_blog_the_theme_svg' ) ):
    /**
     * Output and Get Theme SVG.
     * Output and get the SVG markup for an icon in the Multi_Blog_SVG_Icons class.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function multi_blog_the_theme_svg( $svg_name, $return = false ) {

        if( $return ){

            return multi_blog_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in multi_blog_get_theme_svg();.

        }else{

            echo multi_blog_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in multi_blog_get_theme_svg();.

        }
    }

endif;

if ( ! function_exists( 'multi_blog_get_theme_svg' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function multi_blog_get_theme_svg( $svg_name ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            Multi_Blog_SVG_Icons::get_svg( $svg_name ),
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
                'polyline' => array(
                    'fill'      => true,
                    'points'    => true,
                ),
                'line' => array(
                    'fill'      => true,
                    'x1'      => true,
                    'x2' => true,
                    'y1'    => true,
                    'y2' => true,
                ),
            )
        );
        if ( ! $svg ) {
            return false;
        }
        return $svg;

    }

endif;


if( !function_exists( 'multi_blog_post_category_list' ) ) :

    // Post Category List.
    function multi_blog_post_category_list( $select_cat = true ){

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        if( $select_cat ){

            $post_cat_cat_array[''] = esc_html__( '-- Select Category --','multi-blog' );

        }

        foreach ( $post_cat_lists as $post_cat_list ) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;

        }

        return $post_cat_cat_array;
    }

endif;

if( !function_exists('multi_blog_sanitize_meta_pagination') ):

    /** Sanitize Enable Disable Checkbox **/
    function multi_blog_sanitize_meta_pagination( $input ) {

        $valid_keys = array('global-layout','no-navigation','theme-normal-navigation','ajax-next-post-load');
        if ( in_array( $input , $valid_keys ) ) {
            return $input;
        }
        return '';

    }

endif;

if( !function_exists('multi_blog_disable_post_views') ):

    /** Disable Post Views **/
    function multi_blog_disable_post_views() {

        add_filter('booster_extension_filter_views_ed', 'multi_blog_disable_post_views_callback');

    }

endif;

if( !function_exists('multi_blog_disable_post_views_callback') ):

    /** Disable Reaction **/
    function multi_blog_disable_post_views_callback() {

        return false;

    }

endif;

if( !function_exists('multi_blog_disable_post_read_time') ):

    /** Disable Read Time **/
    function multi_blog_disable_post_read_time() {

        add_filter('booster_extension_filter_readtime_ed', 'multi_blog_disable_post_read_time_callback');

    }

endif;

if( !function_exists('multi_blog_disable_post_read_time_callback') ):

    /** Disable Reaction **/
    function multi_blog_disable_post_read_time_callback() {

        return false;

    }

endif;

if( !function_exists('multi_blog_disable_post_like_dislike') ):

    /** Disable Like Dislike **/
    function multi_blog_disable_post_like_dislike() {

        add_filter('booster_extension_filter_like_ed', 'multi_blog_disable_post_like_dislike_callback');

    }

endif;

if( !function_exists('multi_blog_disable_post_like_dislike_callback') ):

    /** Disable Reaction **/
    function multi_blog_disable_post_like_dislike_callback() {

        return false;

    }

endif;

if( !function_exists('multi_blog_disable_post_author_box') ):

    /** Disable Author Box **/
    function multi_blog_disable_post_author_box() {

        add_filter('booster_extension_filter_ab_ed', 'multi_blog_disable_post_author_box_callback');

    }

endif;

if( !function_exists('multi_blog_disable_post_author_box_callback') ):

    /** Disable Reaction **/
    function multi_blog_disable_post_author_box_callback() {

        return false;

    }

endif;

add_filter('booster_extension_filter_ss_ed', 'multi_blog_disable_post_social_share_callback');

if( !function_exists('multi_blog_disable_post_social_share_callback') ):

    /** Disable Reaction **/
    function multi_blog_disable_post_social_share_callback() {

        return false;

    }

endif;

if( !function_exists('multi_blog_disable_post_reaction') ):

    /** Disable Reaction **/
    function multi_blog_disable_post_reaction() {

        add_filter( 'booster_extension_filter_reaction_ed', 'multi_blog_disable_post_reaction_callback' );

    }

endif;

if( !function_exists('multi_blog_disable_post_reaction_callback') ):

    /** Disable Reaction **/
    function multi_blog_disable_post_reaction_callback() {

        return false;

    }

endif;

if( !function_exists('multi_blog_post_floating_nav') ):

    function multi_blog_post_floating_nav(){

        $multi_blog_default = multi_blog_get_default_theme_options();
        $ed_floating_next_previous_nav = get_theme_mod( 'ed_floating_next_previous_nav',$multi_blog_default['ed_floating_next_previous_nav'] );

        if( 'post' === get_post_type() && $ed_floating_next_previous_nav ){

            $next_post = get_next_post();
            $prev_post = get_previous_post();

            if( isset( $prev_post->ID ) ){

                $prev_link = get_permalink( $prev_post->ID );?>

                <div class="floating-post-navigation floating-navigation-prev">

                    <?php if( get_the_post_thumbnail( $prev_post->ID,'medium' ) ){ ?>
                            <?php echo wp_kses_post( get_the_post_thumbnail( $prev_post->ID,'medium' ) ); ?>
                    <?php } ?>

                    <a href="<?php echo esc_url( $prev_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Previous post', 'multi-blog'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                    </a>

                </div>

            <?php }

            if( isset( $next_post->ID ) ){

                $next_link = get_permalink( $next_post->ID );?>

                <div class="floating-post-navigation floating-navigation-next">

                    <?php if( get_the_post_thumbnail( $next_post->ID,'medium' ) ){ ?>
                        <?php echo wp_kses_post( get_the_post_thumbnail( $next_post->ID,'medium' ) ); ?>
                    <?php } ?>

                    <a href="<?php echo esc_url( $next_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Next post', 'multi-blog'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                    </a>

                </div>

            <?php
            }

        }

    }

endif;

add_action( 'multi_blog_navigation_action','multi_blog_post_floating_nav',10 );

if( !function_exists('multi_blog_single_post_navigation') ):

    function multi_blog_single_post_navigation(){

        $multi_blog_default = multi_blog_get_default_theme_options();
        $twp_navigation_type = esc_attr( get_post_meta( get_the_ID(), 'twp_disable_ajax_load_next_post', true ) );
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;
        if( $twp_navigation_type == '' || $twp_navigation_type == 'global-layout' ){
            $twp_navigation_type = get_theme_mod('twp_navigation_type', $multi_blog_default['twp_navigation_type']);
        }

        if( $twp_navigation_type != 'no-navigation' && 'post' === get_post_type() ){

            if( $twp_navigation_type == 'theme-normal-navigation' ){ ?>

                <div class="navigation-wrapper">
                    <?php
                    // Previous/next post navigation.
                    the_post_navigation(array(
                        'prev_text' => '<span class="arrow" aria-hidden="true">' . multi_blog_the_theme_svg('arrow-left',$return = true ) . '</span><span class="screen-reader-text">' . esc_html__('Previous post:', 'multi-blog') . '</span><span class="post-title">%title</span>',
                        'next_text' => '<span class="arrow" aria-hidden="true">' . multi_blog_the_theme_svg('arrow-right',$return = true ) . '</span><span class="screen-reader-text">' . esc_html__('Next post:', 'multi-blog') . '</span><span class="post-title">%title</span>',
                    )); ?>
                </div>
                <?php

            }else{

                $next_post = get_next_post();
                if( isset( $next_post->ID ) ){

                    $next_post_id = $next_post->ID;
                    echo '<div loop-count="1" next-post="' . absint( $next_post_id ) . '" class="twp-single-infinity"></div>';

                }
            }

        }

    }

endif;

add_action( 'multi_blog_navigation_action','multi_blog_single_post_navigation',30 );

if ( ! function_exists( 'multi_blog_header_toggle_search' ) ):

    /**
     * Header Search
     **/
    function multi_blog_header_toggle_search() {

         ?>
        <div class="header-searchbar">
            <div class="header-searchbar-inner">
                <div class="wrapper">
                    <div class="header-searchbar-area">
                        <a href="javascript:void(0)" class="skip-link-search-start"></a>
                        <?php get_search_form(); ?>
                        <button type="button" id="search-closer" class="close-popup">
                            <?php multi_blog_the_theme_svg('cross'); ?>
                        </button>
                        <a href="javascript:void(0)" class="skip-link-search-end"></a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        

    }

endif;

add_action( 'multi_blog_before_footer_content_action','multi_blog_header_toggle_search',10 );


if( !function_exists('multi_blog_content_offcanvas') ):

    // Offcanvas Contents
    function multi_blog_content_offcanvas(){ ?>

        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">
                <div class="close-offcanvas-menu">
                    <div class="offcanvas-close">
                        <a href="javascript:void(0)" class="skip-link-menu-start"></a>
                        <button type="button" class="button-offcanvas-close">
                            <span class="offcanvas-close-label">
                                <?php echo esc_html__('Close', 'multi-blog'); ?>
                            </span>
                        </button>
                    </div>
                </div>
                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'multi-blog'); ?>" role="navigation">
                        <ul class="primary-menu theme-menu">
                            <?php
                            if (has_nav_menu('multi-blog-primary-menu')) {
                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'multi-blog-primary-menu',
                                        'show_toggles' => true,
                                    )
                                );
                            }else{

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' => false,
                                        'show_toggles' => true,
                                        'walker' => new Multi_Blog_Walker_Page(),
                                    )
                                );
                            }
                            ?>
                        </ul>
                    </nav><!-- .primary-menu-wrapper -->
                </div>
                <?php if (has_nav_menu('multi-blog-social-menu')) { ?>
                    <div id="social-nav-offcanvas" class="offcanvas-item offcanvas-social-navigation">
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

                <a href="javascript:void(0)" class="skip-link-menu-end"></a>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'multi_blog_before_footer_content_action','multi_blog_content_offcanvas',30 );

if( !function_exists('multi_blog_footer_content_widget') ):

    function multi_blog_footer_content_widget(){

        $multi_blog_default = multi_blog_get_default_theme_options();
        if (is_active_sidebar('multi-blog-footer-widget-0') ||
            is_active_sidebar('multi-blog-footer-widget-1') ||
            is_active_sidebar('multi-blog-footer-widget-2')):
            $x = 1;
            $footer_sidebar = 0;
            do {
                if ($x == 3 && is_active_sidebar('multi-blog-footer-widget-2')) {
                    $footer_sidebar++;
                }
                if ($x == 2 && is_active_sidebar('multi-blog-footer-widget-1')) {
                    $footer_sidebar++;
                }
                if ($x == 1 && is_active_sidebar('multi-blog-footer-widget-0')) {
                    $footer_sidebar++;
                }
                $x++;
            } while ($x <= 3);
            if ($footer_sidebar == 1) {
                $footer_sidebar_class = 12;
            } elseif ($footer_sidebar == 2) {
                $footer_sidebar_class = 6;
            } else {
                $footer_sidebar_class = 4;
            }
            $footer_column_layout = absint(get_theme_mod('footer_column_layout', $multi_blog_default['footer_column_layout'])); ?>

            <div class="footer-widgetarea">
                <div class="wrapper">
                    <div class="column-row">

                        <?php if (is_active_sidebar('multi-blog-footer-widget-0')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('multi-blog-footer-widget-0'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('multi-blog-footer-widget-1')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('multi-blog-footer-widget-1'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('multi-blog-footer-widget-2')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('multi-blog-footer-widget-2'); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        <?php
        endif;

    }

endif;

add_action( 'multi_blog_footer_content_action','multi_blog_footer_content_widget',10 );

if( !function_exists('multi_blog_footer_content_info') ):

    /**
     * Footer Copyright Area
    **/
    function multi_blog_footer_content_info(){

        $multi_blog_default = multi_blog_get_default_theme_options(); ?>
        <div class="site-info">
            <div class="wrapper">
                <div class="column-row">

                    <div class="column column-10">
                        <div class="footer-credits">

                            <div class="footer-copyright">

                                <?php
                                $footer_copyright_text = wp_kses_post( get_theme_mod( 'footer_copyright_text', $multi_blog_default['footer_copyright_text'] ) );
                                echo esc_html__('Copyright ', 'multi-blog') . '&copy ' . absint(date('Y')) . ' <a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name', 'display')) . '" ><span>' . esc_html( get_bloginfo( 'name', 'display' ) ) . '. </span></a> ' . esc_html( $footer_copyright_text );

                                
                                    echo '<br>';
                                    echo esc_html__('Theme: ', 'multi-blog') . 'Multi Blog ' . esc_html__('By ', 'multi-blog') . '<a href="' . esc_url('https://www.themeinwp.com/theme/multi-blog') . '"  title="' . esc_attr__('Themeinwp', 'multi-blog') . '" target="_blank" rel="author"><span>' . esc_html__('Themeinwp. ', 'multi-blog') . '</span></a>';
                                    echo esc_html__('Powered by ', 'multi-blog') . '<a href="' . esc_url('https://wordpress.org') . '" title="' . esc_attr__('WordPress', 'multi-blog') . '" target="_blank"><span>' . esc_html__('WordPress.', 'multi-blog') . '</span></a>';
                                 ?>

                            </div>
                        </div>
                    </div>


                    <div class="column column-2 align-text-right">
                        <a class="to-the-top" href="#site-header">
                            <span class="to-the-top-long">
                                <?php
                                printf( esc_html__( 'To the Top %s', 'multi-blog' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
                                ?>
                            </span>
                            <span class="to-the-top-short">
                                <?php
                                printf( esc_html__( 'Up %s', 'multi-blog' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
                                ?>
                            </span>
                        </a>

                    </div>


                </div>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'multi_blog_footer_content_action','multi_blog_footer_content_info',20 );


if( !function_exists( 'multi_blog_main_slider' ) ) :

    function multi_blog_main_slider(){

        $multi_blog_default = multi_blog_get_default_theme_options();
        $ed_header_banner = get_theme_mod( 'ed_header_banner', $multi_blog_default['ed_header_banner'] );
        $multi_blog_header_banner_cat = get_theme_mod( 'multi_blog_header_banner_cat' );

        if( $ed_header_banner ){

            $rtl = '';
            if( is_rtl() ){
                $rtl = 'dir="rtl"';
            }

          $banner_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 4,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $multi_blog_header_banner_cat ) ) );

          if( $banner_query->have_posts() ): ?>

            <div class="theme-custom-block theme-banner-block">
                <div class="swiper-container theme-main-carousel swiper-container" <?php echo $rtl; ?>>

                    <div class="swiper-wrapper">

                      <?php
                      while( $banner_query->have_posts() ):
                        $banner_query->the_post();
                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                        $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>

                          <div class="swiper-slide main-carousel-item">
                             
                                  <div class="theme-article-post">
                                  <div class="entry-thumbnail">
                                      <div class="data-bg data-bg-large" data-background="<?php echo esc_url($featured_image); ?>">
                                          <a href="<?php the_permalink(); ?>" class="theme-image-responsive" tabindex="0"></a>
                                      </div>
                                      <?php multi_blog_post_format_icon(); ?>
                                  </div>
                            
                                  <div class="main-carousel-caption">
                                      <div class="post-content ">
                                          <div class="entry-meta">
                                              <?php
                                              multi_blog_posted_by($icon = false);
                                              multi_blog_posted_on($icon = false);
                                              ?>
                                          </div>

                                          <header class="entry-header">
                                              <h2 class="entry-title entry-title-big">
                                                  <a href="<?php the_permalink(); ?>" rel="bookmark"><span><?php the_title(); ?></span></a>
                                              </h2>
                                          </header>


                                          <div class="entry-content">
                                              <?php
                                              if (has_excerpt()) {

                                                  the_excerpt();

                                              } else {

                                                  echo esc_html(wp_trim_words(get_the_content(), 25, '...'));

                                              } ?>
                                          </div>

                                          <a href="<?php the_permalink(); ?>" class="btn-fancy btn-fancy-primary" tabindex="0">
                                              <?php echo esc_html__('Read More', 'multi-blog'); ?>
                                          </a>

                                      </div>
                                  </div>
                                  </div>


                          </div>

                      <?php endwhile; ?>

                    </div>

                    <div class="swiper-pagination"></div>

                    <div class="swiper-control swiper-control_center">
                            <div class="theme-carousel-control">
                            <div class="swiper-button-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="45.0282" height="9" viewBox="0 0 45.0282 9.0371"><polyline points="4.825 0.354 0.707 4.471 4.92 8.684"></polyline><line x1="0.9028" y1="4.513" x2="45.0278" y2="4.5405"></line></svg>
                            </div>
                            
                            <div class="swiper-button-next">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="45.0277" height="9" viewBox="0 0 45.0277 9.0373"><polyline points="40.108 8.684 44.321 4.471 40.203 0.354"></polyline><line x1="0.0003" y1="4.5409" x2="44.1253" y2="4.5134"></line></svg>
                            </div>
                            </div>
                    </div>

                </div>
            </div>

          <?php
          wp_reset_postdata();
          endif;

        }

    }

endif;

if( !function_exists( 'multi_blog_main_carousel' ) ) :

    function multi_blog_main_carousel(){

        $multi_blog_default = multi_blog_get_default_theme_options();
        $ed_carousel_section = get_theme_mod( 'ed_carousel_section', $multi_blog_default['ed_carousel_section'] );
        $multi_blog_carousel_section_title = get_theme_mod( 'multi_blog_carousel_section_title', $multi_blog_default['multi_blog_carousel_section_title'] );
        $multi_blog_carousel_section_cat = get_theme_mod( 'multi_blog_carousel_section_cat' );

        if( $ed_carousel_section ){

            $rtl = '';
            if( is_rtl() ){
                $rtl = 'dir="rtl"';
            }

            $banner_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 10,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $multi_blog_carousel_section_cat ) ) );

            if( $banner_query->have_posts() ): ?>

            <div class="theme-custom-block theme-recommendation-block">
                <div class="theme-recommendation-main">
                    <div class="wrapper-fluid">
                        <div class="theme-area-header">
                            <div class="theme-area-headlines">
                                <h2 class="theme-area-title"><?php echo esc_html($multi_blog_carousel_section_title); ?></h2>
                                <div class="theme-animated-line"></div>
                            </div>
                            <div class="theme-carousel-control">
                                <div class="twp-carousel-prev"><?php multi_blog_the_theme_svg('chevron-left') ?></div>
                                <div class="swiper-pagination"></div>
                                <div class="twp-carousel-next"><?php multi_blog_the_theme_svg('chevron-right') ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper-fluid">
                        <div class="swiper-container twp-carousel-slider" <?php echo $rtl; ?>>
                            <div class="swiper-wrapper">
                                <?php
                                while ($banner_query->have_posts()):
                                    $banner_query->the_post();
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                    $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>

                                    <div class="swiper-slide swiper-slide-item">
                                        <article id="post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-carousel-post'); ?>>
                                           
                                                <div class="entry-thumbnail">
                                                    <div class="data-bg data-bg-big" data-background="<?php echo esc_url($featured_image); ?>">
                                                        <a href="<?php the_permalink(); ?>" class="theme-image-responsive" tabindex="0"></a>
                                                    </div>
                                                    <?php multi_blog_post_format_icon(); ?>
                                                </div>
                                            

                                            <div class="entry-meta">

                                                <?php
                                                multi_blog_entry_footer($cats = true, $tags = false, $edits = false);
                                                ?>

                                            </div>

                                            <h2 class="entry-title entry-title-medium">
                                                <a href="<?php the_permalink(); ?>">
                                                    <span><?php the_title(); ?></span>
                                                </a>
                                            </h2>

                                            <div class="entry-meta">

                                                <?php
                                                multi_blog_posted_by($icon = false);
                                                multi_blog_posted_on($icon = false);
                                                ?>

                                            </div>


                                        </article>

                                    </div>


                                <?php endwhile; ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

          <?php
          wp_reset_postdata();
          endif;

        }

    }

endif;

if( !function_exists('multi_blog_404_posts') ):

    function multi_blog_404_posts(){

        $lead_post_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 3,'post__not_in' => get_option("sticky_posts") ) );

        if( $lead_post_query ->have_posts() ): ?>
                <div class="wrapper">
                    <div class="column-row column-row-small">

                        <div class="column column-12 column-sm-12 column-order-2">
                            <div class="column-row column-row-small">

                                <?php
                                while( $lead_post_query->have_posts() ){
                                    $lead_post_query->the_post();

                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); ?>

                                    <div class="column column-4 mb-xs-15 column-xs-12">
                                        <div class="content-main content-main-bg">
                                            <div class="content-list">
                                                <article
                                                        id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article'); ?>>

                                                    <?php if ( isset( $featured_image[0] ) && $featured_image[0]) { ?>
                                                        <div class="post-thumbnail">
                                                            <div class="img-hover-scale">

                                                                <a href="<?php the_permalink(); ?>" tabindex="0">
                                                                    <img title="<?php the_title_attribute(); ?>"
                                                                         alt="<?php the_title_attribute(); ?>"
                                                                         src="<?php echo esc_url($featured_image[0]); ?>">
                                                                </a>

                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <div class="article-content">

                                                        <div class="entry-meta">
                                                            <?php multi_blog_entry_footer( $cats = true, $tags = false, $edits = false ); ?>
                                                        </div>

                                                        <h3 class="entry-title entry-title-small">
                                                            <a href="<?php the_permalink(); ?>"
                                                               rel="bookmark"><?php the_title(); ?></a>
                                                        </h3>

                                                        <div class="entry-meta">
                                                            <?php multi_blog_posted_on(); ?>
                                                        </div>

                                                        <div class="entry-content entry-content-muted entry-content-small">

                                                            <?php
                                                            if( has_excerpt() ){

                                                                the_excerpt();

                                                            }else{

                                                                echo esc_html(wp_trim_words(get_the_content(), 20, '...'));

                                                            } ?>

                                                        </div>
                                                    </div>

                                                </article>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>

                            </div>
                        </div>

                    </div>
                </div>
        <?php
        wp_reset_postdata();
        endif;

    }

endif;

if( !function_exists('multi_blog_related_posts') ):

    // Single Posts Related Posts.
    function multi_blog_related_posts(){

        $multi_blog_default = multi_blog_get_default_theme_options();
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;

        if( is_single() && 'post' === get_post_type() ){

            $cats = get_the_category( $post->ID );
            $category = array();
            if( $cats ){
                foreach( $cats as $cat ){
                    $category[] = $cat->term_id; 
                }
            }

            $related_posts_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 6, 'post__not_in' => array( $post->ID ), 'category__in' => $category ) );
            $ed_related_post = absint( get_theme_mod( 'ed_related_post',$multi_blog_default['ed_related_post'] ) );

            if( $ed_related_post && $related_posts_query->have_posts() ): ?>

                <div class="theme-custom-block theme-related-block">

                    <?php $related_post_title = esc_html( get_theme_mod( 'related_post_title',$multi_blog_default['related_post_title'] ) );
                    if( $related_post_title ){ ?>

                        <div class="theme-area-header">
                            <div class="theme-area-headlines">
                                <h2 class="theme-area-title">  <?php echo esc_html( $related_post_title ); ?></h2>
                                <div class="theme-animated-line"></div>
                            </div>
                        </div>
                        
                    <?php } ?>

                    <div class="related-posts">

                        <?php
                        while( $related_posts_query->have_posts() ):
                            $related_posts_query->the_post();

                            $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'medium_large' ); ?>


                            <article id="post-<?php the_ID(); ?>" <?php post_class('related-post-item theme-article-post'); ?>>
                                <div class="column-row">

                                <?php
                                if( isset( $featured_image[0] ) && has_post_thumbnail() ): ?>
                                    <div class="column column-5 column-sm-12">
                                        <div class="post-thumbnail">

                                            <div class="data-bg data-bg-medium" data-background="<?php echo esc_url( $featured_image[0] ); ?>">
                                                <a href="<?php the_permalink(); ?>" class="theme-image-responsive"></a>
                                            </div>

                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="column column-7 column-sm-12">
                                    <div class="post-content">

                                        <header class="entry-header">
                                            <h3 class="entry-title entry-title-medium">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                    <span><?php the_title(); ?></span>
                                                </a>
                                            </h3>
                                        </header>

                                        <div class="entry-meta">

                                            <?php
                                            multi_blog_posted_by($icon = false);
                                            multi_blog_posted_on($icon = false);
                                            ?>

                                        </div>

                                        <div class="entry-content entry-content-muted entry-content-small">

                                            <?php
                                            if( has_excerpt() ){

                                                the_excerpt();

                                            }else{

                                                echo esc_html(wp_trim_words(get_the_content(), 20, '...'));

                                            } ?>

                                        </div>

                                    </div>
                                </div>

                            </div>
                            </article>

                        <?php endwhile; ?>

                    </div>

                </div>

            <?php
            wp_reset_postdata();
            endif;

        }

    }

endif;
add_action( 'multi_blog_navigation_action','multi_blog_related_posts',20 );

if (!function_exists('multi_blog_post_format_icon')):

    // Post Format Icon.
    function multi_blog_post_format_icon()
    {

        $format = get_post_format(get_the_ID()) ?: 'standard';
        $icon = '';
        $title = '';
        if( $format == 'video' ){
            $icon = multi_blog_get_theme_svg( 'video' );
            $title = esc_html__('Video','multi-blog');
        }elseif( $format == 'audio' ){
            $icon = multi_blog_get_theme_svg( 'audio' );
            $title = esc_html__('Audio','multi-blog');
        }elseif( $format == 'gallery' ){
            $icon = multi_blog_get_theme_svg( 'gallery' );
            $title = esc_html__('Gallery','multi-blog');
        }elseif( $format == 'quote' ){
            $icon = multi_blog_get_theme_svg( 'quote' );
            $title = esc_html__('Quote','multi-blog');
        }elseif( $format == 'image' ){
            $icon = multi_blog_get_theme_svg( 'image' );
            $title = esc_html__('Image','multi-blog');
        }

        
        if (!empty($icon)) { ?>
            <div class="theme-post-format">
                <span class="post-format-icom"><?php echo multi_blog_svg_escape($icon); ?></span>
                <?php if( $title ){ echo '<span class="post-format-label">'.esc_html( $title ).'</span>'; } ?>
            </div>
        <?php }
        
    }

endif;

if ( ! function_exists( 'multi_blog_svg_escape' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function multi_blog_svg_escape( $input ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            $input,
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if ( ! $svg ) {
            return false;
        }

        return $svg;

    }

endif;


if( !function_exists( 'multi_blog_sanitize_sidebar_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function multi_blog_sanitize_sidebar_option_meta( $input ){

        $metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists('multi_blog_category_carousel') ):

    // Single Posts Related Posts.
    function multi_blog_category_carousel(){

        $multi_blog_default = multi_blog_get_default_theme_options();
        $ed_category_section = absint( get_theme_mod( 'ed_category_section',$multi_blog_default['ed_category_section'] ) );

        if( $ed_category_section ){
            $rtl = '';
            if( is_rtl() ){
                $rtl = 'dir="rtl"';
            } ?>

            <div class="theme-custom-block featured-categories-block">

                <div class="wrapper-fluid">
                    <div class="swiper-container theme-categories-carousel" <?php echo $rtl; ?>>
                        <div class="swiper-wrapper">

                            <?php
                            for ($x = 1; $x <= 10; $x++) {

                                $c_category = get_theme_mod('multi_blog_category_cat_' . $x);

                                if ($c_category) {

                                    $cat_obj = get_category_by_slug($c_category);
                                    $cat_name = isset( $cat_obj->name ) ? $cat_obj->name : '';
                                    $cat_id = isset( $cat_obj->term_id ) ? $cat_obj->term_id : '';
                                    $cat_link = get_category_link($cat_id);
                                    $twp_term_image = get_term_meta($cat_id, 'twp-term-featured-image', true); ?>

                                    <div class="swiper-slide be-category-item">

                                       <div class="theme-article-post theme-transform-zoom">
                                       <div class="post-thumb-categories">
                                            <div class="data-bg data-bg-medium" data-background="<?php echo esc_url($twp_term_image); ?>">
                                                <a class="theme-image-responsive" href="<?php echo esc_url($cat_link); ?>" tabindex="0"></a>
                                            </div>
                                        </div>

                                        <div class="article-content">

                                            <?php
                                            if ($cat_name) { ?>
                                                <h3 class="category-title">
                                                    <?php echo esc_html($cat_name); ?>
                                                </h3>

                                                <a class="btn-fancy btn-fancy-secondary" href="<?php echo esc_url($cat_link); ?>" tabindex="0">
                                                    <?php echo esc_html__('more post', 'multi-blog'); ?>
                                                </a>
                                            <?php } ?>

                                        </div>
                                       </div>

                                    </div>

                                    <?php
                                }

                            } ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php
        }

    }

endif;

if( class_exists('Booster_Extension_Class') ):

    add_filter('booster_extension_ed_content','multi_blog_read_letter_content_false');

    if( !function_exists('multi_blog_read_letter_content_false') ):

        function multi_blog_read_letter_content_false(){

            return false;

        }

    endif;

    add_filter('booster_extension_before_read_later_post','multi_blog_read_letter_before');

    if( !function_exists('multi_blog_read_letter_before') ):

        function multi_blog_read_letter_before(){

            global $multi_blog_order_class_1, $multi_blog_order_class_2, $post_count;
            $post_count = 1;

        }

    endif;

    add_filter('booster_extension_read_later_post_content','multi_blog_read_letter_content_start',10);

    if( !function_exists('multi_blog_read_letter_content_start') ):

        function multi_blog_read_letter_content_start(){

            global $multi_blog_order_class_1, $multi_blog_order_class_2, $post_count;
            
            if( $post_count == 1 ){
                $multi_blog_order_class_1 = 'column-order-1';
                $multi_blog_order_class_2 = 'column-order-2';
            }else{
                $multi_blog_order_class_1 = 'column-order-2';
                $multi_blog_order_class_2 = 'column-order-1';
            }

        }

    endif;

    add_action('booster_extension_read_later_post_content','multi_blog_readletter_content',20);

    if( !function_exists('multi_blog_readletter_content') ):

        function multi_blog_readletter_content(){

            return get_template_part( 'template-parts/content', get_post_format() );

        }

    endif;
    
    add_filter('booster_extension_read_later_post_content','multi_blog_read_letter_content_end',10);

    if( !function_exists('multi_blog_read_letter_content_end') ):

        function multi_blog_read_letter_content_end(){

            global $multi_blog_order_class_1, $multi_blog_order_class_2, $post_count;
            $post_count++;
            if( $post_count == 3 ){
                $post_count = 1;
            }

        }

    endif;

endif;