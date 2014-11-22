<?php
/**
 * The template for displaying the portfolio singular page.
 *
 * 
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

get_header(); ?>

<div class="row">

	<section id="post-<?php the_ID(); ?>" <?php post_class('fadein'); ?>>

		<div class="entry-content-media">	
			<?php $image_info = getimagesize($post->guid); ?>
			<img src="<?php echo $post->guid; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" <?php echo $image_info[3]; ?> />
		</div><!-- END .entry-content-media-->

		<div class="entry-content">
			<h1 class="entry-title"><?php the_title(); ?></h1>		
			<p class="subtext"><?php _e( 'Uploaded ', 'bean' ); ?><?php the_time(get_option('date_format')); ?></p>
		</div><!-- END .entry-content-->

	</section><!-- END #post-<?php the_ID(); ?> -->	

</div><!-- END .row -->

<?php get_footer();