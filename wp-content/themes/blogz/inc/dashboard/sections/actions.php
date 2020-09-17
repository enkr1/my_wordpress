<?php
/**
 * Recommended Actions Section.
 *
 * @package BlogZ
 */

$actions = $this->recommended_plugins_action();
?>
<div id="actions" class="gt-tab-pane">
	<div class="feature-section two-col">
		<div class="col">
			<h3><?php echo esc_html( $actions['title'] ); ?></h3>
			<p><?php echo wp_kses_post( $actions['body'] ); ?></p>

			<?php if ( ! empty( $actions['button_text'] ) ) : ?>
				<a class="button" href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins&plugin_status=install' ) ); ?>"><?php echo esc_html( $actions['button_text'] ); ?></a>
			<?php endif; ?>

			<?php if ( $this->jetpack_is_recommended() ) : ?>
				<h3><?php esc_html_e( 'Connect Your Site To Jetpack', 'blogz' ); ?></h3>
				<p>
					<?php
					/* translators: theme name. */
					echo esc_html( sprintf( __( '%s uses Jetpack to support featured content, social menu. Connect to Jetpack to use these features as well as variety of other tools.', 'blogz' ), $this->theme->name ) );
					?>
				</p>
				<a class="button" href="<?php echo esc_url( admin_url( 'admin.php?page=jetpack#/' ) ); ?>"><?php esc_html_e( 'Connect To Jetpack', 'blogz' ); ?></a>
			<?php endif; ?>
			<?php do_action( 'blogz_import_demo_action' ); ?>
		</div>
	</div>
</div>
