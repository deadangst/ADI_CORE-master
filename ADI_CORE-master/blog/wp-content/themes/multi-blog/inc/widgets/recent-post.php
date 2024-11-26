<?php
/**
 * Recent Post Widgets.
 *
 * @package Multi Blog
 */
if ( !function_exists('multi_blog_recent_post_widgets') ) :
    
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function multi_blog_recent_post_widgets(){

        // Recent Post widget.
        register_widget('Multi_Blog_Sidebar_Recent_Post_Widget');

    }

endif;

add_action('widgets_init', 'multi_blog_recent_post_widgets');

// Recent Post widget
if ( !class_exists('Multi_Blog_Sidebar_Recent_Post_Widget') ) :
    /**
     * Recent Post.
     *
     * @since 1.0.0
     */
    class Multi_Blog_Sidebar_Recent_Post_Widget extends Multi_Blog_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'multi_blog_recent_post_widget',
                'description' => esc_html__('Displays post form selected category specific for popular post in sidebars.', 'multi-blog'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Title:', 'multi-blog'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => esc_html__('Select Category:', 'multi-blog'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'multi-blog'),
                ),
                'enable_counter' => array(
                    'label' => esc_html__('Enable Counter:', 'multi-blog'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'post_number' => array(
                    'label' => esc_html__('Number of Posts:', 'multi-blog'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 9,
                ),
            );
            parent::__construct( 'multi-blog-popular-sidebar-layout', esc_html__('Multi Blog: Recent Post Widget', 'multi-blog'), $opts, array(), $fields );
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget( $args, $instance )
        {
            $params = $this->get_params( $instance );
            echo $args['before_widget'];
            if ( !empty( $params['title'] ) ) {
                echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
            }
            $qargs = array(
                'posts_per_page' => esc_attr( $params['post_number'] ),
                'no_found_rows' => true,
            );
            if ( absint( $params['post_category'] ) > 0 ) {
                $qargs['cat'] = absint($params['post_category']);
            }
            $recent_posts_query = new WP_Query( $qargs );
            $count = 1;
            
            if ( $recent_posts_query->have_posts() ) : ?>
                <div class="twp-recent-widget">                
                    <ul class="theme-widget-list recent-widget-list">
                    <?php
                    while ( $recent_posts_query->have_posts() ) :
                        $recent_posts_query->the_post(); ?>
                        <li>
                            <article class="article-list">
                                <div class="column-row column-row-small">
                                    <div class="column column-4">
                                        <div class="article-image">
                                            <?php

                                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
                                            $thumb = isset( $thumb[0] ) ? $thumb[0] : '';
                                            ?>
                                            <a href="<?php the_permalink(); ?>" class="data-bg data-bg-thumbnail" data-background="<?php echo esc_url( $thumb ); ?>"></a>
                                            <?php
                                            if ( true === $params['enable_counter'] ) { ?>
                                                <div class="trend-item">
                                                    <span class="number"> <?php echo $count; ?></span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="column column-8">
                                        <div class="article-body">
                                            <h3 class="entry-title entry-title-small">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <div class="entry-meta">
                                                <?php multi_blog_posted_on(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </li>
                        <?php 
                        $count++;
                    endwhile; ?>
                    
                    </ul>
                </div>
                <?php wp_reset_postdata();
            endif;
            
            echo $args['after_widget'];
        }
    }
endif;