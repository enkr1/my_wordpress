jQuery( function ( $ ) {
	'use strict';

	var $window = $( window ),
	$mobileMenu = $( '#mobile-navigation' );

	/**
	 * Site nav
	 */
	 function menuClick() {
		//Add arrow icon to the li.
		var $dropdownToggle = $( '<span class="dropToggle fa fa-angle-down"></span>' );
		$mobileMenu.find( 'li' ).has( 'ul' )
		.children( 'a' )
		.after( $dropdownToggle );

		$( '.dropToggle' ).on( 'click', function( e ) {
			$( this ).toggleClass( 'is-toggled' )
			.next( '.sub-menu' )
			.toggle();
			e.stopPropagation();
		} );
	}

	function hideMobileMenuOnDesktops() {
		$window.on( 'resize', function () {
			if ( $window.width() > 992 ) {
				$mobileMenu.hide();
			}
		} )
	}

	menuClick();
	hideMobileMenuOnDesktops();
} );