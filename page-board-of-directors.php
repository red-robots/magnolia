<?php
/**
 * Template Name: Board
 */
global $post;
$pageId = $post->ID;
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
			<section id="section1"  data-anchor="page1" class="parallax-window section first-section section-one half" data-parallax="scroll" data-image-src="<?php echo $banner_src;?>">
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
					<div class="intro about fadeInUp wow text-center large-text">
						<?php the_content(); ?>
					</div>
				</div>
			</section>

		<?php endwhile; wp_reset_postdata(); ?>
	
		<?php /*=== SECTION 2 (Team Section) ===*/ ?>
		<section id="section3" data-anchor="page3" class="section subpage-section">
				<?php
				$args = array(
					'posts_per_page'=> -1,
					'post_type'		=> 'team',
					'post_status'	=> 'publish',
					'tax_query' => array(
						array(
							'taxonomy' => 'team_type', // your custom taxonomy
							'field' => 'slug',
							'terms' => array( 'board-of-directors' ) // the terms (categories) you created
						)
					)
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
										echo get_team_posts($e);
									} ?>
								</div>
							</div>
						</div>	
						<?php $j++; } ?>
					<?php } else { ?>
						
						<div class="wrapper">
							<div class="flexbox">
								<?php foreach ($teams as $e) { 
									echo get_team_posts($e); 
								} ?>
							</div>
						</div>

					<?php } ?>
					
				</div>
				<?php } ?>
		</section>

		<?php /*=== Learn More ===*/ ?>
		<?php  get_template_part( 'template-parts/content', 'learnmore' ); ?>

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
