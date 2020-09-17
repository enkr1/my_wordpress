<?php
/**
 * Template for grid layout.
 *
 * @package BlogZ.
 */

$count              = 1; // counter to display ads.
$format_image_count = 1; // counter to display posts in group that has at least one image format post.
$ads_pos            = get_theme_mod( 'ads_pos', 4 );
/* Start the Loop */
while ( have_posts() ) :
	the_post();
	// Check if standard post and the previous post is not format image ($format_image_count is odd).
	if ( ! has_post_format( 'image' ) && 1 === $format_image_count % 2 ) {
		get_template_part( 'template-parts/content', get_post_format() );
	}
	// Check if post has format image but is the last post.
	else if ( 1 === $format_image_count % 2 && blogz_is_last_post() ) {
		get_template_part( 'template-parts/content', get_post_format() );
	} else {
		if ( 1 === $format_image_count % 2 ) {
			// if ads is between the two post in image format group, change the position of ads.
			if ( $count === $ads_pos ) {
				$ads_pos++;
			}
			echo '<div class="vertical-blocks__group">';
		}
			get_template_part( 'template-parts/content', 'image' );
		if ( 0 === $format_image_count % 2 ) {
			echo '</div>';
		}
		$format_image_count++;
	}
	$enable_ads = apply_filters( 'blogz_ads_addons', false );
	if ( $enable_ads ) {
		if ( $count === $ads_pos ) {
			blogz_print_ads();
		}
	}
	$count++;
endwhile;
