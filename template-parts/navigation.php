<?php 
	$login_link = get_field('button_link','option');
	$login_label = get_field('button_text','option');
?>
<div class="navOuterWrap">
	<a href="#" class="menutoggle mtoggle"><span></span></a>
	<div id="sideNav" class="side-navigation mtoggle">
		<?php if ($login_link && $login_label) { ?>
			<div class="snButtons">
				<a href="<?php echo $login_link; ?>" target="_blank"><?php echo $login_label; ?></a>
			</div>
		<?php } ?>
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'mainmenu', 'container_class'=>'navwrap','link_before'=>'<span>','link_after'=>'</span><i class="xx"></i>' ) ); ?>
	</div>	
</div>

<header id="masthead" class="site-header" role="banner">
	<div class="wrapper">
		<div class="logo-wrapper"><a id="site_logo" class="logoSVG animateThis show" href="<?php echo get_site_url(); ?>"><?php get_template_part('template-parts/logo'); ?><span class="sr-only"><?php echo get_bloginfo('name') ?></span></a></div>
		<nav id="site-navigation" class="main-navigation animated fadeInDown" role="navigation">
			<?php if ($login_link && $login_label) { ?>
			<ul id="primary-menu" class="menu">
				<li class="menu-item-login custom_menu_link"><a href="<?php echo $login_link; ?>" target="_blank"><?php echo $login_label; ?></a></li>
			</ul>
			<?php } ?>
		</nav>
	</div><!-- wrapper -->
</header><!-- #masthead -->