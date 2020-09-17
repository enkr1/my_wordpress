<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aspro
 */

$post_class = array('at-card');

?>
<article data-aos="fade-up" data-aos-duration="2000" data-aos-delay="50" id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
    <?php if( has_post_thumbnail() ) : ?>
    <div class="at-card__image" title="<?php echo esc_attr(get_the_title()); ?>">
        <?php aspro_post_thumbnail(); ?>
    </div>
    <?php endif; ?>
    <div class="at-card__header entry-header">
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title"><a class="transition" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;

        if ( 'post' === get_post_type() ) :
            ?>
            <div class="entry-meta">
                <?php
                aspro_posted_by();
                aspro_posted_on();
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </div><!-- .entry-header -->
</article><!-- #post-<?php the_ID(); ?> -->
