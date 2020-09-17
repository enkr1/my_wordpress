<?php
/**
 * Add theme dashboard page
 *
 * @package BlogZ
 */

/**
 * Dashboard class.
 */
class BlogZ_Dashboard {

	/**
	 * Store the theme data.
	 *
	 * @var WP_Theme Theme data.
	 */
	private $theme;

	/**
	 * Theme slug.
	 *
	 * @var string Theme slug.
	 */
	private $slug;

	/**
	 * Lite version slug.
	 *
	 * @var string Lite version slug.
	 */
	private $lite_slug;

	/**
	 * UTM link.
	 *
	 * @var string UTM link.
	 */
	private $utm;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->theme     = wp_get_theme();
		$this->slug      = $this->theme->template;
		$this->pro_name = str_replace( ' Lite', '', $this->theme->name );
		$this->lite_slug = $this->slug . '-lite';
		$this->utm       = '?utm_source=WordPress&utm_medium=link&utm_campaign=' . $this->slug;

		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'admin_notices', array( $this, 'notice' ) );
	}

	/**
	 * Add theme dashboard page.
	 */
	public function add_menu() {
		$page = add_theme_page(
			$this->theme->name,
			$this->theme->name,
			'edit_theme_options',
			$this->slug,
			array( $this, 'render' )
		);
		add_action( "admin_print_styles-$page", array( $this, 'enqueue_scripts' ) );
	}

	public function get_tabs() {
		$tabs = array(
			'getting-started' => __( 'Getting Started', 'blogz' ),
			'actions'         => __( 'Actions', 'blogz' ),
		);
		return apply_filters( 'blogz_dashboard_tabs', $tabs );
	}

	/**
	 * Show dashboard page.
	 */
	public function render() {
		$tabs = $this->get_tabs();
		?>
		<div class="wrap">
			<div id="poststuff">
				<div id="post-body" class="columns-2">
					<div id="post-body-content">
						<div class="about-wrap">
							<?php include get_template_directory() . '/inc/dashboard/sections/welcome.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
							<?php include get_template_directory() . '/inc/dashboard/sections/tabs.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
							<?php
							foreach ( $tabs as $id => $name ) {
								include get_template_directory() . '/inc/dashboard/sections/' . $id . '.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Enqueue scripts for dashboard page.
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'slick', get_template_directory_uri() . '/inc/dashboard/css/slick.css', '', '1.8.1' );
		wp_enqueue_style( "{$this->slug}-dashboard-style", get_template_directory_uri() . '/inc/dashboard/css/dashboard-style.css', '', '1.0.0' );
		wp_enqueue_script( 'slick', get_template_directory_uri() . '/inc/dashboard/js/slick.js', array( 'jquery' ), '1.8.0', true );
		wp_enqueue_script( "{$this->slug}-dashboard-script", get_template_directory_uri() . '/inc/dashboard/js/script.js', array( 'slick' ), '1.0.0', true );
	}

	/**
	 * Add a notice after theme activation.
	 */
	public function notice() {
		global $pagenow;
		if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' === $pagenow ) {
			?>
			<div class="updated notice notice-success is-dismissible">
				<p>
					<?php
					// Translators: theme name and welcome page.
					echo wp_kses_post( sprintf( __( 'Welcome! Thank you for choosing %1$s. To get started, visit our <a href="%2$s">welcome page</a>.', 'blogz' ), $this->theme->name, esc_url( admin_url( 'themes.php?page=' . $this->slug ) ) ) );
					?>
				</p>
				<p>
					<a class="button" href="<?php echo esc_url( admin_url( 'themes.php?page=' . $this->slug ) ); ?>">
						<?php
						// Translators: theme name.
						echo esc_html( sprintf( __( 'Get started with %s', 'blogz' ), $this->theme->name ) );
						?>
					</a>
				</p>
			</div>
			<?php
		}
	}

	/**
	 * Recommended Plugin Action.
	 */
	public function recommended_plugins_action() {
		$plugins        = blogz_required_plugins();
		$plugins_number = count( $plugins );
		$installer      = TGM_Plugin_Activation::get_instance();
		$action         = array();

		if ( $plugins_number > 1 ) {
			$action['title'] = esc_html__( 'Install The Recommended Plugins', 'blogz' );
			/* translators: theme name. */
			$action['body']        = sprintf( esc_html__( '%s needs some plugins to working properly. Please install and activate our required plugins.', 'blogz' ), $this->theme->name );
			$action['button_text'] = esc_html__( 'Install Plugins', 'blogz' );
		} else {
			$plugin_name = $plugins[0]['name'];
			/* translators: theme name. */
			$action['body'] = sprintf( __( '%1$s needs %2$s to working properly. Please install and activate it.', 'blogz' ), $this->theme->name, $plugin_name );
			/* translators: plugin name. */
			$action['button_text'] = sprintf( esc_html__( 'Install %s', 'blogz' ), $plugin_name );
			$action['title']       = $action['button_text'];

		}

		if ( $installer->is_tgmpa_complete() ) {
			if ( $plugins_number > 1 ) {
				$action['body'] = '<strong>' . esc_html__( 'You have installed and active all required plugins', 'blogz' ) . '</strong>';
			} else {
				/* translators: plugin name. */
				$action['body'] = sprintf( __( '<strong>%s has been installed and activated</strong>', 'blogz' ), $plugin_name );
			}
			$action['button_text'] = '';
		}
		return $action;
	}

	/**
	 * Check if Jetpack is recommended
	 */
	public function jetpack_is_recommended() {
		$plugins = blogz_required_plugins();
		foreach ( $plugins as $plugin ) {
			if ( 'jetpack' === $plugin['slug'] ) {
				return true;
			}
		}
	}
}
