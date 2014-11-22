<?php
/**
 * Template Name: Post Archives
 * The template for displaying the post archives template.
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

		<div class="<?php echo $bean_content_class; ?>  <?php echo $image; ?>">
			
			<div class="entry-content">

				<?php if ( $page_title == 'on' ) { ?><h1 class="entry-title"><?php the_title(''); ?></h1><?php } ?>

				<?php while ( have_posts() ) : the_post(); the_content(); endwhile; // THE LOOP ?>
			
				<div class="archives-list">
				
					<h6><?php _e( 'Last 30 Posts', 'bean' );?></h6>

					<ul>
						<?php $archive_30 = get_posts('numberposts=30');
						foreach($archive_30 as $post) : ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
						<?php endforeach; ?>
					</ul>

					<h6><?php _e( 'Archives by Month', 'bean' );?></h6>

					<ul><?php wp_get_archives('type=monthly'); ?></ul>

					<h6><?php _e( 'Archives by Category ', 'bean' );?></h6>

					<ul><?php wp_list_categories( 'title_li=' ); ?></ul>

				</div><!-- END .archives-list --> 

				<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'bean' ) . '</span>', 'after' => '</div>' ) ); wp_reset_query(); ?>
			
				<?php if( bean_theme_supports( 'comments', 'pages' )) {
					bean_comments_start();
					comments_template('', true);
					bean_comments_end();
				} ?>
				
			</div><!-- END .entry-content -->
		
		</div><!-- END <?php echo $bean_content_class; ?> -->

		<?php if( $bean_sidebar_location === 'right' ) {
			//SIDEBAR STYLE
			$theme_style = get_theme_mod( 'theme_style');
			if ($theme_style == 'theme_style_2') { $theme_style = 'dark'; } 
			else { $theme_style = ''; }
			?>

			<div class="<?php echo $bean_sidebar_class; ?> <?php echo $theme_style; ?>">
				<?php dynamic_sidebar( 'Internal Sidebar' ); ?>
			</div><!-- END $bean_sidebar_class -->
		<?php } // END $bean_sidebar_location === 'right' ?>

	</section><!-- END #post-<?php the_ID(); ?> -->		

</div><!-- END .row -->

<?php get_footer();