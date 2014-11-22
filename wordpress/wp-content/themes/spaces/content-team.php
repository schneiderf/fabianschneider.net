<?php
/**
 * The content for the displaying on both the team template & the team shortcode.
 * The shortcode ouput is [team]
 * 
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */
 ?>

<ul id="masonry-container" class="team-members col4 fadein">

	<?php //LOAD TEAM MEMBER QUERY
	$args = array(
		'post_type'      => 'team',
		'order'		  => 'ASC',
		'orderby'		  => 'menu_order',
		'posts_per_page' => '-1'
		);
	
	$wp_query = new WP_Query( $args );
	
	if ($wp_query->have_posts()) : while($wp_query->have_posts()) :	$wp_query->the_post();
		get_template_part( 'loop-team' );
	endwhile; endif;

	wp_reset_postdata(); ?>

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