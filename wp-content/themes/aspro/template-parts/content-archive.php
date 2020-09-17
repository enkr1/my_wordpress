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
    <header class="entry-header">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title"><span>', '</span></h1>');
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


    <div class="entry-summary">
        <?php
        the_excerpt();

        wp_link_pages([
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'aspro'),
            'after' => '</div>',
        ]);
        ?>

    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->