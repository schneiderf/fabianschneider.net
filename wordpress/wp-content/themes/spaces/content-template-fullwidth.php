<?php
/**
 * The content for the fullwidth portfolio template.
 *
 *
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */


//PULL PAGINATION FROM CUSTOMIZATION
$portfolio_posts_count = get_theme_mod( 'portfolio_posts_count');

//PULL PAGINATION FROM READING SETTINGS
$paged = 1; 
if ( get_query_var('paged') ) $paged = get_query_var('paged');
if ( get_query_var('page') ) $paged = get_query_var('page');

//GET THE LOOP ORDERBY & META_KAY VARIABLES VIA THEME CUSTOMIZER
$orderby = get_theme_mod( 'portfolio_loop_orderby' );

//LOOP ORDERBY VARIABLE
if( $orderby != '' ) {
	switch ( $orderby ) {
		case 'date': 
		$order = 'DSC';
		$orderby = 'date';
		$meta_key = ''; 
		break;
		case 'rand': 
		$order = 'DSC';
		$orderby = 'rand';
		$meta_key = ''; 
		break;
		case 'menu_order': 
		$order = 'ASC';
		$orderby = 'menu_order';
		$meta_key = ''; 
		break;	
		case 'view_count':
		$order = 'DSC';
		$orderby = 'meta_value_num'; 
		$meta_key = 'post_views_count'; 
		break;
	}
}?>

<div class="row fadein">

	<ul class="home-portfolio-fullwidth">
		
		<?php 
		if ( is_tax() ) {
			global $query_string; query_posts("{$query_string}&posts_per_page=-1");
			if (have_posts()) : while (have_posts()) : the_post();	                 
			
				$slide_img = get_post_meta($post->ID, '_bean_home_slider_image', true);

				if ( ( $slide_img OR function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
				
					<li>
						<div class="post-thumb">
							
							<a title="<?php printf(__('Permanent Link to %s', 'bean'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
								<?php if ($slide_img) { ?>
									<img src="<?php echo $slide_img;?>" />
								<?php } else { ?>
									<?php the_post_thumbnail('post-feat'); ?>
								<?php } ?>
								<div class="overlay fadein"><h1><?php the_title(); ?></h1></div>
							</a>
					
						</div><!-- END .post-thumb -->
					</li>
					
				<?php } //END if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) ?> 

			<?php endwhile; endif; wp_reset_postdata(); 

		} else {
			//SET PORTFOLIO LOOP
			$args = array(
				'post_type'      => 'portfolio',
				'order'		  => $order,
				'orderby'		  => $orderby,
				'paged' 		  => $paged,
				'meta_key' 	  => $meta_key,
				'posts_per_page' => $portfolio_posts_count,
				);
			
			query_posts($args); if (have_posts()) : while (have_posts()) : the_post();
				
				$slide_img = get_post_meta($post->ID, '_bean_home_slider_image', true);

				if ( ( $slide_img OR function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
				
					<li>
						<div class="post-thumb">
							
							<a title="<?php printf(__('Permanent Link to %s', 'bean'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
								<?php if ($slide_img) { ?>
									<img src="<?php echo $slide_img;?>" />
								<?php } else { ?>
									<?php the_post_thumbnail('post-feat'); ?>
								<?php } ?>
								<div class="overlay fadein"><h1><?php the_title(); ?></h1></div>
							</a>
					
						</div><!-- END .post-thumb -->
					</li>
					
				<?php } //END if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) ?> 

			<?php endwhile; endif; ?>

		<?php 
		} //END else ?> 

	</ul><!-- END .home-portfolio-fullwidth -->

</div><!-- END.row -->