<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<div id="fullpage">

	<?php
		$img1 = get_field('banner_image');
		$img1_src = ($img1) ? $img1['url'] : '';
		$title_1 = get_field('title_1');
		$title_2 = get_field('title_2');
	?>

	<?php /*=== SECTION 1 ===*/ ?>
	<div id="section1"  class="parallax-window section fp-auto-height-responsive" data-parallax="scroll" data-image-src="<?php echo $img1_src;?>">
		<div class="wrapper">
			<div class="taglinediv">
				<?php if ($title_1 && $title_2) { ?>
					<h1 class="tagline orig">
						<span class="t1"><em><?php echo $title_1 ?></em></span>
						<span class="t2"><em><?php echo $title_2 ?></em></span>
					</h1>
					<div class="tagline clone">
						<span class="t1 animated fadeIn"><em><?php echo $title_1 ?></em></span>
						<span class="t2 animated zoomIn"><em><?php echo $title_2 ?></em></span>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<?php  
		/*=== SECTION 2 ===*/
		$about = get_field('about');
		$button_text = get_field('button_text');
		$button_link = get_field('button_link');
	?>
	<div id="section2" class="section">
	    <div class="wrapper">
			<div class="intro about animated medwrap text-center large-text">
				<?php echo $about ?>
				<?php if ($button_text && $button_link) { ?>
				<div class="buttondiv"><a class="morebtn" href="<?php echo $button_link ?>"><?php echo $button_text ?></a></div>	
				<?php } ?>
			</div>
		</div>
	</div>

	<?php  
		/*=== SECTION 3 ===*/
		$about = get_field('about');
		$button_text = get_field('button_text');
		$button_link = get_field('button_link');
	?>
	<div id="section3" class="section">
		<div class="wrapper">
			<div class="intro whatwedo">
				<h2 class="section-title text-center">What We Do</h2>
				<p>Lorem ipsum gravida donec nulla orci maecenas leo, praesent feugiat vulputate sed himenaeos quisque, nostra cursus dolor potenti viverra nec blandit varius enim faucibus ante consectetur convallis a vitae lacinia venenatis iaculis ornare turpis.</p>
				<p>Scelerisque nisi ut viverra curabitur justo ut maecenas sagittis mi eleifend, sed ullamcorper velit bibendum nostra mollis urna condimentum nibh rutrum ultricies, volutpat aenean quisque sodales pellentesque lectus auctor feugiat molestie class vivamus ultricies pharetra proin habitasse porttitor morbi, sit justo amet suspendisse dictumst lectus nostra fermentum, varius lorem quisque diam hendrerit hac proin rutrum blandit lacus dictum cursus amet conubia euismod mollis posuere dui laoreet.</p>
				<p>Morbi volutpat rhoncus aliquet dui ornare vitae duis justo purus suscipit tristique est, porta primis eleifend inceptos curae rutrum mattis iaculis non nisi nullam pharetra pellentesque vitae malesuada neque senectus nisi augue vel, litora lacus cubilia sagittis nostra suspendisse egestas etiam, massa integer congue lacinia molestie tempor senectus aliquam primis dictum dapibus porttitor auctor molestie tempus massa faucibus curabitur integer.</p>
			</div>
		</div>
	</div>
</div>

<?php endwhile; ?>
<?php
get_footer();
