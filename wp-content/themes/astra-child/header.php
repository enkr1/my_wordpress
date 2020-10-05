<?php

/**
 * The header for Astra Theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>
<!DOCTYPE html>
<?php astra_html_before(); ?>
<html <?php language_attributes(); ?>>

<head>
	<?php astra_head_top(); ?>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<?php astra_head_bottom(); ?>
</head>

<body <?php astra_schema_body(); ?> <?php body_class(); ?>>

	<?php astra_body_top(); ?>
	<?php wp_body_open(); ?>
	<div <?php
			echo astra_attr(
				'site',
				array(
					'id'    => 'page',
					'class' => 'hfeed site',
				)
			);
			?>>
		<a class="skip-link screen-reader-text" href="#content"><?php echo esc_html(astra_default_strings('string-header-skip-link', false)); ?></a>

		<?php astra_header_before(); ?>

		<?php astra_header(); ?>

		<div class="nav-user-name">
			<p>
				<?php
				$user = wp_get_current_user();
				if (!is_user_logged_in()) {
				?>
					<a href="http://localhost:8000/my-account/">Login</a>
				<?php
				} else {
					echo 'Hello, ' . $user->user_firstname . ' ' . $user->user_lastname . '!';
				}
				?>
			</p>
		</div>

		<?php astra_header_after(); ?>

		<script>
			// setTimeout(hideLoader, 1000);

			jQuery(window).on('load', function() {
				var container = document.getElementsByClassName("loading-process");
				for (var i = 0; i < container.length; i++) {
					jQuery('#loader').addClass('hidden');
					container[i].style.display = 'block';
				}
			});
		</script>

		<?php astra_content_before(); ?>

		<div id="loader" class="lds-dual-ring overlay"></div>

		<div id="content" class="site-content loading-process" style="display:none;">

			<div class="ast-container">

				<?php astra_content_top(); ?>