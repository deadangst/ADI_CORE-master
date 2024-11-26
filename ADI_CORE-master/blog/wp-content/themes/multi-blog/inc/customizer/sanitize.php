<?php
/**
* Custom Functions.
*
* @package Multi Blog
*/

if( !function_exists( 'multi_blog_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function multi_blog_sanitize_sidebar_option( $multi_blog_input ){

        $multi_blog_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $multi_blog_input,$multi_blog_metabox_options ) ){

            return $multi_blog_input;

        }

        return;

    }

endif;

if( !function_exists( 'multi_blog_sanitize_single_pagination_layout' ) ) :

    // Sidebar Option Sanitize.
    function multi_blog_sanitize_single_pagination_layout( $multi_blog_input ){

        $multi_blog_single_pagination = array( 'no-navigation','theme-normal-navigation','ajax-next-post-load' );
        if( in_array( $multi_blog_input,$multi_blog_single_pagination ) ){

            return $multi_blog_input;

        }

        return;

    }

endif;

if( !function_exists( 'multi_blog_sanitize_archive_layout' ) ) :

    // Sidebar Option Sanitize.
    function multi_blog_sanitize_archive_layout( $multi_blog_input ){

        $multi_blog_archive_option = array( 'default','full','grid','masonry' );
        if( in_array( $multi_blog_input,$multi_blog_archive_option ) ){

            return $multi_blog_input;

        }

        return;

    }

endif;

if( !function_exists( 'multi_blog_sanitize_header_layout' ) ) :

    // Sidebar Option Sanitize.
    function multi_blog_sanitize_header_layout( $multi_blog_input ){

        $multi_blog_header_options = array( 'layout-1','layout-2' );
        if( in_array( $multi_blog_input,$multi_blog_header_options ) ){

            return $multi_blog_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'multi_blog_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function multi_blog_sanitize_checkbox( $multi_blog_checked ) {

		return ( ( isset( $multi_blog_checked ) && true === $multi_blog_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'multi_blog_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function multi_blog_sanitize_select( $multi_blog_input, $multi_blog_setting ) {

        // Ensure input is a slug.
        $multi_blog_input = sanitize_text_field( $multi_blog_input );

        // Get list of choices from the control associated with the setting.
        $choices = $multi_blog_setting->manager->get_control( $multi_blog_setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $multi_blog_input, $choices ) ? $multi_blog_input : $multi_blog_setting->default );

    }

endif;