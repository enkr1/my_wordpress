<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="container">
    <header class="site-header">
		<a class="screen-reader-text skip-link" href="#site-content"><?php _e( 'Skip to content', 'quattuor' ); ?></a>
		<div class="site-title">
			<h1><a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo( "title" ) ?></a></h1>
			<div class="site-description"><?php bloginfo( "description" ) ?></div>
		</div>
		<a href="javascript:void(0);" onclick="document.getElementById('nav').classList.toggle('nav-open');" class="nav-toggle"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M3 4h18v2H3V4zm0 7h18v2H3v-2zm0 7h18v2H3v-2z"/></svg></a>
		<nav class="nav" id="nav">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'false') ); ?>
		</nav>
    </header>