<?php
/**
 * Add custom heading for each part in sections.
 */
class Blogz_Customize_Heading_Control extends WP_Customize_Control {
	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'gt-heading';

	/**
	 * Render the control's content.
	 */
	public function render_content() {
		?>
		<h3 style="margin: 30px -12px 0; padding: 12px; background: #fff; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd;"><?php echo esc_html( $this->label ); ?></h3>
		<?php
	}
}
