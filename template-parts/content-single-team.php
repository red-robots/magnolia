<?php  
$photo = get_field('image');
$bg = ($photo) ? ' style="background-image:url('.$photo['url'].')"':'';
$jobtitle = get_field('title');
$email = get_field('email');
$phone_number = get_field('phone_number');
$excerpt = get_field('experience');
$px = get_bloginfo('template_url') . '/images/px2.png';
$education = get_field('education');
$experience = get_field('experience');
$professional_affiliations = get_field('professional_affiliations');
$community_involvement = get_field('community_involvement');
?>

<aside class="single-sidebar">
	<?php if ($photo) { ?>
	<div class="swidget photo <?php echo ($photo) ? 'yes':'noimage'?>">
		<img class="pic" src="<?php echo $photo['url'] ?>" alt="<?php echo $photo['title'] ?>">
	</div>
	<?php } ?>

	<?php if ($education) { ?>
		<div class="swidget teaminfo">
			<h3 class="hd3">Education</h3>
			<div class="educations">
				<?php foreach ($education as $ed) { 
				$school = $ed['school'];
				$degree = $ed['degree_and_year'];
				?>
				<div class="info">
					<div class="school"><?php echo $school ?></div>
					<div class="degree"><?php echo $degree ?></div>
				</div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>

	<?php if ($professional_affiliations) { ?>
		<div class="swidget teaminfo">
			<h3 class="hd3">Professional Affiliations</h3>
			<div class="affiliations">
				<?php foreach ($professional_affiliations as $a) { 
				$affiliation = $a['affiliation']; ?>
				<div class="info">
					<div class="aff"><?php echo $affiliation ?></div>
				</div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>

	<?php if ($community_involvement) { ?>
		<div class="swidget teaminfo">
			<h3 class="hd3">Community Involvement</h3>
			<div class="affiliations">
				<?php foreach ($community_involvement as $ci) { 
				$involvement = $ci['community_involvement']; ?>
					<?php if ($involvement) { ?>
					<div class="info">
						<div class="aff"><?php echo $involvement ?></div>
					</div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
	
</aside>

<article class="single-content staffinfo">
	<h1 class="pagetitle staffname"><?php the_title(); ?></h1>
	<?php if ($jobtitle) { ?>
	<div class="jobtitle"><?php echo $jobtitle ?></div>	
	<?php } ?>
	<?php if ($email) { ?>
	<div class="email ilink"><a href="mailto:<?php echo antispambot($email,1) ?>"><?php echo antispambot($email); ?></a></div>	
	<?php } ?>
	<?php if ($phone_number) { ?>
	<div class="phone ilink"><a href="tel:<?php echo format_phone_number($phone_number) ?>"><?php echo $phone_number ?></a></div>	
	<?php } ?>
	
	<?php if ($experience) { ?>
	<h3 class="hd3">Experience</h3>
	<div class="details"><?php echo $experience ?></div>
	<?php } ?>
	

</article>