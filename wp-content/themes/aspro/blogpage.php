<?php
/**
 * The blog page template file
 *
 * Template Name: Blog Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aspro
 */

get_header();

if( is_active_sidebar( 'aspro_blog_page_sidebar' ) ) :
    dynamic_sidebar( 'aspro_blog_page_sidebar' );
endif;

?>

<div class="at-body">
    <div class="at-container">
        <div class="row">
            <div id="primary" class="content-area w-100">
                <main id="main" class="site-main">
                    <div class="at-card--block">
                        <?php

                        query_posts(array(
                            'post_status' => 'publish',
                            'post_type' =>  'post',
                            'paged' => (get_query_var('page')) ? absint(get_query_var('page')) : 1,
                            'posts_per_page' => get_option('posts_per_page'),
                        ));

                        if (have_posts()) :

                            if (is_home() && !is_front_page()) :
                                ?>
                                <header>
                                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?>
                                    </h1>
                                </header>
                            <?php
                            endif;

                            /* Start the Loop */
                            while (have_posts()) :
                                the_post();

                                get_template_part('template-parts/card/content', get_post_type());

                            endwhile;

                        else :

                            get_template_part('template-parts/content', 'none');

                        endif;
                        ?>
                    </div>
                </main><!-- #main -->
                <div class="at-pagination--home">
                    <?php get_template_part('template-parts/pagination/pagination', 'normal'); ?>
                </div>
            </div><!-- #primary -->
        </div>
    </div>
</div>
<?php

get_footer();
