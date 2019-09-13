<?php
/**
 * Template Name: Blog
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
					<div class="intro about fadeInUp wow text-center large-text">
						<?php the_content(); ?>
					</div>
				</div>
			</section>
			<?php } ?>

		<?php endwhile; wp_reset_postdata(); ?>
	
		<?php /*=== SECTION 2 (Blogs) ===*/ ?>
		<section id="blogs" data-anchor="page3" class="section subpage-section">
				<?php
				$perpage = (get_field('pagenum','option')) ? get_field('pagenum','option') : 12;
				$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
				$all = array(
					'posts_per_page'=> -1,
					'post_type'		=> 'post',
					'post_status'	=> 'publish'
				);
				$allpost = get_posts($all);

				$args = array(
					'posts_per_page'=> $perpage,
					'post_type'		=> 'post',
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
										$thumbId = get_post_thumbnail_id( $postId );
										$photo = wp_get_attachment_image_src($thumbId,'large');
										$bg = ($photo) ? ' style="background-image:url('.$photo[0].')"':'';
										$authorId = $e->post_author;
										$user = get_userdata($authorId);
										$author = ( isset($user->data->display_name) && $user->data->display_name ) ? $user->data->display_name : ''; 
										$excerpt = get_the_content($postId);
										$excerpt = ($excerpt) ? strip_tags($excerpt) : '';
										$excerpt = ($excerpt) ? shortenText($excerpt,120,' ',' [...]') : '';
										$pagelink = get_permalink($postId);
										$date = $e->post_date;
										$postdate = ($date) ? date('F j, Y',strtotime($date)) : ''; ?>
										<div class="info">
											<div class="pad">
												<div class="photo <?php echo ($photo) ? 'yes':'noimage'?>"<?php echo $bg ?>>
													<img src="<?php echo $px1 ?>" alt="" aria-hidden="true">
												</div>
												<h3 class="posttitle"><?php echo $name; ?></h3>
												<?php if ( $author || $postdate ) { ?>
													<div class="author nt">
														<?php if ($author) { ?>
															<div class="dt">
																Posted by: <strong style="text-transform: capitalize;"><?php echo $author ?></strong>
															</div>
														<?php } ?>
														<?php if ($postdate) { ?>
															<div class="dt">
																on <span><?php echo $postdate ?></span>
															</div>
														<?php } ?>
													</div>
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
								<?php foreach ($blogs as $e) { 
									$postId = $e->ID;
									$name = $e->post_title;
									$thumbId = get_post_thumbnail_id( $postId );
									$photo = wp_get_attachment_image_src($thumbId,'large');
									$bg = ($photo) ? ' style="background-image:url('.$photo[0].')"':'';
									$authorId = $e->post_author;
									$user = get_userdata($authorId);
									$author = ( isset($user->data->display_name) && $user->data->display_name ) ? $user->data->display_name : ''; 
									$excerpt = get_the_content($postId);
									$excerpt = ($excerpt) ? strip_tags($excerpt) : '';
									$excerpt = ($excerpt) ? shortenText($excerpt,120,' ',' [...]') : '';
									$pagelink = get_permalink($postId);
									$date = $e->post_date;
									$postdate = ($date) ? date('F j, Y',strtotime($date)) : ''; ?>
									<div class="info">
										<div class="pad">
											<div class="photo <?php echo ($photo) ? 'yes':'noimage'?>"<?php echo $bg ?>>
												<img src="<?php echo $px1 ?>" alt="" aria-hidden="true">
											</div>
											<h3 class="posttitle"><?php echo $name; ?></h3>
											<?php if ( $author || $postdate ) { ?>
												<div class="author nt">
													<?php if ($author) { ?>
														<div class="dt">
															Posted by: <strong style="text-transform: capitalize;"><?php echo $author ?></strong>
														</div>
													<?php } ?>
													<?php if ($postdate) { ?>
														<div class="dt">
															on <span><?php echo $postdate ?></span>
														</div>
													<?php } ?>
												</div>
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

					<?php } ?>
					
				</div>

				<?php
				    $total_pages = $queried->max_num_pages;
				    if ($total_pages > 1){ ?>

				        <div id="pagination" data-section="#blogs" class="pagination wrapper">
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
