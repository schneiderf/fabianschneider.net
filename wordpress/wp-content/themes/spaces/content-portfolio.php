<?php
/**
 * The file for displaying the portfolio template's primary content.
 * It is pulled by the portfolio template files and is setup to reflect both templates.
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
}

//TEMPLATE SWITCHER
if( is_page_template('template-portfolio-fullwidth.php') ) { 
	get_template_part( 'content-template-fullwidth' );

} elseif( is_page_template('template-portfolio-fullwidth-lightbox.php') ) {
	get_template_part( 'content-template-fullwidth' );

} elseif( is_page_template('template-portfolio-fullscreen.php') ) {
	get_template_part( 'content-template-fullscreen' );

} elseif( is_page_template('template-portfolio-carousel.php') ) {
	get_template_part( 'content-template-carousel' );

} else {

	//LAYOUT SWITCHER
	$theme_version = get_theme_mod( 'theme_version');

	if ($theme_version == 'theme_version_fullscreen') {
		get_template_part( 'content-template-fullscreen' );

	} elseif ($theme_version == 'theme_version_fullwidth') {
		get_template_part( 'content-template-fullwidth' );

	} elseif ($theme_version == 'theme_version_grid') {
		get_template_part( 'content-template-portfolio-grid' );

	} elseif ($theme_version == 'theme_version_carousel') {
		get_template_part( 'content-template-carousel' );

	} else  { ?>

		<div class="row portfolio fadein">

			<ul id="masonry-container" class="grid">

				<?php
				if ( is_tax() ) {

					global $query_string; query_posts("{$query_string}&posts_per_page=-1");

					if (have_posts()) : while (have_posts()) : the_post();		                 
						get_template_part( 'loop-portfolio' );
					endwhile; endif; wp_reset_postdata(); 

				} else {

					//LOAD PORTFOLIO QUERY
					$args = array(
						'post_type'      => 'portfolio',
						'order'		  => $order,
						'orderby'		  => $orderby,
						'paged' 		  => $paged,
						'meta_key' 	  => $meta_key,
						'posts_per_page' => $portfolio_posts_count,
						);
					
					$wp_query = new WP_Query( $args );
					
					if ($wp_query->have_posts()) : while($wp_query->have_posts()) :	$wp_query->the_post();
						get_template_part( 'loop-portfolio' );
					endwhile; endif;

					wp_reset_postdata();

				} //END else is_tax() ?>

			</ul><!-- END #masonry-container.main -->

			<script type="text/javascript">
				jQuery(document).ready(function($) {
					var container = document.querySelector('#masonry-container');
				     var msnry;
				     imagesLoaded( container, function() {
						msnry = new Masonry( container, {
							itemSelector: '.masonry-item'
						});
				     });
				});
			</script>

		</div><!-- END .row.portfolio -->
		
	<?php
	} //END if ($theme_version == 'theme_version_fullscreen')

} //END if( is_page_template('template-portfolio-fullwidth.php')...