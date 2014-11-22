<?php
/**
 * The file is for creating the page post type meta. 
 * Meta output is defined on the page editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 *  
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */
 
add_action('add_meta_boxes', 'bean_metabox_page');
function bean_metabox_page(){

$prefix = '_bean_';




/*===================================================================*/
/*  PAGE META SETTINGS							   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'page-meta',
	'title' =>  __('Page Meta Settings', 'bean'),
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'		=> 'Display Page Title:',
			'id' 		=> $prefix.'page_title',
			'type'		=> 'checkbox',
			'desc'		=> 'Select to display the page title above the main entry content.',
			'std'		=> true,
			),
				
		array(
			'name'     	=> __('Display Fullwidth Media:', 'bean'),
			'id' 		=> $prefix.'fullwidth_media',
			'type' 		=> 'checkbox',
			'desc' 		=> __('Display the fullwidth media container.', 'bean'),
			'std' 		=> false 
			),
		array( 
			"name" 		=> __('Fullwidth Image URL:','bean'),
			"desc" 		=> __('Upload an image for the standard fullwidth media. ','bean'),
			"id" 		=> $prefix."fullwidth_image",
			"type" 		=> "file",
			"std" 		=> ''
			),
		array( "name" => __('Fullwidth Image Caption:','bean'),
				"desc" => __('A caption for your fullwidth image','bean'),
				"id" => $prefix."fullwidth_caption",
				"type" => "text",
				"std" => ''
			),
		array( 
			'name' 		=> __('Page Layout:', 'bean'),
			'desc' 		=> __('Display a fullwidth or right sidebar.', 'bean'),
			'id' 		=> $prefix.'page_layout',
			'type' 		=> 'radio',
			'std' 		=> 'right',
			'options' 	=> array(
				'std' 	=> __('Standard', 'bean'),
		    		'none' 	=> __('Fullwidth', 'bean'),
		    		'right' 	=> __('Right Sidebar', 'bean')
		    		)
			),
		array( 
			'name' 		=> __('Text Alignment:', 'bean'),
			'desc' 		=> __('Select the text alignment style.', 'bean'),
			'id' 		=> $prefix.'page_text_align',
			'type' 		=> 'radio',
			'std' 		=> 'left',
			'options' 	=> array(
		    		'left' 	=> __('Left', 'bean'),
		    		'center' 	=> __('Center', 'bean'),
		    		'right' 	=> __('Right', 'bean'),
		    		)
			),
		
		
	)
);
bean_add_meta_box( $meta_box );

} // END function bean_metabox_page()