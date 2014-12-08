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
 
add_action('add_meta_boxes', 'bean_metabox_portfolio');
function bean_metabox_portfolio(){

$prefix = '_bean_';







/*===================================================================*/
/*  PORTFOLIO FORMAT SETTINGS							   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'portfolio-type',
	'title' =>  __('Portfolio Format', 'bean'),
	'description' => __('', 'bean'),
	'page' => 'portfolio',
	'context' => 'side',
	'priority' => 'core',
	'fields'   => array(
		array(  
			'name' => __('Gallery','bean'),
			'desc' => __('','bean'),
			'id' => $prefix.'portfolio_type_gallery',
			'type' => 'checkbox',
			'std' => true 
			),
		array(  
			'name' => __('Audio','bean'),
			'desc' => __('','bean'),
			'id' => $prefix.'portfolio_type_audio',
			'type' => 'checkbox',
			'std' => false 
			),	
		array(  
			'name' => __('Video','bean'),
			'desc' => __('','bean'),
			'id' => $prefix.'portfolio_type_video',
			'type' => 'checkbox',
			'std' => false 
			),							
	)
);
bean_add_meta_box( $meta_box );





/*===================================================================*/
/*  PORTFOLIO META SETTINGS							   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'portfolio-meta',
	'title' =>  __('Portfolio Settings', 'bean'),
	'description' => __('', 'bean'),
	'page' => 'portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'fields'   => array(	
		array( 	
			'name' =>  __('Portfolio Layout:', 'bean'),
			'desc' => __('Choose the layout for this portfolio post.', 'bean'),
			'id' => $prefix.'portfolio_layout',
			'type' => 'select',
			'std' => 'default',
			'options' => array(
				'default' => __('Default', 'bean'),
				'std' => __('Standard', 'bean'),
				'fullwidth' => __('Fullwidth', 'bean'),
				'fullscreen' => __('Fullscreen', 'bean'),
				'carousel' => __('Carousel', 'bean'),
				'grid' => __('Gallery Grid', 'bean'),
				)
			),	
		array(  
			'name' => __('Portfolio Client:','bean'),
			'desc' => __('Display the client meta.','bean'),
			'id' => $prefix.'portfolio_client',
			'type' => 'text',
			'std' => ''
			),	
		array(  
			'name' => __('Portfolio URL:','bean'),
			'desc' => __('Insert a URL to link your post to.','bean'),
			'id' => $prefix.'portfolio_url',
			'type' => 'text',
			'std' => ''
			),
		array(
			'name'     => __('Display Meta Content:', 'bean'),
			'id' => $prefix.'portfolio_content_display',
			'type' => 'checkbox',
			'desc' => __('Display the portfolio content on this post.', 'bean'),
			'std' => true 
			),	
		array(
			'name'     => __('Display Date:', 'bean'),
			'id' => $prefix.'portfolio_date',
			'type' => 'checkbox',
			'desc' => __('Can be modified in your Dashboard General Settings.', 'bean'),
			'std' => true 
			),	
		array(
			'name' => __('Display Categories:', 'bean'),
			'id' => $prefix.'portfolio_cats',
			'type' => 'checkbox',
			'desc' => __('Select to display the portfolio categories.', 'bean'),
			'std' => true 
			),
		array(
			'name' => __('Display Views:', 'bean'),
			'id' => $prefix.'portfolio_views',
			'type' => 'checkbox',
			'desc' => __('Select to display the view counter.', 'bean'),
			'std' => true 
			),
		array(
			'name' => __('Display Tags:', 'bean'),
			'id' => $prefix.'portfolio_tags',
			'type' => 'checkbox',
			'desc' => __('Select to display the portfolio tags.', 'bean'),
			'std' => false 
			),
		array(
			'name' => __('Portfolio Review:', 'bean'),
			'desc' => __('Add a review section to your standard or fullwidth layout post.', 'bean'),
			'id' => $prefix . 'portfolio_review',
			'type' => 'textarea',
			'std' => ''
			),						
	)
);
bean_add_meta_box( $meta_box );




/*===================================================================*/	
/*  GALLERY POST FORMAT SETTINGS						   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'bean-meta-box-portfolio-images',
	'title' => __('Gallery Settings', 'bean'),
	'page' => 'portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' =>  __('Gallery Layout:', 'bean'),
			'desc' => __('Choose which layout to display for this portfolio post.', 'bean'),
			'id' => $prefix.'gallery_layout',
			'type' => 'select',
			'std' => 'stacked',
			'options' => array(
				'stacked' => __('Standard', 'bean'),
				'portfolio-lightbox' => __('Lightbox Viewer', 'bean'),
				)
			),
		array( 
			'name' => __('Image Gallery:','bean'),
			'desc' => __('Upload images here for your gallery post. Once uploaded, drag & drop to reorder.','bean'),
			'id' => $prefix .'portfolio_upload_images1',
			'type' => 'images',
			'std' => __('Browse & Upload', 'bean')
			),
		array(
			'name'     => __('Randomize Gallery:', 'bean'),
			'id' => $prefix.'portfolio_randomize',
			'type' => 'checkbox',
			'desc' => __('Randomize the gallery on page load.', 'bean'),
			'std' => false 
			),
		array( 
			'name' => __('Fullscreen Image:','bean'),
			'desc' => __('Upload an image to deploy on the Fullscreen & Fullwidth Portfolio Templates.','bean'),
			'id' => $prefix .'home_slider_image',
			'type' => 'file',
			'std' => ''
			),
		array(
			'name'     => __('Feature in Home Slider:', 'bean'),
			'id' => $prefix.'portfolio_feature',
			'type' => 'checkbox',
			'desc' => __('Featured this post on the Fullscreen Portfolio Template.', 'bean'),
			'std' => true 
			),				
    )
);
bean_add_meta_box( $meta_box ); 




/*===================================================================*/	
/*  SLIDESHOW SETTINGS						   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'bean-meta-box-portfolio-slideshow',
	'title' => __('Fullscreen Slideshow Settings', 'bean'),
	'page' => 'portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' =>  __('Slideshow Animation', 'bean'),
			'desc' => __('Select the animation style for this post.', 'bean'),
			'id' => $prefix.'fullscreen_animation',
			'type' => 'select',
			'std' => 'slide',
			'options' => array(
				'slide' => __('Slide', 'bean'),
				'fade' => __('Fade', 'bean'),
				)
			),
		array(  
			'name' => __('Display Pagination:','bean'),
			'id' => $prefix.'fullscreen_pagination',
			'desc' => __('Select to display the slide pagination.','bean'),
			'type' => 'checkbox',
			'std' => false
			),
		array(
			'name' => __('Autoplay Slideshow', 'bean'),
			'id' => $prefix.'fullscreen_autoplay',
			'type' => 'checkbox',
			'desc' => __('Select to autoplay the fullscreen slideshow.', 'bean'),
			'std' => false 
			),
		array(  
			'name' => __('Autoplay Time:','bean'),
			'id' => $prefix.'fullscreen_autoplay_time',
			'desc' => __('The time in milliseconds for the slideshow to animate.','bean'),
			'type' => 'text',
			'std' => '5000'
			),			
    )
);
bean_add_meta_box( $meta_box ); 




/*===================================================================*/
/*  AUDIO POST FORMAT SETTINGS						   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'bean-meta-box-portfolio-audio',
	'title' =>  __('Audio Post Format Settings', 'bean'),
	'page' => 'portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( 
		    'name' => __('MP3 File URL:','bean'),
			'desc' => __('','bean'),
			'id' => $prefix.'audio_mp3',
			'type' => 'file',
			'std' => ''
			),
		array( 
			'name' => __('Poster Image:', 'bean'),
			'desc' => __('The preview image for this audio track', 'bean'),
			'id' => $prefix.'audio_poster_url',
			'type' => 'file',
			'std' => ''
			),
	)
);
bean_add_meta_box( $meta_box );
 
 
 
 
/*===================================================================*/
/*  VIDEO POST FORMAT SETTINGS						   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'bean-meta-box-portfolio-video',
	'title' => __('Video Post Format Settings', 'bean'),
	'page' => 'portfolio',
	'context' => 'normal',
	'priority' => 'high',	
	'fields' => array(
		array(
			'name' => __('Embed 1:', 'bean'),
			'desc' => __('Insert your embeded code here.', 'bean'),
			'id' => $prefix . 'portfolio_embed_code',
			'type' => 'textarea',
			'std' => ''
			),
		array(
			'name' => __('Embed 2:', 'bean'),
			'desc' => __('Insert your embeded code here.', 'bean'),
			'id' => $prefix . 'portfolio_embed_code_2',
			'type' => 'textarea',
			'std' => ''
			),
		array(
			'name' => __('Embed 2:', 'bean'),
			'desc' => __('Insert your embeded code here.', 'bean'),
			'id' => $prefix . 'portfolio_embed_code_3',
			'type' => 'textarea',
			'std' => ''
			),
		array(
			'name' => __('Embed 3:', 'bean'),
			'desc' => __('Insert your embeded code here.', 'bean'),
			'id' => $prefix . 'portfolio_embed_code_4',
			'type' => 'textarea',
			'std' => ''
			),	
	),
	
);
bean_add_meta_box( $meta_box );
} // END function bean_metabox_portfolio()