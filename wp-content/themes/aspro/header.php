<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aspro
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body id="at-body" <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}
?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'aspro'); ?></a>

        <?php the_custom_header_markup(); ?>


        <header id="masthead" class="site-header at-header <?php echo empty( get_custom_header_markup() )  ?'':'custom-header'; ?>">
            <div class="at-container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-7">
                        <div class="d-flex align-items-center">
                            <div class="site-logo">
                                <?php the_custom_logo(); ?>
                            </div>
                            <div class="site-branding">
                                <?php if (is_front_page() && is_home()) :?>
                                <h1 class="site-title m-0"><a
                                        href="<?php echo esc_url(home_url('/')); ?>"
                                        rel="home"><?php bloginfo('name'); ?></a>
                                </h1>
                                <?php
                                else :
                                    ?>
                                <h1 class="site-title m-0"><a
                                        href="<?php echo esc_url(home_url('/')); ?>"
                                        rel="home"><?php bloginfo('name'); ?></a>
                                </h1>
                                <?php
                                endif;
                                $aspro_description = get_bloginfo('description', 'display');
                                if ($aspro_description || is_customize_preview()) :
                                    ?>
                                <p class="site-description m-0"><?php echo $aspro_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                </p>
                                <?php endif; ?>
                            </div><!-- .site-branding -->
                        </div>
                    </div>
                    <div class="col-lg-9 col-5">
                        <div class="d-flex align-items-center justify-content-end">

                            <div id="main-nav" class="at-nav d-none d-lg-block">
                                <nav id="site-navigation" class="main-navigation w-100">
                                    <?php
                                        wp_nav_menu([
                                            'theme_location' => 'menu-1',
                                            'menu_id' => 'primary-menu',
                                        ]);
                                    ?>
                                </nav><!-- #site-navigation -->
                            </div>

                            <?php get_template_part('template-parts/search/search', 'popup'); ?>

                            <?php get_template_part('template-parts/menu/menu', 'mobile'); ?>

                        </div>
                    </div>
                </div>
            </div>
        </header><!-- #masthead -->

        <div id="content" class="site-content">