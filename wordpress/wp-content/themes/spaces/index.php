<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

get_header(); ?>

<div class="row fadein">

	<ul id="grid-container" class="grid">
		<?php if (have_posts()) : while (have_posts()) : the_post(); 
			get_template_part( 'loop-post' ); //PULL LOOP-POST.PHP	
			endwhile; endif; 
		?>
	</ul>

</div><!-- END .row -->

<?php get_footer();