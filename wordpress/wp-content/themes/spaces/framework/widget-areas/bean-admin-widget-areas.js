jQuery( document ).ready( function () {
	jQuery( '.bean-conditions.tabs' ).tabs();
	jQuery( '.bean-conditions.tabs .inner-tabs' ).tabs();

	jQuery( '#bean-conditions .advanced-settings a' ).click( function ( e ) {
		jQuery( this ).parent( 'li' ).siblings( '.advanced' ).toggleClass( 'hide' );

		var new_status = '1'; //DISPLAY
		if ( jQuery( this ).parent( 'li' ).siblings( '.advanced' ).hasClass( 'hide' ) ) {
			new_status = '0'; //DONT DISPLAY
		}

	});
});