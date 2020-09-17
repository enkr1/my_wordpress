<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BlogZ
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'adjacent' ); ?>>
	<div class="article__inner">
		<div class="inner__content">
			<?php
			blogz_print_single_category();
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

		</div>

		<div class="entry-footer d-flex flex-wrap justify-content-between">
			<div class="entry-meta">
				<?php
				blogz_posted_on();
				blogz_print_comment_link();
				?>
			</div><!-- .entry-meta -->
			<?php
			echo wp_kses_post( blogz_more_link() );
			?>
		</div>

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
