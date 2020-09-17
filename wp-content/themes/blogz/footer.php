<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BlogZ
 */

$footer_bg             = get_theme_mod( 'footer_bg', get_template_directory_uri() . '/images/footer_bg.jpg' );
$footer_logo           = get_theme_mod( 'footer_logo' );
$footer_logo_alt       = blogz_get_image_alt( $footer_logo );
$subscribe_text        = get_theme_mod( 'subscribe_text', __( 'Subscribe to our newsletter and get latest news!.', 'blogz' ) );
$subscribe_button_text = get_theme_mod( 'subscribe_button_text', __( 'Subscribe', 'blogz' ) );
$footer_subscription   = '[jetpack_subscription_form subscribe_text="' . esc_html( $subscribe_text ) . '" subscribe_button="' . esc_html( $subscribe_button_text ) . '"]';
?>

</div><!-- #content -->

<footer id="colophon" class="site-footer bg-cover" style="background-image: url(<?php echo esc_url( $footer_bg ); ?>)">
	<div class="container">
		<?php
		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'subscriptions' ) ) :
			?>
			<div class="footer-subscription">
				<div class="container">
					<?php echo do_shortcode( $footer_subscription ); ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="footer-bottom">
			<div class="footer-info">
				<?php if ( ! empty( $footer_logo ) ) : ?>
					<a href="<?php echo esc_url( site_url( '/' ) ); ?>">
						<img src="<?php echo esc_url( $footer_logo ); ?>" alt="<?php echo esc_attr( $footer_logo_alt ); ?>">
					</a>
					<span class="sep">|</span>
				<?php endif; ?>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'blogz' ), 'BlogZ', '<a href="https://gretathemes.com">GretaThemes</a>' );
				?>
			</div><!-- .footer-info -->
			<?php
			if ( function_exists( 'jetpack_social_menu' ) ) {
				jetpack_social_menu();
			}
			?>
		</div>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php
if ( function_exists( 'blogz_slideout_sidebar' ) ) {
	blogz_slideout_sidebar();
}
?>
<a href="#" class="scroll-to-top js-scroll-to-top"><i class="icofont-rounded-up"></i></a>
<?php wp_footer(); ?>

</body>
</html>
