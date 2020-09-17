<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aspro
 */

get_header();
?>
    <div class="at-body">
        <div class="at-container">
            <div class="at-page-title">
                <h1 class="mt-0">
                    <?php
                    the_archive_title( '<h1 class="page-title mt-0">', '</h1>' );
                    the_archive_description( '<div class="archive-description">', '</div>' );
                    ?>
                </h1>
            </div>
            <div class="at-content">
                <div class="at-content__primary">
                    <div id="primary" class="content-area at-content-area">
                        <main id="main" class="site-main">

                            <?php if ( have_posts() ) : ?>
                                <?php
                                /* Start the Loop */
                                while ( have_posts() ) :
                                    the_post();

                                    /*
                                     * Include the Post-Type-specific template for the content.
                                     * If you want to override this in a child theme, then include a file
                                     * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                                     */
                                    get_template_part( 'template-parts/content-archive', get_post_type() );

                                endwhile;

                            else :

                                get_template_part( 'template-parts/content', 'none' );

                            endif;
                            ?>

                        </main><!-- #main -->

                        <?php get_template_part('template-parts/pagination/pagination', 'normal'); ?>

                    </div><!-- #primary -->
                </div>
                <div class="at-content__secondary">
                    <?php get_sidebar(); ?><!-- #sidebar -->
                </div>
            </div>
        </div>
    </div>

<?php

get_footer();
