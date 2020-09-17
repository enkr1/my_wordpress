jQuery( function ( $ ) {
	'use strict';

	var touchClass = 'archive',
		clickEvent = 'ontouchstart' in window ? 'touchstart' : 'click',
		transitionEnd = 'transitionend webkitTransitionEnd otransitionend MSTransitionEnd';

	//Add arrow icon to the li.
	var $dropdownToggle = $('<button class="dropToggle fa fa-angle-down"></button>');
	$('.widget_nav_menu').find('.menu-item-has-children > a, .page_item_has_children > a').after($dropdownToggle);

	//Add arrow icon to the li.
	$('.dropToggle').on('click', function(e) {
		$(this).toggleClass('is-toggled')
			.next('.sub-menu, .children')
			.slideToggle();
		e.stopPropagation();
	});

} );