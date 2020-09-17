<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Photobook Lite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if(is_singular() && pings_open()) { ?>
<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' )); ?>">
<?php } ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
	//wp_body_open hook from WordPress 5.2
	if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
?>
<a class="skip-link screen-reader-text" href="#sitemain">
	<?php _e( 'Skip to content', 'photobook-lite' ); ?>
</a>

<div id="header">
	<div class="header-inner container">
		  <div class="logo">
		   <?php photobook_lite_the_custom_logo(); ?>
							<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo( 'name' )); ?></a></h1>

						<?php $description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p><?php echo esc_html($description); ?></p>
						<?php endif; ?>
		 </div><!-- .logo -->                 
		<div id="navigation">
			<div class="toggle">
					<a class="toggleMenu" href="#"><?php esc_html_e('Menu','photobook-lite'); ?></a>
			</div><!-- toggle --> 	
			<nav id="main-navigation" class="site-navigation primary-navigation sitenav" role="navigation">		
					<?php wp_nav_menu( array('theme_location' => 'primary') ); ?>	
			</nav>
		</div><!-- navigation -->
		<?php if(get_theme_mod('facebook') || get_theme_mod('twitter') || get_theme_mod('linkedin') || get_theme_mod('instagram') || get_theme_mod('ytube') != ''){?>
		<div class="social">
			<?php if(get_theme_mod('facebook') != '') { ?>
				<a href="<?php echo esc_url(get_theme_mod('facebook')); ?>" target="_blank" title="facebook-f"><i class="fa fa-facebook-f" aria-hidden="true"></i></a>
			<?php } ?>
			<?php if(get_theme_mod('twitter') != '') { ?>
				<a href="<?php echo esc_url(get_theme_mod('twitter')); ?>" target="_blank" title="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
			<?php } ?>
			<?php if(get_theme_mod('linkedin') != '') { ?>
				<a href="<?php echo esc_url(get_theme_mod('linkedin')); ?>" target="_blank" title="linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
			<?php } ?>
			<?php if(get_theme_mod('instagram') != '') { ?>
				<a href="<?php echo esc_url(get_theme_mod('instagram')); ?>" target="_blank" title="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
			<?php } ?>
			<?php if(get_theme_mod('ytube') != '') { ?>
				<a href="<?php echo esc_url(get_theme_mod('ytube')); ?>" target="_blank" title="youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a>
			<?php } ?>
		</div><!-- social -->
		<?php } ?>
	</div><!-- .header-inner--><div class="clear"></div>  
</div><!-- #header -->