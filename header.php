<?php
/**
 * The header for theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ACStarter
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url') ?>/css/jquery.fullpage.min.css">
<script defer src="<?php bloginfo( 'template_url' ); ?>/assets/svg-with-js/js/fontawesome-all.js"></script>


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'acstarter' ); ?></a>
<div id="page" class="site">
	<header id="masthead" class="site-header" role="banner">
		<div class="wrapper">
			<div class="logo-wrapper"><a id="site_logo" class="logoSVG animateThis show" href="<?php echo get_site_url(); ?>"><?php get_template_part('template-parts/logo'); ?><span class="sr-only"><?php echo get_bloginfo('name') ?></span></a></div>
			<nav id="site-navigation" class="main-navigation animated fadeInRight" role="navigation">
				<?php 
					$login_link = get_field('button_link','option');
					$login_label = get_field('button_text','option');
					$nav_options = array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu','container'=>false );
					if($login_link && $login_label){
						$nav_options['items_wrap'] = '<ul id="%1$s" class="%2$s">%3$s<li class="custom_menu_link"><a href="'.$login_link.'">'.$login_label.'</a></li></ul>';
					}
					wp_nav_menu($nav_options);
					//wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu','container'=>false ) ); 
				?>
			</nav>
		</div><!-- wrapper -->
	</header><!-- #masthead -->
	<div id="content" class="contentwrapper clear">


