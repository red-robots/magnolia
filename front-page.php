<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php
		$img1 = get_field('banner_image');
		$img1_src = ($img1) ? $img1['url'] : '';
		$title_1 = get_field('title_1');
		$title_2 = get_field('title_2');
	?>

	<?php /*=== SECTION 1 ===*/ ?>
	<section id="section0"  data-anchor="page1" class="parallax-window section first-section section-one" data-parallax="scroll" data-image-src="<?php echo $img1_src;?>">
		<?php get_template_part('template-parts/navigation'); ?>
		<div class="wrapper clear">
			<div class="taglinediv">
				<?php if ($title_1 && $title_2) { ?>
					<h1 class="tagline orig wow">
						<span class="t1"><em><?php echo $title_1 ?></em></span>
						<span class="t2"><em><?php echo $title_2 ?></em></span>
					</h1>
					<div class="tagline clone">
						<span class="t1  wow fadeInDown"><em><?php echo $title_1 ?></em></span>
						<span class="t2  wow fadeInUp"><em><?php echo $title_2 ?></em></span>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>

	<?php  
		/*=== SECTION 2 ===*/
		$about = get_field('about');
		$button_text = get_field('button_text');
		$button_link = get_field('button_link');
	?>
	<section id="section1" data-anchor="page2" class="section section-two">
	    <div class="wrapper clear">
			<div class="intro about animated fadeInUp wow text-center large-text">
				<?php echo $about ?>
				<?php if ($button_text && $button_link) { ?>
				<div class="buttondiv"><a class="morebtn" href="<?php echo $button_link ?>"><?php echo $button_text ?></a></div>	
				<?php } ?>
			</div>
		</div>
	</section>

	<?php  
		/*=== SECTION 3 ===*/
		$services = get_field('service');
	?>
	<section id="section2" data-anchor="page3" class="section services-section section-three">
		<div class="wrapper clear">
			<div class="intro whatwedo">
				<h2 class="section-title text-center animated zoomIn wow" data-wow-delay=".2s">What We Do</h2>
				<?php if ($services) { ?>
				<div class="services fullwidth">
					<div class="flexrow">
						<?php foreach ($services as $svc) { 
						$s_icon = $svc['service_icon'];
						$s_title = $svc['service_title'];
						$s_text = $svc['service_description']; ?>
						<div class="fbox svc text-center animated fadeInUp wow">
							<?php if ($s_icon) { ?>
							<div class="svc-icon">
								<span><img src="<?php echo $s_icon['url'] ?>" alt="<?php echo $s_icon['title'] ?>" /></span>
							</div>	
							<?php } ?>
							<?php if ($s_title) { ?>
								<h3 class="box-title"><?php echo $s_title ?></h3>
							<?php } ?>
							<?php if ($s_text) { ?>
								<div class="svc-text"><?php echo $s_text ?></div>
							<?php } ?>
						</div>	
						<?php } ?>
					</div>
				</div>	
				<?php } ?>
			</div>
		</div>
	</section>


	<?php  
		/*=== SECTION 4 ===*/
		$why_title = get_field('why_title');
		$description = get_field('description');
		$details = get_field('details');
	?>
	<section id="section3" data-anchor="page4" class="section whyus-section section-four">
		<div class="wrapper clear">
			<div class="intro whyus text-center">
				<?php if ($why_title) { ?>
					<h2 class="section-title text-center animated fadeInUp wow"><?php echo $why_title ?></h2>
				<?php } ?>
				
				<?php if ($description) { ?>
				<div class="why-text fullwidth animated fadeInUp wow">
					<?php echo $description ?>
				</div>	
				<?php } ?>

				<?php if ($details) { ?>
				<div class="whydetails fullwidth">
					<div class="medwrap">
						<div class="flexrow">
							<?php $i=1; foreach ($details as $d) { 
							$d_icon = $d['icon'];
							$d_title = $d['title'];
							$d_text = $d['description']; ?>
							<div id="wcol<?php echo $i;?>" class="whybox animated zoomIn wow" data-wow-delay="0.'<?php echo $i+1?>'s">
								<?php if ($d_icon) { ?>
								<div class="icon">
									<span><img src="<?php echo $d_icon['url'] ?>" alt="<?php echo $d_icon['title'] ?>" /></span>
								</div>	
								<?php } ?>
								<?php if ($d_title) { ?>
									<h3 class="title"><?php echo $d_title ?></h3>
								<?php } ?>
								<?php if ($d_text) { ?>
									<div class="text"><?php echo $d_text ?></div>
								<?php } ?>
							</div>	
							<?php $i++; } ?>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</section>

	<?php  
	/*=== Contact Us ===*/
	$contact_description = get_field('contact_description');
	$imgBg = get_field('section_bg');
	$parallax_class = '';
	$atts = '';
	if($imgBg) {
		$parallax_class = ' parallax-window';
		$atts = ' data-parallax="scroll" data-image-src="'.$imgBg['url'].'"';
	}
	?>
	<section id="section4" data-anchor="page5" class="section contactus-section clear section-five<?php echo $parallax_class?>"<?php echo $atts?>>
		<div class="wrapper clear"> 
			<div id="contact" class="intro contactus text-center">
				<div class="section-logo"><a class="logov2 animateStroke wow" data-wow-offset="10" data-wow-delay="1s" href="<?php echo get_site_url(); ?>"><?php get_template_part('template-parts/logo'); ?></a></div>
				<h2 class="section-title text-center animated zoomIn wow">Contact us.</h2>
				<?php if ($contact_description) { ?>
					<div class="contact-text clear animated fadeInUp wow"><?php echo $contact_description ?></div>
				<?php } ?>
			</div>
		</div>
	</section>

<?php endwhile; ?>
<?php
get_footer();
