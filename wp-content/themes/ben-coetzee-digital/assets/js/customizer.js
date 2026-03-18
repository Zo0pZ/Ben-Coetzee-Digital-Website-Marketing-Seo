/**
 * Live preview for the Customizer logo settings.
 */
( function( $ ) {
	wp.customize( 'bcd_logo_mark', function( value ) {
		value.bind( function( newVal ) {
			$( '.logo-mark' ).text( newVal );
		} );
	} );

	wp.customize( 'bcd_logo_text', function( value ) {
		value.bind( function( newVal ) {
			$( '.logo-text' ).text( newVal );
		} );
	} );
} )( jQuery );
