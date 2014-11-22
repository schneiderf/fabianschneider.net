<?php
/**
 * The file is for creating the portfolio post type meta. 
 * Meta output is defined on the portfolio single editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 *  
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */
 
add_action('add_meta_boxes', 'bean_metabox_team');
function bean_metabox_team(){

$prefix = '_bean_';




/*===================================================================*/
/*  PORTFOLIO META SETTINGS							   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'portfolio-meta',
	'title' =>  __('Team Member Settings', 'bean'),
	'description' => __('', 'bean'),
	'page' => 'team',
	'context' => 'normal',
	'priority' => 'high',
	'fields'   => array(	
		array(  
			'name' => __('Role:','bean'),
			'desc' => __('Display this team member&#39;s position.','bean'),
			'id' => $prefix.'team_role',
			'type' => 'text',
			'std' => ''
			),
		array(  
			'name' => __('Quote:','bean'),
			'desc' => __('Display a small quote on image hover.','bean'),
			'id' => $prefix.'team_quote',
			'type' => 'text',
			'std' => ''
			),	
		array(  
			'name' => __('External URL:','bean'),
			'desc' => __('Insert a URL to link this team member to.','bean'),
			'id' => $prefix.'team_url',
			'type' => 'text',
			'std' => ''
			),				
	)
);
bean_add_meta_box( $meta_box );



} // END function bean_metabox_team()