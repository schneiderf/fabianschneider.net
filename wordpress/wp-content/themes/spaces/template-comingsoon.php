<?php
/**
 * Template Name: Coming Soon
 * The template for displaying the coming soon template.
 *
 * 
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

get_header();

// VARIABLES FROM THEME CUSTOMIZER
$years = get_theme_mod('comingsoon_year');
$months = get_theme_mod('comingsoon_month');
$days = get_theme_mod('comingsoon_day');

//VARIABLE DEFAULTS
if( !$years )   { $years = '2014'; }
if( !$months )  { $months = '01';  }
if( !$days ) 	{ $days = '01';    }

?>

<div class="row">

<section id="post-<?php the_ID(); ?>" <?php post_class('fadein'); ?>>
		
	<div class="seven columns centered mobile-four">
		
		<div class="entry-content">

			<h1 class="entry-title"><?php the_title(); ?></h1>
		
			<?php while ( have_posts() ) : the_post(); the_content(); endwhile; // THE LOOP ?>
			
		</div><!-- END .entry-content -->

	</div><!-- END .seven.columns.mobile-four -->

	<div class="bean-coming-soon" data-years="<?php echo $years ?>" data-months="<?php echo $months ?>" data-days="<?php echo $days ?>" data-hours="00" data-minutes="00" data-seconds="00">

		<div class="three columns mobile-two fadein days">
			<div class="count-inner">
				<div class="fadein">
					<div class="count"></div>
					<h3><div class="subtext"><?php _e( 'Days', 'bean' ); ?></div></h3>
				</div><!-- END .fadein -->
			</div><!-- END .count-inner -->	
		</div><!-- END .days -->

		<div class="three columns mobile-two fadein hours">
			<div class="count-inner">
				<div class="fadein">
					<div class="count"></div>
					<h3><div class="subtext"><?php _e( 'Hours', 'bean' ); ?></div></h3>
				</div><!-- END .fadein -->		
			</div><!-- END .count-inner -->		
		</div><!-- END .hours -->	

		<div class="three columns mobile-two fadein minutes">
			<div class="count-inner">
				<div class="fadein">
					<div class="count"></div>
					<h3><div class="subtext"><?php _e( 'Minutes', 'bean' ); ?></div></h3>
				</div><!-- END .fadein -->
			</div><!-- END .count-inner -->		
		</div><!-- END .minutes -->
			
		<div class="three columns mobile-two fadein seconds">
			<div class="count-inner">
				<div class="fadein">
					<div class="count"></div>
					<h3><div class="subtext"><?php _e( 'Seconds', 'bean' ); ?></div></h3>
				</div><!-- END .fadein -->
			</div><!-- END .count-inner -->		
		</div><!-- END .seconds -->	
		
	</div><!-- END bean-coming-soon -->

</div><!-- END .row -->

<?php get_footer();