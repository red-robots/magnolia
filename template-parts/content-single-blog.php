<?php  
// $photo = get_field('image');
// $bg = ($photo) ? ' style="background-image:url('.$photo['url'].')"':'';
// $jobtitle = get_field('title');
// $email = get_field('email');
// $phone_number = get_field('phone_number');
// $excerpt = get_field('experience');
// $px = get_bloginfo('template_url') . '/images/px2.png';
// $education = get_field('education');
// $experience = get_field('experience');
// $professional_affiliations = get_field('professional_affiliations');

$px = get_bloginfo('template_url') . '/images/px.png';
$postId = get_the_ID();
$thumbId = get_post_thumbnail_id( $postId );
$imageMeta = get_posts(array('p' => $thumbId, 'post_type' => 'attachment'));
$imageAlt = ($imageMeta) ? $imageMeta[0]->post_title : '';

$photo = wp_get_attachment_image_src($thumbId,'large');
$bg = ($photo) ? ' style="background-image:url('.$photo[0].')"':'';
$author = get_the_author($postId);
$excerpt = get_the_content('experience',$postId);
$excerpt = ($excerpt) ? strip_tags($excerpt) : '';
$excerpt = ($excerpt) ? shortenText($excerpt,120,' ',' [...]') : '';
$pagelink = get_permalink($postId);
$postdate = get_the_date('F j, Y',$postId);
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
	<p class="post-info">
		Posted by: <strong class="author"><?php echo $author ?></strong> on: <?php echo $postdate; ?>
	</p>
	
	<div class="details"><?php the_content(); ?></div>

</article>