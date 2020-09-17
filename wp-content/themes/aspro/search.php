<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
                    /* translators: %s: search query. */
                    printf( esc_html__( 'Search Results for: %s', 'aspro' ), '<span>' . get_search_query() . '</span>' );
                    ?>
                </h1>
            </div>
            <div class="at-content at-content--search">
                <div class="at-content__primary">
                    <div id="primary" class="content-area at-content-area">
                        <main id="main" class="site-main">

                            <?php if ( have_posts() ) : ?>
                                <?php
                                /* Start the Loop */
                                while ( have_posts() ) :
                                    the_post();

                                    /**
                                     * Run the loop for the search to output the results.
                                     * If you want to overload this in a child theme then include a file
                                     * called content-search.php and that will be used instead.
                                     */
                                    get_template_part( 'template-parts/content', 'search' );

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
