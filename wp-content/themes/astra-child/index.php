<?php

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if (astra_page_layout() == 'left-sidebar') : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<div class="home home-main-content">
	<div class="home-main-text">
		<h1>Customized WordPress Site</h1>
		<p>Customized by Jing Hui</p>
	</div>
</div>

<br>

<div id="primary main-body" <?php astra_primary_class(); ?>>

	<div class="primary-content-title">
		<h1>Recent Posts</h1>
	</div>

	<?php astra_primary_content_top(); ?>

	<?php astra_content_loop(); ?>

	<?php astra_pagination(); ?>

	<?php astra_primary_content_bottom(); ?>

</div><!-- #primary -->

<?php if (astra_page_layout() == 'right-sidebar') : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>