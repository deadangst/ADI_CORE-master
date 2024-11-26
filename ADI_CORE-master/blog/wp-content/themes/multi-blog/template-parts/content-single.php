<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Multi Blog
 * @since 1.0.0
 */

$multi_blog_default = multi_blog_get_default_theme_options();
$multi_blog_ed_feature_image = esc_html( get_post_meta( get_the_ID(), 'multi_blog_ed_feature_image', true ) );
$multi_blog_ed_post_views = esc_html( get_post_meta( get_the_ID(), 'multi_blog_ed_post_views', true ) );
$multi_blog_ed_post_read_time = esc_html( get_post_meta( get_the_ID(), 'multi_blog_ed_post_read_time', true ) );
$multi_blog_ed_post_like_dislike = esc_html( get_post_meta( get_the_ID(), 'multi_blog_ed_post_like_dislike', true ) );
$multi_blog_ed_post_author_box = esc_html( get_post_meta( get_the_ID(), 'multi_blog_ed_post_author_box', true ) );
$multi_blog_ed_post_social_share = esc_html( get_post_meta( get_the_ID(), 'multi_blog_ed_post_social_share', true ) );
$multi_blog_ed_post_reaction = esc_html( get_post_meta( get_the_ID(), 'multi_blog_ed_post_reaction', true ) );

if( $multi_blog_ed_post_views ){ multi_blog_disable_post_views(); }
if( $multi_blog_ed_post_read_time ){ multi_blog_disable_post_read_time(); }
if( $multi_blog_ed_post_like_dislike ){ multi_blog_disable_post_like_dislike(); }
if( $multi_blog_ed_post_author_box ){ multi_blog_disable_post_author_box(); }
if( $multi_blog_ed_post_reaction ){ multi_blog_disable_post_reaction(); }

$multi_blog_single_layout = get_post_meta(get_the_ID(), 'multi_blog_single_layout', true);
if (empty ($multi_blog_single_layout)) {
	$multi_blog_single_layout = esc_html( get_theme_mod( 'multi_blog_single_post_layout',$multi_blog_default['multi_blog_single_post_layout'] ) );
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
<?php if ($multi_blog_single_layout == 'layout-1') { ?>

	<?php if( has_post_thumbnail() ){
		
		if( is_single() ){

			if( empty( $multi_blog_ed_feature_image ) ){ ?>

				<div class="post-thumbnail">

					<?php multi_blog_post_thumbnail(); ?>
						
				</div>

			<?php
			}

		}else{ ?>

			<div class="post-thumbnail">
			
				<?php multi_blog_post_thumbnail(); ?>

			</div>

		<?php
		}

	}

	if ( is_singular() ) { ?>

		<header class="entry-header entry-header-1">

			<h1 class="entry-title entry-title-large">

	            <span><?php the_title(); ?></span>

	        </h1>

		</header>

	<?php }

	if( is_single() && 'post' === get_post_type() ){ ?>

		<div class="entry-meta">

			<?php
			multi_blog_posted_by();
			multi_blog_posted_on();
			multi_blog_entry_footer( $cats = true, $tags = false, $edits = false );
			?>

		</div>

	<?php } ?>
<?php } ?>
	<div class="post-content-wrap <?php if( 'post' != get_post_type() || $multi_blog_ed_post_social_share || !class_exists( 'Booster_Extension_Class' ) ){ echo 'twp-no-social-share'; } ?>">

		<?php if( is_singular() && empty( $multi_blog_ed_post_social_share ) && class_exists( 'Booster_Extension_Class' ) && 'post' === get_post_type() ){ ?>

			<div class="post-content-share">
				<?php echo do_shortcode('[booster-extension-ss layout="layout-1" status="enable"]'); ?>
			</div>

		<?php } ?>

		<div class="post-content">

			<div class="entry-content">

				<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'multi-blog' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'multi-blog' ),
					'after'  => '</div>',
				) ); ?>

			</div>

			<?php
			if ( is_singular() && 'post' === get_post_type() ){ ?>

				<div class="entry-footer">
                    <div class="entry-meta">
                        <?php multi_blog_entry_footer( $cats = false, $tags = true, $edits = true ); ?>
                    </div>
				</div>

			<?php } ?>

		</div>

	</div>

</article>