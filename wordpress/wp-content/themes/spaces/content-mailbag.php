<?php
/**
 * The template for displaying the Mailbag shortcode on single posts.
 * 
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

//CHECK FOR MAILBAG PLUGIN
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
if (is_plugin_active('mailbag/mailbag.php')) 
{ ?>
	
	<div class="subscribe-divide"></div>
	
	<div class="subscribe">
		
		<h3><?php echo get_theme_mod( 'mailbag_title' ); ?></h3>
		
		<p><?php echo get_theme_mod( 'mailbag_desc' ); ?></p>
		
		<?php //SHORTCODE SWITCHER FOR MAILBAG
		$mailbag_select = get_theme_mod( 'mailbag_select' );
		if( $mailbag_select != '' ) 
		{
			switch ( $mailbag_select ) 
			{
			case 'mailchimp':
				echo do_shortcode('[mailbag_mailchimp]');
				break;
			case 'campaign_monitor':
				echo do_shortcode('[mailbag_mailchimp]');
				break;
			}
		}
		?>

	</div><!-- END .subscribe -->	

<?php } //END if (is_plugin_active('mailbag/mailbag.php'))	