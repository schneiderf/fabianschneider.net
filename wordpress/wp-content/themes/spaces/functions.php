<?php
/**
 * This is the theme's functions.php file.
 * This file loads the theme's constants.
 * Please be cautious when editing this file, errors here cause big problems.
 *
 *
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 *
 *
 * CONTENTS:
 * 1. THEME FEATURES FILTER
 * 2. LOAD FRAMEWORK
 * 3. GENERAL THEME SETUP
 * 4. ADD OUR SCRIPTS
 * 5. REGISTER WIDGET AREAS
 * 6. THEME SPECIFIC FUNCTIONS
 */

/*===================================================================*/
/* 1. THEME FEATURES FILTER
/*===================================================================*/
do_action( 'bean_pre' );

//FEATURE SETUP
if ( !function_exists( 'bean_feature_setup' ) )
{
	function bean_feature_setup()
	{
		$args = array(
			'primary' => array(
				'adminstyles'       => true,
				'customizer'        => true,
				'edd'               => false,
				'free'              => false,
				'fonts'             => true,
				'hideadminbar'      => false,
				'meta'              => true,
				'seo'               => true,
				'widgets'           => true,
				'widgetareas'       => true,
				'whitelabel'        => false,
				'woocommerce'       => true,
				'updates'           => false,
				),
			'plugins' => array(
				'notice'            => true,
				'portfolio'         => true,
				'shortcodes'        => true,
				'twitter'           => true,
				'instagram'         => true,
				'social'            => true,
				'pricingtables'     => true,
				'500px'			=> true,
				),
			'comments' => array(
				'posts'             => true,
				'pages'             => false,
				'portfolio'         => false,
				),
			'debug' => array(
				'footer'            => false,
				'queries'           => false,
				),
			);

	return apply_filters( 'bean_theme_config_args', $args );
	}
add_action('bean_init', 'bean_feature_setup');
} //END if ( !function_exists( 'bean_feature_setup' ) )

// FEATURE SETUP RETURN
function bean_theme_supports( $group, $feature )
{
	$setup = bean_feature_setup();
	if( isset( $setup[$group][$feature] ) && $setup[$group][$feature] )
		return true;
	else {
	}
}




/*===================================================================*/
/* 2. LOAD FRAMEWORK
/*===================================================================*/
function bean_load_framework()
{
	do_action( 'bean_pre_framework' );

	// FRAMEWORK FUNCTIONS
	$tempdir = get_template_directory();
	require_once($tempdir .'/framework/functions/bean-admin-init.php');
	require_once($tempdir .'/inc/functions/init.php');

	// THEME CUSTOMIZER
	if( bean_theme_supports( 'primary', 'customizer' ))
	{
		require( BEAN_CUSTOMIZER_DIR . '/customizer.php' );
		require( BEAN_CUSTOMIZER_DIR . '/customizer-css.php' );

		// CUSTOMIZER CSS
		function bean_customizer_ui_css() 
		{
			wp_register_style('customizer-ui-css', BEAN_CUSTOMIZER_URL . '/assets/css/customizer-ui.css', 'all');
			wp_enqueue_style('customizer-ui-css');
		}
		add_action( 'customize_controls_print_scripts', 'bean_customizer_ui_css' );

		// CUSTOMIZER JS
		function bean_customizer_ui_js()
		{
			wp_register_script('customizer-ui-js', BEAN_CUSTOMIZER_URL . '/assets/js/customizer-ui.js', 'jquery');
			wp_enqueue_script('customizer-ui-js');
		}
		add_action( 'customize_controls_print_scripts', 'bean_customizer_ui_js' );

	} //END if( bean_theme_supports( 'primary', 'customizer' ))

} //END function bean_load_framework()

add_action( 'bean_init', 'bean_load_framework' );

/* RUN THE BEAN_INIT HOOK */
do_action( 'bean_init' );

/* RUN THE BEAN_SETUP HOOK */
do_action( 'bean_setup' );




/*===================================================================*/
/* 3. GENERAL THEME SETUP
/*===================================================================*/
if ( !function_exists( 'bean_theme_setup' ) )
{
	function bean_theme_setup()
	{
		// MENUS
		register_nav_menus( array(
			'primary-menu' => __( 'Primary Navigation', 'bean' ),
			'secondary-menu' => __( 'Footer Navigation', 'bean' ),
			'mobile-menu'  => __( 'Mobile Navigation', 'bean' )
			));

		// TRANSLATION
		load_theme_textdomain( 'bean', get_template_directory() . '/languages' );

		// THUMBNAILS
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size( 140, 140 );
		add_image_size( 'post-feat', 755, 9999, false  );
		add_image_size( 'port-full', 1540, 9999, false  );;
		add_image_size( 'grid-feat', 500, 500, array( 'center', 'top' ) );
		add_image_size( 'masonry-std', 400, 620, array( 'center', 'top' ) );
		add_image_size( 'masonry-std2', 400, 400, array( 'center', 'top' ) );
		add_image_size( 'shop-grid', 500, 9999, false );
		add_image_size( 'shop-feat', 950, 9999, false );
		add_image_size( 'testimonial-feat', 128, 128, array( 'center', 'top' ) );

		// FEED LINKS
		add_theme_support( 'automatic-feed-links' );

		// POST FORMATS
		add_theme_support('post-formats', array('aside', 'audio', 'image', 'gallery', 'link', 'quote', 'video'));

		// CONTENT WIDTH
		if ( ! isset( $content_width ) ) $content_width = 1400;

		//IF WOOCOMMERCE
		if( bean_theme_supports( 'primary', 'woocommerce' ))
		{
			//ADD SUPPORT
			add_theme_support( 'woocommerce' );

			//REMOVE STANDARD WOO CSS
			add_filter( 'woocommerce_enqueue_styles', '__return_false' );
		}
	}
}
add_action('after_setup_theme', 'bean_theme_setup');




/*===================================================================*/
/* 4. ADD OUR SCRIPTS
/*===================================================================*/
if ( !function_exists( 'bean_enqueue_scripts') )
{
	function bean_enqueue_scripts()
	{
		// STYLESHEETS
		wp_enqueue_style('main', get_stylesheet_directory_uri(). '/style.css', false, '1.0', 'all');

		// CUSTOM STYLES
//		$theme_style = get_theme_mod( 'theme_style');
//		if ($theme_style == 'theme_style_2') { 
//			wp_enqueue_style('style-2', get_stylesheet_directory_uri(). '/assets/styles/style-2/style-2.css',false,'1.0','all');	
//		} 
//		if ($theme_style == 'theme_style_3') { 
//			wp_enqueue_style('style-3', get_stylesheet_directory_uri(). '/assets/styles/style-3/style-3.css',false,'1.0','all');	
//			wp_enqueue_style('roboto', 'http://fonts.googleapis.com/css?family=Roboto:400,500,700' );
//		} 
//		if ($theme_style == 'theme_style_4') { 
//			wp_enqueue_style('style-4', get_stylesheet_directory_uri(). '/assets/styles/style-4/style-4.css',false,'1.0','all');	
//		} 

		// Fabians Styles
		wp_enqueue_style('fabian', get_stylesheet_directory_uri(). '/assets/styles/fabian.css',false,'1.0','all');
		
		//Mobile Stylesheets
		wp_enqueue_style('mobile', get_stylesheet_directory_uri(). '/assets/css/mobile.css',false,'1.0','all');

		// IF FONTS ARE DISABLED, USE THIS FOR DEFAULT
		$type_select_headings = get_theme_mod('type_select_headings');

		//IF WOOCOMMERCE IS ENABLED
		if( bean_theme_supports( 'primary', 'woocommerce' ) && get_theme_mod( 'enable_wc' ) == true )
		{
			wp_enqueue_style('woo', get_stylesheet_directory_uri(). '/woocommerce/style-woo.css', false, '1.0', 'all');
		}	
		
		// REGISTER SCRIPTS
		wp_register_script('validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', 'jquery', '1.9', true);
		wp_register_script('custom', get_template_directory_uri() . '/assets/js/custom.js', 'jquery', '1.0', TRUE);
		wp_register_script('custom-libraries', get_template_directory_uri() . '/assets/js/custom-libraries.js', 'jquery', '1.0', TRUE);
		wp_register_script('retina', get_template_directory_uri() . '/assets/js/retina.js', 'jquery', '1.0', TRUE);
		wp_register_script('bean-soon', get_template_directory_uri() . '/assets/js/bean-soon.js', 'jquery', '1.0', TRUE);

		// ENQUEUE SCRIPTS
		wp_enqueue_script('jquery');
		wp_enqueue_script('custom-libraries');
		wp_enqueue_script('custom');

		// LOCALIZE THE 'WP_TEMPLATE_DIRECTORY_URI' VARIABLE FOR USE BY THE JS
		wp_localize_script( 'custom', 'WP_TEMPLATE_DIRECTORY_URI', array( 0 => get_template_directory_uri() ) );

		//AJAX
		wp_localize_script('custom', 'bean', array(
		    'ajaxurl' => admin_url('admin-ajax.php'),
		    'nonce' => wp_create_nonce('bean-ajax'),
		));

		if( get_theme_mod( 'retina_option' ) == true) {
			wp_enqueue_script('retina');
		}

		// CONDITIONALLY LOADED ENQUEUE SCRIPTS
		if ( !is_404() ) {
			global $post;
			$postid = $post->ID;
		}

		//LAYOUT
		//WE ARE USING THE GLOBAL THEME CUSTOMIZER VALUE AS PRIORITY HERE, BUT IF THE PORTFOLIO LAYOUT 
		//FROM THE PORTFOLIO POST META IS NOT "DEFAULT", THEN WE PULL THAT.
		$theme_version = get_theme_mod( 'theme_version');
		$portfolio_layout = get_post_meta($postid, '_bean_portfolio_layout', true);
		if ($portfolio_layout == 'default') {
			if 	  ( get_theme_mod( 'theme_version') == 'theme_version_fullscreen') { $portfolio_layout = 'fullscreen'; } 
			elseif ( get_theme_mod( 'theme_version') == 'theme_version_fullwidth') { $portfolio_layout = 'fullwidth'; }
			elseif ( get_theme_mod( 'theme_version') == 'theme_version_carousel') { $portfolio_layout = 'carousel'; }
			elseif ( get_theme_mod( 'theme_version') == 'theme_version_grid') { $portfolio_layout = 'grid'; }
			else   { $portfolio_layout = 'std'; }
		}

		if ( $theme_version !== 'theme_version_grid' && 
			$theme_version !== 'theme_version_grid' || is_singular('portfolio') &&
			!is_page_template('template-portfolio-grid.php') && 
			!is_page_template('template-portfolio-grid-fullwidth.php') &&
			!is_page_template('template-portfolio-grid-lightbox.php') &&
			!is_page_template('template-portfolio-grid-fullwidth-lightbox.php')
			) {
			wp_enqueue_script('masonry');
		}

		if ( is_page_template('template-team.php') OR
			is_page_template('template-portfolio-masonry.php') OR 
			is_page_template('template-portfolio-masonry-fullwidth.php') OR
			is_page_template('template-portfolio-masonry-fullwidth-lightbox.php') OR
			is_page_template('template-portfolio-masonry-lightbox.php')
			) {
			wp_enqueue_script('masonry');
		}

		if ( is_page_template('template-contact.php') || is_singular('post') || is_singular('portfolio') ) {
			wp_enqueue_script('validation');
		}

		if ( is_singular('post') || is_singular('portfolio') && comments_open() && get_option( 'thread_comments' ) && !is_page_template('template-home.php') ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		if ( is_page_template('template-comingsoon.php') ) {
			wp_enqueue_script('bean-soon'); 
		}

	} //END function bean_enqueue_scripts()

	add_action( 'wp_enqueue_scripts', 'bean_enqueue_scripts');

} //END if ( !function_exists( 'bean_enqueue_scripts') )




/*===================================================================*/
/* 5. REGISTER WIDGET AREAS	
/*===================================================================*/
if ( !function_exists( 'bean_widget_areas_init' ) ) 
{
	function bean_widget_areas_init() 
	{
		register_sidebar(array(
			'name' => __('Internal Sidebar', 'bean'),
			'description' => __('Widget area for the primary sidebar.', 'bean'),
			'id' => 'internal-sidebar',
			'before_widget' => '<div class="widget %2$s clearfix">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		));

		//IF WOOCOMMERCE IS ENABLED
		if( bean_theme_supports( 'primary', 'woocommerce' ) && get_theme_mod( 'enable_wc' ) == true )
		{
			register_sidebar(array(
				'name' => __('Shop Sidebar', 'bean'),
				'description' => __('Widget area for the shop pages.', 'bean'),
				'id' => 'shop-template',
				'before_widget' => '<div class="widget %2$s clearfix">',
				'after_widget' => '</div>',
				'before_title' => '<h6 class="widget-title">',
				'after_title' => '</h6>',
			));
		} //END if( bean_theme_supports( 'primary', 'woocommerce' ))

		if( get_theme_mod( 'hidden_sidebar' ) == true) 
		{
			register_sidebar(array(
				'name' => __('Hidden Sidebar', 'bean'),
				'description' => __('Widget area for the hidden sidebar.', 'bean'),
				'id' => 'home-template',
				'before_widget' => '<div class="widget %2$s clearfix">',
				'after_widget' => '</div>',
				'before_title' => '<h6 class="widget-title">',
				'after_title' => '</h6>',
			));
		} //END get_theme_mod( 'hidden_sidebar' ) == true) 

	} //END function bean_widget_areas_init()

	add_action( 'widgets_init', 'bean_widget_areas_init' );
	
} //END if ( !function_exists( 'bean_widget_areas_init' ) )








/*===================================================================*/
/*
/* 6. THEME SPECIFIC FUNCTIONS
/*
/*===================================================================*/
/*===================================================================*/
/*  ONLY SEARCH POSTS
/*===================================================================*/
function bean_search_filter($query)
{
	if ( !$query->is_admin && $query->is_search)
		{
			//UNCOMMENT BELOW TO SEARCH FOR POSTS ONLY
			//$query->set('post_type', 'post' );
			
			//UNCOMMENT BELOW TO SEARCH FOR PORTFOLIO ONLY
			//$query->set('post_type', 'portfolio' );
			
			//UNCOMMENT BELOW TO SEARCH FOR PAGES ONLY
			//$query->set('post_type', 'page' );
			
			$query->set('post_type', array('page', 'post', 'portfolio') );
		}
	return $query;
}
add_filter( 'pre_get_posts', 'bean_search_filter' );



/*===================================================================*/
/*  ADD ODD / EVEN CLASSES TO POSTS	          							
/*===================================================================*/
if ( !function_exists( 'oddeven_post_class' ) ) 
{
	function oddeven_post_class ( $classes ) 
	{
	   global $current_class;
	   $classes[] = $current_class;
	   $current_class = ($current_class == 'odd') ? 'even' : 'odd';
	   return $classes;
	} //END if ( function_exists( 'oddeven_post_class' ) )
	add_filter ( 'post_class' , 'oddeven_post_class' );

	global $current_class;
	$current_class = 'odd';
} //END if ( !function_exists( 'oddeven_post_class' ) )




/*===================================================================*/
/*  SIDEBAR LOADER
/*===================================================================*/
if ( !function_exists( 'bean_sidebar_loader' ) ) 
{
	function bean_sidebar_loader() 
	{
		global $post, $bean_sidebar_location, $bean_sidebar_class, $bean_content_class;

		$bean_sidebar_location = get_post_meta ($post->ID, '_bean_page_layout', true);
		$bean_sidebar_class = "";
		$bean_content_class = "";

		if ( $bean_sidebar_location === 'right' ) {
			$bean_sidebar_class = "four columns sidebar";
			$bean_content_class = "eight columns sidebar-right";

		} elseif ( $bean_sidebar_location === 'std' ) {
			$bean_content_class = "six columns centered mobile-four";
		} else {
			$bean_content_class = "twelve columns content";
		}
	}
} //END if ( !function_exists( 'bean_sidebar_loader' ) )




/*===================================================================*/
/*  LOOP BY VIEWS - VIEW COUNT FUNCTION
/*===================================================================*/
function bean_getPostViews($postID)
{
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);

	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	return '0';
 	}

 	return $count;
}//END if ( function( 'bean_getPostViews' ) )

function bean_setPostViews($postID) 
{
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	
	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	} else {
		$count++;
		update_post_meta($postID, $count_key, $count);
	}

}//END if ( function( 'bean_setPostViews' ) )




/*===================================================================*/
/* RELATED POSTS
/*===================================================================*/
if ( !function_exists( 'bean_get_related_posts' ) ) 
{
	function bean_get_related_posts($post_id, $taxonomy, $args=array()) 
	{
		$terms = wp_get_object_terms($post_id, $taxonomy);

		if( count($terms) ) {
			$post = get_post($post_id);
			$our_terms = array();
			foreach ($terms as $term) {
			$our_terms[] = $term->slug;
		}

		$args = wp_parse_args($args, array(
		'post_type' => $post->post_type,
		'post__not_in' => array($post_id),
		'tax_query' => array(
		array(
			'taxonomy' => $taxonomy,
			'terms' => $our_terms,
			'field' => 'slug',
			'operator' => 'IN'
			)
		),
		'orderby' => 'rand'
		)
		);
		$query = new WP_Query($args);
			return $query;
		} else {
			return false;
		}
	} //END if ( function( 'bean_get_related_posts' ) )
} //END if ( !function_exists( 'bean_get_related_posts' ) )


/*===================================================================*/
/*  PORTFOLIO MASONRY OUTPUT
/*===================================================================*/
if ( !function_exists( 'bean_portfolio_masonry' ) )
{
	function bean_portfolio_masonry()
	{ 
		if ( !is_404() ) 
		{
			global $post;
			$postid = $post->ID;
			$portfolio_layout = get_post_meta($postid, '_bean_portfolio_layout', true); 
			$theme_version = get_theme_mod( 'theme_version'); 
	 
			if ( is_page_template('template-portfolio.php') && $theme_version == 'theme_version_std') 
			{ ?> 

				<script type="text/javascript">
					jQuery(document).ready(function($) {
						//MASONRY
						var container = document.querySelector('#masonry-container');
					     var msnry;
					     imagesLoaded( container, function() {
							msnry = new Masonry( container, {
								itemSelector: '.masonry-item'
							});
					     });

					});
				</script>
			
			<?php 
			}	
		} //END if ( is_page_template('template-portfolio-masonry.php')...
	} //END function bean_portfolio_masonry()
} //END if ( !function_exists( 'bean_portfolio_masonry' ) )
add_action('wp_footer', 'bean_portfolio_masonry');




/*===================================================================*/
/* LOAD MORE PORTFOLIO POSTS                                          
/*===================================================================*/
if ( !function_exists( 'bean_load_more_portfolio' ) ) 
{
    function bean_load_more_portfolio() 
    {
        if( !wp_verify_nonce($_POST['nonce'], 'bean-ajax') ) die('Invalid nonce');
        if( !is_numeric($_POST['page']) || $_POST['page'] < 0 ) die('Invalid page');

        $load_more_data = $_POST['data'];
        $loop_template = $load_more_data['loopTemplate'];
        $order = $load_more_data['order'];
        $orderby = $load_more_data['orderby'];
        $meta_key = $load_more_data['metakey'];
        $posts_per_page = $load_more_data['postsCount'];

        $query_args = '';
        if( isset($_POST['archive']) && $_POST['archive'] ) $query_args = $_POST['archive'] .'&';
        $query_args .= 'post_type=portfolio&post_status=publish&posts_per_page='. $posts_per_page .'&paged='. $_POST['page'] . '&order=' . $order . '&orderby=' . $orderby . '&meta_key=' . $meta_key;
        
        //THE LOOP
        ob_start();
        
        $query = new WP_Query( $query_args );
        if ($query->have_posts()) : while($query->have_posts()) : $query->the_post();
            get_template_part( $loop_template );
        endwhile; endif;
        wp_reset_postdata();

        $content = ob_get_contents();
        ob_end_clean();
        echo json_encode(array(
            'pages' => $query->max_num_pages,
            'content' => $content
        ));
        exit;
    } //END  function bean_load_more_portfolio()
    add_action('wp_ajax_bean_load_more_portfolio', 'bean_load_more_portfolio');
    add_action('wp_ajax_nopriv_bean_load_more_portfolio', 'bean_load_more_portfolio');
} //END if ( !function_exists( 'bean_load_more_portfolio' ) )




/*===================================================================*/           
/*  NO SINGLE VIEW FOR TEAM AND TESTIMONIAL POSTS             
/*===================================================================*/
if ( !function_exists('bean_no_single_cpt_redirect') ) 
{
	function bean_no_single_cpt_redirect() 
	{
		$queried_post_type = get_query_var('post_type');
		if ( is_single() && 'team' ==  $queried_post_type ) {
			wp_redirect( home_url(), 301 );
			exit;
		}

		if ( is_single() && 'testimonial' ==  $queried_post_type ) {
			wp_redirect( home_url(), 301 );
			exit;
		}
	} //END function bean_no_single_cpt_redirect()
} //END if ( !function_exists( 'bean_no_single_cpt_redirect' ) )
add_action( 'template_redirect', 'bean_no_single_cpt_redirect' );




/*===================================================================*/
/*  TEAM MEMBERS SHORTCODE OUTPUT          							
/*===================================================================*/
add_shortcode('team', 'scTeam');   
function scTeam($attr, $content)
{        
	ob_start(); 

	echo "<div class='row portfolio'>"; 
		get_template_part('content', 'team');  
	echo "</div>"; 

	$ret = ob_get_contents();  
	ob_end_clean();  
	return $ret;    
}




/*===================================================================*/
/*  TESTIMONIALS SHORTCODE OUTPUT          							
/*===================================================================*/
add_shortcode('testimonials', 'scTestimonials');   
function scTestimonials($attr, $content)
{        
	ob_start(); 
	
	echo "<div class='testimonials'>"; 
		get_template_part('content', 'testimonials');  
	echo "</div>"; 

	$ret = ob_get_contents();  
	ob_end_clean();  
	return $ret;    
}




/*===================================================================*/
/*  CUSTOM COMMENT OUTPUT
/*===================================================================*/
if ( !function_exists( 'bean_comment' ) )
{
	function bean_comment($comment, $args, $depth)
	{
	    $isByAuthor = false;

	    if($comment->comment_author_email == get_the_author_meta('email')) {
	        $isByAuthor = true;
	    }

	    $GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>">

				<div class="comment-author vcard">
					 <?php echo get_avatar($comment,$size='45'); ?>
					<?php printf(__('<cite class="fn">%s</cite> ', 'bean'), get_comment_author_link()) ?> <?php if($isByAuthor) { ?><span class="author-tag"><?php _e('(Author)', 'bean') ?></span><?php } ?>
				</div><!-- END .comment-author.vcard -->

				<div class="comment-meta commentmetadata subtext">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'bean'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('Edit', 'bean'),' &middot; ','') ?>   &middot; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div><!-- END .comment-meta.commentmetadata.subtext -->

				<div class="comment-body">
					<?php if ($comment->comment_approved == '0') : ?>
						<span class="moderation"><?php _e('Awaiting Moderation', 'bean') ?></span>
					<?php endif; ?>
				<?php comment_text() ?>
				</div><!-- END .comment-body -->

			</div><!-- END #comment-<?php comment_ID(); ?> -->
		</li>
	<?php
	} //END function bean_comment($comment, $args, $depth)
} //END if ( !function_exists( 'bean_comment' ) )




/*===================================================================*/
/*  CUSTOM PING OUTPUT
/*===================================================================*/
if ( !function_exists( 'bean_ping' ) )
{
	function bean_ping($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment; ?>

		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>

		<?php
	} //END //function bean_ping($comment, $args, $depth)
}//END if ( !function_exists( 'bean_ping' ) )




/*===================================================================*/
/*	COMMENTS FORM
/*===================================================================*/
function bean_custom_form_filters( $args = array(), $post_id = null )
{
	global $id;

	if ( null === $post_id )
		$post_id = $id;
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';


	$fields =  array(
		'author' => '
			<div class="comment-form-author clearfix">
				<label for="author" class="subtext">' . __( 'Name', 'bean' ) . ('<span class="required">*</span>') . '</label>
				<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required/>
			</div>',

		'email'  => '
			<div class="comment-form-email clearfix">
			<label for="email" class="subtext">' . __( 'Email', 'bean' ) . ('<span class="required">*</span>') . '</label>
				<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" required/>
			</div>',

		'url'    => '
			<div class="comment-form-url">
				<label for="url" class="subtext">' . __( 'Website', 'bean') . '</label>
				<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"/>
			</div>',
	);

	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<div class="comment-form-message clearfix"><label for="comment" class="subtext">' . __( 'Comment', 'bean') . '</label><textarea id="comment" name="comment" cols="45" rows="8"  required></textarea></div>','',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'bean' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as subtext">' . sprintf( __( 'Currently logged in as <a href="%1$s">%2$s</a> / <a href="%3$s" title="Log out of this account">Logout</a>', 'bean' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => null,
		'comment_notes_after'  => null,
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => sprintf( __( 'Leave a Comment', 'bean' )),
		'title_reply_to'       => __( 'Leave a Reply to %s', 'bean' ),
		'cancel_reply_link'    => __( 'Cancel', 'bean' ),
		'label_submit'         => __( 'Submit Comment', 'bean' ),
	);

	return $defaults;
}
add_filter( 'comment_form_defaults', 'bean_custom_form_filters' );