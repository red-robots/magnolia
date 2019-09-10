<?php
/**
 * Template Name: Page with Sections
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php
	$banner = get_field('banner');
	$banner_src = ($banner) ? $banner['url'] : '';
	$banner_caption = get_field('banner_caption');
	?>

	<?php /*=== SECTION 1 ===*/ ?>
	<section id="section1"  data-anchor="page1" class="parallax-window section first-section section-one half" data-parallax="scroll" data-image-src="<?php echo $banner_src;?>">
		<?php //get_template_part('template-parts/navigation'); ?>
		<div class="wrapper clear">
			<div class="banner-caption">
				<?php if ($banner_caption) { ?>
					<div class="caption animated zoomIn"><?php echo $banner_caption ?></div>
				<?php } ?>
			</div>
		</div>
	</section>
	
	
	<?php /*=== SECTION 2 ===*/ ?>
	<?php $s2content = get_field('s2content'); ?>
	<div id="content"></div>
	<section id="section2" data-anchor="page2" class="section subpage-section">
	    <div class="wrapper clear">
			<div class="intro about animated fadeIn wow text-center large-text">
				<?php echo $s2content ?>
			</div>
		</div>
	</section>
	
	<?php /*=== SECTION 3 ===*/ ?>
	<?php 
		$s3toptext = get_field('s3toptext'); 
		$s3columns = get_field('s3columns'); 
		$square = get_bloginfo('template_url') . '/images/px.png';
	?>
	<?php if ($s3columns || $s3toptext) { ?>
	<section id="section3" data-anchor="page3" class="section section-blue subpage-section">
	    <div class="wrapper clear">
			<?php if ($s3toptext) { ?>
			<div class="top-text large-text text-center animated fadeInUp wow"><?php echo $s3toptext ?></div>	
			<?php } ?>
			<?php if ($s3columns) { ?>
			<div class="icons-columns">
				<div class="flexboxes">
					<?php $j=1; foreach ($s3columns as $s) { 
						$s_icon = $s['icon'];
						$s_title = $s['title'];
						$s_caption = $s['caption']; 
						$delay = '.' . ($j+5) . 's';
						?>
						<div class="col text-center animated zoomIn wow" data-wow-delay="<?php echo $delay ?>">
							<div class="pad clear">
								<?php if ($s_icon) { ?>
								<div class="icondiv">
									<span style="background-image:url('<?php echo $s_icon['url'] ?>')">
										<img src="<?php echo $square ?>" alt="" aria-hidden="true" />
									</span>
								</div>	
								<?php } ?>

								<div class="text">
									<?php if ($s_title) { ?>
									<h3 class="title"><?php echo $s_title ?></h3>	
									<?php } ?>
									<?php if ($s_caption) { ?>
									<div class="caption"><?php echo $s_caption ?></div>	
									<?php } ?>
								</div>
							</div>
						</div>	
					<?php $j++; } ?>
				</div>
			</div>	
			<?php } ?>
		</div>
	</section>
	<?php } ?>

	<?php /*=== SECTION 4 ===*/ ?>
	<?php $s4content = get_field('s4content'); ?>
	<?php if ($s4content) { ?>
	<section id="section4" data-anchor="page4" class="section subpage-section">
	    <div class="wrapper clear">
			<div class="intro about animated fadeIn wow text-center large-text">
				<?php echo $s4content ?>
			</div>
		</div>
	</section>
	<?php } ?>

	<?php /*=== SECTION 5 ===*/ ?>
	<?php 
		$s5image = get_field('s5image');  
		$s5imagetext = get_field('s5imagetext'); 
		$s5image_src = ($s5image) ? $s5image['url'] : '';
	?>
	<?php if ($s5imagetext) { ?>
	<section id="section5"  data-anchor="page5" class="parallax-window section subpage-section imagebg" data-parallax="scroll" data-image-src="<?php echo $s5image_src;?>">
	    <div class="wrapper clear">
	    	<div class="banner-caption">
				<?php if ($s5imagetext) { ?>
					<div class="caption animated zoomIn wow"><h1 class="imgtitle"><?php echo $s5imagetext ?></h1></div>
				<?php } ?>
			</div>
		</div>
	</section>
	<?php } ?>

	<?php 
		$valuestext = get_field('valuestext'); 
		$s5columns = get_field('s5columns'); 
	?>

	<section id="section5-2" data-anchor="page5" class="section section-gray subpage-section">
	    <div class="wrapper clear">
			<?php if ($valuestext) { ?>
			<div class="top-text large-text text-center animated fadeInUp wow"><?php echo $valuestext ?></div>	
			<?php } ?>
			<?php if ($s5columns) { ?>
			<div class="icons-columns animated fadeInUp wow">
				<div class="flexboxes">
					<?php $j=1; foreach ($s5columns as $s) { 
						$s_title = $s['title'];
						$s_caption = $s['caption']; 
						$delay = '.' . ($j+5) . 's';
						?>
						<div class="col text-center">
							<div class="pad clear">
								<div class="text">
									<?php if ($s_title) { ?>
									<h3 class="title"><?php echo $s_title ?></h3>	
									<?php } ?>
									<?php if ($s_caption) { ?>
									<div class="caption"><?php echo $s_caption ?></div>	
									<?php } ?>
								</div>
							</div>
						</div>	
					<?php $j++; } ?>
				</div>
			</div>	
			<?php } ?>
		</div>
	</section>
	
	<?php /*=== SECTION 6 ===*/ ?>
	<?php 
		$s6content = get_field('s6content'); 
	?>
	<section id="section6" data-anchor="page6" class="section subpage-section">
	    <div class="wrapper clear">
			<div class="top-text about text-center large-text animated fadeIn wow">
				<?php echo $s6content ?>
			</div>
		</div>
	</section>

	<?php /*=== SECTION 7 ===*/ ?>
	<?php 
		$s76content = get_field('s76content'); 
		$s7btn = get_field('s7btn'); 
		$s7btnlink = get_field('s7btnlink'); 
	?>
	<section id="section7" data-anchor="page6" class="section section-teal subpage-section">
	    <div class="wrapper clear">
			<div class="top-text animated zoomIn wow text-center large-text" data-wow-delay="0.5s">
				<?php echo $s76content ?>

				<?php if ($s7btn && $s7btnlink) { ?>
					<div class="buttondiv"><a class="morebtn" href="<?php echo $s7btnlink ?>"><?php echo $s7btn ?></a></div>
				<?php } ?>
			</div>
		</div>
	</section>

<?php endwhile; ?>

<?php
get_footer();
