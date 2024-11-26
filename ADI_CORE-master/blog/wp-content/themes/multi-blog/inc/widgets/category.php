<?php
/**
 * Category Widgets.
 *
 * @package Multi Blog
 */


if( !function_exists('multi_blog_category_widgets') ):

    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function multi_blog_category_widgets(){

        // Recent Post widget.
        register_widget('Multi_Blog_Sidebar_Category_Widget');

    }

endif;

add_action('widgets_init', 'multi_blog_category_widgets');

// Recent Post widget
if( !class_exists('Multi_Blog_Sidebar_Category_Widget') ):

    /**
     * Recent Post.
     *
     * @since 1.0.0
     */
    class Multi_Blog_Sidebar_Category_Widget extends Multi_Blog_Widget_Base{

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct(){
            
            $opts = array(
                'classname' => 'multi_blog_category_widget',
                'description' => esc_html__('Displays categories and posts.', 'multi-blog'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Title:', 'multi-blog'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'top_category' => array(
                    'label' => esc_html__('Top Categories:', 'multi-blog'),
                    'type' => 'number',
                    'default' => 5,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 20,
                ),
                'enable_cat_desc' => array(
                    'label' => esc_html__('Enable Category Description:', 'multi-blog'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'latest_title' => array(
                    'label' => esc_html__('Latest Text Label:', 'multi-blog'),
                    'type' => 'text',
                    'class' => 'widefat',
                    'default' => esc_html__('Latest :', 'multi-blog'),
                ),
            );

            parent::__construct('multi-blog-category-layout', esc_html__('Multi Blog: Category Widget', 'multi-blog'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget( $args, $instance ){

            $params = $this->get_params( $instance );

            $latest_title = isset( $params['latest_title'] ) ? $params['latest_title'] : '';

            echo $args['before_widget'];

            if ( !empty( $params['title'] ) ) {
                echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
            }
            $top_category = $params['top_category'];
            $enable_cat_desc = $params['enable_cat_desc'];

            $post_cat_lists = get_categories(
                array(
                    'hide_empty' => '0',
                    'exclude' => '1',
                )
            );
            $slug_counts = array();

            foreach( $post_cat_lists as $post_cat_list ){

                if( $post_cat_list->count >= 1 ){
                    $slug_counts[] = array( 
                        'count'         => $post_cat_list->count,
                        'slug'          => $post_cat_list->slug,
                        'name'          => $post_cat_list->name,
                        'cat_ID'        => $post_cat_list->cat_ID,
                        'description'   => $post_cat_list->category_description, 
                    );
                }
            }
            
            if( $slug_counts ){
                arsort( $slug_counts ); ?>

                <div class="theme-category-widget">
                    <ul class="theme-widget-list theme-category-list">
                    <?php
                        $i = 1;
                        foreach( $slug_counts as $key => $slug_count ){

                            if( $i > $top_category){ break; }
                            
                            $cat_link           = get_category_link( $slug_count['cat_ID'] );
                            $cat_name           = $slug_count['name'];
                            $cat_slug           = $slug_count['slug'];
                            $cat_count          = $slug_count['count'];
                            $cat_description    = $slug_count['description']; ?>

                            <li>
                                <article class="article-list">

                                    <header class="category-widget-header">

                                        <a href="<?php echo esc_url( $cat_link ); ?>">

                                            <span class="category-title"><?php echo esc_html( $cat_name ); ?></span>

                                            <span class="post-count"><?php echo absint( $cat_count ); ?></span>

                                        </a>

                                    <?php if( $enable_cat_desc && $cat_description ){ ?>

                                        <div class="category-widget-description"><?php echo esc_html( $cat_description ); ?></div>

                                    <?php } ?>

                                    </header>

                                    <?php
                                    $cat_posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 1,'category_name' => $cat_slug ) );
                                    
                                    while( $cat_posts->have_posts() ){
                                        $cat_posts->the_post(); ?>

                                        <div class="category-latest-article">
                                            <h3 class="entry-title entry-title-small">

                                                <span class="latest-category-post"><?php echo esc_html( $latest_title ); ?></span>
                                                
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>

                                            </h3>
                                        </div>

                                    <?php }
                                    wp_reset_postdata(); ?>

                                </article>
                            </li>
                        <?php
                        $i++; }
                    ?>
                    </ul>
                </div>

                <?php 
            }
            echo $args['after_widget'];
        }
    }
endif;