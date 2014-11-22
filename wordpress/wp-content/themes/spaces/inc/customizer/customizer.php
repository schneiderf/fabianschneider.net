<?php 
/*===================================================================*/                							
/*  LIVE PREVIEW EDITING (JS) - GRABS THE JS		                							
/*===================================================================*/
add_action( 'customize_preview_init', 'bean_customizer_live_preview' );
function bean_customizer_live_preview() {
	wp_enqueue_script('customizer', BEAN_CUSTOMIZER_URL . '/assets/js/customizer-preview.js', 'jquery', '1.0', true);
}



/*===================================================================*/                							
/*  THEME CUSTOMIZER FUNCTIONS		                							
/*===================================================================*/
add_action( 'customize_register', 'Bean_Customize_Register' );
function Bean_Customize_Register( $wp_customize ) 
{


//REQUIRE CUSTOM CONTROLS
require_once( BEAN_FRAMEWORK_FUNCTIONS_DIR . '/bean-admin-customizer-controls.php' );




/*===================================================================*/         	
/*  MOVE STUFF TO OTHER SECTIONS               							
/*===================================================================*/	
//SITE TITLE/DESC
$wp_customize->get_control( 'blogname' )->section='logo';
$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
$wp_customize->get_control( 'blogname' )->priority=1;

$wp_customize->get_control( 'blogdescription' )->section='logo';
$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
$wp_customize->get_control( 'blogdescription' )->priority=2;




/*===================================================================*/         	
/*  VARIABLES FOR FONTS			                							
/*===================================================================*/	
if( bean_theme_supports( 'primary', 'fonts' )) 
{
	//FONT VARIABLES/LOAD LISTS
	$fonts = bean_fonts();

	//SIZE RANGES
	$font_size_range = array(
		'min' => '10',
		'max' => '80',
		'step' => '1',
		);
	//LINE HEIGHT RANGES
	$font_lineheight_range = array(
		'min' => '10',
		'max' => '80',
		'step' => '1',
		);
	//LETTER SPACING RANGES
	$font_letterspacing_range = array(
		'min' => '-5',
		'max' => '20',
		'step' => '1',
		);
} else { 
	$fonts = '';
	$font_size_range = '';
	$font_lineheight_range = '';
	$font_letterspacing_range = '';
}//END if( bean_theme_supports( 'primary', 'fonts' )) 	




/*===================================================================*/         	
/*  LOGO SECTION			                							
/*===================================================================*/	
$wp_customize->add_section( 'logo', array(
	'title' => __( 'Site Title & Tagline', 'bean' ),
	'priority' => 1,
	)
);
	
	$wp_customize->add_setting( 'header_intro', array( 'default' => 'A creative&#39;s dream theme featuring a classic minimal appeal & fully-featured portfolio to follow. Set up your professional portfolio effortlessly, with zero coding required.' ) );
	$wp_customize->add_control( new Bean_Customize_Textarea_Control( $wp_customize, 'header_intro', array(
		'label' => __( 'Header Tagline', 'bean' ),
		'section' => 'logo',
		'settings' => 'header_intro',
		'priority' =>2
		) ) );


	if( bean_theme_supports( 'primary', 'fonts' )) 
	{
		$wp_customize->add_setting( 'type_select_logo', array( 'default' => 'Courier') );
		$wp_customize->add_control( 'type_select_logo',
			array(
				'type' => 'select',
				'label' => __( 'Logo Font', 'bean' ),
				'section' => 'logo',
				'priority' => 3,
				'choices' => $fonts
				)
			);
		
		$wp_customize->add_setting( 'type_slider_logo_size', array('default' => '22') );
		$wp_customize->add_control( new Bean_Customize_Slider_Control( $wp_customize, 'type_slider_logo_size', array(
			'type' 		=> 'slider',
			'label' 	=> __( 'Logo Size', 'bean' ),
			'section' 	=> 'logo',
			'settings' 	=> 'type_slider_logo_size',
			'priority' 	=> 4,
			'choices' => $font_size_range
			) ) );
		
		$wp_customize->add_setting( 'type_slider_logo_lineheight', array('default' => '30') );
		$wp_customize->add_control( new Bean_Customize_Slider_Control( $wp_customize, 'type_slider_logo_lineheight', array(
			'type' 		=> 'slider',
			'label' 	=> __( 'Logo Line Height', 'bean' ),
			'section' 	=> 'logo',
			'settings' 	=> 'type_slider_logo_lineheight',
			'priority' 	=> 5,
			'choices' => $font_lineheight_range
			) ) );
		
		$wp_customize->add_setting( 'type_slider_logo_letterspacing', array('default' => '0') );
		$wp_customize->add_control( new Bean_Customize_Slider_Control( $wp_customize, 'type_slider_logo_letterspacing', array(
			'type' 		=> 'slider',
			'label' 	=> __( 'Logo Letter Spacing', 'bean' ),
			'section' 	=> 'logo',
			'settings' 	=> 'type_slider_logo_letterspacing',
			'priority' 	=> 6,
			'choices' => $font_letterspacing_range
			) ) );
	}//END if( bean_theme_supports( 'primary', 'fonts' )) 



/*===================================================================*/         	
/*  THEME SETTINGS SECTION			                							
/*===================================================================*/	
$wp_customize->add_section( 'theme_settings', array(
	'title' => __( 'Theme Settings', 'bean' ),
	'priority' => 2,
	)
);

	$wp_customize->add_setting( 'retina_option', array( 'default' => false ) );
	$wp_customize->add_control( 'retina_option',
		array(
			'type' => 'checkbox',
			'label' => __( 'Enable Retina.js', 'bean' ),
			'section' => 'theme_settings',
			'priority' => 1,
			)
		);

	$wp_customize->add_setting( 'framework_seo', array( 'default' => true ) );
	$wp_customize->add_control( 'framework_seo',
		array(
			'type' => 'checkbox',
			'label' => __( 'Enable Framework SEO', 'bean' ),
			'section' => 'theme_settings',
			'priority' => 2,
			)
		);

	if( bean_theme_supports( 'primary', 'woocommerce' )) 
	{
		$wp_customize->add_setting( 'enable_wc', array( 'default' => false ) );
		$wp_customize->add_control( 'enable_wc',
		    array(
		        'type' => 'checkbox',
		        'label' => __( 'Enable WooCommerce', 'bean' ),
		        'section' => 'theme_settings',
		        'priority' => 3,
		    )
		);
	}

	$wp_customize->add_setting( 'hidden_sidebar', array( 'default' => true ) );
	$wp_customize->add_control( 'hidden_sidebar',
	    array(
	        'type' => 'checkbox',
	        'label' => 'Enable Hidden Sidebar',
	        'section' => 'theme_settings',
	        'priority' => 4,
	    )
	);

	$wp_customize->add_setting( 'header_search', array( 'default' => false ) );
	$wp_customize->add_control( 'header_search',
		array(
			'type' => 'checkbox',
			'label' => __( 'Enable Header Search', 'bean' ),
			'section' => 'theme_settings',
			'priority' => 5,
			)
		);




/*===================================================================*/         	
/*  GENERAL SETTINGS SECTION			                							
/*===================================================================*/		
$wp_customize->add_section( 'general_settings', array(
	'title' => __( 'General Settings', 'bean' ),
	'priority' => 3,
	)
);

	$wp_customize->add_setting( 'img-upload-login-logo', array() );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'img-upload-login-logo', array(
		'label' 	=> __( 'Login Logo', 'bean' ),
		'section' 	=> 'general_settings',
		'settings' 	=> 'img-upload-login-logo',
		'priority' 	=> 2
		) ) );

	$wp_customize->add_setting( 'img-upload-logo', array() );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'img-upload-logo', array(
		'label' 	=> __( 'Logo', 'bean' ),
		'section' 	=> 'general_settings',
		'settings' 	=> 'img-upload-logo',
		'priority' 	=> 1
		) ) );

	$wp_customize->add_setting( 'img-upload-favicon', array() );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'img-upload-favicon', array(
		'label' 	=> __( 'Favicon', 'bean' ),
		'section' 	=> 'general_settings',
		'settings' 	=> 'img-upload-favicon',
		'priority' 	=> 4
		) ) );

	$wp_customize->add_setting( 'img-upload-apple_touch', array() );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'img-upload-apple_touch', array(
		'label' 	=> __( 'Apple Touch Icon', 'bean' ),
		'section' 	=> 'general_settings',
		'settings' 	=> 'img-upload-apple_touch',
		'priority' 	=> 5
		) ) );

	$wp_customize->add_setting( 'twitter_profile', array('default' => ''));
	$wp_customize->add_control( 'twitter_profile',
		array(
			'label' => __( 'Twitter Username (eg:ThemeBeans)', 'bean' ),
			'section' => 'general_settings',
			'type' => 'text',
			'priority' => 6,
			)
		);

	$wp_customize->add_setting( 'footer_copyright', array( 'default' => '' ) );
	$wp_customize->add_control( new Bean_Customize_Textarea_Control( $wp_customize, 'footer_copyright', array(
		'label' => __( 'Footer Copyright', 'bean' ),
		'section' => 'general_settings',
		'settings' => 'footer_copyright',
		'priority' => 7
		) ) );

	$wp_customize->add_setting( 'google_analytics', array( 'default' => '' ) );
	$wp_customize->add_control( new Bean_Customize_Textarea_Control( $wp_customize, 'google_analytics', array(
		'label' => __( 'Google Analytics Script', 'bean' ),
		'section' => 'general_settings',
		'settings' => 'google_analytics',
		'priority' =>8
		) ) );	




/*===================================================================*/                							
/*  DIVIDER SECTION			                							
/*===================================================================*/
$wp_customize->add_section('divider1', array('priority' => 5 ));
$wp_customize->add_setting('divider1');
$wp_customize->add_control('divider1', array('section' => 'divider1'));




/*===================================================================*/                							
/*  BACKGROUND SECTION			                							
/*===================================================================*/
$wp_customize->add_section( 'background', array(
	'title' => __( 'Custom Background', 'bean' ),
	'priority' => 6,
	)
);




/*===================================================================*/                							
/*  COLORS SECTION			                							
/*===================================================================*/
$wp_customize->add_section( 'custom_styles', array(
	'title' => __( 'Styles & Layouts', 'bean' ),
	'priority' => 7,
	)
);

	$wp_customize->add_setting( 'wrapper_background_color', array(
		'default' => '#FFF',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wrapper_background_color', array(
		'label'   	=> __( 'Background', 'bean' ),
		'section' 	=> 'custom_styles',
		'settings'  	=> 'wrapper_background_color',
		'priority' 	=> 1
	) ) );


	$wp_customize->add_setting( 'theme_accent_color', array(
		'default' => '#1AA8D8',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_accent_color', array(
		'label'   	=> __( 'Accent Color', 'bean' ),
		'section' 	=> 'custom_styles',
		'settings'  	=> 'theme_accent_color',
		'priority' 	=> 2
		) ) );


	$wp_customize->add_setting( 'theme_style', array( 'default' => 'theme_style_1' ) );
	$wp_customize->add_control( 'theme_style',
		array(
			'type' => 'select',
			'label' => __( 'Theme Style', 'bean' ),
			'section' => 'custom_styles',
			'priority' => 3,
			'choices' => array(
				'theme_style_1' => __( 'Style 1 - Mono', 'bean' ),
				'theme_style_2' => __( 'Style 2 - Dark', 'bean' ),
				'theme_style_3' => __( 'Style 3 - Clean', 'bean' ),
				'theme_style_4' => __( 'Style 4 - Classic', 'bean' ),
				),
			)
		);	


	$wp_customize->add_setting( 'header_style', array( 'default' => 'header_style_1' ) );
	$wp_customize->add_control( 'header_style',
		array(
			'type' => 'select',
			'label' => __( 'Header Layout', 'bean' ),
			'section' => 'custom_styles',
			'priority' => 4,
			'choices' => array(
				'header_style_1' => __( 'Style 1 - Default', 'bean' ),
				'header_style_2' => __( 'Style 2 - Centered', 'bean' ),
				),
			)
		);

	$wp_customize->add_setting( 'theme_version', array( 'default' => 'theme_version_std' ) );
	$wp_customize->add_control( 'theme_version',
		array(
			'type' => 'select',
			'label' => __( 'Portfolio Layout', 'bean' ),
			'section' => 'custom_styles',
			'priority' => 5,
			'choices' => array(
				'theme_version_std' => __( 'Standard', 'bean' ),
				'theme_version_fullwidth' => __( 'Fullwidth', 'bean' ),
				'theme_version_fullscreen' => __( 'Fullscreen', 'bean' ),
				'theme_version_carousel' => __( 'Carousel', 'bean' ),
				'theme_version_grid' => __( 'Gallery Grid', 'bean' ),
				),
			)
		);	

	$wp_customize->add_setting( 'portfolio_column_width', array( 'default' => 'col_std' ) );
	$wp_customize->add_control( 'portfolio_column_width',
		array(
			'type' => 'select',
			'label' => __( 'Portfolio Grid Layout', 'bean' ),
			'section' => 'custom_styles',
			'priority' => 6,
			'choices' => array(
				'col_std' => __( 'Small Columns', 'bean' ),
				'col4' => __( 'Large Columns', 'bean' ),
				),
			)
		);			




/*===================================================================*/                							
/*  TYPOGRAPHY SECTION			                							
/*===================================================================*/
if( bean_theme_supports( 'primary', 'fonts' )) 
{				
	//HEADING TYPOGRAPHY
	$wp_customize->add_section( 'custom_typography', array(
	        'title' => __( 'Custom Typography', 'bean' ),
	        'priority' => 8,
	    )
	);
	
	$wp_customize->add_setting( 'type_select_primary_headings', array( 'default' => 'Courier') );
	$wp_customize->add_control( 'type_select_primary_headings',
	    array(
	        'type' => 'select',
	        'label' => __( 'Primary Header Font', 'bean' ),
	        'section' => 'custom_typography',
	        'priority' => 1,
	        'choices' => $fonts
	    )
	);

	$wp_customize->add_setting( 'type_select_secondary_headings', array( 'default' => 'Helvetica') );
	$wp_customize->add_control( 'type_select_secondary_headings',
	    array(
	        'type' => 'select',
	        'label' => __( 'Secondary Header Font', 'bean' ),
	        'section' => 'custom_typography',
	        'priority' => 1,
	        'choices' => $fonts
	    )
	);

	$wp_customize->add_setting( 'type_select_body', array( 'default' => 'Courier') );
	$wp_customize->add_control( 'type_select_body',
	    array(
	        'type' => 'select',
	        'label' => __( 'Body Font', 'bean' ),
	        'section' => 'custom_typography',
	        'priority' => 2,
	        'choices' => $fonts
	    )
	);

} //if( bean_theme_supports( 'primary', 'fonts' )) 	




/*===================================================================*/                							
/*  DIVIDER SECTION			                							
/*===================================================================*/	
$wp_customize->add_section('divider2', array('priority' => 9 ));
$wp_customize->add_setting('divider2');
$wp_customize->add_control('divider2', array('section' => 'divider2'));		




/*===================================================================*/         	
/*  PORTFOLIO SINGLE 			                							
/*===================================================================*/	
$wp_customize->add_section( 'portfolio_settings', array(
	'title' => __( 'Portfolio Settings', 'bean' ),
	'priority' => 11,
	)
);		

	$wp_customize->add_setting( 'portfolio_likes', array( 'default' => true, ) );
	$wp_customize->add_control( 'portfolio_likes',
		array(
			'type' => 'checkbox',
			'label' => __( 'Enable Porfolio Likes', 'bean' ),
			'section' => 'portfolio_settings',
			'priority' => 1,
			)
		);

	$wp_customize->add_setting( 'show_portfolio_sharing', array( 'default' => true, ) );
	$wp_customize->add_control( 'show_portfolio_sharing',
		array(
			'type' => 'checkbox',
			'label' => __( 'Enable Portfolio Sharing', 'bean' ),
			'section' => 'portfolio_settings',
			'priority' => 2,
			)
		);

	$wp_customize->add_setting( 'show_portfolio_loop_single', array( 'default' => true, ) );
	$wp_customize->add_control( 'show_portfolio_loop_single',
		array(
			'type' => 'checkbox',
			'label' => __( 'Enable Single Porfolio Loop', 'bean' ),
			'section' => 'portfolio_settings',
			'priority' => 3,
			)
		);

	$wp_customize->add_setting( 'portfolio_posts_count', array( 'default' => '-1') );
	$wp_customize->add_control( 'portfolio_posts_count',
		array(
			'label' => __( 'Portfolio Template Count', 'bean' ),
			'section' => 'portfolio_settings',
			'type' => 'text',
			'priority' => 4,
			)
		);


	$wp_customize->add_setting( 'portfolio_loop_orderby', array( 'default' => 'date' ) );
	$wp_customize->add_control( 'portfolio_loop_orderby',
		array(
			'type' => 'select',
			'label' => __( 'Portfolio Loop', 'bean' ),
			'section' => 'portfolio_settings',
			'priority' => 7,
			'choices' => array(
				'date' => __( 'Most Recent', 'bean' ),
				'view_count' => __( 'Most Popular', 'bean' ),
				'menu_order' => __( 'Sort Order', 'bean' ),
				),
			)
		);	

	//PAGES ARRAY
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = '';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	$wp_customize->add_setting('portfolio_page_selector');
	$wp_customize->add_control( 'portfolio_page_selector', array(
	    'settings' => 'portfolio_page_selector',
	    'label'   => __( 'Portfolio Page', 'bean' ),
	    'section' => 'portfolio_settings',
	    'type'    => 'select',
	    'choices' => $options_pages,
	    'priority' => 8,
	));

	$wp_customize->add_setting( 'portfolio_css_filter', array( 'default' => 'none' ) );
	$wp_customize->add_control( 'portfolio_css_filter',
	array(
		'type' => 'select',
		'label' => __( 'Portfolio CSS3 Filter', 'bean' ),
		'section' => 'portfolio_settings',
		'priority' => 9,
		'choices' => array(
			'none' => 'None',
			'grayscale' => 'Black & White',
			'sepia' => 'Sepia Tone',
			'saturation' => 'High Saturation',
			),
		)
	);

	$wp_customize->add_setting( 'portfolio_more_loop', array( 'default' => 'more' ) );
	$wp_customize->add_control( 'portfolio_more_loop',
	array(
		'type' => 'select',
		'label' => __( 'Portfolio Single Loop', 'bean' ),
		'section' => 'portfolio_settings',
		'priority' => 10,
		'choices' => array(
			'more' => 'All Posts',
			'related' => 'Related Posts',
			),
		)
	);





/*===================================================================*/         	
/*  BLOG SETTINGS SECTION			                							
/*===================================================================*/		
$wp_customize->add_section( 'blog_settings', array(
	'title' => __( 'Blog Settings', 'bean' ),
	'priority' => 12,
	)
);

	$wp_customize->add_setting( 'post_likes', array( 'default' => true, ) );
	$wp_customize->add_control( 'post_likes',
		array(
			'type' => 'checkbox',
			'label' => __( 'Display Post Likes', 'bean' ),
			'section' => 'blog_settings',
			'priority' => 2,
			)
		);

	$wp_customize->add_setting( 'post_sharing', array( 'default' => true, ) );
	$wp_customize->add_control( 'post_sharing',
		array(
			'type' => 'checkbox',
			'label' => __( 'Enable Post Sharing', 'bean' ),
			'section' => 'blog_settings',
			'priority' => 3,
			)
		);

	
	$wp_customize->add_setting( 'about_author', array( 'default' => true, ) );
	$wp_customize->add_control( 'about_author',
		array(
			'type' => 'checkbox',
			'label' => __( 'Enable About the Author', 'bean' ),
			'section' => 'blog_settings',
			'priority' => 4,
			)
		);

	$wp_customize->add_setting( 'reveal_content', array( 'default' => true, ) );
	$wp_customize->add_control( 'reveal_content',
		array(
			'type' => 'checkbox',
			'label' => __( 'Enable Post Content Reveal', 'bean' ),
			'section' => 'blog_settings',
			'priority' => 5,
			)
		);


/*===================================================================*/                						
/*  CONTACT TEMPLATE SECTION			                							
/*===================================================================*/		
$wp_customize->add_section( 'contact_settings', array(
	'title' => __( 'Contact Template', 'bean' ),
	'priority' => 13,
	)
);

	$wp_customize->add_setting( 'bean_contact_form', array( 'default' => true, ) );
	$wp_customize->add_control( 'bean_contact_form',
	    array(
	        'type' => 'checkbox',
	        'label' => 'Use Default Contact Form',
	        'section' => 'contact_settings',
	        'priority' => 1,
	    )
	);

	$wp_customize->add_setting( 'admin_custom_email',array( 'default' => '',));
	$wp_customize->add_control( 'admin_custom_email',
		array(
			'label' => __( 'Contact Form Email', 'bean' ),
			'section' => 'contact_settings',
			'type' => 'text',
			'priority' => 1,
			)
		);

	$wp_customize->add_setting('contact_button_text',array( 'default' => 'Send Message',));
	$wp_customize->add_control('contact_button_text',
		array(
			'label' => __( 'Contact Button Text', 'bean' ),
			'section' => 'contact_settings',
			'type' => 'text',
			'priority' => 2,
			)
		);

	$wp_customize->add_setting( 'google_maps_code', array( 'default' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3022.6150171700842!2d-73.985596!3d40.748495999999996!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire+State+Building!5e0!3m2!1sen!2sus!4v1398365535004" width="600" height="450" frameborder="0" style="border:0"></iframe>' ) );
	$wp_customize->add_control( new Bean_Customize_Textarea_Control( $wp_customize, 'google_maps_code', array(
		'label' => __( 'Google Maps Code', 'bean' ),
		'section' => 'contact_settings',
		'settings' => 'google_maps_code',
		'priority' => 3
		) ) );




/*===================================================================*/         	
/*  MAILBAG SECTION		                							
/*===================================================================*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
if (is_plugin_active('mailbag/mailbag.php')) 
{
		
	$wp_customize->add_section( 'mailbag_settings', array(
		'title' => __( 'Mailbag Settings', 'bean' ),
		'priority' => 14,
		)
	);	

		$wp_customize->add_setting( 'mailbag_title',array( 'default' => 'Newsletter Subscribe',));
		$wp_customize->add_control( 'mailbag_title',
			array(
				'label' => __( 'Mailbag Title', 'bean' ),
				'section' => 'mailbag_settings',
				'type' => 'text',
				'priority' => 1,
				)
			);

		$wp_customize->add_setting( 'mailbag_desc', array( 'default' => 'Subscribe to our email newsletter and receive free stuff, updates & new releases - straight to your inbox.' ) );
		$wp_customize->add_control( new Bean_Customize_Textarea_Control( $wp_customize, 'mailbag_desc', array(
			'label' => __( 'Mailbag Paragraph', 'bean' ),
			'section' => 'mailbag_settings',
			'settings' => 'mailbag_desc',
			'priority' => 2
			) ) );

		$wp_customize->add_setting( 'mailbag_select', array( 'default' => 'mailchimp' ) );
		$wp_customize->add_control( 'mailbag_select',
		array(
			'type' => 'select',
			'label' => __( 'Select Email Service', 'bean' ),
			'section' => 'mailbag_settings',
			'priority' => 3,
			'choices' => array(
				'mailchimp' => 'MailChimp',
				'campaign_monitor' => 'Campaign Monitor',
				),
			)
		);
}




/*===================================================================*/         	
/*  404 PAGE SECTION			                							
/*===================================================================*/		
$wp_customize->add_section( '404_settings', array(
	'title' => __( '404 Error & Coming Soon', 'bean' ),
	'priority' => 200,
	)
);	

	$wp_customize->add_setting( '404-img-upload', array() );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, '404-img-upload', array(
		'label' 	=> __( '404 Custom Image', 'bean' ),
		'section' 	=> '404_settings',
		'settings' 	=> '404-img-upload',
		'priority' 	=> 1
		) ) );

	$wp_customize->add_setting( 'error_text',array( 'default' => 'Sorry, that page does not exist' ));
	$wp_customize->add_control( 'error_text',
		array(
			'label' => __( '404 Text', 'bean' ),
			'section' => '404_settings',
			'type' => 'text',
			'priority' => 2,
			)
		);

	$wp_customize->add_setting( 'comingsoon_year',array( 'default' => '2016',));
	$wp_customize->add_control( 'comingsoon_year',
		array(
			'label' => __( 'Year (ex: 2014)', 'bean' ),
			'section' => '404_settings',
			'type' => 'text',
			'priority' => 3,
			)
		);

	$wp_customize->add_setting( 'comingsoon_month',array( 'default' => '01',));
	$wp_customize->add_control( 'comingsoon_month',
		array(
			'label' => __( 'Month (ex: 01 for JAN)', 'bean' ),
			'section' => '404_settings',
			'type' => 'text',
			'priority' => 4,
			)
		);

	$wp_customize->add_setting( 'comingsoon_day',array( 'default' => '01',));
	$wp_customize->add_control( 'comingsoon_day',
		array(
			'label' => __( 'Day (ex: 01)', 'bean' ),
			'section' => '404_settings',
			'type' => 'text',
			'priority' => 5,
			)
		);				




/*===================================================================*/                							
/*  DIVIDER SECTION			                							
/*===================================================================*/
$wp_customize->add_section('divider3', array('priority' => 201 ));
$wp_customize->add_setting('divider3');
$wp_customize->add_control('divider3', array('section' => 'divider3'));





/*===================================================================*/                						
/*  CUSTOM CSS SECTION			                							
/*===================================================================*/	
$wp_customize->add_section( 'tools', array(
	'title' => __( 'Tools CSS', 'bean' ),
	'priority' => 200,
	)
);

$default_css =
'/*
List your Custom CSS in this textarea. All your styles will be 
minimized and printed in the theme header. 
You are free to remove this note. Enjoy! 

CSS for Beginners: http://www.w3schools.com/css/
*/
';		

$wp_customize->add_setting( 'bean_tools_css', array( 'default' => $default_css ) );
$wp_customize->add_control( new Bean_Customize_Textarea_Control( $wp_customize, 'bean_tools_css', array(
	'label' => __( 'Custom CSS Editor', 'bean' ),
	'section' => 'tools',
	'settings' => 'bean_tools_css',
	'priority' => 8
	) ) );




/*===================================================================*/                							
/*  TRANSPORTS FOR LIVE PREVIEW EDITING		                							
/*===================================================================*/
	//LIVE HTML
$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
$wp_customize->get_setting( 'contact_button_text' )->transport = 'postMessage';
}