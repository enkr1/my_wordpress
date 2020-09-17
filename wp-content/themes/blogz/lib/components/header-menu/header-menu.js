jQuery( function ( $ ) {
	'use strict';

		/* Make sure menu does not fly off the right of the screen */
		$('.main-navigation').find('li ul.sub-menu li.menu-item-has-children').mouseenter(function() {
			if ($(this).children('ul.sub-menu').offset().left + 250 > $(window).width()) {
				$(this).find('ul.sub-menu').css({ right: '100%', left: 'auto' });
			}
		});

} );