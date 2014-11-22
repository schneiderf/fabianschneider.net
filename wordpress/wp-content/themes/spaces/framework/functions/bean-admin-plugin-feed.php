<?php 
/**
 * Admin functions for displaying the themes rss feed
 * The rss feed is pulled from www.themebeans.com
 *
 *
 * @package WordPress
 * @subpackage Bean Framework
 * @author ThemeBeans
 * @since Bean Framework 2.9
 */

if ( ! class_exists( 'Bean_MorePlugins' ) ) :
class Bean_MorePlugins 
{

	const MORE_PLUGINS_FEED = "http://themebeans.com/plugins/feed/";

	private $TABS = array(  "bean_plugins" => array( "title" => "Bean Plugins",
		"heading" => "Bean Plugins",
		"description" => "Get more plugins from ThemeBeans!"
		),
	);

	private $cache_date;




	/*===================================================================*/        							
	/*  CLASS CONSTRUCT						
	/*===================================================================*/	
	function __construct() 
	{
		add_action('init', array( &$this, 'moreplugins_init') , 0);
		register_deactivation_hook(__FILE__, array( &$this, 'deactivated' ) );
	}




	/*===================================================================*/        							
	/*  INITIALIZES THE PLUGIN							
	/*===================================================================*/	
	function moreplugins_init() 
	{
		add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
	}




	/*===================================================================*/        							
	/*  ADD THE MENU ITEM   							
	/*===================================================================*/	
	function admin_menu() 
	{
		add_theme_page('Bean Plugins', 'Bean Plugins', 'edit_theme_options', 'more-themebeans-plugins', array(&$this, 'admin_page'));
		add_filter( 'wp_feed_cache_transient_lifetime' , array( &$this, 'return_1') );
	}

	function return_10() { return 1; }




	/*===================================================================*/        							
	/*  OUTPUT THE PAGE     							
	/*===================================================================*/
	function admin_page() 
	{
		$tabs_keys = array_keys($this->TABS);
		$tab_key = isset($_GET['tab']) ? $_GET['tab'] : $tabs_keys[0];
		?>
			<div class='wrap'>
				<h2><?php _e( 'More Plugins by ThemeBeans', 'bean' ); ?></h2>
				<p><?php _e( 'Free & premium WordPress plugins that our team has developed in-house to futher extend the functionality of your awesome new WordPress theme.', 'bean' ); ?></p>
				<?php @call_user_func( array($this, "render_" . $tab_key) ); ?>
			</div>

		<?php
	}




	/*===================================================================*/        							
	/*  RENDER THE THEMES PAGE CONTENT       							
	/*===================================================================*/
	function render_bean_plugins() 
	{
		include_once(ABSPATH . WPINC . '/feed.php');
		$rss = fetch_feed(self::MORE_PLUGINS_FEED);
		$rss_items = $rss->get_items();
		$this->render_bean_rss_items($rss_items);
	}




	/*===================================================================*/        							
	/*  RENDER THE RSS PAGE ITEMS       							
	/*===================================================================*/
	function render_bean_rss_items($rss_items) 
	{
		echo "<ul id='bean_items'>";
			if ($rss_items) {
				foreach($rss_items as $rss_item) 
					{ ?>
					<li>
						<div>
							<h3><a href="<?php echo $rss_item->get_link(); ?>?ref=more_plugins" target="_blank">Bean <?php echo $rss_item->get_title(); ?></a></h3>
							<?php echo html_entity_decode($rss_item->get_content()); ?>
							<p class="btns">
								<a href="<?php echo $rss_item->get_link(); ?>?ref=more_plugins" class="button-primary" target="_blank">More Info</a>
							</p>
						</div>
					</li>
				<?php }
			} else {
				_e("Error fetching items.");
			}
		echo "</ul>";
	}
}

new Bean_MorePlugins;

endif;

?>