<?php
/**
 * Theme info page
 *
 * @package aspro
 */

add_action('admin_menu', 'aspro_info');
function aspro_info() {

    if ( !current_user_can('edit_theme_options') ) {
        return;
    }
    add_theme_page(
        esc_html__('Aspro Info', 'aspro'),
        esc_html__('Aspro Info', 'aspro'),
        'manage_options',
        'aspro-info.php',
        'aspro_info_page'
    );
}

function aspro_info_page() {

    $aspro_author_uri = ASPRO_AUTHOR_URI;
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Aspro Info', 'aspro' ); ?></h1>
        <div class="welcome-panel">
            <div class="welcome-panel-content">
                <h2><?php esc_html_e( 'Welcome to Aspro!', 'aspro' ); ?></h2>
                <span><?php
                    /* translators: %s: Theme version. */
                    echo sprintf( esc_html__( 'Version: %s', 'aspro' ), wp_get_theme( 'aspro' )->get('Version') ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    ?></span>
                <p class="theme-author"><?php esc_html_e( 'By', 'aspro' ); ?> <a target="_blank" href="<?php echo esc_url($aspro_author_uri); ?>"><?php esc_html_e( '99colorthemes', 'aspro' ); ?></a></p>
                <p class="theme-description"><?php esc_html_e( 'Aspro is a clean, minimal and beautifully layout design WordPress theme.
                    It is a modern blog focused on high speed and nice effects, the theme fits perfectly any kind of blog like
                    personal, travel, photography, food or biography blogs. It is SEO friendly with featured image supports and
                    custom colors. Theme customizer can be used to change color, upload logo and other theme settings. Also it
                    looks great on mobile devices due to responsive and mobile-friendly design.', 'aspro' ); ?></p>
                <p class="about-description"><?php esc_html_e( 'Important links to get you started with Aspro.', 'aspro' ); ?></p>
                <div class="welcome-panel-column-container">
                    <div class="welcome-panel-column">
                        <h3><?php esc_html_e( 'Get Started', 'aspro' ); ?></h3>
                        <a href="<?php echo esc_url($aspro_author_uri); ?>/docs/aspro/" class="button button-primary button-hero" target="_blank"><?php esc_html_e( 'Learn Basics', 'aspro' ); ?></a>
                    </div>
                    <div class="welcome-panel-column">
                        <h3><?php esc_html_e( 'Next Steps', 'aspro' ); ?></h3>
                        <ul>
                            <li><a target="_blank" href="<?php echo esc_url($aspro_author_uri); ?>/demo/aspro/" class="welcome-icon dashicons-layout"><?php esc_html_e( 'Beautiful Demos', 'aspro' ); ?></a></li>
                            <li><a target="_blank" href="<?php echo esc_url($aspro_author_uri); ?>/themes/aspro/" class="welcome-icon dashicons-migrate"><?php esc_html_e( 'Premium Version', 'aspro' ); ?></a></li>
                            <li><a target="_blank" href="<?php echo esc_url($aspro_author_uri); ?>/docs/aspro/" class="welcome-icon dashicons-media-text"><?php esc_html_e( 'Documentation', 'aspro' ); ?></a></li>
                        </ul>
                    </div>
                    <div class="welcome-panel-column">
                        <h3><?php esc_html_e( 'More Actions', 'aspro' ); ?></h3>
                        <ul>
                            <li><a target="_blank" href="https://wordpress.org/support/theme/aspro/" class="welcome-icon dashicons-businesswoman"><?php esc_html_e( 'Got theme support question?', 'aspro' ); ?></a></li>
                            <li><a target="_blank" href="https://wordpress.org/support/theme/aspro/reviews/" class="welcome-icon dashicons-thumbs-up"><?php esc_html_e( 'Leave a review', 'aspro' ); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}