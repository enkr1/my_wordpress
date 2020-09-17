<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
                        esc_html_e( 'Page not Found!', 'aspro' );
                    ?>
                </h1>
            </div>
            <div class="at-content at-content--search">
                <div class="at-content__primary">
                    <div id="primary" class="content-area at-content-area">
                        <main id="main" class="site-main">
                            <section class="error-404 not-found">
                                <h1><?php esc_html_e( '404', 'aspro' ); ?></h1>
                                <h4><?php esc_html_e( "Oops! That page can't be found.", 'aspro' ); ?></h4>
                                <div class="page-content">
                                    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'aspro' ); ?></p>

                                    <?php
                                    get_search_form();
                                    ?>
                                </div><!-- .page-content -->
                            </section><!-- .error-404 -->
                        </main><!-- #main -->
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
