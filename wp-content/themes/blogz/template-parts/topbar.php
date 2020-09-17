<?php
/**
 * Display Topbar.
 *
 * @package BlogZ
 */

$is_hidden_topbar = get_theme_mod( 'hidden_topbar', false );
if ( $is_hidden_topbar ) return;

$topbar_text      = get_theme_mod( 'topbar_text', __( ' Hello Folks! Welcome to Our Blog.', 'blogz' ) );
$is_hidden_social = get_theme_mod( 'hidden_social', false );
?>

<div class="topbar">
	<div class="container d-flex justify-content-between flex-wrap">
		<div class="topbar__text">
			<?php echo wp_kses_post( $topbar_text ); ?>
		</div>

		<?php if ( ! $is_hidden_social ) : ?>
			<div class="topbar__social">
				<?php
				if ( function_exists( 'jetpack_social_menu' ) ) {
					jetpack_social_menu();
				}
				?>
			</div>
		<?php endif; ?>
	</div>
</div>
