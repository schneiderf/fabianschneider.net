<?php
/**
 * The file is for creating the page & post seo meta. 
 * Meta output is output on header.php via bean_meta_head();
 *
 *  
 * @package WordPress
 * @subpackage Bean Framework
 * @author ThemeBeans
 * @since Bean Framework 2.0
 */
 
add_action('add_meta_boxes', 'bean_metabox_seo');
function bean_metabox_seo(){

$prefix = '_bean_';




/*===================================================================*/
/*  SEO SETTINGS							   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'bean_metabox_seo',
	'title' => __('SEO Settings', 'bean'),
	'description' => __('Customize the SEO settings of your posts/pages', 'bean'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'low',
	'fields' => array(
	  array(
	    'name' => __('Title:', 'bean'),
	    'desc' => __('The page or post title. Maximum of 60 characters.', 'bean'),
	    'id' => $prefix.'seo_title',
	    'type' => 'text',
	    'std' => ''
	    ),
	  array(
	    'name' => __('Description:', 'bean'),
	    'desc' => __('A description of your page or post. Maximum of 160 characters.', 'bean'),
	    'id' => $prefix.'seo_description',
	    'type' => 'textarea',
	    'std' => ''
	    ),
	  array(
	    'name' => __('Keywords:', 'bean'),
	    'desc' => __('List SEO keywords, separated by commas.', 'bean'),
	    'id' => $prefix.'seo_keywords',
	    'type' => 'text',
	    'std' => ''
	    ),
	  array(
	    'name' => __('Meta Robots Index:', 'bean'),
	    'desc' => __('Do you want robots to index this page?', 'bean'),
	    'id' => $prefix.'seo_robots_index',
	    'type' => 'radio',
	    'std' => 'index',
	    'options' => array('index', 'noindex')
	    ),
	  array(
	    'name' => __('Meta Robots Follow:', 'bean'),
	    'desc' => __('Do you want robots to follow links from this page?', 'bean'),
	    'id' => $prefix.'seo_robots_follow',
	    'type' => 'radio',
	    'std' => 'follow',
	    'options' => array('follow', 'nofollow')
	    )
	  )
	);

// SEO META ON POSTS
bean_add_meta_box( $meta_box );

// SEO META ON PAGES
$meta_box['page'] = 'page';
bean_add_meta_box( $meta_box );	

// SEO META ON PORTFOLIO
$meta_box['page'] = 'portfolio';
bean_add_meta_box( $meta_box );

} // END function bean_metabox_seo()




/*===================================================================*/
/* BETTER WP TITLE OUTPUT
/*===================================================================*/ 
if ( !function_exists( 'bean_better_wp_title' ) ) 
{
	function bean_better_wp_title( $title, $sep ) 
	{
	    global $paged, $page;
	
	    if( is_feed() )
	        return $title;
	
	    $title .= get_bloginfo( 'name' );
	    $description = get_bloginfo( 'description', 'display' );
	   
	    if( $description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $description";
			
		if( $paged >= 2 || $page >= 2 )
	        $title = "$title $sep " . sprintf( __('Page %s', 'bean'), max( $paged, $page ) );
	        
		return $title;
	}
} //END bean_better_wp_title( $title, $sep ) 
add_filter('wp_title', 'bean_better_wp_title', 10, 2);



 
/*===================================================================*/
/* SEO TITLE
/*===================================================================*/
function bean_metabox_seo_title($title)
{
  global $post;

  if($post)
  {
    if(is_home() || is_archive() || is_search()){
      $postid = get_option('page_for_posts');
    }else{
      $postid = $post->ID;
    }
    if( $seo_title = get_post_meta($postid, '_bean_seo_title', true) ) {
      return $seo_title;
    } 
  }
  return $title;
} //END bean_metabox_seo_title($title)
add_filter('wp_title', 'bean_metabox_seo_title', 15);




/*===================================================================*/
/* SEO DESCRIPTION
/*===================================================================*/
function bean_metabox_seo_description()
{
  global $post;

  if($post)
  {
    if( is_home() || is_archive() || is_search() ){
      $postid = get_option('page_for_posts');
    }else{
      $postid = $post->ID;
    }

    if($seo_description = get_post_meta($postid, '_bean_seo_description', true)){
      echo '<meta name="description" content="'.esc_html(strip_tags($seo_description)).'"/>'."\n";
    }
  }
} //END bean_metabox_seo_description()
add_action('bean_meta_head', 'bean_metabox_seo_description');




/*===================================================================*/
/* SEO KEYWORDS
/*===================================================================*/
function bean_metabox_seo_keywords()
{
  global $post;

  if($post){
    if( is_home() || is_archive() || is_search() ){
      $postid = get_option('page_for_posts');
    }else{
      $postid = $post->ID;
    }

    if($seo_keywords = get_post_meta($postid, '_bean_seo_keywords', true)){
      echo '<meta name="keywords" content="'.esc_html(strip_tags($seo_keywords)).'" />'."\n";
    }
  }
} //END bean_metabox_seo_keywords()
add_action('bean_meta_head', 'bean_metabox_seo_keywords');




/*===================================================================*/
/* SEO ROBOTS
/*===================================================================*/
function bean_metabox_seo_robots()
{
  global $post;

  if($post && get_option('blog_public') == 1  )
  {
    if( is_home() || is_archive() || is_search() ){
      $postid = get_option('page_for_posts');
    }else{
      $postid = $post->ID;
    }

    $seo_index = get_post_meta($postid, '_bean_seo_robots_index', true);
    $seo_follow = get_post_meta($postid, '_bean_seo_robots_follow', true);

    if(!$seo_index) { $seo_index = 'index'; } else {$seo_index = 'noindex';}
    if(!$seo_follow){ $seo_follow = 'follow'; } else {$seo_follow = 'nofollow';}

    if(!($seo_index == 'index' && $seo_follow == 'follow'))
      echo '<meta name="robots" content="'.$seo_index.', '.$seo_follow.'" />'."\n";
  }
}
add_action('bean_meta_head', 'bean_metabox_seo_robots');