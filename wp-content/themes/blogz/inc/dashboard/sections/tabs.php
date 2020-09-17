<?php
/**
 * Tabs navigation.
 *
 * @package BlogZ
 */

?>
<h2 class="nav-tab-wrapper">
	<?php foreach ( $tabs as $tab_id => $name ) :
		$tab_class = $tab_id === 'getting-started' ? 'nav-tab-active' : '';
		?>
		<a href="#<?php echo esc_attr( $tab_id ); ?>" class="nav-tab <?php echo esc_attr( $tab_class ); ?>"><?php echo esc_html( $name ); ?></a>
	<?php endforeach ?>
</h2>
