<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package BlogZ
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function blogz_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'blogz_pingback_header' );

/**
 * Customize default comment form
 *
 * @param array $fields Comment form fields.
 */
function blogz_modify_comment_form_default( $fields ) {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$html_req  = ( $req ? " required='required'" : '' );
	$html5     = 'html5' === current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$fields['author'] = '<div class="col-md-6"><p class="comment-form-author">' .
				'<input id="author" name="author" placeholder="' . esc_attr__( 'Full Name *', 'blogz' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>';
	$fields['email']  = '<p class="comment-form-email">' .
				'<input id="email" placeholder="' . esc_attr__( 'Mail Address *', 'blogz' ) . '" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req . ' /></p>';
	$fields['url']    = '<p class="comment-form-url">' .
				'<input id="url" placeholder="' . esc_attr__( 'Website URL', 'blogz' ) . '" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></p></div></div>';
	return $fields;
}
add_filter( 'comment_form_default_fields', 'blogz_modify_comment_form_default' );

/**
 * Modify default comment form args.
 *
 * @param array $defaults default args.
 */
function blogz_modify_comment_form_args( $defaults ) {
	$defaults['label_submit']         = esc_html__( 'Submit', 'blogz' );
	$submit_button                    = sprintf(
		$defaults['submit_button'],
		esc_attr( $defaults['name_submit'] ),
		esc_attr( $defaults['id_submit'] ),
		esc_attr( $defaults['class_submit'] ),
		esc_attr( $defaults['label_submit'] )
	);
	$submit_field                     = sprintf(
		$defaults['submit_field'],
		$submit_button,
		get_comment_id_fields( get_the_ID() )
	);
	$class                            = is_user_logged_in() ? 'col-md-12' : 'col-md-6';
	$defaults['submit_field']         = '';
	$defaults['comment_field']        = '<div class="row"><div class="' . esc_attr( $class ) . ' comment-form-comment"><textarea id="comment" placeholder="' . esc_attr__( 'Write Your Comments Here...', 'blogz' ) . '" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea>' . $submit_field . '</div>';
	$defaults['comment_notes_before'] = '';
	return $defaults;
}
add_filter( 'comment_form_defaults', 'blogz_modify_comment_form_args' );

/**
 * Change the tag could args
 *
 * @param array $args Widget parameters.
 *
 * @return mixed
 */
function blogz_tag_cloud_args( $args ) {
	$args['largest']  = 1; // Largest tag.
	$args['smallest'] = 1; // Smallest tag.
	$args['unit']     = 'em'; // Tag font unit.

	return $args;
}

add_filter( 'widget_tag_cloud_args', 'blogz_tag_cloud_args' );

/**
 * Additional class to post.
 *
 * @param array $classes Post class.
 */
function blogz_post_class( $classes ) {
	$wrapper = has_post_thumbnail();
	if ( ! $wrapper ) {
		$classes[] = 'blogz-no-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'blogz_post_class' );

/**
 * Change output of adjacent post links.
 *
 * @param  string  $output        The adjacent post link.
 * @param  string  $format        Link anchor format.
 * @param  string  $link          Link permalink format.
 * @param  WP_Post $adjacent_post The adjacent post.
 *
 * @return string
 */
function blogz_adjacent_post_link( $output, $format, $link, $adjacent_post ) {
	if ( empty( $adjacent_post ) ) {
		return $output;
	}

	// Using global $post for setup_postdata() to make template tags work.
	global $post;
	$post = $adjacent_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	setup_postdata( $post );

	ob_start();
	get_template_part( 'template-parts/content', 'adjacent' );
	wp_reset_postdata();

	return ob_get_clean();
}

add_filter( 'previous_post_link', 'blogz_adjacent_post_link', 10, 4 );
add_filter( 'next_post_link', 'blogz_adjacent_post_link', 10, 4 );
