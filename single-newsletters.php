<?php get_header(); ?>

<?php  
$post_type = get_post_type();
$parent_id = get_the_page_id('newsletter');
$banner = get_field('banner',$parent_id);
$banner_src = ($banner) ? $banner['url'] : '';
$banner_caption = get_field('banner_caption',$parent_id);
$px = get_bloginfo('template_url') . '/images/px.png';
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
		<div id="info"></div>
		<?php  
			$description = get_field('description');
			$photo = get_field('image');
			$issuedNum = get_field('issue');
			$issuedDate = get_field('date');
		?>
		<section id="texts" data-anchor="page2" class="section subpage-section">
		    <div class="wrapper clear animated fadeIn">

				<?php if ($photo) { ?>
				<aside class="single-sidebar <?php echo ($photo) ? 'yes':'no-image'?>">
					<?php if ($photo) { ?>
					<div class="swidget photo <?php echo ($photo) ? 'yes':'noimage'?>">
						<img class="pic" src="<?php echo $photo['url'] ?>" alt="<?php echo $photo['title'] ?>">
					</div>
					<?php } ?>
				</aside>
				<?php } ?>

				<article class="single-content singlepost <?php echo ($photo) ? 'half':'full'?>">
					<h1 class="pagetitle posttitle"><?php the_title(); ?></h1>
					<div class="post-info">
						<?php if ($issuedNum) { ?>
							<div class="dt">
								Issued #: <strong><?php echo $issuedNum ?></strong>
							</div>
						<?php } ?>
						<?php if ($issuedDate) { ?>
							<div class="dt">
								Date: <span><?php echo $issuedDate ?></span>
							</div>
						<?php } ?>
					</div>	
					<div class="details"><?php the_content(); ?></div>
				</article>


			</div>
		</section>
	
	<?php endwhile; ?>


<?php } else { ?>
	<div id="primary" class="full-content-area clear default-template">
		<main id="main" class="site-main wrapper clear" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part('template-parts/content','single-blog');

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php } ?>


<?php 
if($parent_id) {
$parent_title = get_the_title($parent_id);
$parent_link = get_permalink($parent_id);
?>
<section class="section section-gray section-cta">
	<div class="wrapper">
		<div class="buttondiv">
			<a href="<?php echo $parent_link; ?>"><i class="arrow fas fa-chevron-left"></i> Back to <?php echo $parent_title;?></a>
		</div>
	</div>
</section>
<?php } ?>



<?php
get_footer();
