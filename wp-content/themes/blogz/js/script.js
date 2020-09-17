(function($){
	'use strict';
	var $body = $( 'body' );
	var isRTL = $body.hasClass( 'rtl' );

	function initFeaturedPostsSlider() {
		$( '.hero__featured-posts' )
			.removeClass( 'd-none' )
			.slick( {
				slidesToShow  : 3,
				slidesToScroll: 1,
				arrows: false,
				rtl: isRTL,
				rows: 0, // fix div wrap outsite item (v1.8.1)
				responsive: [
					{
						breakpoint: 992,
						settings  : {
							slidesToShow: 2
						}
					},
					{
						breakpoint: 576,
						settings  : {
							slidesToShow: 1
						}
					}
				]
			});
	}

	function scrollToTop() {
		var $window = $(window),
			$button = $( '.scroll-to-top' );
        $window.scroll(function() {
            $button[$window.scrollTop() > 100 ? 'addClass' : 'removeClass']('is-visible');
        });
        $button.on('click', function(e) {
            e.preventDefault();
            $('body, html').animate({
                scrollTop: 0
            }, 500);
        });
	}

	function handleMenuAccessibility() {
		var menuItems = $( '.slideout-sidebar__footer > a' );
		var lastEl = menuItems[ menuItems.length - 1 ];

		$( document ).on( 'keydown', function( e ) {
			if ( $( window ).width() > 992 ) {
				return;
			}
			var keyCode = (window.event) ? e.which : e.keyCode;

			var tabKey = keyCode === 9;
			var shiftKey = event.shiftKey;

			var activeElement = document.activeElement;

			if ( ! shiftKey && tabKey && lastEl === activeElement ) {
				e.preventDefault();
				$( '.header__close' ).focus();
			}
		} );
	}

	scrollToTop();
	initFeaturedPostsSlider();
	handleMenuAccessibility();
})(jQuery);