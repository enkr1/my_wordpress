<?php
/**
 * Toggle Mobile menu.
 *
 * @package Gt Addons
 */
function blogz_toggle_mobile_menu() {
	?>

<nav class="mobile-navigation" role="navigation">
	<?php
	wp_nav_menu(
		array(
			'container_class' => 'mobile-menu',
			'menu_class'      => 'mobile-menu clearfix',
			'theme_location'  => 'menu-1',
		)
	);
	?>
</nav>

	<?php
}
