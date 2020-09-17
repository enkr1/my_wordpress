<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aspro
 */


get_header();
?>
    <div class="at-body">
        <div class="at-container">

            <div class="at-content">
                <div class="at-content__block">
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
                                    get_template_part( 'template-parts/content' );

                                endwhile;

                            else :

                                get_template_part( 'template-parts/content', 'none' );

                            endif;
                            ?>

                        </main><!-- #main -->

                        <?php get_template_part('template-parts/pagination/pagination', 'normal'); ?>

                    </div><!-- #primary -->
                </div>
                <div class="at-content__sidebar">
                    <?php get_sidebar(); ?><!-- #sidebar -->
                </div>
            </div>
        </div>
    </div>

<?php

get_footer();