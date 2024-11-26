<?php
/**
 * Woocommerce Compatibility.
 *
 * @link https://woocommerce.com/
 *
 * @package Multi Blog
 */

if ( class_exists('WooCommerce') ) {

    remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar',10 );

}

if( !function_exists('multi_blog_woocommerce_setup') ):

    /**
     * Woocommerce support.
     */
    function multi_blog_woocommerce_setup(){

        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
        add_theme_support('woocommerce', array(
            'gallery_thumbnail_image_width' => 300,
        ));

    }

endif;

add_action('after_setup_theme', 'multi_blog_woocommerce_setup');

if( !function_exists('multi_blog_woocommerce_before_main_content') ):

    // Before Main Content woocommerce hook
    function multi_blog_woocommerce_before_main_content(){

        echo '<div class="singular-main-block">';
        echo '<div class="wrapper">';
        echo '<div class="column-row">';

    }

endif;

if( class_exists('WooCommerce') ){

    add_action('woocommerce_before_main_content', 'multi_blog_woocommerce_before_main_content', 5);

}

if( !function_exists('multi_blog_woocommerce_after_main_content') ):

    // After Main Content woocommerce hook
    function multi_blog_woocommerce_after_main_content(){
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

endif;

if( class_exists('WooCommerce') ){

    add_action('woocommerce_after_main_content', 'multi_blog_woocommerce_after_main_content', 15);

}