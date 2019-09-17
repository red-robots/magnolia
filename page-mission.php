<?php
/**
 * Template Name: Mission Page
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php
	$banner = get_field('banner');
	$banner_src = ($banner) ? $banner['url'] : '';
	$banner_caption = get_field('banner_caption');
	?>
	
	<h1 style="display:none;"><?php the_title(); ?></h1>

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
	<section id="iconssection" data-anchor="page3" class="section iconssection services-section">
		<div class="wrapper clear">
			<?php if ($s3toptext) { ?>
				<div class="top-text text-center fadeInUp wow"><?php echo $s3toptext ?></div>
			<?php } ?>

				
			<?php if ($s3columns) { ?>
			<div class="services fullwidth">
				<div class="flexrow">
					<?php $j=1; foreach ($s3columns as $svc) { 

					// 	$s_icon = $s['icon'];
					// $s_title = $s['title'];
					// $s_caption = $s['caption']; 
					// $delay = '.' . ($j+5) . 's';
					$delay = '.' . ($j+5) . 's';
					$s_icon = $svc['icon'];
					$s_title = $svc['title'];
					$s_text = $svc['caption']; ?>
					<div class="fbox4 svc text-center fadeInUp wow" data-wow-delay="<?php echo $delay ?>">
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
					<?php $j++; } ?>
				</div>
			</div>	
			<?php } ?>

		</div>
	</section>

	<?php /*=== SECTION 4 ===*/ ?>
	<?php $s4content = get_field('s4content'); ?>
	<section id="section4" data-anchor="page4" class="section subpage-section">
	    <div class="wrapper clear">
			<div class="intro about animated fadeIn wow text-center large-text">
				<?php echo $s4content ?>
			</div>
		</div>
	</section>

	<?php /*=== SECTION 5 ===*/ ?>
	<?php 
		$s5image = get_field('s5image');  
		$s5imagetext = get_field('s5imagetext'); 
		$s5image_src = ($s5image) ? $s5image['url'] : '';
	?>
	<section id="section5"  data-anchor="page5" class="parallax-window section subpage-section imagebg" data-parallax="scroll" data-image-src="<?php echo $s5image_src;?>">
	    <div class="wrapper clear">
	    	<div class="banner-caption">
				<?php if ($s5imagetext) { ?>
					<div class="caption animated zoomIn wow"><?php echo $s5imagetext ?></div>
				<?php } ?>
			</div>
		</div>
	</section>

	<?php 
		$valuestext = get_field('valuestext'); 
		$s5columns = get_field('s5columns'); 
	?>

	<section id="values" data-anchor="page3" class="section iconssection services-section">
		<div class="wrapper clear">
			<?php if ($valuestext) { ?>
				<div class="intro top-text text-center fadeInUp wow"><?php echo $valuestext ?></div>
			<?php } ?>

				
			<?php if ($s5columns) { ?>
			<div class="services fullwidth">
				<div class="flexrow">
					<?php $j=1; foreach ($s5columns as $svc) { 
					$delay = '.' . ($j+5) . 's';
					$s_icon = $svc['icon'];
					$s_title = $svc['title'];
					$s_text = $svc['caption']; ?>
					<div class="fbox4 svc text-center fadeInUp wow" data-wow-delay="<?php echo $delay ?>">
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
			<div class="intro top-text text-center large-text animated fadeIn wow">
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
