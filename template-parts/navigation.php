<header id="masthead" class="site-header" role="banner">
	<div class="wrapper">
		<div class="logo-wrapper"><a id="site_logo" class="logoSVG animateThis show" href="<?php echo get_site_url(); ?>"><?php get_template_part('template-parts/logo'); ?><span class="sr-only"><?php echo get_bloginfo('name') ?></span></a></div>
		<nav id="site-navigation" class="main-navigation animated fadeInDown" role="navigation">
			<?php 
				$login_link = get_field('button_link','option');
				$login_label = get_field('button_text','option');
				$nav_options = array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu','container'=>false );
				if($login_link && $login_label){
					$nav_options['items_wrap'] = '<ul id="%1$s" class="%2$s">%3$s<li class="custom_menu_link"><a href="'.$login_link.'" target="_blank">'.$login_label.'</a></li></ul>';
				}
				if( has_nav_menu( 'primary' ) ) {
					wp_nav_menu($nav_options);
				} else { ?>
					<?php if ($login_link && $login_label) { ?>
					<ul id="primary-menu" class="menu">
						<li class="menu-item-login custom_menu_link"><a href="<?php echo $login_link; ?>" target="_blank"><?php echo $login_label; ?></a></li>
					</ul>
					<?php } ?>
				<?php }
			?>
		</nav>
	</div><!-- wrapper -->
</header><!-- #masthead -->