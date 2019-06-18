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
	<div id="section0"  data-anchor="page1" class="parallax-window section first-section fp-auto-height-responsive" data-parallax="scroll" data-image-src="<?php echo $img1_src;?>">
		<div class="wrapper clear">
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
	<div id="section1" data-anchor="page2" class="section">
	    <div class="wrapper clear">
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
		$services = get_field('service');
	?>
	<div id="section2" data-anchor="page3" class="section services-section">
		<div class="wrapper clear">
			<div class="intro whatwedo">
				<h2 class="section-title text-center">What We Do</h2>
				<?php if ($services) { ?>
				<div class="services fullwidth">
					<div class="flexrow">
						<?php foreach ($services as $svc) { 
						$s_icon = $svc['service_icon'];
						$s_title = $svc['service_title'];
						$s_text = $svc['service_description']; ?>
						<div class="fbox svc text-center">
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
	</div>


	<?php  
		/*=== SECTION 4 ===*/
		$why_title = get_field('why_title');
		$description = get_field('description');
		$details = get_field('details');
	?>
	<div id="section3" data-anchor="page4" class="section whyus-section">
		<div class="wrapper clear">
			<div class="intro whyus text-center">
				<?php if ($why_title) { ?>
					<h2 class="section-title text-center"><?php echo $why_title ?></h2>
				<?php } ?>
				
				<?php if ($description) { ?>
				<div class="why-text fullwidth">
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
							<div id="wcol<?php echo $i;?>" class="whybox">
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
	</div>

	<?php  
	/*=== Contact Us ===*/
	$contact_description = get_field('contact_description');
	?>
	<div id="section4" data-anchor="page5" class="section contactus-section clear">
		<div class="wrapper clear">
			<div id="contact" class="intro contactus text-center">
				<h2 class="section-title text-center">Contact us.</h2>
				<?php if ($contact_description) { ?>
					<div class="contact-text"><?php echo $contact_description ?></div>
				<?php } ?>
			</div>
		</div>
	</div>
	

	<?php /*=== FOOTER ===*/ ?>
	<?php
	$phone_number = get_field('phone_number','option');  
	$address_1 = get_field('address_1','option');  
	$address_2 = get_field('address_2','option');  

	$linkedin = get_field('linkedin','option');
	$facebook = get_field('facebook','option');
	$twitter = get_field('twitter','option');
	?>
	<div id="footer" data-anchor="page6" class="section clear footer-section">
		<div class="wrapper">
			<div class="intro footer-info text-center">
				<h2 class="section-title"><?php echo get_bloginfo('name'); ?></h2>
				<?php if ($phone_number) { ?>
				<div class="phone"><?php echo $phone_number ?></div>	
				<?php } ?>
				<?php if ($address_1) { ?>
				<div class="address add1"><?php echo $address_1 ?></div>	
				<?php } ?>
				<?php if ($address_2) { ?>
				<div class="address add2"><?php echo $address_2 ?></div>	
				<?php } ?>

				<?php if ($linkedin || $facebook || $twitter) { ?>
				<div class="social-links">
					<?php if ($linkedin) { ?>
					<a href="<?php echo $linkedin ?>" target="_blank"><i class="fab fa-linkedin-in"></i><span class="sr-only">Linkedin</span></a>
					<?php } ?>
					<?php if ($facebook) { ?>
					<a href="<?php echo $facebook ?>" target="_blank"><i class="fab fa-facebook-f"></i><span class="sr-only">Facebook</span></a>
					<?php } ?>
					<?php if ($twitter) { ?>
					<a href="<?php echo $twitter ?>" target="_blank"><i class="fab fa-twitter"></i><span class="sr-only">Twitter</span></a>
					<?php } ?>
				</div>
				<?php } ?>

				<div class="copyright">
					Copyright <?php echo date('Y') ?> <?php echo get_bloginfo('name'); ?>. All Rights Reserved.
				</div>
			</div>
		</div>
	</div>

</div>



<?php endwhile; ?>
<?php
get_footer();
