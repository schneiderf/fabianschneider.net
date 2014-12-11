<?php
/**
 * The template for displaying the portfolio meta.
 * Note that we are using the $portfolio_layout to generate two separate styles within this file.
 * 
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

get_header();

wp_reset_query();

//VIEW COUNTER
bean_setPostViews(get_the_ID());

//SETTING UP META
$portfolio_content_display = get_post_meta($post->ID, '_bean_portfolio_content_display', true); 
$portfolio_date = get_post_meta($post->ID, '_bean_portfolio_date', true); 
$portfolio_url = get_post_meta($post->ID, '_bean_portfolio_url', true); 
$portfolio_views = get_post_meta($post->ID, '_bean_portfolio_views', true);
$portfolio_client = get_post_meta($post->ID, '_bean_portfolio_client', true); 
$portfolio_cats = get_post_meta($post->ID, '_bean_portfolio_cats', true); 
$portfolio_tags = get_post_meta($post->ID, '_bean_portfolio_tags', true);

//CUSTOM
$portfolio_mypart = post_custom( 'mypart' );
$portfolio_brand = post_custom( 'brand' );
$portfolio_agency = post_custom( 'agency' );
$portfolio_linktext = post_custom( 'linktext' );


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
?>

<?php if ($portfolio_content_display == 'on') { ?> 

	<div class="clearfix">

		<div class="portfolio-wrap <?php if ($portfolio_layout == 'grid') { echo 'gallery-grid'; } ?>">

			<?php if ($portfolio_layout == 'fullwidth' OR $portfolio_layout == 'fullscreen' OR $portfolio_layout == 'grid') { echo '<div class="eight columns sidebar-right">'; } ?>

				<?php if ($portfolio_layout == 'std') { ?>
					<?php if( get_theme_mod( 'post_likes' ) == true) { ?>
						<?php Bean_PrintLikes($post->ID); ?>
					<?php } //END if get_theme_mod( 'post_likes' ) ?> 
				<?php } //END $portfolio_layout == 'std' ?> 

				
				<?php if ($portfolio_url) { // DISPLAY PORTFOLIO URL ?>
					<div class= "entry-content">
						<div class="portfolio-link clearfix"><a href="<?php echo $portfolio_url; ?>" target="_blank" ><i class="fa fa-long-arrow-right"></i><?php echo $portfolio_linktext; ?></a></div>
					</div>
				<?php } ?>
				

			<?php if ($portfolio_layout != 'std') { echo '</div>'; } ?>

			<?php if ($portfolio_layout == 'fullwidth' OR $portfolio_layout == 'fullscreen' OR $portfolio_layout == 'grid') { echo '<div class="eight columns sidebar-right">'; } ?>

				<?php if ($portfolio_mypart) { // DISPLAY MYPART SECTION ?>
					<div class= "entry-content">
						<h2>My role</h2>
						<ul>
						<?php echo $portfolio_mypart; ?>
						</ul>
					</div>
				<?php } ?>

			<?php if ($portfolio_layout != 'std') { echo '</div>'; } ?>

			<?php if ($portfolio_layout == 'fullwidth' OR $portfolio_layout == 'fullscreen' OR $portfolio_layout == 'grid') { echo '<div class="four columns portfolio-full-meta">'; } ?>	

				<ul class="entry-meta clearfix subtext">
						
					<!-- CLIENT -->	
					<?php if ($portfolio_client) { // DISPLAY CLIENT ?>
						<li><span class="post-meta-key"><?php _e( 'Client ', 'bean' ); ?></span>
							<p>
							<?php echo $portfolio_client; ?>
							</p>
						</li> 
					<?php } ?>

					<!-- BRAND -->
					<?php if ($portfolio_brand) { // DISPLAY BRAND ?>
					<li>
						<span class="post-meta-key">Brand</span>
						<p>
						<?php echo $portfolio_brand; ?>
						</p>
					</li> 
					<?php } ?>

					<!-- AGENCY -->
					<?php if ($portfolio_agency) { // DISPLAY AGENCY ?>
					<li>
						<span class="post-meta-key">Agency</span>
						<p>
						<?php echo $portfolio_agency; ?>
						</p>
					</li>
					<?php } ?>
					
					<?php if ($portfolio_date == 'on') { ?> 
						<li><span class="post-meta-key"><?php _e( 'Date ', 'bean' ); ?></span>
						<p>
						<?php the_time(get_option('date_format')); ?>
						</p>
						</li>
					<?php } ?>
					
					<?php if ($portfolio_cats == 'on') { // DISPLAY CATEGORY ?>	
						<?php $terms = get_the_terms( $post->ID, 'portfolio_category' ); ?>
						<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
							<li class="tax"><span class="post-meta-key"><?php _e( 'Category ', 'bean' ); ?></span>
							<p>
							<?php the_terms($post->ID, 'portfolio_category', '', ', ', ''); ?>
							</p>
							</li>
						<?php endif;?>
					<?php } ?>
					
					<?php if ($portfolio_views == 'on') { // DISPLAY VIEWS ?>	
						<li><span class="post-meta-key"><?php _e( 'Views ', 'bean' ); ?></span><?php echo bean_getPostViews(get_the_ID()); ?><?php _e( ' & Counting', 'bean' ); ?></li>
					<?php } ?>
					

					<!-- CATEGORIES -->
					<?php if ($portfolio_tags == 'on') { // DISPLAY CATEGORY ?>	
						<li class="tax"><span class="post-meta-key"><?php _e( 'Tags ', 'bean' ); ?></span><?php the_terms($post->ID, 'portfolio_tag', '#', ' #', ''); ?></li>
					<?php } ?>				

					
				</ul><!-- END .entry-meta-->

			<?php if ($portfolio_layout != 'std' ) { echo '</div>'; } ?>	

		</div><!-- END .portfolio-wrap -->

	</div>

<?php } ?> 