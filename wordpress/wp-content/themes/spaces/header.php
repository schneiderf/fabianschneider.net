<?php
/**
 * The Header template for our theme.
 *
 * Displays all of the <head> section that is pulled on every page.
 *
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */
 ?>

<!DOCTYPE HTML>
<!--[if IE 8 ]><html class="no-js ie8" lang="en"><![endif]-->
<!--[if IE 9 ]><html class="no-js ie9" lang="en"><![endif]-->

<!-- BEGIN html -->
<html <?php language_attributes(); ?>>

<head>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php bean_meta_head(); ?>
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<?php echo get_theme_mod( 'google_analytics' ); ?>
	
	<?php bean_head(); wp_head(); ?>
</head>

<body <?php body_class(); ?>> <?php bean_body_start(); ?>

	<?php if ( !is_404() && !is_page_template('template-comingsoon.php') && !is_page_template('template-underconstruction.php')) 
	{ 

		//LAYOUT
		//WE ARE USING THE GLOBAL THEME CUSTOMIZER VALUE AS PRIORITY HERE, BUT IF THE PORTFOLIO LAYOUT 
		//FROM THE PORTFOLIO POST META IS NOT "DEFAULT", THEN WE PULL THAT.
		$theme_version = get_theme_mod( 'theme_version');
		$portfolio_layout = get_post_meta($post->ID, '_bean_portfolio_layout', true);
		if ($portfolio_layout == 'default') {
			if 	  ( get_theme_mod( 'theme_version') == 'theme_version_fullscreen') { $portfolio_layout = 'fullscreen'; } 
			elseif ( get_theme_mod( 'theme_version') == 'theme_version_fullwidth') { $portfolio_layout = 'fullwidth'; }
			elseif ( get_theme_mod( 'theme_version') == 'theme_version_carousel') { $portfolio_layout = 'carousel'; }
			elseif ( get_theme_mod( 'theme_version') == 'theme_version_grid') { $portfolio_layout = 'grid'; }
			else   { $portfolio_layout = 'std'; }
		} 

		$theme_style = get_theme_mod( 'theme_style');
		if ($theme_style == 'theme_style_2') { $theme_style = 'dark_style'; } 
		else { $theme_style = ''; }

		//HEADER LAYOUT
		$header_style = get_theme_mod( 'header_style');
		if ($header_style == 'header_style_2') { $header_style = 'layout-centered'; } 
		else { $header_style = ''; }
		?>

		<div id="theme-wrapper" class="<?php echo $theme_style; ?> <?php echo $header_style; ?>">

			<nav id="mobile-nav" class="show-for-small">
					
				<?php if ( function_exists('wp_nav_menu') ) {
					wp_nav_menu( array(
						'theme_location' => 'mobile-menu'
					));
				} ?>
			
			</nav><!-- END #mobile-nav -->

			<?php if( get_theme_mod( 'hidden_sidebar' ) == true) { ?>
				<a class="sidebar-btn" href="javascript:void(0);"><span class="menu-icon slidein-right"></span></a> 
			<?php } ?>

			<div class="row">

				<header id="header">

					<?php get_template_part( 'content', 'logo' ); //PULL CONTENT-LOGO.PHP ?>
					
					<?php $header_intro = get_theme_mod('header_intro'); ?>
					
					<?php 
					//CHECK FOR CONTENT ON THESE TEMPLATES, USE THE CONTENT INSTEAD OF THE HEADER TEXT
					//ON SINGLE PORTFOLIO POSTS WE CHECK HERE TO DISPLAY THE POST'S CONTENT, IF THE DEFAULT CONTENT BLOCK IS DISABLED
					$portfolio_content_display = get_post_meta($post->ID, '_bean_portfolio_content_display', true);

					if(
					is_page_template('template-team.php') OR
					is_page_template('template-portfolio.php') OR
					is_page_template('template-testimonials.php') OR
					is_page_template('template-portfolio-grid.php') OR
					is_page_template('template-portfolio-masonry.php') OR
					is_page_template('template-portfolio-carousel.php') OR
					is_page_template('template-portfolio-fullwidth.php') OR
					is_page_template('template-portfolio-fullscreen.php') OR
					is_page_template('template-portfolio-grid-lightbox.php') OR
					is_page_template('template-portfolio-grid-fullwidth.php') OR
					is_page_template('template-portfolio-masonry-lightbox.php') OR
					is_page_template('template-portfolio-grid-fullwidth-lightbox.php') OR
					is_page_template('template-portfolio-masonry-fullwidth-lightbox.php') OR
					is_page_template('template-portfolio-masonry-fullwidth.php') OR
					is_singular('portfolio') && $portfolio_content_display == 'off'
					) {

						$content = $post->post_content; 

						if ($content) { 
								while ( have_posts() ) : the_post(); the_content(); endwhile; 
						} else { 
							if ($header_intro) { ?>
								<div class="site-description">
									<p><?php echo $header_intro; ?></p>
								</div><!-- END .site-description -->
							<?php
							}
						}//END if ($content)  

					} elseif( is_archive('portfolio_category') OR is_archive('portfolio_tag') ) {
						
						$content = category_description();

						if ($content) { 
							echo category_description();	
						} else { 
							if ($header_intro) { ?>
								<div class="site-description">
									<p><?php echo $header_intro; ?></p>
								</div><!-- END .site-description -->
							<?php
							}
						}//END if ($content)

					} else { //END if is_page_template
						if ($header_intro) { ?>
							<div class="site-description">
								<p><?php echo $header_intro; ?></p>
							</div><!-- END .site-description -->
						<?php 
						} //END if ($header_intro)
					} ?>

					<nav class="primary subtext hide-for-small clearfix">
						<?php wp_nav_menu( array( 
							'theme_location' => 'primary-menu', 
							'container' => '', 
							'menu_id' => 'primary-menu',
							'menu_class' => 'sf-menu main-menu',
							) ); 
						?>

						<?php if( get_theme_mod( 'header_search' ) == true ) {  ?>
							<form method="get" id="searchform" class="searchform" action="<?php echo home_url(); ?>/">
								<fieldset> 
									<input type="text" name="s" id="s" class="search subtext">
								</fieldset>
							</form>
						<?php } ?>
					</nav>

				</header><!-- END #header -->

			</div><!-- END .row -->	
			
		<?php
	} //END if ( !is_404()...