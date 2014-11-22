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

if ( ! class_exists( 'Bean_MoreThemes' ) ) :
class Bean_MoreThemes 
{

	const MORE_THEMES_FEED = "http://themebeans.com/themes/feed/";

	private $TABS = array(  "bean_themes" => array( "title" => "Bean Themes",
		"heading" => "Bean Themes",
		"description" => "Get more themes from ThemeBeans"
		),
	);

	private $cache_date;




	/*===================================================================*/        							
	/*  CLASS CONSTRUCT						
	/*===================================================================*/	
	function __construct() 
	{
		add_action('init', array( &$this, 'morethemes_init') , 0);
		register_deactivation_hook(__FILE__, array( &$this, 'deactivated' ) );
	}




	/*===================================================================*/        							
	/*  INITIALIZES THE PLUGIN							
	/*===================================================================*/	
	function morethemes_init() 
	{
		add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
	}




	/*===================================================================*/        							
	/*  ADD THE MENU ITEM   							
	/*===================================================================*/	
	function admin_menu() 
	{
		add_theme_page('More Themes', 'More Themes', 'edit_theme_options', 'more-themebeans-themes', array(&$this, 'admin_page'));
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
				<h2><?php _e( 'More Themes by ThemeBeans', 'bean' ); ?></h2>
				<p><?php _e( 'Each theme in our collection is meticulously crafted to afford the best user experience possible, for developers & WordPress novices alike.', 'bean' ); ?></p>
				<?php @call_user_func( array($this, "render_" . $tab_key) ); ?>
			</div>

		<?php
	}




	/*===================================================================*/        							
	/*  RENDER THE THEMES PAGE CONTENT       							
	/*===================================================================*/
	function render_bean_themes() 
	{
		include_once(ABSPATH . WPINC . '/feed.php');
		$rss = fetch_feed(self::MORE_THEMES_FEED);
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
							<h3><a href="<?php echo $rss_item->get_link(); ?>?ref=more_themes" target="_blank"><?php echo $rss_item->get_title(); ?></a></h3>
							<?php echo html_entity_decode($rss_item->get_content()); ?>
							<p class="btns">
								<a href="<?php echo $rss_item->get_link(); ?>?ref=more_themes" class="button-primary" target="_blank">More Info</a>
								<a href="http://demo.themebeans.com/<?php echo $rss_item->get_title(); ?>" class="button-secondary" target="_blank">Live Demo</a>
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

new Bean_MoreThemes;

endif;

?>