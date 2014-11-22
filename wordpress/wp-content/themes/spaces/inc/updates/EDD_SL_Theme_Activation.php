<?php
/**
 * This file sets up the auto license activater.
 *
 *
 * @package Spaces
 * @subpackage WordPress
 * @author ThemeBeans
 * @since Spaces 1.1
 */


/*===================================================================*/
/* UPDATER SETUP
/*===================================================================*/
//STORE URL
define( 'BEAN_EDD_SL_STORE_URL', 'http://themebeans.com' );

//THEME NAME IN EDD ON STORE
define( 'BEAN_EDD_SL_THEME_NAME', 'Spaces WordPress Theme' );

//ADD LICENSE VARIABLE
function bean_license_setup() {
	add_option( 'bean_activate_license', 'THEMEBEANSSPACES' );
}
add_action( 'init', 'bean_license_setup' );

//INITIALIZE UPDATER
if ( !class_exists( 'EDD_SL_Theme_Updater' ) ) {
	include( dirname( __FILE__ ) . '/EDD_SL_Theme_Updater.php' );
}

$theme_license = trim( get_option( 'bean_activate_license' ) );

$edd_updater = new EDD_SL_Theme_Updater( array(
		'remote_api_url' 	=> BEAN_EDD_SL_STORE_URL,
		'version' 		=> '1.4.1',
		'license' 		=> $theme_license,
		'item_name' 		=> BEAN_EDD_SL_THEME_NAME,
		'author'			=> 'ThemeBeans'
	)
);




/*===================================================================*/
/* ACTIVATION
/*===================================================================*/
function bean_edd_activate_license( $oldname, $oldtheme=false ) {

	 	global $wp_version;

	 	//GET THE LICENSE	
		$license = trim( get_option( 'bean_activate_license' ) );

		$api_params = array(
			'edd_action' => 'activate_license',
			'license' => $license,
			'item_name' => urlencode( BEAN_EDD_SL_THEME_NAME )
		);

		//SEND THE REMOTE REQUEST
		$response = wp_remote_get( add_query_arg( $api_params, BEAN_EDD_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		if ( is_wp_error( $response ) )
			return false;

		//DECODE DATA
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "active" or "inactive"

		update_option( 'edd_sample_theme_license_key_status', $license_data->license );
	
}
add_action("after_switch_theme", "bean_edd_activate_license", 10 , 2);



/*===================================================================*/
/* DEACTIVATION - ON THEME SWITCH
/*===================================================================*/
function bean_edd_deactivate_license() 
{   
	//GET THE LICENSE
    $theme_license = trim( get_option( 'bean_activate_license' ) );

    //DATA TO SEND
	$api_params = array( 
		'edd_action' => 'deactivate_license', 
		'license'    => $theme_license, 
		'item_name'  => BEAN_EDD_SL_THEME_NAME
	);
	 
	//SEND THE REMOTE REQUEST
	$response = wp_remote_get( add_query_arg( $api_params, BEAN_EDD_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) ); 

	//DELETE THE OPTION
	delete_option( 'bean_activate_license' );
}
add_action('switch_theme', 'bean_edd_deactivate_license');