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
		<section id="blogs" data-anchor="page3" class="section subpage-section <?php echo ( get_the_content() ) ? 'hastoptext':'notoptext';?>">
				<?php
				$perpage = (get_field('pagenum','option')) ? get_field('pagenum','option') : 12;
				$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
				// $all = array(
				// 	'posts_per_page'=> -1,
				// 	'post_type'		=> 'post',
				// 	'post_status'	=> 'publish'
				// );
				// $allpost = get_posts($all);

				// $args = array(
				// 	'posts_per_page'=> $perpage,
				// 	'post_type'		=> 'post',
				// 	'post_status'	=> 'publish',
				// 	'paged'			=> $paged
				// );
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
										echo get_post_blog_posts($e);
									} ?>
								</div>
							</div>
						</div>	
						<?php $j++; } ?>

					<?php } else { 

						$excerpt = get_the_excerpt();
						$author = get_the_author($postId);
					    $author_fullname = ($author) ? ucwords($author) : ''; 
					    $author_firstname = get_the_author_meta('first_name',$authorId);
					    $author_lastname = get_the_author_meta('last_name',$authorId);
					    $fname =  array($author_firstname,$author_lastname);
					    if( $fname && array_filter($fname) ) {
					        $author_name = implode(" ", array_filter($fname) );
					        $author_fullname = ucwords($author_name);
					    }
					    $teaminfo = get_field('teaminfo','user_' . $authorId);
					    if($teaminfo) {
					        $authorFull = $teaminfo->post_title;
					        $bio_page = get_permalink($teaminfo->ID) . '#bio';
					        $author_fullname = '<a href="'.$bio_page.'">'.$authorFull.'</a>';
					    }
						?>
						
						<div class="wrapper">
							<div class="flexbox">
								<div class="info animated fadeIn wow">
							        <div class="pad">
							            <div class="photo <?php echo ($photo) ? 'yes':'noimage'?>"<?php echo $bg ?>>
							                <img src="<?php echo $px1 ?>" alt="" aria-hidden="true">
							            </div>
							            <h3 class="posttitle"><?php the_title(); ?></h3>
							            <?php if ( $author_fullname || $postdate ) { ?>
							                <div class="author nt">
							                    <?php if ($author_fullname) { ?>
							                        <div class="dt">
							                            Posted by: <strong style="text-transform: capitalize;"><?php echo $author_fullname ?></strong>
							                        </div>
							                    <?php } ?>
							                    <?php if ($postdate) { ?>
							                        <!-- <div class="dt">
							                            on <span><?php //echo $postdate ?></span>
							                        </div> -->
							                    <?php } ?>
							                </div>
							            <?php } ?>
							            
							            <?php if ($excerpt) { ?>
							            <!-- <p class="excerpt"><?php echo $excerpt ?></p>    -->
							            <?php } ?>

							            <div class="buttondiv">
							                <a href="<?php echo $pagelink ?>#info">Read More</a>
							            </div>
							        </div>
							    </div>
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
		<section id="blogs" data-anchor="page3" class="section subpage-section <?php echo ( get_the_content() ) ? 'hastoptext':'notoptext';?>">
				<?php
				$perpage = (get_field('pagenum','option')) ? get_field('pagenum','option') : 12;
				$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
				// $all = array(
				// 	'posts_per_page'=> -1,
				// 	'post_type'		=> 'post',
				// 	'post_status'	=> 'publish'
				// );
				// $allpost = get_posts($all);

				// $args = array(
				// 	'posts_per_page'=> $perpage,
				// 	'post_type'		=> 'post',
				// 	'post_status'	=> 'publish',
				// 	'paged'			=> $paged
				// );
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
										echo get_post_blog_posts($e);
									} ?>
								</div>
							</div>
						</div>	
						<?php $j++; } ?>

					<?php } else { 

						$excerpt = get_the_excerpt();
						$author = get_the_author($postId);
					    $author_fullname = ($author) ? ucwords($author) : ''; 
					    $author_firstname = get_the_author_meta('first_name',$authorId);
					    $author_lastname = get_the_author_meta('last_name',$authorId);
					    $fname =  array($author_firstname,$author_lastname);
					    if( $fname && array_filter($fname) ) {
					        $author_name = implode(" ", array_filter($fname) );
					        $author_fullname = ucwords($author_name);
					    }
					    $teaminfo = get_field('teaminfo','user_' . $authorId);
					    if($teaminfo) {
					        $authorFull = $teaminfo->post_title;
					        $bio_page = get_permalink($teaminfo->ID) . '#bio';
					        $author_fullname = '<a href="'.$bio_page.'">'.$authorFull.'</a>';
					    }
						?>
						
						<div class="wrapper">
							<div class="flexbox">
								<div class="info animated fadeIn wow">
							        <div class="pad">
							            <div class="photo <?php echo ($photo) ? 'yes':'noimage'?>"<?php echo $bg ?>>
							                <img src="<?php echo $px1 ?>" alt="" aria-hidden="true">
							            </div>
							            <h3 class="posttitle"><?php the_title(); ?></h3>
							            <?php if ( $author_fullname || $postdate ) { ?>
							                <div class="author nt">
							                    <?php if ($author_fullname) { ?>
							                        <div class="dt">
							                            Posted by: <strong style="text-transform: capitalize;"><?php echo $author_fullname ?></strong>
							                        </div>
							                    <?php } ?>
							                    <?php if ($postdate) { ?>
							                        <!-- <div class="dt">
							                            on <span><?php //echo $postdate ?></span>
							                        </div> -->
							                    <?php } ?>
							                </div>
							            <?php } ?>
							            
							            <?php if ($excerpt) { ?>
							            <!-- <p class="excerpt"><?php echo $excerpt ?></p>    -->
							            <?php } ?>

							            <div class="buttondiv">
							                <a href="<?php echo $pagelink ?>#info">Read More</a>
							            </div>
							        </div>
							    </div>
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
	<?php } ?>



<?php
get_footer();
