<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BlogZ
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="article__inner">
		<div class="inner__content">
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</div>

		<div class="link-more">
			<?php echo wp_kses_post( blogz_more_link() ); ?>
		</div>

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
