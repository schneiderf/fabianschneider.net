<?php 
/**
 * This file contains the primary footer debug module.
 *
 *
 * @package WordPress
 * @subpackage Bean Framework
 * @author ThemeBeans
 * @since Bean Framework 2.0
 */

//ADD A CLASS, JUST IN CASE BOTH BARS ARE ENABLED
if( bean_theme_supports( 'debug', 'footer' ) && bean_theme_supports( 'debug', 'queries' ) ) {
	$debugclass = 'debug-both';
} else {
	$debugclass = '';
}
?>

<div id="bean-debug-footer" class="<?php echo $debugclass ?>">
	<div class="four columns">
		<ul class="theme-details">
			<li><?php _e( '<span>Theme:</span> <span class="debug-detail">'. BEAN_THEME_NAME .' v'. BEAN_THEME_VER .'</span>', 'bean' ); ?></li>
			<li><a class="bean-changelog" target="_blank" href="<?php echo strtolower(BEAN_THEME_CHANGELOG_URL); ?>"><?php _e( 'View Changelog', 'bean' ); ?></a></li>
		</ul><!-- END .theme-details -->
	</div><!-- END .four.columns -->
	<div class="eight columns text-right">
		<ul class="server-details">
			<li><span><?php _e( 'PHP: ', 'bean' ); ?></span><?php echo phpversion(); ?> <span class="debug-detail"><?php _e( '(Requires >PHP 5.2.4)', 'bean' ); ?></span></li>
			
			<li><span><?php _e( 'MySQL: ', 'bean' ); ?></span><?php print mysql_get_client_info(); ?><span class="debug-detail"><?php _e( ' (Requires >MySQL 5.0)', 'bean' ); ?></span></li>
		
			<li><span><?php _e( 'CURL: ', 'bean' ); ?></span><span class="debug-detail"><?php echo function_exists('curl_version') ? 'Enabled' : 'Disabled :('; ?></span></li>
		</ul><!-- END .server-details -->		
	</div><!-- END .four.columns -->		 			
</div><!-- END #bean-debug-footer --> 