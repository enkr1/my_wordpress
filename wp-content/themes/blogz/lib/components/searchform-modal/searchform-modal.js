jQuery(function($) {

	var $body = $( 'body' );

	$( '.header__search .search-toggle' ).on( 'click', function ( e ) {
		e.stopPropagation();
		var parent = jQuery( this ).parent();
		$body.addClass( 'gt-search-active' );
		setTimeout( function () {
			parent.find( '.search-field' ).focus();
		}, 500 );

		return false;

	} );
	jQuery( '.search-popup-bg, .close-search-toggle' ).on( 'click', function () {
		var parent = jQuery( this ).parent();
		parent.find( '.search-field' ).val( '' );
		$body.removeClass( 'gt-search-active' );

		return false;
	} );

	$( '.header__search > a' ).on( 'click', function () {
		$( this ).siblings( 'form' ).slideToggle();
	} );

});