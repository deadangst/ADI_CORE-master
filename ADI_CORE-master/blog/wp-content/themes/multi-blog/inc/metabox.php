<?php
/**
* Sidebar Metabox.
*
* @package Multi Blog
*/

add_action( 'add_meta_boxes', 'multi_blog_metabox' );

if( ! function_exists( 'multi_blog_metabox' ) ):


    function multi_blog_metabox() {
        
        add_meta_box(
            'twp-custom-metabox',
            esc_html__( 'Single Post Settings', 'multi-blog' ),
            'multi_blog_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
    }

endif;

$multi_blog_single_layout_options = array(
    'layout-1' => esc_html__( 'Simple Layout', 'multi-blog' ),
    'layout-2' => esc_html__( 'Banner Layout', 'multi-blog' ),
);


$multi_blog_post_sidebar_fields = array(
    'global-sidebar' => array(
                    'id'        => 'post-global-sidebar',
                    'value' => 'global-sidebar',
                    'label' => esc_html__( 'Global sidebar', 'multi-blog' ),
                ),
    'right-sidebar' => array(
                    'id'        => 'post-left-sidebar',
                    'value' => 'right-sidebar',
                    'label' => esc_html__( 'Right sidebar', 'multi-blog' ),
                ),
    'left-sidebar' => array(
                    'id'        => 'post-right-sidebar',
                    'value'     => 'left-sidebar',
                    'label'     => esc_html__( 'Left sidebar', 'multi-blog' ),
                ),
    'no-sidebar' => array(
                    'id'        => 'post-no-sidebar',
                    'value'     => 'no-sidebar',
                    'label'     => esc_html__( 'No sidebar', 'multi-blog' ),
                ),
);

/**
 * Callback function for post option.
*/
if( ! function_exists( 'multi_blog_post_metafield_callback' ) ):
    
	function multi_blog_post_metafield_callback() {

		global $post, $multi_blog_single_layout_options, $multi_blog_post_sidebar_fields;
        $post_type = get_post_type($post->ID);
		wp_nonce_field( basename( __FILE__ ), 'multi_blog_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-appearance" class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('Appearance Settings', 'multi-blog'); ?>

                        </a>
                    </li>

                    <?php
                    if( class_exists('Booster_Extension_Class') ){ ?>

                        <li>
                            <a id="twp-tab-booster" href="javascript:void(0)">

                                <?php esc_html_e('Booster Extension Settings', 'multi-blog'); ?>

                            </a>
                        </li>

                    <?php } ?>

                </ul>
            </div>

            <div class="twp-tab-content">

                <?php if( $post_type == 'post' ): ?>

                    <div id="metabox-navbar-appearance-content" class="metabox-content-wrap metabox-content-wrap-active">

                         <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Navigation Setting','multi-blog'); ?></h3>

                            <?php
                            $twp_disable_ajax_load_next_post = esc_attr( get_post_meta($post->ID, 'twp_disable_ajax_load_next_post', true) ); ?>
                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <label><b><?php esc_html_e( 'Navigation Type','multi-blog' ); ?></b></label>

                                <select name="twp_disable_ajax_load_next_post">

                                    <option <?php if( $twp_disable_ajax_load_next_post == '' || $twp_disable_ajax_load_next_post == 'global-layout' ){ echo 'selected'; } ?> value="global-layout"><?php esc_html_e('Global Layout','multi-blog'); ?></option>
                                    <option <?php if( $twp_disable_ajax_load_next_post == 'no-navigation' ){ echo 'selected'; } ?> value="no-navigation"><?php esc_html_e('Disable Navigation','multi-blog'); ?></option>
                                    <option <?php if( $twp_disable_ajax_load_next_post == 'theme-normal-navigation' ){ echo 'selected'; } ?> value="theme-normal-navigation"><?php esc_html_e('Next Previous Navigation','multi-blog'); ?></option>
                                    <option <?php if( $twp_disable_ajax_load_next_post == 'ajax-next-post-load' ){ echo 'selected'; } ?> value="ajax-next-post-load"><?php esc_html_e('Ajax Load Next 3 Posts Contents','multi-blog'); ?></option>

                                </select>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>

                <div class="metabox-opt-panel">

                    <h3 class="meta-opt-title"><?php esc_html_e('Single Page/Post','multi-blog'); ?></h3>

                    <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                        <?php
                        $multi_blog_single_layout = esc_html( get_post_meta( $post->ID, 'multi_blog_single_layout', true ) ); 
                        foreach ( $multi_blog_single_layout_options as $key => $multi_blog_single_layout_option) { ?>

                            <label class="description">
                                <input type="radio" name="multi_blog_single_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $multi_blog_single_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $multi_blog_single_layout_option ); ?>
                            </label>

                        <?php } ?>

                    </div>

                </div>

                <div id="metabox-navbar-general-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Sidebar Layout','multi-blog'); ?></h3>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <?php
                            $multi_blog_post_sidebar = esc_html( get_post_meta( $post->ID, 'multi_blog_post_sidebar_option', true ) ); 
                            if( $multi_blog_post_sidebar == '' ){ $multi_blog_post_sidebar = 'global-sidebar'; }

                            foreach ( $multi_blog_post_sidebar_fields as $multi_blog_post_sidebar_field) { ?>

                                <label class="description">

                                    <input type="radio" name="multi_blog_post_sidebar_option" value="<?php echo esc_attr( $multi_blog_post_sidebar_field['value'] ); ?>" <?php if( $multi_blog_post_sidebar_field['value'] == $multi_blog_post_sidebar ){ echo "checked='checked'";} if( empty( $multi_blog_post_sidebar ) && $multi_blog_post_sidebar_field['value']=='right-sidebar' ){ echo "checked='checked'"; } ?>/>&nbsp;<?php echo esc_html( $multi_blog_post_sidebar_field['label'] ); ?>

                                </label>

                            <?php } ?>

                        </div>

                    </div>

                </div>
                <?php 
                $multi_blog_ed_post_views = esc_html( get_post_meta( $post->ID, 'multi_blog_ed_post_views', true ) );
                $multi_blog_ed_post_read_time = esc_html( get_post_meta( $post->ID, 'multi_blog_ed_post_read_time', true ) );
                $multi_blog_ed_post_like_dislike = esc_html( get_post_meta( $post->ID, 'multi_blog_ed_post_like_dislike', true ) );
                $multi_blog_ed_post_author_box = esc_html( get_post_meta( $post->ID, 'multi_blog_ed_post_author_box', true ) );
                $multi_blog_ed_post_social_share = esc_html( get_post_meta( $post->ID, 'multi_blog_ed_post_social_share', true ) );
                $multi_blog_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'multi_blog_ed_post_reaction', true ) );
                $multi_blog_ed_post_rating = esc_html( get_post_meta( $post->ID, 'multi_blog_ed_post_rating', true ) ); ?>

                <div id="twp-tab-booster-content" class="metabox-content-wrap">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Booster Extension Plugin Content','multi-blog'); ?></h3>

                        <div class="metabox-opt-wrap twp-checkbox-wrap">

                            <input type="checkbox" id="multi-blog-ed-post-views" name="multi_blog_ed_post_views" value="1" <?php if( $multi_blog_ed_post_views ){ echo "checked='checked'";} ?>/>
                            <label for="multi-blog-ed-post-views"><?php esc_html_e( 'Disable Post Views','multi-blog' ); ?></label>

                        </div>

                        <div class="metabox-opt-wrap twp-checkbox-wrap">

                            <input type="checkbox" id="multi-blog-ed-post-read-time" name="multi_blog_ed_post_read_time" value="1" <?php if( $multi_blog_ed_post_read_time ){ echo "checked='checked'";} ?>/>
                            <label for="multi-blog-ed-post-read-time"><?php esc_html_e( 'Disable Post Read Time','multi-blog' ); ?></label>

                        </div>

                        <div class="metabox-opt-wrap twp-checkbox-wrap">

                            <input type="checkbox" id="multi-blog-ed-post-like-dislike" name="multi_blog_ed_post_like_dislike" value="1" <?php if( $multi_blog_ed_post_like_dislike ){ echo "checked='checked'";} ?>/>
                            <label for="multi-blog-ed-post-like-dislike"><?php esc_html_e( 'Disable Post Like Dislike','multi-blog' ); ?></label>

                        </div>

                        <div class="metabox-opt-wrap twp-checkbox-wrap">

                            <input type="checkbox" id="multi-blog-ed-post-author-box" name="multi_blog_ed_post_author_box" value="1" <?php if( $multi_blog_ed_post_author_box ){ echo "checked='checked'";} ?>/>
                            <label for="multi-blog-ed-post-author-box"><?php esc_html_e( 'Disable Post Author Box','multi-blog' ); ?></label>

                        </div>

                        <div class="metabox-opt-wrap twp-checkbox-wrap">

                            <input type="checkbox" id="multi-blog-ed-post-social-share" name="multi_blog_ed_post_social_share" value="1" <?php if( $multi_blog_ed_post_social_share ){ echo "checked='checked'";} ?>/>
                            <label for="multi-blog-ed-post-social-share"><?php esc_html_e( 'Disable Post Social Share','multi-blog' ); ?></label>

                        </div>

                        <div class="metabox-opt-wrap twp-checkbox-wrap">

                            <input type="checkbox" id="multi-blog-ed-post-reaction" name="multi_blog_ed_post_reaction" value="1" <?php if( $multi_blog_ed_post_reaction ){ echo "checked='checked'";} ?>/>
                            <label for="multi-blog-ed-post-reaction"><?php esc_html_e( 'Disable Post Reaction','multi-blog' ); ?></label>

                        </div>

                        <div class="metabox-opt-wrap twp-checkbox-wrap">

                            <input type="checkbox" id="multi-blog-ed-post-rating" name="multi_blog_ed_post_rating" value="1" <?php if( $multi_blog_ed_post_rating ){ echo "checked='checked'";} ?>/>
                            <label for="multi-blog-ed-post-rating"><?php esc_html_e( 'Disable Post Rating','multi-blog' ); ?></label>

                        </div>

                    </div>

                </div>
                
            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'multi_blog_save_post_meta' );

if( ! function_exists( 'multi_blog_save_post_meta' ) ):

    function multi_blog_save_post_meta( $post_id ) {

        global $post, $multi_blog_single_layout_options, $multi_blog_post_sidebar_fields;

        if ( !isset( $_POST[ 'multi_blog_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['multi_blog_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if ( 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }

        $twp_disable_ajax_load_next_post_old = sanitize_text_field( get_post_meta( $post_id, 'twp_disable_ajax_load_next_post', true ) ); 
        $twp_disable_ajax_load_next_post_new = isset( $_POST['twp_disable_ajax_load_next_post'] ) ? multi_blog_sanitize_meta_pagination( wp_unslash( $_POST['twp_disable_ajax_load_next_post'] ) ) : '' ;
        if( $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_new != $twp_disable_ajax_load_next_post_old ){

            update_post_meta ( $post_id, 'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_new );

        }elseif( '' == $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_old ) {

            delete_post_meta( $post_id,'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_old );

        }

        foreach ( $multi_blog_post_sidebar_fields as $multi_blog_post_sidebar_field ) {  
            

                $old = esc_html( get_post_meta( $post_id, 'multi_blog_post_sidebar_option', true ) ); 
                $new = isset( $_POST['multi_blog_post_sidebar_option'] ) ? multi_blog_sanitize_sidebar_option_meta( wp_unslash( $_POST['multi_blog_post_sidebar_option'] ) ) : '';

                if ( $new && $new != $old ){

                    update_post_meta ( $post_id, 'multi_blog_post_sidebar_option', $new );

                }elseif( '' == $new && $old ) {

                    delete_post_meta( $post_id,'multi_blog_post_sidebar_option', $old );

                }

            
        }


        foreach ( $multi_blog_single_layout_options as $multi_blog_single_layout_option ) {  
            
            $multi_blog_single_layout_old = sanitize_text_field( get_post_meta( $post_id, 'multi_blog_single_layout', true ) ); 
            $multi_blog_single_layout_new = sanitize_text_field( wp_unslash( $_POST['multi_blog_single_layout'] ) );

            if ( $multi_blog_single_layout_new && $multi_blog_single_layout_new != $multi_blog_single_layout_old ){

                update_post_meta ( $post_id, 'multi_blog_single_layout', $multi_blog_single_layout_new );

            }elseif( '' == $multi_blog_single_layout_new && $multi_blog_single_layout_old ) {

                delete_post_meta( $post_id,'multi_blog_single_layout', $multi_blog_single_layout_old );

            }
            
        }
        
        $multi_blog_ed_feature_image_old = absint( get_post_meta( $post_id, 'multi_blog_ed_feature_image', true ) );
        $multi_blog_ed_feature_image_new = isset( $_POST['multi_blog_ed_feature_image'] ) ? absint( wp_unslash( $_POST['multi_blog_ed_feature_image'] ) ) : '';

        if ( $multi_blog_ed_feature_image_new && $multi_blog_ed_feature_image_new != $multi_blog_ed_feature_image_old ){

            update_post_meta ( $post_id, 'multi_blog_ed_feature_image', $multi_blog_ed_feature_image_new );

        }elseif( '' == $multi_blog_ed_feature_image_new && $multi_blog_ed_feature_image_old ) {

            delete_post_meta( $post_id,'multi_blog_ed_feature_image', $multi_blog_ed_feature_image_old );

        }

        $multi_blog_ed_post_views_old = absint( get_post_meta( $post_id, 'multi_blog_ed_post_views', true ) );
        $multi_blog_ed_post_views_new = isset( $_POST['multi_blog_ed_post_views'] ) ? absint( wp_unslash( $_POST['multi_blog_ed_post_views'] ) ) : '';

        if ( $multi_blog_ed_post_views_new && $multi_blog_ed_post_views_new != $multi_blog_ed_post_views_old ){

            update_post_meta ( $post_id, 'multi_blog_ed_post_views', $multi_blog_ed_post_views_new );

        }elseif( '' == $multi_blog_ed_post_views_new && $multi_blog_ed_post_views_old ) {

            delete_post_meta( $post_id,'multi_blog_ed_post_views', $multi_blog_ed_post_views_old );

        }

        $multi_blog_ed_post_read_time_old = absint( get_post_meta( $post_id, 'multi_blog_ed_post_read_time', true ) );
        $multi_blog_ed_post_read_time_new = isset( $_POST['multi_blog_ed_post_read_time'] ) ? absint( wp_unslash( $_POST['multi_blog_ed_post_read_time'] ) ) : '';

        if ( $multi_blog_ed_post_read_time_new && $multi_blog_ed_post_read_time_new != $multi_blog_ed_post_read_time_old ){

            update_post_meta ( $post_id, 'multi_blog_ed_post_read_time', $multi_blog_ed_post_read_time_new );

        }elseif( '' == $multi_blog_ed_post_read_time_new && $multi_blog_ed_post_read_time_old ) {

            delete_post_meta( $post_id,'multi_blog_ed_post_read_time', $multi_blog_ed_post_read_time_old );

        }

        $multi_blog_ed_post_like_dislike_old = absint( get_post_meta( $post_id, 'multi_blog_ed_post_like_dislike', true ) );
        $multi_blog_ed_post_like_dislike_new = isset( $_POST['multi_blog_ed_post_like_dislike'] ) ? absint( wp_unslash( $_POST['multi_blog_ed_post_like_dislike'] ) ) : '';

        if ( $multi_blog_ed_post_like_dislike_new && $multi_blog_ed_post_like_dislike_new != $multi_blog_ed_post_like_dislike_old ){

            update_post_meta ( $post_id, 'multi_blog_ed_post_like_dislike', $multi_blog_ed_post_like_dislike_new );

        }elseif( '' == $multi_blog_ed_post_like_dislike_new && $multi_blog_ed_post_like_dislike_old ) {

            delete_post_meta( $post_id,'multi_blog_ed_post_like_dislike', $multi_blog_ed_post_like_dislike_old );

        }

        $multi_blog_ed_post_author_box_old = absint( get_post_meta( $post_id, 'multi_blog_ed_post_author_box', true ) );
        $multi_blog_ed_post_author_box_new = isset( $_POST['multi_blog_ed_post_author_box'] ) ? absint( wp_unslash( $_POST['multi_blog_ed_post_author_box'] ) ) : '';

        if ( $multi_blog_ed_post_author_box_new && $multi_blog_ed_post_author_box_new != $multi_blog_ed_post_author_box_old ){

            update_post_meta ( $post_id, 'multi_blog_ed_post_author_box', $multi_blog_ed_post_author_box_new );

        }elseif( '' == $multi_blog_ed_post_author_box_new && $multi_blog_ed_post_author_box_old ) {

            delete_post_meta( $post_id,'multi_blog_ed_post_author_box', $multi_blog_ed_post_author_box_old );

        }

        $multi_blog_ed_post_social_share_old = absint( get_post_meta( $post_id, 'multi_blog_ed_post_social_share', true ) );
        $multi_blog_ed_post_social_share_new = isset( $_POST['multi_blog_ed_post_social_share'] ) ? absint( wp_unslash( $_POST['multi_blog_ed_post_social_share'] ) ) : '';

        if ( $multi_blog_ed_post_social_share_new && $multi_blog_ed_post_social_share_new != $multi_blog_ed_post_social_share_old ){

            update_post_meta ( $post_id, 'multi_blog_ed_post_social_share', $multi_blog_ed_post_social_share_new );

        }elseif( '' == $multi_blog_ed_post_social_share_new && $multi_blog_ed_post_social_share_old ) {

            delete_post_meta( $post_id,'multi_blog_ed_post_social_share', $multi_blog_ed_post_social_share_old );

        }

        $multi_blog_ed_post_reaction_old = absint( get_post_meta( $post_id, 'multi_blog_ed_post_reaction', true ) );
        $multi_blog_ed_post_reaction_new = isset( $_POST['multi_blog_ed_post_reaction'] ) ? absint( wp_unslash( $_POST['multi_blog_ed_post_reaction'] ) ) : '';

        if ( $multi_blog_ed_post_reaction_new && $multi_blog_ed_post_reaction_new != $multi_blog_ed_post_reaction_old ){

            update_post_meta ( $post_id, 'multi_blog_ed_post_reaction', $multi_blog_ed_post_reaction_new );

        }elseif( '' == $multi_blog_ed_post_reaction_new && $multi_blog_ed_post_reaction_old ) {

            delete_post_meta( $post_id,'multi_blog_ed_post_reaction', $multi_blog_ed_post_reaction_old );

        }

        $multi_blog_ed_post_rating_old = absint( get_post_meta( $post_id, 'multi_blog_ed_post_rating', true ) );
        $multi_blog_ed_post_rating_new = isset( $_POST['multi_blog_ed_post_rating'] ) ? absint( wp_unslash( $_POST['multi_blog_ed_post_rating'] ) ) : '';

        if ( $multi_blog_ed_post_rating_new && $multi_blog_ed_post_rating_new != $multi_blog_ed_post_rating_old ){

            update_post_meta ( $post_id, 'multi_blog_ed_post_rating', $multi_blog_ed_post_rating_new );

        }elseif( '' == $multi_blog_ed_post_rating_new && $multi_blog_ed_post_rating_old ) {

            delete_post_meta( $post_id,'multi_blog_ed_post_rating', $multi_blog_ed_post_rating_old );

        }

    }

endif;   