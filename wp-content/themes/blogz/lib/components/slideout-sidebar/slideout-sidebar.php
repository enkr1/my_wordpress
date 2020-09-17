<?php
/**
 * Template part for displaying Slide Out Sidebar
 *
 * @package Gt addons
 */

/**
 * Register sidebar for modules.
 */
function blogz_widgets_init() {
	$body_classes = get_body_class();
	if ( in_array( 'slideout-sidebar-enabel', $body_classes ) ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Slide Out Sidebar', 'blogz' ),
				'id'            => 'slide-out-sidebar',
				'description'   => esc_html__( 'Add widgets here.', 'blogz' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="hamburger-title"><span>',
				'after_title'   => '</span></div>',
			)
		);
	}
}
add_action( 'widgets_init', 'blogz_widgets_init' );

/**
 * Slideout sidebar.
 */
function blogz_slideout_sidebar() {
	?>
	<div class="slideout-sidebar">
		<div class="slideout-sidebar__header">
			<span class="header__site-title">
				<?php bloginfo( 'name' ); ?>
			</span>
			<button class="header__close"><i class="fas fa-times"></i></button>
		</div>
		<div class="slideout-sidebar__body">
			<div id="mobile-navigation" class="widget widget_nav_menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</div><!-- #site-navigation -->

			<?php
			if ( is_active_sidebar( 'slide-out-sidebar' ) ) {
				dynamic_sidebar( 'slide-out-sidebar' );
			} else {
				printf( '<a class="add-widget-link" href="%1$s" title="%2$s">%2$s</a>', esc_url( admin_url( 'widgets.php' ) ), esc_html__( 'Add your widget here', 'blogz' ) );
			}
			?>
		</div>
		<div class="slideout-sidebar__footer">
			<?php
			/* translators: placeholder replaced with string */
			printf( esc_html__( 'Coppyright &copy; %1$s %2$s', 'blogz' ), esc_html( date( 'Y' ) ), '<a href="https://gretathemes.com/" rel="designer">GretaThemes</a>' );
			?>
		</div>
	</div>
	<?php
}
