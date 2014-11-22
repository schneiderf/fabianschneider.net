/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. This javascript will grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
 
( function( $ ) {
		
	//LIVE HTML
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.logo_text' ).html( newval );
		} );
	} );
	
	wp.customize( 'footer_alt_text', function( value ) {
		value.bind( function( newval ) {
			$( '.alt-text p' ).html( newval );
		} );
	} );
	
	wp.customize( 'contact_button_text', function( value ) {
		value.bind( function( newval ) {
			$( '.bean-contactform li.submit .button' ).html( newval );
		} );
	} );

	//LIVE CSS
	wp.customize( 'thumb_bg_color', function( value ) {
		value.bind( function( newval ) {
			$('.grid-item .post-thumb').css('background-color', newval );
		} );
	} );

} )( jQuery );
