<?php
/**
 * Template for grid layout.
 *
 * @package BlogZ.
 */

global $wp_query;
$post_ids      = wp_list_pluck( $wp_query->posts, 'ID' );
$current_index = 0;
$count         = 1;
$ads_pos       = get_theme_mod( 'ads_pos', 4 );

echo '<div class="vertical-blocks">';
while ( have_posts() ) :
	the_post();
	// Group 2 article into one group for adding divider between groups.
	if ( 1 === $count % 2 ) {
		echo '<div class="vertical-blocks__group">';
	}

	if ( has_post_format( 'quote' ) ) {
		get_template_part( 'template-parts/content-quote' );
		// Early close to display full width blockquote.
		if ( 1 === $count % 2 ) {
			echo '</div>';
			$current_index++;
			continue;
		}
	} else if (
		has_post_format( 'image' )
		// post is the first post in group and the next post has image format.
		|| ( 1 === $count % 2 && isset( $post_ids[ $current_index + 1 ] ) && blogz_post_has_format_image( $post_ids[ $current_index + 1 ] ) )
		// post is the last post in group and the previous post has image format.
		|| ( 0 === $count % 2 && blogz_post_has_format_image( $post_ids[ $current_index - 1 ] ) )
	) {
		get_template_part( 'template-parts/content-image' );
	} else {
		get_template_part( 'template-parts/content-vertical' );
	}

	// Close group.
	if ( 0 === $count % 2 ) {
		echo '</div>';
	}
	$enable_ads = apply_filters( 'blogz_ads_addons', false );
	if ( $enable_ads ) {
		if ( $count === $ads_pos ) {
			blogz_print_ads();
		}
	}
	$count++;
	$current_index++;
endwhile;
echo '</div>';
