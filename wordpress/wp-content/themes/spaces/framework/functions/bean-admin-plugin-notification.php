<?php 
/**
 * The functions for displaying the plugin admin notices.
 * Plugins are added via the theme functions.php file
 *
 *
 * @package WordPress
 * @subpackage Bean Framework
 * @author ThemeBeans
 * @since Bean Framework 2.0
 */

/*===================================================================*/
/* 1. BEAN PLUGIN NOTIFICATION	
/*===================================================================*/
add_action('admin_notices', 'bean_plugin_admin_notice');

function bean_plugin_admin_notice() {
	global $pagenow;
	
	if (( $pagenow == 'index.php' )) 
	{
		if( bean_theme_supports( 'plugins', 'notice' )) 
		{
			
			global $current_user ;
			$user_id = $current_user->ID;
			
			if ( !get_user_meta($user_id, 'bean_plugin_ignore_notice') ) 
			{
				echo '<div class="updated bean-plugin-notification">'; 
					echo '<p>'; 
						echo ''. BEAN_THEME_NAME .' is compatible with the ThemeBeans '; 
						
						
						//PLUGIN LIST
						if( bean_theme_supports( 'plugins', 'portfolio' )) { 
							echo '<a href=" '. BEAN_PORTFOLIO_PLUGIN_URL .' " target="blank">Portfolio</a>';
							echo ', ';
						}
						if( bean_theme_supports( 'plugins', 'twitter' )) { 
							echo '<a href="'. BEAN_TWEETS_PLUGIN_URL .'" target="blank">Twitter</a>';
							echo ', ';
						}
						if( bean_theme_supports( 'plugins', 'instagram' )) { 
							echo '<a href="'. BEAN_INSTAGRAM_PLUGIN_URL .'" target="blank">Instagram</a>';
							echo ', ';
						}
						if( bean_theme_supports( 'plugins', '500px' )) { 
							echo '<a href="'. BEAN_500PX_PLUGIN_URL .'" target="blank">500px</a>';
							echo ', ';
						}
						if( bean_theme_supports( 'plugins', 'social' )) { 
							echo '<a href="'. BEAN_SOCIAL_PLUGIN_URL .'" target="blank">Social</a>';
							echo ', ';
						}
						if( bean_theme_supports( 'plugins', 'pricingtables' )) { 
							echo '<a href="'. BEAN_PRICINGTABLES_PLUGIN_URL .'" target="blank">Pricing Tables</a>';
							echo ', ';
						}
						if( bean_theme_supports( 'plugins', 'utilities' )) { 
							echo '<a href="'. BEAN_UTILITIES_PLUGIN_URL .'" target="blank">Utilities</a>';
							echo ', ';
						}
						if( bean_theme_supports( 'plugins', 'modals' )) { 
							echo '<a href="'. BEAN_MODALS_PLUGIN_URL .'" target="blank">Modals</a>';
							echo ', ';
						} 
						
						//THIS ONE REMAINS LAST
						if( bean_theme_supports( 'plugins', 'shortcodes' )) { 
							echo '& <a href="'. BEAN_SHORTCODES_PLUGIN_URL .'" target="blank">Shortcodes</a>';
							echo ' ';
						} 
						
						printf(__('WordPress Plugins. <a class="dismiss-notice" href="%1$s">[Dismiss]</a>'), '?bean_plugin_ignore=0');
						
					echo "</p>";
				echo "</div>";
			}
		
		} //END if( bean_theme_supports( 'plugins', 'notice' )) 
		
	}//END if (( $pagenow == 'index.php' ))
	
} //END 


//DISMISS NOTIFICATION 
add_action('admin_init', 'bean_plugin_ignore');

function bean_plugin_ignore() {
	global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['bean_plugin_ignore']) && '0' == $_GET['bean_plugin_ignore'] ) {
             add_user_meta($user_id, 'bean_plugin_ignore_notice', 'true', true);
	}
}