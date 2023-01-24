<?php
/**
 * Template Name: Board
 */
global $post;
$pageId = $post->ID;
get_header(); ?>

<style>.teams .buttondiv {display:none!important;}</style>

	<?php
	$banner = get_field('banner');
	$banner_src = ($banner) ? $banner['url'] : '';
	$banner_caption = get_field('banner_caption');
	?>
	
	
		
		<?php while ( have_posts() ) : the_post(); ?>
			<h1 style="display:none;"><?php the_title(); ?></h1>


      <?php if ($banner) { ?>
  			<?php /*=== SECTION 1 BANNER ===*/ ?>
  			<section id="section1"  data-anchor="page1" class="parallax-window section first-section section-one half" data-parallax="scroll" data-image-src="<?php echo $banner_src;?>">
  				<div class="wrapper clear">
  					<div class="banner-caption">
  						<?php if ($banner_caption) { ?>
  							<div class="caption animated zoomIn"><?php echo $banner_caption ?></div>
  						<?php } ?>
  					</div>
  				</div>
  			</section>
      <?php } ?>
			
			
  		<?php /*=== SECTION 2 ===*/ ?>
      <?php if ( get_the_content() ) { ?>
  			<div id="content"></div>
  			<section id="section2" data-anchor="page2" class="section subpage-section">
  			    <div class="wrapper clear">
  					<div class="intro about fadeInUp wow text-center large-text">
  						<?php the_content(); ?>
  					</div>
  				</div>
  			</section>
      <?php } ?>

		<?php endwhile; wp_reset_postdata(); ?>
	
		<?php /*=== SECTION 2 (Team Section) ===*/ ?>
		
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
    <section id="section3" data-anchor="page3" class="section subpage-section">
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
    </section>
		<?php } ?>


		<?php /*=== Learn More ===*/ ?>
		<?php  get_template_part( 'template-parts/content', 'learnmore' ); ?>

	

<?php
get_footer();
