<?php
/**
 * Template Name: Under Construction 
 * The template for displaying the under construction page template.
 *
 * 
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */
 
get_header(); 
?>

<div class="construction-banner"></div>

	<div class="row"> 

		<div class="five columns centered mobile-four">
			
			<div class="entry-content">

				<h1 class="entry-title"><?php the_title(); ?></h1>

				<?php while ( have_posts() ) : the_post(); the_content(); endwhile; // THE LOOP ?>
				
			</div><!-- END .entry-content -->

		</div><!-- END .five.columns.centered.mobile-four -->

	</div><!-- END .row -->

<div class="construction-banner btm"></div>

<?php get_footer();