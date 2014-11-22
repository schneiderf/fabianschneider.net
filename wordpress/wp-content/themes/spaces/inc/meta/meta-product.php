<?php
/**
 * The file is for creating the product post type meta. 
 * Meta output is defined on the page editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 *  
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */
 
add_action('add_meta_boxes', 'bean_metabox_product');
function bean_metabox_product(){

$prefix = '_bean_';




/*===================================================================*/
/*  PAGE META SETTINGS							   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'product-meta',
	'title' =>  __('Product Meta', 'bean'),
	'page' => 'product',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('Product Excerpt:','bean'),
				"desc" => __('A mini description of your product, to be displayed on the shop page.','bean'),
				"id" => $prefix."product_excerpt",
				"type" => "text",
				"std" => ''
			),
		array( 
			'name' => __('Product Grid Image:','bean'),
			'desc' => 'Upload an image to deploy on the shop pages.',
			'id' => $prefix .'product_grid_image',
			'type' => 'file',
			'std' => ''
		),
	)
);
bean_add_meta_box( $meta_box );

} // END function bean_metabox_page()