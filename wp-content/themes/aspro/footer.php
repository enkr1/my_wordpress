<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aspro
 */

?>

</div><!-- #content -->



<footer id="colophon" class="site-footer at-footer">
    <?php if ( is_active_sidebar( 'aspro_footer_section_1' ) ||
    is_active_sidebar( 'aspro_footer_section_2' ) ||
    is_active_sidebar( 'aspro_footer_section_3' ) ) : ?>
        <div class="at-footer__widget">
        <div class="at-container">
            <div class="at-footer--block">
                <?php if( is_active_sidebar( 'aspro_footer_section_1' ) ) : ?>
                    <div class="at-footer__item">
                        <?php dynamic_sidebar( 'aspro_footer_section_1' )?>
                    </div>
                <?php endif; ?>

                <?php if( is_active_sidebar( 'aspro_footer_section_2' ) ) : ?>
                    <div class="at-footer__item">
                        <?php dynamic_sidebar( 'aspro_footer_section_2' )?>
                    </div>
                <?php endif; ?>

                <?php if( is_active_sidebar( 'aspro_footer_section_3' ) ) : ?>
                    <div class="at-footer__item">
                        <?php dynamic_sidebar( 'aspro_footer_section_3' )?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="at-footer__bottom">
        <div class="at-container">
            <div class="row">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="site-info">
                        <span>&copy; <?php echo esc_html__('Copyright', 'aspro'); ?>
                            <?php echo date_i18n(  'Y'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <a href="<?php echo esc_url( home_url( '/' )); ?>"><?php echo esc_html(get_bloginfo('name', 'display')); ?></a>.
                            <?php echo esc_html__(' All rights reserved. ', 'aspro'); ?>
                        </span>
                        <span>
                            <span class="sep">|</span>
                            <?php echo esc_html__(' Designed By ', 'aspro'); ?>
                            <a target="_blank" class="at-theme-url" href="https://99colorthemes.com">
                                <?php echo esc_html__('99colorthemes', 'aspro'); ?>
                             </a>
                        </span>
                    </div><!-- .site-info -->
                </div>
            </div>
        </div>
    </div>
</footer><!-- #colophon -->

<button role="button" class="at-scroll-top">
    <span>Go To Top</span>
    <svg class="at-icon at-icon--md" id="arrow-up" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
        <path d="M263.432 3.136c-4.16-4.171-10.914-4.179-15.085-.019l-.019.019-192 192c-4.093 4.237-3.975 10.99.262 15.083 4.134 3.992 10.687 3.992 14.82 0L245.213 36.416v464.917c0 5.891 4.776 10.667 10.667 10.667s10.667-4.776 10.667-10.667V36.416l173.781 173.781c4.093 4.237 10.845 4.355 15.083.262 4.237-4.093 4.354-10.845.262-15.083a10.787 10.787 0 00-.262-.262L263.432 3.136z" fill="#4caf50"/><path d="M447.88 213.333a10.663 10.663 0 01-7.552-3.115L255.88 25.749 71.432 210.219c-4.237 4.093-10.99 3.975-15.083-.262-3.992-4.134-3.992-10.687 0-14.82l192-192c4.165-4.164 10.917-4.164 15.083 0l192 192c4.159 4.172 4.149 10.926-.024 15.085a10.665 10.665 0 01-7.528 3.111z"/><path d="M255.88 512c-5.891 0-10.667-4.776-10.667-10.667V10.667C245.213 4.776 249.989 0 255.88 0s10.667 4.776 10.667 10.667v490.667c-.001 5.89-4.776 10.666-10.667 10.666z"/>
    </svg>
</button>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>