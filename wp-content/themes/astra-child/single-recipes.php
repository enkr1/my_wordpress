<?php

/**
 * The template for displaying "Single Recipe" posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header(); ?>


<!-- https://wpbeaches.com/displaying-featured-products-woocommerce/ -->
<?php
$args = array(
	'posts_per_page' => 1, // -1 means loop with an infinite amount
	'post_type'      => 'recipes',
	'post_status'    => 'publish',
);
$single_recipe = new WP_Query($args);

$post_thumbnail_id     = get_post_thumbnail_id();
$product_thumbnail     = wp_get_attachment_image_src($post_thumbnail_id, $size = 'single-recipe-image');
$product_thumbnail_alt = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);
?>

<div class="template-single-recipe">
	<?php
	if ($product_thumbnail[0] != null) {
	?>
		<img src="<?php echo $product_thumbnail[0]; ?>" alt="<?php echo $product_thumbnail_alt; ?>">
	<?php
	} else {
	?>
		<img src="/wp-content/uploads/woocommerce-placeholder.png" alt="No Image Shown">
	<?php
	}
	?>

	<div class="template-single-recipe-description">
		<!-- here  -->
		<h2><?php the_title(); ?></h2>
		<p><?php the_content(); ?></p>
		
		<p>Posted by <?php the_author(); ?> <?php echo get_the_date(); ?></p>
	</div>

	<?php
	wp_reset_query();
	?>
	<!-- Featured products loop -->

	<?php get_footer(); ?>