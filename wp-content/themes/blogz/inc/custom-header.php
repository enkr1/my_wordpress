<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package BlogZ
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses blogz_header_style()
 */
function blogz_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'blogz_custom_header_args',
			array(
				'default-image'      => get_template_directory_uri() . '/images/header.jpg',
				'default-text-color' => '',
				'width'              => 1920,
				'height'             => 500,
				'flex-height'        => true,
				'flex-width'         => true,
				'wp-head-callback'   => 'blogz_header_style',
			)
		)
	);
	register_default_headers(
		array(
			'mountain' => array(
				'url'           => '%s/images/header.jpg',
				'thumbnail_url' => '%s/images/header.jpg',
				'description'   => esc_html__( 'Mountain', 'blogz' ),
			),
		)
	);
}
add_action( 'after_setup_theme', 'blogz_custom_header_setup' );

if ( ! function_exists( 'blogz_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see blogz_custom_header_setup().
	 */
	function blogz_header_style() {
		?>
		<style id="blogz-header-css">
			<?php if ( has_header_image() ) : ?>
				.page-header {
					background-image: url(<?php echo esc_url( get_header_image() ); ?>);
				}
			<?php endif; ?>
			<?php if ( ! display_header_text() ) : ?>
				.site-title, .site-description {
					clip: rect(1px, 1px, 1px, 1px);
					position: absolute;
				}
			<?php elseif ( get_header_textcolor() ) : ?>
				.page-header,
				.page-header h1,
				.page-header i,
				.breadcrumbs a,
				.breadcrumbs span {
					color: #<?php echo esc_attr( get_header_textcolor() ); ?>;
				}
			<?php endif; ?>
		</style>
		<?php
	}
endif;

/**
 * Use featured image for the header image on single post.
 *
 * @param string $image Header image URL.
 *
 * @return string
 */
function blogz_header_image_singular( $image ) {
	if ( ! is_singular() || ! has_post_thumbnail() ) {
		return $image;
	}

	$thumbnail = wp_get_attachment_image_url( get_post_thumbnail_id(), 'full' );
	if ( $thumbnail ) {
		$image = $thumbnail;
	}

	return $image;
}

/**
 * Replace default header image with featured image of single post if set.
 */
function blogz_filter_header_image_singular() {
	add_filter( 'theme_mod_header_image', 'blogz_header_image_singular' );
}

add_action( 'template_redirect', 'blogz_filter_header_image_singular' );
