<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Dartmouth
 * @since Dartmouth 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site container">
	<?php if ( get_header_image() ) : ?>
	<div id="site-header" class="row">
		<div class="logo col-md-6">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php header_image(); ?>" alt="">
			</a>
		</div>

		<div class="header-links col-md-6">
		    <nav role="navigation" class="navigation site-navigation secondary-navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
			</nav>

			<div class="social">
			    <div class="dropdown">
			        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Follow: <b class="caret"></b></a>
			        <ul class="dropdown-menu">
			            <li class="facebook"><a href="http://www.facebook.com/TheDartmouth" target="_blank"></a></li>
			            <li class="twitter"><a href="http://twitter.com/thedartmouth" target="_blank"></a></li>
			            <li class="youtube"><a href="http://www.youtube.com/user/TheDartmouthVideo/" target="_blank"></a></li>
			            <li class="instagram"><a href="http://www.instagram.com/thedartmouth" target="_blank"></a></li>
			        </ul>
			    </div>
			</div>
		</div>

	</div>
	<?php endif; ?>

	<header id="masthead" class="site-header row" role="banner">
		<div class="header-main">
			<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
				<div class="container">
					<button class="menu-toggle"><?php _e( 'Primary Menu', 'dartmouth' ); ?></button>
					<a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'dartmouth' ); ?></a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu col-md-8' ) ); ?>
					<div class="form-search col-md-4"><?php get_search_form(); ?></div>
				</div>
			</nav>
		</div>
	</header><!-- #masthead -->

	<div id="main" class="site-main">
