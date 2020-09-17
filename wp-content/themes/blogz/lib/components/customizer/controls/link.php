<?php
/**
 * Add custom title for each part in sections.
 */
class Blogz_Customize_Link_Control extends WP_Customize_Section {
	/**
	 * Control's type.
	 *
	 * @var string
	 */
	/**
	 * Pro_text.
	 *
	 * @var string
	 */
	public $pro_text = '';

	/**
	 * Pro_url.
	 *
	 * @var string
	 */
	public $pro_url = '';

	/**
	 * Custom link documentation to output.
	 *
	 * @var string
	 */
	public $section_type = '';

	public $type  = 'gt-link';
	public $url   = '';
	public $label = '';

	public function json() {
		$json          = parent::json();
		$json['label'] = $this->label;
		$json['url']   = esc_url( $this->url );
		$json['section_type'] = $this->section_type;
		$json['pro_text']  = $this->pro_text;
		$json['pro_url']  = $this->pro_url;
		return $json;
	}

	/**
	 * Render the control's content.
	 */
	public function render_template() {
		?>
		<# if ( 'doc' === data.section_type ) { #>
			<li id="accordion-section-{{ data.id }}-doc" class="accordion-section control-section cannot-expand">
				<h3 class="accordion-section-title link-doc">
					<a href="{{{ data.url }}}" target="_blank">{{ data.label }}</a>
				</h3>
			</li>
		<# } #>
		<# if ( 'pro' === data.section_type ) { #>
			<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
				<h3 class="accordion-section-title link-pro">
					{{ data.title }}
					<a href="{{{ data.pro_url }}}" class="button button-primary alignright" target="_blank">{{ data.pro_text }}</a>
				</h3>
			</li>
		<# } #>
		<?php
	}
}

if ( ! function_exists( 'gt_customizer_controls_css' ) ) {
	add_action( 'customize_controls_enqueue_scripts', 'gt_customizer_controls_css' );
	/**
	 * Add CSS for our controls
	 */
	function gt_customizer_controls_css() {
		wp_enqueue_style( 'gt-link-css', GT_LIB_URL . '/lib/components/customizer/controls/css/link.css', array(), '1.0' );
		wp_enqueue_script( 'gt-link-js', GT_LIB_URL . '/lib/components/customizer/controls/js/link.js', array( 'customize-base' ), array(), '1.0', true );
	}
}