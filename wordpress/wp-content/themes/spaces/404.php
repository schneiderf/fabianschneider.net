<?php
/**
 * The template for displaying the 404 error page
 * This page is set automatically, not through the use of a template
 *
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */
 
get_header(); ?>

<div class="row"> 
	
	<div class="entry-content">
		
		<div class="error-logo">
			<a href="<?php echo home_url(); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="home">
			<?php if( get_theme_mod( '404-img-upload' )) { ?>  
  				<img src="<?php echo get_theme_mod( '404-img-upload' )?>"/>
			<?php } else { ?>
				<img src="<?php echo get_template_directory_uri(); echo '/assets/images/404.png'; ?>">
			<?php } ?>
			</a>	
		</div><!-- END .error-logo -->
	
		<p class="title"><?php echo get_theme_mod( 'error_text' ); ?></p>

		<p>&larr; <a href="javascript:javascript:history.go(-1)"><?php _e( 'Go Back', 'bean' ); ?></a><?php _e( ' or ', 'bean' ); ?><a href="<?php echo home_url(); ?>"><?php _e( 'Go Home', 'bean' ); ?></a> &rarr;</p>
		 
	</div><!-- END .entry-content -->
	
</div><!-- END .row -->

<?php get_footer();