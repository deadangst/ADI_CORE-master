<?php

/**
 * Multi Blog About Page
 * @package Multi Blog
 *
*/

if( !class_exists('Multi_Blog_About_page') ):

	class Multi_Blog_About_page{

		function __construct(){

			add_action('admin_menu', array($this, 'multi_blog_backend_menu'),999);

		}

		// Add Backend Menu
        function multi_blog_backend_menu(){

            add_theme_page(esc_html__( 'Multi Blog Options','multi-blog' ), esc_html__( 'Multi Blog Options','multi-blog' ), 'activate_plugins', 'multi-blog-about', array($this, 'multi_blog_main_page'));

        }

        // Settings Form
        function multi_blog_main_page(){

            require get_template_directory() . '/classes/about-render.php';

        }

	}

	new Multi_Blog_About_page();

endif;