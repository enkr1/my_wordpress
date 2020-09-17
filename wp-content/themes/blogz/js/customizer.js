/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $, customize, body ) {

	// Site title and description.
	customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
	customize( 'subscribe_button_text', function( setting ) {
		setting.bind( function( value ) {
			document.querySelector( '[name="jetpack_subscriptions_widget"]' ).setAttribute( 'value', value );
		} );
	} );

	// Toggle class options.
	var toggleOptions = {
		'sticky_header'            : 'sticky-header',
		'hide_topbar_social'       : 'topbar-social-hidden',
		'hide_archive_categories'  : 'archive-categories-hidden',
		'hide_archive_comment'     : 'archive-comment-hidden',
		'hide_archive_date'        : 'archive-date-hidden',
		'hide_archive_share'       : 'archive-share-hidden',
		'hide_archive_author'      : 'archive-author-hidden',
		'hide_single_categories'   : 'single-categories-hidden',
		'hide_single_tags'         : 'single-tags-hidden',
		'hide_single_date'         : 'single-date-hidden',
		'hide_single_author'       : 'single-author-hidden',
		'hide_single_author_social': 'single-author-social-hidden',
		'hide_single_comment'      : 'single-comment-hidden',
		'hide_single_share'        : 'single-share-hidden'
	};
	Object.keys( toggleOptions ).forEach( function( option ){
		customize( option, function( setting ) {
			setting.bind( function( value ) {
				body.classList.toggle( toggleOptions[ option ], value );
			} );
		} );
	} );
} )( jQuery, wp.customize, document.body );
