<?php 
/*
 * Template Name: Locations
 */
get_header(); 
?>

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

        <?php if ( get_the_content() ) { ?>
        <div class="intro about animated fadeIn wow text-center large-text">
          <?php the_content(); ?>
        </div>
        <?php } ?>


        <?php  
        $locations = get_field('locations');
        if($locations) { ?>

        <div class="section-locations">
          <?php foreach ($locations as $a) { 
            $name = $a['name'];
            $address = $a['address'];
            $map = $a['google_map_embed'];
            $hasColumn = ( ($name || $address) && $map ) ? 'twocol':'full';
          ?>
          <div class="details <?php echo $hasColumn ?>">
            <?php if ($name || $address) { ?>
            <div class="infocol address-info">
              <?php if ($name) { ?>
                <h3><?php echo $name ?></h3>
              <?php } ?>
              <?php if ($address) { ?>
                <address>
                  <div class="subhead"><strong>Office Address:</strong></div>
                  <div class="address"><?php echo $address ?></div>
                </address>
              <?php } ?>
            </div>  
            <?php } ?>

            <?php if ($map) { ?>
            <div class="infocol map-info">
              <?php echo $map ?>
              <img src="<?php echo get_stylesheet_directory_uri() ?>/images/resizer.png" class="resizer" alt="resizer" aria-hidden="true">
            </div>
            <?php } ?>
          </div>
          <?php } ?>
        </div>

        <?php } ?>
				
			</div>
		</section>


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
