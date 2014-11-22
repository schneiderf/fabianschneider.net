<?php 
/**
 * Admin functions for core framework features.
 * This file is the same contents as all themes using our framework
 *
 *
 * @package WordPress
 * @subpackage Bean Framework
 * @author ThemeBeans
 * @since Bean Framework 2.0
 */
 
 
/*===================================================================*/        							
/*  ADD THEME/FRAMEWORK VERSION TO THE HEAD	       							
/*===================================================================*/
if ( !function_exists('bean_admin_version_meta') ) 
{
	function bean_admin_version_meta()
	{
	  echo '<meta name="generator" content="'. BEAN_THEME_NAME .' '. BEAN_THEME_VER .'" />'."\n";
	  echo '<meta name="generator" content="BeanFramework '. BEAN_FRAMEWORK_VERSION .'" />'."\n";
	}
}
add_action('bean_meta_head', 'bean_admin_version_meta');




/*===================================================================*/        							
/*  ADMIN FAVICON	       							
/*===================================================================*/
if ( !function_exists('bean_admin_favicon') ) 
{
	function bean_admin_favicon() 
	{ 
		if( get_theme_mod( 'img-upload-favicon' ) ) { 
			$favicon = get_theme_mod( 'img-upload-favicon');
		} else { 	
			$favicon = BEAN_FRAMEWORK_IMAGES_URL.'/favicon.ico';
		} 
		
		if( !bean_theme_supports( 'primary', 'whitelabel' ) OR get_theme_mod( 'img-upload-favicon' ) ) { ?>	
			<link rel="shortcut icon" href="<?php echo $favicon ?>"/> 
		<?php 
		}
	} //END function bean_admin_favicon() 
	add_action('admin_head', 'bean_admin_favicon');
} //END if ( !function_exists('bean_admin_favicon') )




/*===================================================================*/    							
/*  CUSTOM LOGIN LOGO				      							
/*===================================================================*/
if ( !function_exists('bean_custom_login') ) 
{
	function bean_custom_login() 
	{
		
		if( get_theme_mod( 'img-upload-login-logo' ) ) { 
			//GET DEFAULT IMAGE IF UPLOADED
			$login_logo = get_theme_mod( 'img-upload-login-logo');
		} else {
			//GET DEFAULT IMAGES IF NO UPLOADED IMAGE
			$framwork_logo = TRUE;
			$login_logo = BEAN_FRAMEWORK_IMAGES_URL.'/login-logo.png';
			$login_logo_retina = BEAN_FRAMEWORK_IMAGES_URL.'/login-logo@2x.png';
		}
 		
 		if( !bean_theme_supports( 'primary', 'whitelabel' ) OR get_theme_mod( 'img-upload-login-logo' ) ) { 	

			$dimensions = @getimagesize( $login_logo );
			echo '<style>';
				echo 'body.login #login h1 a {';	
					echo 'background: url("' . $login_logo . '") no-repeat scroll center top transparent;';
					echo 'height: ' . $dimensions[1] . 'px;';
					echo 'background-size: auto !important; width:auto;';
				echo '}';
				
				echo '.login #nav {text-align: center}.login #backtoblog { display:none }';
				
				if( !get_theme_mod( 'img-upload-login-logo' ) ) { 
					echo '@media all and (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 192dpi) {';	
						echo 'body.login #login h1 a {';
							echo 'background-image: url("' . $login_logo_retina . '");';
							echo 'background-size: 163px 75px!important;';
						echo '}';
					echo '}';
				} //END if ( $framwork_logo = true )
			echo '</style>';

		} //END if( !bean_theme_supports( 'primary', 'whitelabel' ) OR get_theme_mod( 'img-upload-login-logo' ) )
	} 
	add_filter('login_head', 'bean_custom_login');	
}




/*===================================================================*/    							
/*  CUSTOM LOGIN URL (DIRECTS LINK TO YOUR HOME)				      							
/*===================================================================*/
if ( !function_exists('bean_login_url') ) 
{
	function bean_login_url($url) 
	{
		$login_url = home_url();
		return $login_url; 
	} 
	add_filter('login_headerurl', 'bean_login_url');
}

if ( !function_exists('bean_login_title') ) {
	function bean_login_title($title) {
		$title_text = get_bloginfo('name').' - Log In';
	    return $title_text;
	} 
	add_filter('login_headertitle', 'bean_login_title');
}	




/*===================================================================*/        							
/*  THEME FAVICON AND APPLE TOUCH ICON		       							
/*===================================================================*/
if ( !function_exists('bean_add_favicon') ) 
{
	function bean_add_favicon() 
	{	

	//FAVICON
	if( get_theme_mod( 'img-upload-favicon' ) ) 
	{ 
		$favicon = get_theme_mod( 'img-upload-favicon');
	} else { 
		$favicon = BEAN_FRAMEWORK_IMAGES_URL.'/favicon.ico';
	} 

	//APPLE TOUCH ICON
	if( get_theme_mod( 'img-upload-apple_touch' ) ) 
	{ 
		$appleicon = get_theme_mod( 'img-upload-apple_touch');
	} else { 
		$appleicon = BEAN_FRAMEWORK_IMAGES_URL.'/apple-touch-icon.png';
	}

	if( !bean_theme_supports( 'primary', 'whitelabel' ) OR get_theme_mod( 'img-upload-favicon' ) ) { ?>	
		<link rel="shortcut icon" href="<?php echo $favicon ?>"/> 
	<?php }
	if( !bean_theme_supports( 'primary', 'whitelabel' ) OR get_theme_mod( 'img-upload-apple_touch' ) ) { ?>	
		<link rel="apple-touch-icon-precomposed" href="<?php echo $appleicon ?>"/>
	<?php } 

	} //END function bean_add_favicon() 
	add_action('wp_head', 'bean_add_favicon');
} //END if ( !function_exists('bean_add_favicon') ) 




/*===================================================================*/
/* ADD CLASSES TO BODY CLASSES	
/*===================================================================*/
add_filter('body_class','bean_browser_body_class');
function bean_browser_body_class($classes) 
{
	global $post, $is_IE, $is_safari, $is_chrome, $is_iphone;
	
	if($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) {
	    $classes[] = 'ie';
	    $browser = $_SERVER[ 'HTTP_USER_AGENT' ];
	    if( preg_match( "/MSIE 7.0/", $browser ) ) {
	        $classes[] = 'ie7';
	    }
    }
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';
	
	return $classes;
}




/*===================================================================*/
/* CUSTOM EDITOR STYLE		
/*===================================================================*/
add_action( 'admin_print_styles', 'bean_add_editor_styles' );
function bean_add_editor_styles() 
{
    add_editor_style( 'custom-editor-style.css' );
}




/*===================================================================*/
/* CHECK POST FOR SHORTCODE
/*===================================================================*/
if ( !function_exists('bean_has_shortcode') ) 
{
	function bean_has_shortcode($shortcode = '') 
	{
		global $post;
		$post_obj = get_post( $post->ID );
		$found = false;
		if ( !$shortcode )
			return $found;
		if ( stripos( $post_obj->post_content, '[' . $shortcode ) !== false )
			$found = true;
		return $found;
	}
}




/*===================================================================*/
/* REMOVE GENERATOR FOR WP SECURITY
/*===================================================================*/
remove_action( 'wp_head', 'wp_generator' );




/*===================================================================*/
/* ADD DASHBOARD LINK
/*===================================================================*/
if ( !function_exists('admin_menu_new_items') ) 
{
	if( !bean_theme_supports( 'primary', 'whitelabel' ) ) {	
		function admin_menu_new_items() 
		{
		    global $submenu;
		    $submenu['index.php'][500] = array( 'ThemeBeans', 'manage_options' , THEMEBEANS_URL . '/?ref=wp_sidebar' ); 
		} //END function admin_menu_new_items() 
		add_action( 'admin_menu' , 'admin_menu_new_items' );
	} //END if( !bean_theme_supports( 'primary', 'whitelabel' ) ) 
} //END if ( !function_exists('admin_menu_new_items') ) 




/*===================================================================*/
/* ADMIN FOOTER FILTER
/*===================================================================*/
if ( !function_exists('bean_footer_admin') ) 
{
	if( !bean_theme_supports( 'primary', 'whitelabel' ) ) {	
		function bean_footer_admin () 
		{  
			$ran = array (
				'You&#39;re using '. BEAN_THEME_NAME .' v'. BEAN_THEME_VER .' by <a href="'. THEMEBEANS_URL .'?ref=wp_footer' .'"target="blank">ThemeBeans</a>. Enjoy.', 
				'<a href="'. THEMEBEANS_URL .'?ref=wp_footer_num2 "target="blank">Download Free Plugins</a> by ThemeBeans to use with '. BEAN_THEME_NAME .'. Nice.',
				'Stay up to date with the latest ThemeBeans news. <a href="'. BEAN_SUBSCRIBE_URL .'"target="blank">Subscribe Now &rarr;</a>',
			);
			
			$random = (count($ran)/1);
			$nmbr = (rand(0,($random-1)));
			$nmbr = $nmbr*1;
			$footer_text = $ran[$nmbr];
			$nmbr = $nmbr+1;
			
			echo $footer_text;
		} //END function bean_footer_admin () 
		add_filter('admin_footer_text', 'bean_footer_admin'); 	
	} //END if( !bean_theme_supports( 'primary', 'whitelabel' ) ) 
} //END if ( !function_exists('bean_footer_admin') ) 




/*===================================================================*/
/* GET DEBUG HEADER IF TURNED ON VIA FUNCTIONS.PHP
/*===================================================================*/
if ( !function_exists('bean_debug_footer') ) 
{
	function bean_debug_footer() 
	{
		// only proceed if the current user's capabilities include 'manage_options'
		if ( ! current_user_can('manage_options')) return;
		
		if( bean_theme_supports( 'debug', 'footer' ))
		{
			get_template_part('framework/debug/bean-debug-footer');
		}
		
		if( bean_theme_supports( 'debug', 'queries' ))
		{
			get_template_part('framework/debug/bean-debug-queries');
		}
	} //END function bean_debug_footer() 

add_action('bean_body_end','bean_debug_footer');

}




/*===================================================================*/
/* DEBUG HEADER CSS
/*===================================================================*/
if ( !function_exists('bean_debug_footer_css') ) 
{
	function bean_debug_footer_css() 
	{
		// only proceed if the current user's capabilities include 'manage_options'
		if ( ! current_user_can('manage_options')) return;

		if( bean_theme_supports( 'debug', 'footer' ) OR bean_theme_supports( 'debug', 'queries' ) ) 
		{ ?>
			<style>
			#bean-debug-footer,
			#bean-debug-queries {
				background-color: #222;
				bottom: 0;
				color: #FFF;
				font-size: 14px;
				font-family: "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, sans-serif;
				height: 60px;
				line-height: 60px;
				padding: 0 30px;
				position: fixed;
				width: 100%;
				z-index: 9999;
			}
			#bean-debug-footer.debug-both {
				bottom: 32px;
			}
			/* DEBUG BAR TYPOGRAPHY */
			#bean-debug-footer span {
				font-weight: bold;
			}
			#bean-debug-footer span.debug-detail {
				color: #858585;
				font-size: 13px;
				font-weight: normal;
			}
			#bean-debug-footer ul li {
				display: inline-block;
				line-height: 60px;
				margin-right: 15px;
			}
			#bean-debug-footer ul li:last-child {
				margin-right: 0px;
			}
			#bean-debug-footer ul li a.bean-changelog {
				background: #383838;
				border-radius: 2px;
				color: #FFF;
				font-size: 13px;
				padding: 4px 8px;
			}
			#bean-debug-footer ul li a.bean-changelog:hover {
				background: #414141;
			}
			#bean-debug-footer .server-details {
				text-align: right;
			}
			/* QUERIES BAR */
			#bean-debug-queries {
				background-color: #161616;
				box-shadow: none;
				color: #858585;
				font-size: 13px;
				height: 32px;
				line-height: 34px;
				padding: 0 30px;
				text-align: center;
			}</style>
			
			<?php
		} //END if( bean_theme_supports( 'debug', 'footer' ) OR bean_theme_supports( 'debug', 'queries' )
		
	} //END function bean_debug_footer_css() 

add_action('wp_enqueue_scripts','bean_debug_footer_css');

}




/*===================================================================*/
/* DISABLE WP ADMIN BAR IF SET VIA FUNCTIONS.PHP
/*===================================================================*/
if( bean_theme_supports( 'primary', 'hideadminbar' ) == true )
{
	show_admin_bar(false); 
} else { }