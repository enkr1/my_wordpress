<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package BlogZ
 */

if ( ! function_exists( 'blogz_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function blogz_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="updated screen-reader-text" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date( 'd M Y' ) ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date( 'd M Y' ) )
		);

		echo '<span class="posted-on"><i class="icofont-clock-time"></i>' . wp_kses_post( $time_string ) . '</span>';

	}
endif;

if ( ! function_exists( 'blogz_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 *
	 * @param string $prefix Prefix before author name.
	 */
	function blogz_posted_by( $prefix = '' ) {
		if ( 'text' === $prefix ) {
			$prefix = esc_html__( 'By ', 'blogz' );
		} elseif ( 'icon' === $prefix ) {
			$prefix = '<i class="icofont-user-alt-3"></i>';
		}
		$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . $prefix . esc_html( get_the_author() ) . '</a></span>';

		echo '<span class="byline"> ' . wp_kses_post( $byline ) . '</span>';

	}
endif;

if ( ! function_exists( 'blogz_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function blogz_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list();
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">%1$s</span>', wp_kses_post( $tags_list ) );
			}
		}

		if ( function_exists( 'sharing_display' ) ) {
			sharing_display( '', true );
		}

		blogz_edit_link();
	}
endif;


/**
 * Edit Link.
 */
function blogz_edit_link() {
	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'blogz' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}

if ( ! function_exists( 'blogz_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @param string $size thumbnail size.
	 */
	function blogz_post_thumbnail( $size = 'post-thumbnail' ) {
		if ( is_attachment() ) {
			return;
		}

		if ( is_singular() && ! is_front_page() ) : ?>

			<div class="post-thumbnail">
				<?php blogz_get_post_thumbnail( $size ); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php blogz_get_post_thumbnail( $size ); ?>
			</a>

		<?php
		endif; // End is_singular().
	}
endif;

/**
 * Get the post thumbnail image.
 *
 * @param string $size image size.
 */
function blogz_get_post_thumbnail( $size ) {
	if ( has_post_thumbnail() ) {
		the_post_thumbnail( $size );
	} else {
		blogz_get_default_image( true );
	}
}

/**
 * Get single category
 *
 * @param boolean $has_background background or not.
 */
function blogz_print_single_category( $has_background = true ) {
	$categories = get_the_category();
	// Page has no categories (search result).
	if ( empty( $categories ) ) {
		return;
	}
	$link       = get_category_link( $categories[0]->term_id );
	$name       = $categories[0]->name;
	$color      = get_theme_mod( 'category_color' );
	$html       = '';
	$background = '';
	if ( ! empty( $color ) && $has_background ) {
		$background = 'style="background-color:' . esc_attr( $color ) . '"';
	}
	printf(
		'<span class="cat-links" %s>
			<a href="%s">%s</a>
		</span>',
		wp_kses_post( $background ),
		esc_url( $link ),
		esc_html( $name )
	);
}

/**
 * Prints HTML with meta information for the comment number.
 */
function blogz_print_comment_link() {
	$comment_number = get_comments_number();
	$text           = esc_html( _nx( 'Comment: ', 'Comments: ', $comment_number, 'comments', 'blogz' ) );
	if ( in_the_loop() && ! is_single() && ! $comment_number ) {
		return;
	}
	if ( ! post_password_required() && ( comments_open() || $comment_number ) ) {
		?>
		<span class="comments-link">
			<a href="<?php comments_link(); ?>">
				<i class="icofont-speech-comments"></i>
				<?php
				if ( is_single() ) {
					echo esc_html( $text );
				}
				echo esc_html( $comment_number );
				?>
			</a>
		</span>
		<?php
	}
}

/**
 * Socials author bio.
 *
 * @param string $id user id.
 */
function blogz_user_social_links( $id ) {
	$socials = array( 'facebook', 'twitter', 'google-plus', 'dribbble', 'instagram', 'youtube', 'pinterest' );
	$output  = '';

	foreach ( $socials as $social ) {
		$social_value = get_the_author_meta( $social, $id );

		if ( 'twitter' === $social ) {
			$social_value = 'https://twitter.com/' . get_the_author_meta( 'twitter', $id );
		}

		if ( empty( $social_value ) ) {
			continue;
		}

		$output .= sprintf(
			'<li><a class="social-links" href="%s"><i class="icofont-%s"></i></a></li>',
			esc_url( $social_value ),
			esc_html( $social )
		);
	}

	if ( empty( $output ) ) {
		return '';
	}

	echo '<ul class="author-social">' . wp_kses_post( $output ) . '</ul>';
}

/**
 * Author Box.
 */
function blogz_author_box() {
	$author_id      = get_the_author_meta( 'ID' );
	$author_website = get_the_author_meta( 'user_url', $author_id );
	if ( ! empty( $author_website ) ) {
		$author_website_link = sprintf(
			'<a class="button" href="%s">%s</a>',
			esc_url( $author_website ),
			esc_html__( 'Visit Website', 'blogz' )
		);
	}
	?>
	<div class="entry-author">
		<div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 85 ); ?>
		</div><!-- .author-avatar -->
		<div class="author-info">
			<div class="author-heading">
				<div class="author-name">
					<?php
					echo wp_kses_post( '<span class="author-name">' . get_the_author() . '</span>' );
					?>
				</div>
				<div class="author-twitter">
					<?php
					$twitter = get_the_author_meta( 'twitter' );
					if ( $twitter ) {
						/* translators: author twitter name. */
						printf( wp_kses_post( '<a href="https://twitter.com/%s">@%s</a>', 'blogz' ), esc_html( $twitter ), esc_html( get_the_author_meta( 'twitter' ) ) );
					}
					?>
				</div>

				<?php if ( ! empty( $author_website_link ) ) : ?>
					<div class="author-website">
						<?php echo wp_kses_post( $author_website_link ); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="author-bio">
				<?php the_author_meta( 'description' ); ?>
			</div><!-- .author-bio -->
			<?php blogz_user_social_links( $author_id ); ?>
		</div><!-- .author-info -->
	</div><!-- .entry-author -->
	<?php
}

/**
 * Author Box Aboaut
 */
function blogz_author_box_about() {
	$author_id      = get_the_author_meta( 'ID' );
	$author_website = get_the_author_meta( 'user_url', $author_id );
	if ( ! empty( $author_website ) ) {
		$author_website_link = sprintf(
			'<a class="button" href="%s">%s</a>',
			esc_url( $author_website ),
			esc_html__( 'Visit Website', 'blogz' )
		);
	}
	?>
	<div class="entry-author">
		<div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 85 ); ?>
		</div><!-- .author-avatar -->
		<div class="author-info">
			<div class="author-heading">
				<div class="author-name">
					<?php
					echo wp_kses_post( '<span class="author-name">' . get_the_author() . '</span>' );
					?>
				</div>
				<div class="author-bio">
					<?php the_author_meta( 'description' ); ?>
				</div><!-- .author-bio -->

				<?php if ( ! empty( $author_website_link ) ) : ?>
					<div class="author-website">
						<?php echo wp_kses_post( $author_website_link ); ?>
					</div>
				<?php endif; ?>
			</div>

			<?php 
				if ( is_single() ) {
					blogz_user_social_links( $author_id );
				}
			?>
		</div><!-- .author-info -->
	</div><!-- .entry-author -->
	<?php
}

/**
 * Get default images
 *
 * @param bool $echo Echo the result or not.
 */
function blogz_get_default_image( $echo = false ) {
	$image_default = '<img class="default-img" src="' . get_template_directory_uri() . '/images/default.jpg" alt="default">';
	if ( $echo ) {
		echo wp_kses_post( $image_default );
		return;
	}
	return $image_default;
}

/**
 *
 * Get image alt from image url
 *
 * @param string $url image url.
 */
function blogz_get_image_alt( $url ) {
	$image_id = attachment_url_to_postid( $url );
	return ( ! empty( $image_id ) ) ? get_post_meta( $image_id, '_wp_attachment_image_alt', true ) : '';
}
