<?php
/**
 * Template Name: Newsletter
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
			<?php if ( get_the_content() ) { ?>
			<section id="section2" data-anchor="page2" class="section subpage-section">
			    <div class="wrapper clear">
					<div class="intro fadeInUp wow text-center large-text">
						<?php the_content(); ?>
					</div>
				</div>
			</section>
			<?php } ?>

		<?php endwhile; wp_reset_postdata(); ?>
	
		<?php /*=== Newsleter Feeds ===*/ ?>
		<section id="posts" data-anchor="page3" class="section subpage-section">
				<?php
				$perpage = (get_field('pagenum','option')) ? get_field('pagenum','option') : 12;
				$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
				$posttype = 'newsletters';
				$all = array(
					'posts_per_page'=> -1,
					'post_type'		=> $posttype,
					'post_status'	=> 'publish'
				);
				$allpost = get_posts($all);

				$args = array(
					'posts_per_page'=> $perpage,
					'post_type'		=> $posttype,
					'post_status'	=> 'publish',
					'paged'			=> $paged
				);
				$queried = new WP_Query($args);
				$blogs = get_posts($args);
				
				$total = ($allpost) ? count($allpost) : 0;
				$px1 = get_bloginfo('template_url') . '/images/px.png';
				$px2 = get_bloginfo('template_url') . '/images/px2.png';
				if ( $blogs ) {  ?>
				<div class="blogs clear">
					
					<?php if ($total>3) { $lists = array_chunk($blogs,3); ?>

						<?php $j=1; foreach ($lists as $list) { ?>
						<div class="group <?php echo ($j%2==0) ? 'even':'odd'?>">
							<div class="wrapper">
								<div class="flexbox">
									<?php foreach ($list as $e) { 
									$postId = $e->ID;
									$name = $e->post_title;
									$photo = get_field('image',$postId);
									$bg = ($photo) ? ' style="background-image:url('.$photo['url'].')"':'';
									$author = get_the_author($postId);
									$excerpt = $e->post_content;
									$excerpt = ($excerpt) ? strip_tags($excerpt) : '';
									$excerpt = ($excerpt) ? shortenText($excerpt,120,' ',' [...]') : '';
									$pagelink = get_permalink($postId);
									$postdate = get_the_date('F j, Y',$postId);
									$issuedNum = get_field('issue',$postId);
									$issuedDate = get_field('date',$postId);
									?>
									<div class="info">
										<div class="pad">
											<div class="photo <?php echo ($photo) ? 'yes':'noimage'?>"<?php echo $bg ?>>
												<img src="<?php echo $px1 ?>" alt="" aria-hidden="true">
											</div>
											<h3 class="posttitle"><?php echo $name; ?></h3>
											<div class="author">
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
								<?php foreach ($blogs as $e) { 
									$postId = $e->ID;
									$name = $e->post_title;
									$photo = get_field('image',$postId);
									$bg = ($photo) ? ' style="background-image:url('.$photo['url'].')"':'';
									$author = get_the_author($postId);
									$excerpt = $e->post_content;
									$excerpt = ($excerpt) ? strip_tags($excerpt) : '';
									$excerpt = ($excerpt) ? shortenText($excerpt,120,' ',' [...]') : '';
									$pagelink = get_permalink($postId);
									$postdate = get_the_date('F j, Y',$postId);
									$issuedNum = get_field('issue',$postId);
									$issuedDate = get_field('date',$postId);
									?>
									<div class="info">
										<div class="pad">
											<div class="photo <?php echo ($photo) ? 'yes':'noimage'?>"<?php echo $bg ?>>
												<img src="<?php echo $px1 ?>" alt="" aria-hidden="true">
											</div>
											<h3 class="posttitle"><?php echo $name; ?></h3>
											<div class="author">
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
											<div class="buttondiv">
												<a href="<?php echo $pagelink ?>">Read More</a>
											</div>
										</div>
									</div>	
								<?php } ?>
							</div>
						</div>

					<?php } ?>
					
				</div>

				<?php
				    $total_pages = $queried->max_num_pages;
				    if ($total_pages > 1){ ?>

				        <div id="pagination" data-section="#posts" class="pagination wrapper">
				            <?php
				                $pagination = array(
				                    'base' => @add_query_arg('pg','%#%'),
				                    'format' => '?paged=%#%',
				                    'mid-size' => 1,
				                    'current' => $paged,
				                    'total' => $total_pages,
				                    'prev_next' => True,
				                    'prev_text' => __( '<span class="fas fa-chevron-left"></span>' ),
				                    'next_text' => __( '<span class="fas fa-chevron-right"></span>' )
				                );
				                echo paginate_links($pagination);
				            ?>
				        </div>
				        <?php
				} ?>

				<?php } ?>
		</section>


		<?php /*=== Subscription ===*/ ?>
		<?php if ( $subscribe = get_field('subscribe') ) { ?>
		<section id="section2" data-anchor="page2" class="section section-gray subpage-section subscribe">
		    <div class="wrapper clear">
				<div class="intro fadeInUp wow text-center large-text">
					<?php echo $subscribe; ?>
				</div>
			</div>
		</section>
		<?php } ?>

		<?php /*=== Learn More ===*/ ?>
		<?php  get_template_part( 'template-parts/content', 'learnmore' ); ?>

	<?php } else { ?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main wrapper" role="main">

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
