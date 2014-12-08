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

get_header();

//VIEWS
bean_setPostViews(get_the_ID());

//META
$portfolio_content_display = get_post_meta($post->ID, '_bean_portfolio_content_display', true);
$gallery_layout = get_post_meta($post->ID, '_bean_gallery_layout', true);
$portfolio_date = get_post_meta($post->ID, '_bean_portfolio_date', true); 
$portfolio_url = get_post_meta($post->ID, '_bean_portfolio_url', true); 
$portfolio_views = get_post_meta($post->ID, '_bean_portfolio_views', true);
$portfolio_client = get_post_meta($post->ID, '_bean_portfolio_client', true); 
$portfolio_cats = get_post_meta($post->ID, '_bean_portfolio_cats', true); 
$portfolio_tags = get_post_meta($post->ID, '_bean_portfolio_tags', true); 
$portfolio_review = get_post_meta($post->ID, '_bean_portfolio_review', true); 
$portfolio_page = get_theme_mod('portfolio_page_selector');

//VIDEOS
$portfolio_video_position = post_custom( 'video_position' );

//RANDOMIZE
$orderby = get_post_meta($post->ID, '_bean_portfolio_randomize', true);
$orderby = ( $orderby == 'off' ) ? 'post__in' : 'rand';

//LAYOUT
//WE ARE USING THE GLOBAL THEME CUSTOMIZER VALUE AS PRIORITY HERE, BUT IF THE PORTFOLIO LAYOUT 
//FROM THE PORTFOLIO POST META IS NOT "DEFAULT", THEN WE PULL THAT.
$portfolio_layout = get_post_meta($post->ID, '_bean_portfolio_layout', true);
if ($portfolio_layout == 'default') {
	if 	  ( get_theme_mod( 'theme_version') == 'theme_version_fullscreen') { $portfolio_layout = 'fullscreen'; } 
	elseif ( get_theme_mod( 'theme_version') == 'theme_version_fullwidth') { $portfolio_layout = 'fullwidth'; }
	elseif ( get_theme_mod( 'theme_version') == 'theme_version_carousel') { $portfolio_layout = 'carousel'; }
	elseif ( get_theme_mod( 'theme_version') == 'theme_version_grid') { $portfolio_layout = 'grid'; }
	else   { $portfolio_layout = 'std'; }
}



//!FULLSCREEN SINGLE PORTFOLIO OUTPUT (NOT FULLSCREEN)
if ($portfolio_layout != 'fullscreen') {  ?>

	<div class="row fadein<?php if ($portfolio_layout == 'std') { echo ' portfolio';} ?>">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


		<?php if ($portfolio_layout == 'std') {  ?>

			<ul id="masonry-container" class="grid <?php if ($gallery_layout == 'portfolio-lightbox') { echo ' lb-layout';} ?>">
				
				<?php if ($portfolio_content_display == 'on') { ?>
					<?php echo '<lmedmedclass="masonry-item portfolio-content">'; get_template_part( 'content', 'portfolio-meta' ); echo '</li>'; ?>
				<?php } ?>

				<?php get_template_part( 'content', 'portfolio-media' ); ?>
				
				<?php bean_gallery($post->ID, 'post-feat', $gallery_layout , $orderby , true); ?>
		
				<?php if ($portfolio_review) 
				{ 
					echo '<li class="masonry-item portfolio-content portfolio-review">'; 
						echo '<div class="portfolio-wrap"><span class="quote-icon"></span>';
							echo $portfolio_review; 
						echo '</div>';
					echo '</li>'; 
				} ?>

				<?php if ( get_theme_mod( 'show_portfolio_sharing' ) == true ) { ?>
					<?php echo '<li class="masonry-item portfolio-content social">'; get_template_part( 'content', 'portfolio-social' ); echo '</li>'; ?>
				<?php } ?>

			</ul><!-- END #masonry-container -->

			<script type="text/javascript">
				jQuery(document).ready(function($) {
					//MASONRY
					var container = document.querySelector('#masonry-container');
				     var msnry;
				     imagesLoaded( container, function() {
						msnry = new Masonry( container, {
							itemSelector: '.masonry-item'
						});
				     });

				});
			</script>

		<?php } //END if ($portfolio_layout == 'std') ?>



		<?php if ($portfolio_layout == 'fullwidth') {  ?>

			<div class="eight columns sidebar-right portfolio-intro-text">

				<h1><?php the_title(); ?></h1>

				<div class="entry-content">

					<?php the_content(); ?>

				</div><!-- END .entry-content-->

			</div>
			
				<ul class="stacked <?php if ($gallery_layout == 'portfolio-lightbox') { echo ' lb-layout';} ?>">
					
					<?php if ($portfolio_video_position == 'front') { get_template_part( 'content', 'portfolio-media' ); } ?>
					
					<?php bean_gallery($post->ID, 'port-full', $gallery_layout , $orderby , true); ?>
					
					<?php if ($portfolio_video_position == 'back') { get_template_part( 'content', 'portfolio-media' ); } ?>
						
					<?php if ($portfolio_review) { ?> 
						<li class="portfolio-content fullwidth-review portfolio-review">
							<div class="portfolio-wrap">
								<span class="quote-icon"></span>
								<?php echo $portfolio_review; ?>
							</div>
						</li>
					<?php } ?>
	
				</ul><!-- END .stacked -->

			<?php get_template_part( 'content', 'portfolio-meta' ); ?>

			<div class="eight columns sidebar-right">

				<div class="entry-content">

					<?php get_template_part( 'content', 'portfolio-social' ); ?>

				</div>

			</div>

		<?php } //END if ($portfolio_layout == 'fullwidth') ?>



		<?php endwhile; endif; wp_reset_postdata(); ?>

	</div><!-- END .row -->

<?php } //END if ($portfolio_layout == 'std' OR $portfolio_layout == 'fullwidth' )



//FULLSCREEN SINGLE PORTFOLIO OUTPUT
if ($portfolio_layout == 'fullscreen') {  ?>

	<?php bean_gallery($post->ID, 'port-full', 'fullscreen' , $orderby , true); ?>

	<div class="row">
		<?php get_template_part( 'content', 'portfolio-meta' ); ?>
	</div><!-- END .row -->

<?php } //END if ($portfolio_layout == 'fullscreen')



//CAROUSEL SINGLE PORTFOLIO OUTPUT
if ($portfolio_layout == 'carousel') { ?>

	<div class="row carousel portfolio fullscreen <?php if ($portfolio_content_display == 'off') { echo 'no-content'; }?>">

		<?php bean_gallery($post->ID, 'grid-feat', 'port-single-crsl' , $orderby , true); ?>

	</div><!-- END .row.carousel.portfolio.fullscreen -->

	<div class="row">
		<?php get_template_part( 'content', 'portfolio-meta' ); ?>
	</div><!-- END .row -->

<?php } //END if ($portfolio_layout == 'carousel')



//GALLERY GRID SINGLE PORTFOLIO OUTPUT
if ($portfolio_layout == 'grid') {  ?>

	<div class="row portfolio fadein">
		
		<ul id="portfolio-grid" class="hfeed grid gallery-grid <?php echo get_theme_mod( 'portfolio_column_width');?>">
			<?php bean_gallery($post->ID, 'port-grid-lightbox', 'grid-gallery' , $orderby , true); ?>

			<?php if ( get_theme_mod( 'show_portfolio_loop_single' ) == false ) { ?>
				<?php if ($portfolio_page) { ?>
		               <li id="load-more">
		                    <div class="portfolio">
		                    <a class="entry-link" href="<?php echo get_page_link($portfolio_page); ?>"></a> 
		                         <?php if ( get_theme_mod( 'theme_style') == 'theme_style_2') { ?>
		                              <img src="<?php echo get_template_directory_uri(); echo '/assets/styles/style-2/images/placeholder.png'; ?>">
		                         <?php } else { ?> 
		                              <img src="<?php echo get_template_directory_uri(); echo '/assets/images/placeholder.png'; ?>">
		                         <?php } ?>
		                         <div class="overlay">
		                              <h5><?php echo  __('Portfolio &rarr;', 'bean') ?></h5>
		                         </div><!-- END .overlay -->
		                    </div><!-- END .portfolio -->
		               </li><!-- END #load-more -->
           		<?php } //END  if ($portfolio_page) ?> 
			<?php } //END if ( get_theme_mod( 'show_portfolio_loop_single' ) == true ) ?>

		</ul><!-- END #portfolio-grid -->
		
		<?php if ($portfolio_content_display == 'on') { ?>
			<div class="row portfolio">
				<?php get_template_part( 'content', 'portfolio-meta' ); ?>
			</div><!-- END .row -->	
		<?php }  ?>

	</div><!-- END .row -->	

<?php } //END if ($portfolio_layout == 'grid')



//MORE LOOP PULL
if ( get_theme_mod( 'show_portfolio_loop_single' ) == true ) {
	
	//SWITCHER FOR MORE OR RELATED LOOP
	$more_loop = get_theme_mod( 'portfolio_more_loop' );
	if( $more_loop != '' ) 
	{
		switch ( $more_loop ) 
		{
		case 'related':

			$terms = get_the_terms( $post->ID, 'portfolio_category' );
			if ( $terms && ! is_wp_error( $terms ) ) :
					get_template_part( 'content', 'portfolio-related' );
			endif;
			
			break;
		case 'more':

			get_template_part( 'content', 'portfolio-more' );
			
			break;
		}
	}

} //END if ( get_theme_mod( 'show_portfolio_loop_single' ) == true ) ?>

<?php get_footer();