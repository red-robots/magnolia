<?php
/**
 * Template Name: Resources
 */
global $post;
$pageId = $post->ID;
$currentURL = get_permalink($pageId);
$is_external_link = ( isset($_GET['external']) && $_GET['external'] ) ? true : false;
$dFile = ( isset($_GET['download']) && $_GET['download'] ) ?  base64_decode( $_GET['download'] ) :  '';

$file_extensions = array('pdf','doc','docx','xlsx','xls','ods','ppt','pptx','txt','jpg','jpeg','png','gif');

if( $dFile &&  $is_external_link ) {

	$path = pathinfo($dFile);
	$ext = ( isset($path['extension']) && $path['extension'] ) ? strtolower($path['extension']) : '';
	if( $ext && in_array($ext, $file_extensions) ) {
		header("Content-Description: File Transfer"); 
		header("Content-Type: application/octet-stream"); 
		header("Content-Disposition: attachment; filename=" . basename($dFile));
		readfile ($dFile);
		exit();
	}

} else {

	if( $dFile ) {
		header("Content-Description: File Transfer"); 
		header("Content-Type: application/octet-stream"); 
		header("Content-Disposition: attachment; filename=" . basename($dFile));
		readfile ($dFile);
		exit();
	}

}

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
					'post_type'		=> 'resources',
					'post_status'	=> 'publish'
				);
				$resources = get_posts($args);
				$total = ($resources) ? count($resources) : 0;
				$px1 = get_bloginfo('template_url') . '/images/px.png';
				$px2 = get_bloginfo('template_url') . '/images/px2.png';
				if ( $resources ) {  ?>
				<div class="blogs clear">
					
					<?php if ($total>3) { $lists = array_chunk($resources,3); ?>
						<?php $j=1; foreach ($lists as $list) { ?>
						<div class="group <?php echo ($j%2==0) ? 'even':'odd'?>">
							<div class="wrapper">
								<div class="flexbox">
									<?php foreach ($list as $e) { 
									$postId = $e->ID;
									$name = $e->post_title;
									$photo = get_field('icon',$postId);
									$bg = ($photo) ? ' style="background-image:url('.$photo['url'].')"':'';
									$jobtitle = get_field('title',$postId);
									$excerpt = get_field('description',$postId);
									$pagelink = get_permalink($postId);
									$buttonLabel = get_field('button_name',$postId);
									$download_type = get_field('download',$postId);
									$download_link = '';
									$is_external = '';
									$blank_target = '';
									if($download_type=='Upload File') {
										if( $file = get_field('upload_file',$postId) ) {
											//$download_link = $file['url'] . '?download=yes';
											$encrypt = base64_encode($file['url']);
											$download_link = $currentURL . '?download=' .$encrypt;
										}
									} else if($download_type=='External Link') {
										if( $link = get_field('external_link',$postId) ) {
											$is_external = $link;
											//$download_link = $link;
											$encrypt = base64_encode($link);

											$i_path = pathinfo($link);
											$i_ext = ( isset($i_path['extension']) && $i_path['extension'] ) ? strtolower($i_path['extension']) : '';

											if( $i_ext && in_array($i_ext, $file_extensions) ) {
												$download_link = $currentURL . '?download=' .$encrypt . '&external=1';
											} else {
												$blank_target = ' target="_blank"';
												$download_link = $link;
											}
											
										}
									}
									?>
									<div class="info">
										<div class="pad">
											<div class="photo iconpic <?php echo ($photo) ? 'yes':'noimage'?>"<?php echo $bg ?>>
												<img src="<?php echo $px1 ?>" alt="" aria-hidden="true">
											</div>
											<h3 class="name nt"><?php echo $name; ?></h3>
											<?php if ($excerpt) { ?>
											<div class="description"><?php echo $excerpt ?></div>	
											<?php } ?>

											<?php if ($buttonLabel && $download_link) { ?>
												<div class="buttondiv">
													<a href="<?php echo $download_link ?>"<?php echo $blank_target ?>><?php echo $buttonLabel ?></a>
												</div>
											<?php } ?>

										</div>
									</div>	
									<?php } ?>
								</div>
							</div>
						</div>	
						<?php $j++; } ?>
					<?php } else { ?>
					
					<div class="wrapper-fullwidth clear gray">
						<div class="wrapper">
							<div class="flexbox">
								<?php foreach ($resources as $e) { 
									$postId = $e->ID;
									$name = $e->post_title;
									$photo = get_field('icon',$postId);
									$bg = ($photo) ? ' style="background-image:url('.$photo['url'].')"':'';
									$jobtitle = get_field('title',$postId);
									$excerpt = get_field('description',$postId);
									$pagelink = get_permalink($postId);
									$buttonLabel = get_field('button_name',$postId);
									$download_type = get_field('download',$postId);
									$download_link = '';
									$is_external = '';
									$blank_target = '';
									if($download_type=='Upload File') {
										if( $file = get_field('upload_file',$postId) ) {
											//$download_link = $file['url'] . '?download=yes';
											$encrypt = base64_encode($file['url']);
											$download_link = $currentURL . '?download=' .$encrypt;
										}
									} else if($download_type=='External Link') {
										if( $link = get_field('external_link',$postId) ) {
											$is_external = $link;
											//$download_link = $link;
											$encrypt = base64_encode($link);

											$i_path = pathinfo($link);
											$i_ext = ( isset($i_path['extension']) && $i_path['extension'] ) ? strtolower($i_path['extension']) : '';

											if( $i_ext && in_array($i_ext, $file_extensions) ) {
												$download_link = $currentURL . '?download=' .$encrypt . '&external=1';
											} else {
												$blank_target = ' target="_blank"';
												$download_link = $link;
											}
											
										}
									}
									?>
									<div class="info">
										<div class="pad">
											<div class="photo iconpic <?php echo ($photo) ? 'yes':'noimage'?>"<?php echo $bg ?>>
												<img src="<?php echo $px1 ?>" alt="" aria-hidden="true">
											</div>
											<h3 class="name nt"><?php echo $name; ?></h3>
											<?php if ($excerpt) { ?>
											<div class="description"><?php echo $excerpt ?></div>	
											<?php } ?>

											<?php if ($buttonLabel && $download_link) { ?>
												<div class="buttondiv">
													<a href="<?php echo $download_link ?>"<?php echo $blank_target ?>><?php echo $buttonLabel ?></a>
												</div>
											<?php } ?>

										</div>
									</div>	
									<?php } ?>
							</div>
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
