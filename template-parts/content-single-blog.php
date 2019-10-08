<?php  
global $post;
//global $authordata;

$px = get_bloginfo('template_url') . '/images/px.png';
$postId = get_the_ID();
$thumbId = get_post_thumbnail_id( $postId );
$imageMeta = get_posts(array('p' => $thumbId, 'post_type' => 'attachment'));
$imageAlt = ($imageMeta) ? $imageMeta[0]->post_title : '';

$photo = wp_get_attachment_image_src($thumbId,'large');
$bg = ($photo) ? ' style="background-image:url('.$photo[0].')"':'';
$author_id = $post->post_author;
$author = get_the_author($postId);
$author_fullname = ($author) ? ucwords($author) : ''; 
$author_firstname = get_the_author_meta('first_name',$author_id);
$author_lastname = get_the_author_meta('last_name',$author_id);
$fname =  array($author_firstname,$author_lastname);
if( $fname && array_filter($fname) ) {
	$author_name = implode(" ", array_filter($fname) );
	$author_fullname = ucwords($author_name);
}
$excerpt = get_the_content('experience',$postId);
$excerpt = ($excerpt) ? strip_tags($excerpt) : '';
$excerpt = ($excerpt) ? shortenText($excerpt,120,' ',' [...]') : '';
$pagelink = get_permalink($postId);
$postdate = get_the_date('F j, Y',$postId);
$teaminfo = get_field('teaminfo','user_' . $author_id);
if($teaminfo) {
	$authorFull = $teaminfo->post_title;
	$bio_page = get_permalink($teaminfo->ID) . '#bio';
	$author_fullname = '<a href="'.$bio_page.'">'.$authorFull.'</a>';
}
?>

<?php if ($photo) { ?>
<aside class="single-sidebar <?php echo ($photo) ? 'yes':'no-image'?>">
	<?php if ($photo) { ?>
	<div class="swidget photo <?php echo ($photo) ? 'yes':'noimage'?>">
		<img class="pic" src="<?php echo $photo[0] ?>" alt="<?php echo $imageAlt ?>">
	</div>
	<?php } ?>
</aside>
<?php } ?>

<article class="single-content singlepost <?php echo ($photo) ? 'half':'full'?>">
	<h1 class="pagetitle posttitle"><?php the_title(); ?></h1>
	<div class="post-info clear">
		<div class="authordiv">
			Posted by: <strong class="author"><?php echo $author_fullname ?></strong>
		</div>
		<div class="socialshare">
			<span id="shareitBtn" data-rel=".social-buttons" class="socbtn">
				<span><i class="fas fa-share-alt-square"></i></span>
			</span>
			<a id="contactUsBtn" class="socbtn" href="<?php echo get_permalink(256); ?>#contactform"><span>Contact Us</span></a>
			<div class="social-buttons">
				<?php echo do_shortcode("[social_share_button themes='theme10']"); ?>
			</div>
		</div>
		
	</div>
	
	<div class="details"><?php the_content(); ?></div>
	
	<div class="bottomButton buttondiv">
		<a href="<?php echo get_site_url() ?>/contact/#contactform" class="defaultbtn">Contact Us</a>
	</div>
</article>