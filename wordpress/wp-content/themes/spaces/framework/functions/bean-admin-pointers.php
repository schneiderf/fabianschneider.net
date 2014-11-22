<?php 
/**
 * Admin functions for displaying portfolio plugin pointers.
 * This file is the same contents as all themes using our framework
 *
 *
 * @package WordPress
 * @subpackage Bean Framework
 * @author ThemeBeans
 * @since Bean Framework 2.0
 */
 
/*===================================================================*/
/* LOAD PORTFOLIO ADMIN POINTERS	
/*===================================================================*/

//ENQUEUE POINTER SCRIPTS AND STYLES
add_action( 'admin_enqueue_scripts', 'custom_admin_pointers_header' );
function custom_admin_pointers_header() 
{
	if ( custom_admin_pointers_check() ) 
	{
		add_action( 'admin_print_footer_scripts', 'custom_admin_pointers_footer' );
		wp_enqueue_script( 'wp-pointer' );
		wp_enqueue_style( 'wp-pointer' );
	}
}

//CHECK IF POINTER IS ACTIVE
function custom_admin_pointers_check() 
{
	$admin_pointers = custom_admin_pointers();
	foreach ( $admin_pointers as $pointer => $array ) 
	{
		if ( $array['active'] )
		return true;
	}
	
}

//CUSTOM POINTER PRINT
function custom_admin_pointers_footer() 
{
   $admin_pointers = custom_admin_pointers();
   ?>
	<script type="text/javascript">
		/* <![CDATA[ */
		( function($) {
		   <?php
		   foreach ( $admin_pointers as $pointer => $array ) {
		      if ( $array['active'] ) {
		         ?>
		         $( '<?php echo $array['anchor_id']; ?>' ).pointer( {
		            content: '<?php echo $array['content']; ?>',
		            position: {
		            edge: '<?php echo $array['edge']; ?>',
		            align: '<?php echo $array['align']; ?>'
		         },
		            close: function() {
		               $.post( ajaxurl, {
		                  pointer: '<?php echo $pointer; ?>',
		                  action: 'dismiss-wp-pointer'
		               } );
		            }
		         } ).pointer( 'open' );
		         <?php
		      }
		   }
		   ?>
		} )(jQuery);
		/* ]]> */
	</script>
   <?php
}

//POINTER ARRAY
function custom_admin_pointers() 
{
	$dismissed = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
	$version = '1_0';
	$prefix = 'custom_admin_pointers' . $version . '_';
	
	//CONTENT
	$portfolio_feat_image_content = '<h3>' . __('Portfolio Featured Image', 'bean') . '</h3>';
	$portfolio_feat_image_content .= '<p>' . __('Don&#39;t forget to set your portfolio featured image. Otherwise your post may not display on the portfolio templates. Cheers!', 'bean') . '</p>';
	
	$portfolio_add_gallery_images = '<h3>' . __('Upload your Gallery Images', 'bean') . '</h3>';
	$portfolio_add_gallery_images .= '<p>' . __('Utilize our media uploader to insert your portfolio images. You may add new or select previously uploaded media. Nice.', 'bean') . '</p>';
	
	
	//POINTERS
	return array(
		//FEATURED IMAGE POINTER
		$prefix . 'portfolio_feat_image_content' => array(
		 'content' => $portfolio_feat_image_content,
		 'anchor_id' => '.post-type-portfolio #postimagediv',
		 'edge' => 'right',
		 'align' => 'left',
		 'active' => ( ! in_array( $prefix . 'portfolio_feat_image_content', $dismissed ) )
		),
		
		//ADD IMAGES POINTER
		$prefix . 'portfolio_add_gallery_images' => array(
		 'content' => $portfolio_add_gallery_images,
		 'anchor_id' => '.post-type-portfolio #bean_images_upload',
		 'edge' => 'left',
		 'align' => 'left',
		 'active' => ( ! in_array( $prefix . 'portfolio_add_gallery_images', $dismissed ) )
		),
	);
}