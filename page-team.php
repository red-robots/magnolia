<?php
/**
 * Template Name: Team
 */

get_header(); ?>

	<?php
	$banner = get_field('banner');
	$banner_src = ($banner) ? $banner['url'] : '';
	$banner_caption = get_field('banner_caption');
	?>
	
	<?php if ($banner) { ?>
		
		<?php while ( have_posts() ) : the_post(); ?>
			<h1 style="display:none;"><?php the_title(); ?></h1>

			<?php /*=== SECTION 1 ===*/ ?>
			<section id="section1"  data-anchor="page1" class="parallax-window section first-section section-one" data-parallax="scroll" data-image-src="<?php echo $banner_src;?>">
				<div class="wrapper clear">
					<div class="banner-caption">
						<?php if ($banner_caption) { ?>
							<div class="caption animated zoomIn"><?php echo $banner_caption ?></div>
						<?php } ?>
					</div>
				</div>
			</section>
			
			
			<?php /*=== SECTION 2 ===*/ ?>
			<div id="content"></div>
			<section id="section2" data-anchor="page2" class="section subpage-section">
			    <div class="wrapper clear">
					<div class="intro about animated fadeIn wow text-center large-text">
						<?php the_content(); ?>
					</div>
				</div>
			</section>

		<?php endwhile; ?>
	
		<?php /*=== SECTION 2 (Team Section) ===*/ ?>
		<section id="section3" data-anchor="page3" class="section subpage-section">
				<?php
				$args = array(
					'posts_per_page'=> -1,
					'post_type'		=> 'team',
					'post_status'	=> 'publish'
				);
				$teams = get_posts($args);
				$total = ($teams) ? count($teams) : 0;
				$px = get_bloginfo('template_url') . '/images/px2.png';
				if ( $teams ) {  ?>
				<div class="teams clear">
					
					<?php if ($total>3) { $lists = array_chunk($teams,3); ?>
						<?php $j=1; foreach ($lists as $list) { ?>
						<div class="group <?php echo ($j%2==0) ? 'even':'odd'?>">
							<div class="wrapper">
								<div class="flexbox">
									<?php foreach ($list as $e) { 
									$postId = $e->ID;
									$name = $e->post_title;
									$photo = get_field('image',$postId);
									$bg = ($photo) ? ' style="background-image:url('.$photo['url'].')"':'';
									$jobtitle = get_field('title',$postId);
									$excerpt = get_field('experience',$postId);
									$excerpt = ($excerpt) ? strip_tags($excerpt) : '';
									$excerpt = ($excerpt) ? shortenText($excerpt,120,' ',' [...]') : '';
									$pagelink = get_permalink($postId);
									?>
									<div class="info">
										<div class="pad">
											<div class="photo <?php echo ($photo) ? 'yes':'noimage'?>"<?php echo $bg ?>>
												<img src="<?php echo $px ?>" alt="" aria-hidden="true">
											</div>
											<h3 class="name"><?php echo $name; ?></h3>
											<?php if ($jobtitle) { ?>
											<p class="jobtitle"><?php echo $jobtitle ?></p>	
											<?php } ?>
											<?php if ($excerpt) { ?>
											<p class="excerpt"><?php echo $excerpt ?></p>	
											<?php } ?>

											<div class="buttondiv">
												<a href="<?php echo $pagelink ?>">Read More</a>
											</div>
										</div>
									</div>	
									<?php } ?>
								</div>
							</div>
						</div>	
						<?php $j++; } ?>
					<?php } else { ?>
						
						<div class="wrapper">
							<div class="flexbox">
								<?php foreach ($teams as $e) { 
								$postId = $e->ID;
								$name = $e->post_title;
								$photo = get_field('image',$postId);
								$bg = ($photo) ? ' style="background-image:url('.$photo['url'].')"':'';
								$jobtitle = get_field('title',$postId);
								$excerpt = get_field('experience',$postId);
								$excerpt = ($excerpt) ? strip_tags($excerpt) : '';
								$excerpt = ($excerpt) ? shortenText($excerpt,120,' ',' [...]') : '';
								?>
								<div class="info">
									<div class="pad">
										<div class="photo <?php echo ($photo) ? 'yes':'noimage'?>"<?php echo $bg ?>>
											<img src="<?php echo $px ?>" alt="" aria-hidden="true">
										</div>
										<h3 class="name"><?php echo $name; ?></h3>
										<?php if ($jobtitle) { ?>
										<p class="jobtitle"><?php echo $jobtitle ?></p>	
										<?php } ?>
										<?php if ($excerpt) { ?>
										<p class="excerpt"><?php echo $excerpt ?></p>	
										<?php } ?>
									</div>
								</div>	
								<?php } ?>
							</div>
						</div>

					<?php } ?>
					
				</div>
				<?php } ?>
		</section>

		<?php /*=== SECTION 3 ===*/ ?>
		<?php 
			$last_section_content = get_field('last_section_content'); 
			$lsBtnName = get_field('lsBtnName'); 
			$lsBtnLink = get_field('lsBtnLink'); 
		?>
		<section id="section3" data-anchor="page3" class="section section-teal subpage-section">
		    <div class="wrapper clear">
				<div class="top-text animated zoomIn wow text-center large-text" data-wow-delay="0.5s">
					<?php echo $last_section_content ?>

					<?php if ($lsBtnName && $lsBtnLink) { ?>
						<div class="buttondiv"><a class="morebtn" href="<?php echo $lsBtnLink ?>"><?php echo $lsBtnName ?></a></div>
					<?php } ?>
				</div>
			</div>
		</section>

	<?php } else { ?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- #primary -->
	<?php } ?>



<?php
get_footer();
