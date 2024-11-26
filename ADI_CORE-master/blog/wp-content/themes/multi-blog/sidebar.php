<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Multi Blog
 */

$multi_blog_default = multi_blog_get_default_theme_options();

$multi_blog_post_sidebar = esc_html( get_post_meta( $post->ID, 'multi_blog_post_sidebar_option', true ) );
$sidebar_column_class = 'column-order-2';

if (empty($multi_blog_post_sidebar)) {
    $global_sidebar_layout = esc_html( get_theme_mod( 'global_sidebar_layout',$multi_blog_default['global_sidebar_layout'] ) );
} else {
    $global_sidebar_layout = $multi_blog_post_sidebar;
}
if ( ! is_active_sidebar( 'sidebar-1' ) || $global_sidebar_layout == 'no-sidebar' ) {
    return;
}

if ($global_sidebar_layout == 'left-sidebar') {
    $sidebar_column_class = 'column-order-1';
}
 ?>

<aside id="secondary" class="widget-area <?php echo $sidebar_column_class; ?>">
    <div class="widget-area-wrapper">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </div>
</aside>
