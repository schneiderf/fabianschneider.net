<?php
/**
 * Plugin Name: Bean Team Members
 * Plugin URI: http://themebeans.com
 * Description: Enables a team post type for use in specific ThemeBeans themes.
 * Version: 1.0
 * Author: ThemeBeans
 * Author URI: http://themebeans.com
 *  
 *   
 * @package Bean Plugins
 * @subpackage BeanTeam
 * @author ThemeBeans
 * @since BeanTeam 1.0
 */


/*===================================================================*/
/* PLUGIN CLASS
/*===================================================================*/
if ( ! class_exists( 'Bean_Team_Post_Type' ) ) :
class Bean_Team_Post_Type 
{
	function __construct() 
	{
		// PLUGIN ACTIVATION
		register_activation_hook( __FILE__, array( &$this, 'plugin_activation' ) );
		
		// TRANSLATION
		load_plugin_textdomain( 'bean', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		
		add_action( 'init', array( &$this, 'team_init' ) );
		add_action( 'restrict_manage_posts', array( &$this, 'add_taxonomy_filters' ) );
		add_action( 'admin_head', array( &$this, 'custom_post_type_icon' ) );
		add_action( 'admin_menu', array( &$this, 'bean_create_team_sort_page') );
		add_action( 'wp_ajax_team_sort', array( &$this, 'bean_save_team_sorted_order' ) );	
	}
	
		
		
		
	/*===================================================================*/
	/* FLUSH REWRITE RULE
	/*===================================================================*/ 
	function plugin_activation() 
	{
		$this->team_init();
		flush_rewrite_rules();
	}
	
	
	
	
	/*===================================================================*/
	/* REGISTER POST TYPE
	/*===================================================================*/ 
	function team_init() 
	{
		// REGISTER THE POST TYPE
		$labels = array(
			'name' 			 => __( 'Team', 'bean' ),
			'singular_name' 	 => __( 'Team Member', 'bean' ),
			'add_new' 		 => __( 'Add New Member', 'bean' ),
			'add_new_item'		 => __( 'Add New Member', 'bean' ),
			'edit_item' 		 => __( 'Edit Team', 'bean' ),
			'new_item' 		 => __( 'Add New', 'bean' ),
			'view_item' 		 => __( '', 'bean' ),
			'search_items' 	 => __( '', 'bean' ),
			'not_found' 		 => __( 'No team members found', 'bean' ),
			'not_found_in_trash' => __( 'No team members found in trash', 'bean' )
		);
		
		$args = array(
	    		'labels' 			=> $labels,
	    		'public' 			=> true,
			'supports' 		=> array( 'title', 'editor', 'thumbnail'),
			'capability_type' 	=> 'post',
			'rewrite' 		=> array("slug" => "team"),
			'menu_position' 	=> 20,
			'has_archive' 		=> false,
			'hierarchical' 	=> false,
			'menu_icon'	     => '',
			'exclude_from_search' => true,
			'show_in_nav_menus' => false,
		);
		
		$args = apply_filters('bean_args', $args);

		register_post_type( 'team', $args );		
	}




	/*===================================================================*/
	/* ADD TAXONOMY FILTERS TO THE ADMIN PAGE
	/*===================================================================*/ 
	function add_taxonomy_filters() 
	{
		global $typenow;
		
		// USE TAXONOMY NAME OR SLUG
		$taxonomies = array( 'team_category', 'team_tag' );
	}




	/*===================================================================*/
	/* SORTING
	/*===================================================================*/ 
	function bean_create_team_sort_page() 
	{
	    $bean_sort_page = add_submenu_page('edit.php?post_type=team', __('Sort Teams', 'bean'), __('Sort', 'bean'), 'edit_posts', basename(__FILE__), array($this, 'bean_team_sort'));
	    
	    add_action('admin_print_styles-' . $bean_sort_page, array($this, 'bean_print_sort_styles')) ;
	    add_action('admin_print_scripts-' . $bean_sort_page , array($this,'bean_print_sort_scripts'));
	}
	
	//OUTPUT FOR SORTING PAGE
	function bean_team_sort() 
	{
	    $teams = new WP_Query('post_type=team&posts_per_page=-1&orderby=menu_order&order=ASC'); ?>
	   
	    <div class="wrap">
	    
	        <div id="icon-edit" class="icon32"></div>
	        
	        <h2><?php _e('Sort Team Members', 'bean'); ?></h2>
	        
	        <p><?php _e('Click, drag, re-order & repeat as necessary. The member at the top of the list will display first.', 'bean'); ?></p>
	
		        <ul id="team_list">
		        
		            <?php while( $teams->have_posts() ) : $teams->the_post();
		        
		                if( get_post_status() == 'publish' ) { ?>
		        
		                    <li id="<?php the_id(); ?>" class="menu-item">
		        
		                        <dl class="menu-item-bar">
		        
		                            <dt class="menu-item-handle">
		        
		                                <span class="menu-item-title"><?php the_title(); ?></span>
		        
		                            </dt><!-- END .menu-item-handle -->
		        
		                        </dl><!-- END .menu-item-bar --> 
		        
		                        <ul class="menu-item-transport"></ul>
		        
		                    </li><!-- END .menu-item -->
	
		            <?php } endwhile; wp_reset_postdata(); ?>
		        
		        </ul><!-- END #team_list -->
	    
	    	</div><!-- END .wrap -->
	
	<?php }
	
	//ORDER
	function bean_save_team_sorted_order() 
	{
	    global $wpdb;
	    
	    $order = explode(',', $_POST['order']);
	    $counter = 0;
	    
	    foreach($order as $team_id) {
	        $wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $team_id));
	        $counter++;
	    }
	    die(1);
	}
	
	//SCRIPTS
	function bean_print_sort_scripts() 
	{
	    wp_enqueue_script('jquery-ui-sortable');
	    wp_enqueue_script( 'bean_team_sort', plugins_url( '/js/bean-sort.js', __FILE__ ), array('jquery') );
	
	}
	
	//SORTER STYLES
	function bean_print_sort_styles() 
	{
	    wp_enqueue_style ('nav-menu');
	}	
	



	/*===================================================================*/
	/* CUSTOM ICON FOR POST TYPE
	/*===================================================================*/
	function custom_post_type_icon()
	{ ?>
		<style type="text/css" media="screen">
			#adminmenu #menu-posts-team div.wp-menu-image:before { content: "\f307"; }
		</style>
	<?php
	}
} //END class Bean_Team_Post_Type

new Bean_Team_Post_Type;

endif;