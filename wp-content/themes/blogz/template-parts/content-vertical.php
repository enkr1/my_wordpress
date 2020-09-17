<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BlogZ
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'vertical-post' ); ?>>
	<div class="entry-thumbnail">
		<?php
		blogz_post_thumbnail( 'blogz-layout-2' );
		blogz_print_single_category();
		?>
	</div>

	<div class="entry-meta">
		<?php
		blogz_posted_by( 'icon' );
		blogz_posted_on();
		blogz_print_comment_link();
		?>
	</div><!-- .entry-meta -->

	<?php
	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	?>

	<div class="entry-content">
		<?php
		the_excerpt();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blogz' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
	<div class="entry-footer d-flex flex-wrap justify-content-between">
		<?php
		if ( function_exists( 'sharing_display' ) ) {
			sharing_display( '', true );
		}
		echo wp_kses_post( blogz_more_link() );
		?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
