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

<div class="home home-main-content">
	<div class="home-main-text">
		<h1>Customized WordPress Site</h1>
		<p>Customized by Jing Hui</p>
	</div>
</div>

<!-- https://wpbeaches.com/displaying-featured-products-woocommerce/ -->
<?php
$args = array(
	'posts_per_page' => 3, // -1 means loop with an infinite amount
	'post_type'      => 'product',
	'post_status'    => 'publish',
	'orderby'     =>  'date',
	'order'       =>  'DESC',
	'tax_query'      => array(
		array(
			'taxonomy' => 'product_visibility',
			'field'    => 'name',
			'terms'    => 'featured',
			'operator' => 'IN',
		),
	)
);
$featured_product = new WP_Query($args);

// Get the number of the featured products
$noOfFP = 0;
while ($featured_product->have_posts()) : $featured_product->the_post();
	$noOfFP++;
endwhile;

if ($featured_product->have_posts()) :

	echo '<div class="featured-products-page">
	<h1>Featured Products</h1>
	<div class="woocommerce columns-' . $noOfFP . ' featured-products-container"><ul class="products featured-products">';

	while ($featured_product->have_posts()) : $featured_product->the_post();

		$post_thumbnail_id     = get_post_thumbnail_id();
		$product_thumbnail     = wp_get_attachment_image_src($post_thumbnail_id, $size = 'shop-feature');
		$product_thumbnail_alt = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);
?>
		<li class="product featured-product">
			<a href="<?php the_permalink(); ?>">
				<img class="featured-product-img" src="<?php echo $product_thumbnail[0]; ?>" alt="<?php echo $product_thumbnail_alt; ?>">
			</a>
			<a href="<?php the_permalink(); ?>">
				<button class="featured-product-btn">VIEW PRODUCT</button>
			</a>
			<h3 class="woocommerce-loop-product__title"><?php the_title(); ?></h3>
		</li>
<?php
	endwhile;

	echo '</ul></div></div>';
endif;

wp_reset_query();
?>
<!-- Featured products loop -->

<div id="primary main-body" <?php astra_primary_class(); ?>>

	<div class="primary-content-title">
		<h1>Recent Posts</h1>
	</div>

	<?php astra_primary_content_top(); ?>

	<?php astra_content_loop(); ?>

	<!-- removed pagination, can get it from astra_pagination(); -->

	<?php astra_primary_content_bottom(); ?>

</div><!-- #primary -->


<?php get_footer(); ?>