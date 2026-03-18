/**
 * Live preview for the Customizer logo settings.
 */
( function( $ ) {
	wp.customize( 'bcd_logo_mark_image', function( value ) {
		value.bind( function( newVal ) {
			var $mark = $( '.logo-mark' );
			if ( newVal ) {
				$mark.html( '<img src="' + newVal + '" alt="" class="logo-mark__img">' );
			} else {
				var fallback = wp.customize( 'bcd_logo_mark' ).get() || 'BC';
				$mark.text( fallback );
			}
		} );
	} );

	wp.customize( 'bcd_logo_mark', function( value ) {
		value.bind( function( newVal ) {
			var imageUrl = wp.customize( 'bcd_logo_mark_image' ).get();
			if ( ! imageUrl ) {
				$( '.logo-mark' ).text( newVal );
			}
		} );
	} );

	wp.customize( 'bcd_logo_text', function( value ) {
		value.bind( function( newVal ) {
			$( '.logo-text' ).text( newVal );
		} );
	} );
} )( jQuery );
