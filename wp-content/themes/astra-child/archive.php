<?php

/**
 * The template for displaying archive pages.
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

<div id="primary" <?php astra_primary_class(); ?>>

	<?php astra_primary_content_top(); ?>

	<?php astra_archive_header(); ?>

	<?php astra_content_loop(); ?>

	<?php astra_pagination(); ?>

	<?php astra_primary_content_bottom(); ?>

</div><!-- #primary -->

<div class="blog-sidebar" id="blog-sidebar">
	<div class="blog-sidebar-hider" id="blog-sidebar-hider">
		<p>Hide Sidebar</p>
	</div>
	<?php dynamic_sidebar('blog-sidebar'); ?>
</div>

<div class="blog-sidebar-opener" id="blog-sidebar-opener">Open Sidebar</div>



<?php if (astra_page_layout() == 'right-sidebar') : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>