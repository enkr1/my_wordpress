<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aspro
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header text-center">
		<?php
        if (is_singular()) :
            the_title('<h1 class="entry-title mt-0">', '</h1>');
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;

        if ('post' === get_post_type()) :
            ?>
		<div class="entry-meta">
			<?php
                aspro_posted_by();
                aspro_posted_on();
                aspro_entry_footer();
                ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="at-post__thumbnail">
            <?php aspro_post_thumbnail(); ?>
        </div>
    <?php endif; ?>


    <div class="at-content">
        <div class="at-content__primary">
            <div class="entry-content mt-0">
                <?php
                the_content(sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'aspro'),
                        [
                            'span' => [
                                'class' => [],
                            ],
                        ]
                    ),
                    get_the_title()
                ));

                /* translators: used between list items, there is a space after the comma */
                $tags_list = get_the_tag_list();
                if ($tags_list) {
                    /* translators: 1: list of tags. */
                    printf('<span class="tags-links">' . esc_html__('Tagged : %1$s', 'aspro') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                }

                wp_link_pages([
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'aspro'),
                    'after' => '</div>',
                ]);
                ?>

            </div><!-- .entry-content -->
        </div>

        <div class="at-content__secondary">
            <?php get_sidebar(); ?>
        </div>
    </div>

</article><!-- #post-<?php the_ID(); ?> -->