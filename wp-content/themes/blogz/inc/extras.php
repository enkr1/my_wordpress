<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package BlogZ
 */

/**
 * Handle Retina Logo.
 *
 * @param array  $attr Image.
 * @param object $attachment Image obj.
 * @param sting  $size Size name.
 *
 * @return array Image attr.
 */
function blogz_retina_logo( $attr, $attachment, $size ) {
	$custom_logo = get_theme_mod( 'custom_logo' );
	if ( $custom_logo !== $attachment->ID ) {
		return $attr;
	}
	$retina_logo = get_theme_mod( 'blogz_retina_logo' );
	if ( empty( $retina_logo ) ) {
		return $attr;
	}
	$custom_logo     = wp_get_attachment_image_src( $custom_logo, 'full' );
	$custom_logo_url = $custom_logo[0];

	$attr['srcset'] = $custom_logo_url . ' 1x, ' . $retina_logo . ' 2x';
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'blogz_retina_logo', 10, 3 );

/**
 * Check if current post is the last post.
 */
function blogz_is_last_post() {
	global $wp_query;
	return ( $wp_query->current_post + 1 ) === ( $wp_query->post_count );
}

/**
 * Change the more text
 *
 * @param string $more more text.
 */
function blogz_excerpt_more( $more ) {
	if ( is_admin() ) {
		return;
	}
	return sprintf( '<span class="more-link">%s</span>', '&hellip;' );
}
add_filter( 'excerpt_more', 'blogz_excerpt_more' );

/**
 * More link
 */
function blogz_more_link() {
	$read_more_text = get_theme_mod( 'read_more_text', __( 'Read Ahead', 'blogz' ) );
	$text           = wp_kses_post(
		sprintf(
			/* translators: 1 read more text, 2 the title, 3 the icon */
			'%s %s %s',
			'<span class="read-more-text">' . $read_more_text . '</span>',
			'<span class="screen-reader-text">' . get_the_title() . '</span>',
			'<i class="icofont-long-arrow-right"></i>'
		)
	);

	$more = sprintf( '<span class="more-link"><a href="%s">%s</a></span>', esc_url( get_permalink() ), $text );
	return $more;
}

/**
 * Check if post has format image.
 *
 * @param int $post_id post id.
 */
function blogz_post_has_format_image( $post_id ) {
	return 'image' === get_post_format( $post_id );
}

/**
 * Get the map from the page/post content.
 *
 * @package blogz
 */
function blogz_get_iframe() {
	$main_content = apply_filters( 'the_content', get_the_content() );
	$media        = get_media_embedded_in_content( $main_content, array( 'iframe' ) );
	if ( $media ) {
		echo reset( $media ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
