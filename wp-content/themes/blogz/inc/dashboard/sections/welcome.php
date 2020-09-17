<?php
/**
 * Welcome section.
 *
 * @package BlogZ
 */

?>
<h1>
	<?php
	// Translators: %1$s - Theme name, %2$s - Theme version.
	echo esc_html( sprintf( __( 'Welcome to %1$s', 'blogz' ), $this->theme->name, $this->theme->version ) );
	?>
</h1>

<div class="about-text"><?php echo esc_html( $this->theme->description ); ?></div>

<a target="_blank" href="<?php echo esc_url( 'https://gretathemes.com/' . $this->utm ); ?>" class="wp-badge"><?php esc_html_e( 'GretaThemes', 'blogz' ); ?></a>

<p class="about-buttons">
	<a href="<?php echo esc_url( "https://gretathemes.com/docs/{$this->slug}/{$this->utm }" ); ?>" target="_blank" class="button button-secondary"><?php esc_html_e( 'Documentation', 'blogz' ); ?></a>
	<a target="_blank" class="button" href="<?php echo esc_url( 'https://gretathemes.com/support/' . $this->utm ); ?>"><?php esc_html_e( 'Support', 'blogz' ); ?></a>
</p>
