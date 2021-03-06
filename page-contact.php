<?php
/**
 * Template Name: Contact Us
 */

get_header(); ?>

	<?php
	$banner = get_field('banner');
	$banner_src = ($banner) ? $banner['url'] : '';
	$banner_caption = get_field('banner_caption');
	$form = get_field('form');
	?>
	 
	<?php if ($banner) { ?>

	<?php while ( have_posts() ) : the_post(); ?>
		
		<h1 style="display:none;"><?php the_title(); ?></h1>

		<?php /*=== SECTION 1 ===*/ ?>
		<section id="section1" class="parallax-window section first-section section-one half" data-parallax="scroll" data-image-src="<?php echo $banner_src;?>">
			<div class="wrapper clear">
				<div class="banner-caption">
					<?php if ($banner_caption) { ?>
						<div class="caption animated zoomIn"><?php echo $banner_caption ?></div>
					<?php } ?>
				</div>
			</div>
		</section>
		

		<?php /*=== SECTION 2 ===*/ ?>
		<?php if( get_the_content() ) { ?>
		<div id="contactform"></div>
		<section class="section subpage-section contactpage">
		    <div class="wrapper clear">
				<div class="intro about animated fadeIn wow text-center large-text">
					<?php ob_start(); ?>
					<?php the_content(); ?>
					<?php 
						$content = ob_get_contents(); 
						ob_end_clean();
						$content = ($content) ? email_obfuscator($content) : '';
						echo $content;
					?>
				</div>
				<?php if ($form) { ?>
					<div id="contact" class="intro contactus text-center">
						<div class="contact-text clear fadeIn wow">
							<?php echo $form; ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</section>
		<?php } ?>
		

		<?php /*=== Learn More ===*/ ?>
		<?php  get_template_part( 'template-parts/content', 'learnmore' ); ?>
		
	
	<?php endwhile; ?>

	<?php } else { ?>
		<div id="primary" class="full-content-area clear default-template">
			<main id="main" class="site-main wrapper clear" role="main">

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
