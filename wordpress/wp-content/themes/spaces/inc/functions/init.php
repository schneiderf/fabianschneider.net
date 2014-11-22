<?php 
/**
 * Initiating file for core theme files.
 *
 *
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 2.0
 */
 

/*===================================================================*/
/* LOAD FUNCTIONS
/*===================================================================*/
//TGM PLUGINS
require( BEAN_INC_DIR . '/plugins/class-tgm-plugin-activation.php' );
require( BEAN_INC_DIR . '/plugins/class-tgm-plugin-setup.php' );


// MEDIA FUNCTIONS
require( BEAN_FUNCTIONS_DIR . '/media.php' );


// LOAD PORTFOLIO LIKES
include( BEAN_FUNCTIONS_DIR . '/bean-likes.php' );


// LOAD WIDGETS
if( bean_theme_supports( 'primary', 'widgets' ))
{
	include( BEAN_WIDGETS_DIR . '/widget-dribbble.php' );
	include( BEAN_WIDGETS_DIR . '/widget-flickr.php' );
	include( BEAN_WIDGETS_DIR . '/widget-portfolio.php' );
	include( BEAN_WIDGETS_DIR . '/widget-portfolio-filter.php' );
	include( BEAN_WIDGETS_DIR . '/widget-portfolio-menu.php' );
	include( BEAN_WIDGETS_DIR . '/widget-portfolio-taxonomy.php' );
	include( BEAN_WIDGETS_DIR . '/widget-video.php' );
}


// THEME META
if( is_admin() ) {
	if( bean_theme_supports( 'primary', 'meta' )) 
	{
		require_once( BEAN_INC_DIR . '/meta/meta-page.php');
		require_once( BEAN_INC_DIR . '/meta/meta-post.php');
		require_once( BEAN_INC_DIR . '/meta/meta-portfolio.php');
		require_once( BEAN_INC_DIR . '/meta/meta-team.php');

		//IF WOOCOMMERCE IS ENABLED
		if( bean_theme_supports( 'primary', 'woocommerce' ))
		{
			require_once( BEAN_INC_DIR . '/meta/meta-product.php');
		}
	}  
}


// META SCRIPT
if( bean_theme_supports( 'primary', 'meta' )) 
{
	function bean_admin_meta_js() {
		wp_enqueue_script( 'admin-meta', BEAN_INC_URL . '/meta/js/meta.js', 'jquery', '1.0', true );
	}
	add_action( 'admin_enqueue_scripts', 'bean_admin_meta_js');
}


// CUSTOMIZER FONTS
if( bean_theme_supports( 'primary', 'customizer' ) && bean_theme_supports( 'primary', 'fonts' )) 
{
	require_once( BEAN_FUNCTIONS_DIR . '/bean-fonts.php' );
}


// THEME UPDATER CLASS
if( bean_theme_supports( 'primary', 'updates' ))
{
	require( get_template_directory() . '/inc/updates/EDD_SL_Theme_Activation.php' );
}