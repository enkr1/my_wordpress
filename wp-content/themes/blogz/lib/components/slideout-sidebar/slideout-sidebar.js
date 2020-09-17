jQuery( function ( $ ) {
	'use strict';

	var $body = $( 'body' );
	var $menuToggle = $( '.slideout-sidebar-enabel .menu-toggle' );

	$menuToggle.on( 'click', e => {
		e.stopPropagation(); // do not trigger event on .site
		$body.addClass( 'slideout-sidebar-open' );
		setTimeout( () => {
			$( '.header__close' ).focus();
		}, 200 );
	} );

	$( '.site, .header__close' ).on( 'click', () => {
		$body.removeClass( 'slideout-sidebar-open' );
	} );

} );