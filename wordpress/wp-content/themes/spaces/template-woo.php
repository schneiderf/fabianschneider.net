<?php
/**
 * Template Name: Woo Default
 * The template for displaying the WooCommerce templates.
 *
 * 
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

get_header(); bean_sidebar_loader(); 

//PAGE META
$page_title = get_post_meta($post->ID, '_bean_page_title', true);
$fullwidth_media = get_post_meta($post->ID, '_bean_fullwidth_media', true);
$fullwidth_image = get_post_meta($post->ID, '_bean_fullwidth_image', true);
$fullwidth_caption = get_post_meta($post->ID, '_bean_fullwidth_caption', true);

//ADD CLASS IF NO IMAGE IS UPLOADED
if ($fullwidth_media == 'on' && $fullwidth_image) {
	$image = 'full-img';
} else {
	$image = '';
} ?>

<div class="row">

	<section id="post-<?php the_ID(); ?>" <?php post_class('fadein'); ?>>

		<?php if( $fullwidth_media == 'on' && $fullwidth_image ) {  ?>

			<div class="entry-content-media">
				<?php echo '<img src='.$fullwidth_image.'>'; ?>
				<?php if ($fullwidth_caption) { ?>
					<span class="bean-image-caption"><?php echo $fullwidth_caption ?></span>
				<?php } ?>
			</div><!-- END .entry-content-media -->

		<?php } //END $fullwidth_media == 'on' && $fullwidth_image ?>

		<div class="<?php echo $bean_content_class; ?> <?php echo $image ?>">
			
			<?php if ( $page_title == 'on' ) { ?><h1 class="entry-title"><?php the_title(''); ?></h1><?php } ?>

			<div class="entry-content">

				<?php while ( have_posts() ) : the_post(); the_content(); endwhile; // THE LOOP ?>
			
				<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'bean' ) . '</span>', 'after' => '</div>' ) ); ?>
				
			</div><!-- END .entry-content -->
		
		</div><!-- END <?php echo $bean_content_class; ?> -->

		<?php if( $bean_sidebar_location === 'right' ) {
			//SIDEBAR STYLE
			$theme_style = get_theme_mod( 'theme_style');
			if ($theme_style == 'theme_style_2') { $theme_style = 'dark'; } 
			else { $theme_style = ''; }
			?>

			<div class="<?php echo $bean_sidebar_class; ?> <?php echo $theme_style; ?>">
				<?php dynamic_sidebar( 'Shop Sidebar' ); ?>
			</div><!-- END $bean_sidebar_class -->
		<?php } // END $bean_sidebar_location === 'right' ?>

	</section><!-- END #post-<?php the_ID(); ?> -->	

</div><!-- END .row -->

<?php get_footer();