<?php
/**
 * Display Featured Section.
 *
 * @package BlogZ
 */

if ( ! defined( 'JETPACK__VERSION' ) ) {
	return;
}

$featured_posts = blogz_get_featured_posts();
if ( empty( $featured_posts ) ) {
	return;
}

?>
<div class="hero__featured-posts d-none container">
	<?php
	// Using global $post for setup_postdata() to make template tags work.
	foreach ( $featured_posts as $post ) : setup_postdata( $post ) // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	?>
		<article <?php post_class( 'featured__post d-flex' ); ?>>
			<a href="<?php the_permalink(); ?>" class="post__image">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'blogz-small' );
				} else {
					echo wp_kses_post( blogz_get_default_image() );
				}
				?>
			</a>
			<div class="post__text">
				<div class="entry-meta">
					<?php
					blogz_posted_on();
					blogz_posted_by( 'text' );
					?>
				</div>
				<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
			</div>
		</article>
	<?php endforeach; wp_reset_postdata(); ?>
</div>
