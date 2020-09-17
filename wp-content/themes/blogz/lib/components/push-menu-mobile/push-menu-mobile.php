<?php
/**
 * Push Mobile menu.
 *
 * @package Gt Addons
 */
function blogz_push_menu_mobile() {
	?>

<nav class="mobile-navigation" role="navigation">
	<?php
	wp_nav_menu(
		array(
			'container_class' => 'mobile-menu',
			'menu_class'      => 'mobile-menu clearfix',
			'theme_location'  => 'menu-1',
			'items_wrap'      => '<ul>%3$s</ul>',
		)
	);
	?>
</nav>

	<?php
}
