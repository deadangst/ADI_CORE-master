<?php
/**
 * Tab Posts Widgets.
 *
 * @package Multi Blog
 */

if ( !function_exists('multi_blog_tab_posts_widgets') ) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function multi_blog_tab_posts_widgets(){
        // Tab Post widget.
        register_widget('Multi_Blog_Tab_Posts_Widget');

    }
endif;
add_action('widgets_init', 'multi_blog_tab_posts_widgets');

/* Tabed widget */
if ( !class_exists('Multi_Blog_Tab_Posts_Widget') ):

    /**
     * Tabbed widget Class.
     *
     * @since 1.0.0
     */
    class Multi_Blog_Tab_Posts_Widget extends Multi_Blog_Widget_Base {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct() {

            $opts = array(
                'classname'   => 'multi_blog_widget_tabbed',
                'description' => esc_html__('Tabbed widget.', 'multi-blog'),
            );
            $fields = array(
                'popular_heading' => array(
                    'label'          => esc_html__('Popular', 'multi-blog'),
                    'type'           => 'heading',
                ),
                'popular_title' => array(
                    'label' => esc_html__('Popular Tab Title', 'multi-blog'),
                    'type' => 'text',
                    'class' => 'widefat',
                    'default'         => esc_html__('Popular', 'multi-blog'),
                ),
                'popular_number' => array(
                    'label'         => esc_html__('No. of Posts:', 'multi-blog'),
                    'type'          => 'number',
                    'css'           => 'max-width:60px;',
                    'default'       => 5,
                    'min'           => 1,
                    'max'           => 10,
                ),
                'enable_discription' => array(
                    'label'             => esc_html__('Enable Description:', 'multi-blog'),
                    'type'              => 'checkbox',
                    'default'           => false,
                ),
                'excerpt_length' => array(
                    'label'         => esc_html__('Excerpt Length:', 'multi-blog'),
                    'description'   => esc_html__('Number of words', 'multi-blog'),
                    'default'       => 10,
                    'css'           => 'max-width:60px;',
                    'min'           => 0,
                    'max'           => 200,
                ),
                'recent_heading' => array(
                    'label'         => esc_html__('Recent', 'multi-blog'),
                    'type'          => 'heading',
                ),
                'recent_title' => array(
                    'label' => esc_html__('Recent Tab Title', 'multi-blog'),
                    'type' => 'text',
                    'class' => 'widefat',
                    'default'         => esc_html__('Recent', 'multi-blog'),
                ),
                'recent_number' => array(
                    'label'        => esc_html__('No. of Posts:', 'multi-blog'),
                    'type'         => 'number',
                    'css'          => 'max-width:60px;',
                    'default'      => 5,
                    'min'          => 1,
                    'max'          => 10,
                ),
                'comments_heading' => array(
                    'label'           => esc_html__('Comments', 'multi-blog'),
                    'type'            => 'heading',
                ),
                'comment_title' => array(
                    'label' => esc_html__('Comment Tab Title', 'multi-blog'),
                    'type' => 'text',
                    'class' => 'widefat',
                    'default'         => esc_html__('Comments', 'multi-blog'),
                ),
                'comments_number' => array(
                    'label'          => esc_html__('No. of Comments:', 'multi-blog'),
                    'type'           => 'number',
                    'css'            => 'max-width:60px;',
                    'default'        => 5,
                    'min'            => 1,
                    'max'            => 10,
                ),
            );

            parent::__construct( 'multi-blog-tabbed', esc_html__( 'Multi Blog: Tab Posts Widget', 'multi-blog' ), $opts, array(), $fields );

        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget( $args, $instance ) {

            $params = $this->get_params( $instance );
            $tab_id = 'tabbed-'.$this->number;
            
            $popular_title = isset( $params['popular_title'] ) ? $params['popular_title'] : '';
            $recent_title = isset( $params['recent_title'] ) ? $params['recent_title'] : '';
            $comment_title = isset( $params['comment_title'] ) ? $params['comment_title'] : '';

            echo $args['before_widget'];
            ?>
            <div class="tabbed-container">
                <div class="tab-head">
                    <ul class="twp-nav-tabs clear">

                        <li id="tab-popular-<?php echo esc_attr( $args['widget_id'] ); ?>" class="tab tab-popular active">
                            <a href="javascript:void(0)">
                                <span class="fire-icon tab-icon">
                                    <svg version="1.1" id="fire-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" fill="currentcolor" viewBox="0 0 611.999 611.999" style="enable-background:new 0 0 611.999 611.999;" xml:space="preserve">
                                        <g>
                                            <path d="M216.02,611.195c5.978,3.178,12.284-3.704,8.624-9.4c-19.866-30.919-38.678-82.947-8.706-149.952
                                                c49.982-111.737,80.396-169.609,80.396-169.609s16.177,67.536,60.029,127.585c42.205,57.793,65.306,130.478,28.064,191.029
                                                c-3.495,5.683,2.668,12.388,8.607,9.349c46.1-23.582,97.806-70.885,103.64-165.017c2.151-28.764-1.075-69.034-17.206-119.851
                                                c-20.741-64.406-46.239-94.459-60.992-107.365c-4.413-3.861-11.276-0.439-10.914,5.413c4.299,69.494-21.845,87.129-36.726,47.386
                                                c-5.943-15.874-9.409-43.33-9.409-76.766c0-55.665-16.15-112.967-51.755-159.531c-9.259-12.109-20.093-23.424-32.523-33.073
                                                c-4.5-3.494-11.023,0.018-10.611,5.7c2.734,37.736,0.257,145.885-94.624,275.089c-86.029,119.851-52.693,211.896-40.864,236.826
                                                C153.666,566.767,185.212,594.814,216.02,611.195z"/>
                                        </g>
                                    </svg>
                                </span>
                                <?php echo esc_html( $popular_title );?>
                            </a>
                        </li>

                        <li id="tab-recent-<?php echo esc_attr( $args['widget_id'] ); ?>" class="tab tab-recent">
                            <a href="javascript:void(0)">
                                <span class="flash-icon tab-icon">
                                    <svg version="1.1" id="flash-icon" xmlns="http://www.w3.org/2000/svg" fill="currentcolor" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve">
                                        <g>
                                            <path d="M286.363,607.148l195.851-325.636c7.954-13.225-1.571-30.069-17.003-30.069H334.436L479.335,30.732
                                                C487.998,17.537,478.532,0,462.748,0H237.426c-8.806,0-16.558,5.804-19.039,14.253l-90.655,308.81
                                                c-3.73,12.706,5.796,25.431,19.039,25.431h176.915l-55.512,251.4C265.75,610.872,280.57,616.781,286.363,607.148z"/>
                                        </g>
                                    </svg>
                                </span>
                                <?php echo esc_html( $recent_title );?>
                            </a>
                        </li>

                        <li id="tab-comments-<?php echo esc_attr( $args['widget_id'] ); ?>" class="tab tab-comments">
                            <a href="javascript:void(0)">
                                <span class="comment-icon tab-icon">
                                    <svg version="1.1" id="comment-icon" fill="currentcolor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18px" height="18px" viewBox="0 0 511.626 511.626" style="enable-background:new 0 0 511.626 511.626;" xml:space="preserve">
                                        <g>
                                            <path d="M477.371,127.44c-22.843-28.074-53.871-50.249-93.076-66.523c-39.204-16.272-82.035-24.41-128.478-24.41
                                                c-34.643,0-67.762,4.805-99.357,14.417c-31.595,9.611-58.812,22.602-81.653,38.97c-22.845,16.37-41.018,35.832-54.534,58.385
                                                C6.757,170.833,0,194.484,0,219.228c0,28.549,8.61,55.3,25.837,80.234c17.227,24.931,40.778,45.871,70.664,62.811
                                                c-2.096,7.611-4.57,14.846-7.426,21.693c-2.855,6.852-5.424,12.474-7.708,16.851c-2.286,4.377-5.376,9.233-9.281,14.562
                                                c-3.899,5.328-6.849,9.089-8.848,11.275c-1.997,2.19-5.28,5.812-9.851,10.849c-4.565,5.048-7.517,8.329-8.848,9.855
                                                c-0.193,0.089-0.953,0.952-2.285,2.567c-1.331,1.615-1.999,2.423-1.999,2.423l-1.713,2.566c-0.953,1.431-1.381,2.334-1.287,2.707
                                                c0.096,0.373-0.094,1.331-0.57,2.851c-0.477,1.526-0.428,2.669,0.142,3.433v0.284c0.765,3.429,2.43,6.187,4.998,8.277
                                                c2.568,2.092,5.474,2.95,8.708,2.563c12.375-1.522,23.223-3.606,32.548-6.276c49.87-12.758,93.649-35.782,131.334-69.097
                                                c14.272,1.522,28.072,2.286,41.396,2.286c46.442,0,89.271-8.138,128.479-24.417c39.208-16.272,70.233-38.448,93.072-66.517
                                                c22.843-28.062,34.263-58.663,34.263-91.781C511.626,186.108,500.207,155.509,477.371,127.44z"/>
                                        </g>
                                    </svg>
                                </span>
                                <?php echo esc_html( $comment_title );?>
                            </a>
                        </li>

                    </ul>
                </div>

                <div class="tab-content">

                    <div id="content-tab-popular-<?php echo esc_attr( $args['widget_id'] ); ?>" class="tab-pane active">
                        <?php $this->render_news( 'popular', $params );?>
                    </div>

                    <div id="content-tab-recent-<?php echo esc_attr( $args['widget_id'] ); ?>" class="tab-pane">
                        <?php $this->render_news('recent', $params );?>
                    </div>

                    <div id="content-tab-comments-<?php echo esc_attr( $args['widget_id'] ); ?>" class="tab-pane">
                        <?php $this->render_comments( $params );?>
                    </div>

                </div>
            </div>
            <?php

            echo $args['after_widget'];

        }

        /**
         * Render news.
         *
         * @since 1.0.0
         *
         * @param array $type Type.
         * @param array $params Parameters.
         * @return void
         */
        function render_news($type, $params) {

            if ( !in_array( $type, array('popular', 'recent') ) ) {
                return;
            }

            switch ($type) {
                case 'popular':
                    $qargs = array(
                        'posts_per_page' => $params['popular_number'],
                        'no_found_rows'  => true,
                        'orderby'        => 'comment_count',
                    );
                    break;

                case 'recent':
                    $qargs = array(
                        'posts_per_page' => $params['recent_number'],
                        'no_found_rows'  => true,
                    );
                    break;

                default:
                    break;
            }

            $tab_posts_query = new WP_Query( $qargs );

            if ( $tab_posts_query->have_posts() ): ?>

                <ul class="theme-widget-list article-tabbed-list">

                    <?php
                    while ( $tab_posts_query->have_posts() ):
                        $tab_posts_query->the_post(); ?>

                        <li>
                            <article class="article-list">

                                <div class="column-row column-row-small">

                                    <div class="column column-4">
                                        <div class="article-image">

                                            <?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
                                            $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>
                                            <a href="<?php the_permalink();?>" class="data-bg data-bg-thumbnail" data-background="<?php echo esc_url( $featured_image ); ?>"></a>

                                        </div>
                                    </div>

                                    <div class="column column-8">
                                        <div class="article-body">
                                            <h3 class="entry-title entry-title-small">
                                                <a href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                    <?php the_title();?>
                                                </a>
                                            </h3>
                                            <div class="entry-meta">
                                                <?php multi_blog_posted_on(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="column-row">
                                    <div class="column column-12">

                                        <?php 
                                        if ( true === $params['enable_discription'] ) {

                                            if ( absint( $params['excerpt_length'] ) > 0): ?>

                                                <div class="entry-content entry-content-muted entry-content-small">

                                                    <?php
                                                    if( has_excerpt() ){

                                                        the_excerpt();

                                                    }else{

                                                        echo wp_kses_post( wp_trim_words( get_the_content(),25,'...') );

                                                    } ?>

                                                </div>

                                            <?php
                                            endif;

                                        } ?>

                                    </div>
                                </div>

                            </article>
                        </li>

                    <?php 
                    endwhile; ?>

                </ul><!-- .news-list -->

                <?php wp_reset_postdata();?>

            <?php endif; 

        }

        /**
         * Render comments.
         *
         * @since 1.0.0
         *
         * @param array $params Parameters.
         * @return void
         */
        function render_comments($params) {

            $comment_args = array(
                'number'      => $params['comments_number'],
                'status'      => 'approve',
                'post_status' => 'publish',
            );

            $comments = get_comments( $comment_args );
            
            if ( !empty( $comments ) ):?>
                <ul class="theme-widget-list comments-tabbed-list">

                    <?php foreach ( $comments as $key => $comment ): ?>

                        <li>
                            <div class="column-row">
                                <div class="column column-4">
                                    <div class="article-image">
                                        <?php $comment_author_url = esc_url( get_comment_author_url( $comment ) ); ?>

                                        <?php if ( !empty( $comment_author_url ) ): ?>

                                            <a href="<?php echo esc_url( $comment_author_url ); ?>">
                                                <?php echo wp_kses_post( get_avatar( $comment, 130 ) ); ?>
                                            </a>

                                        <?php  else : ?>

                                            <?php echo wp_kses_post( get_avatar( $comment, 130 ) ); ?>

                                        <?php endif;?>

                                    </div>
                                </div>

                                <div class="column column-8">
                                    <div class="article-body">

                                        <div class="entry-meta">
                                            <?php echo wp_kses_post( get_comment_author_link( $comment ) ); ?>
                                        </div>

                                        <h3 class="entry-title entry-title-small">
                                            <a href="<?php echo esc_url( get_comment_link( $comment ) ); ?>">
                                                <?php echo esc_html( get_the_title( $comment->comment_post_ID ) );?>
                                            </a>
                                        </h3>

                                    </div>
                                </div>

                            </div>
                        </li>

                    <?php endforeach; ?>

                </ul><!-- .comments-list -->
            <?php
            endif;
        }

    }
endif;
