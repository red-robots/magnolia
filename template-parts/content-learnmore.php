<?php 
	$last_section_content = get_field('last_section_content'); 
	$lsBtnName = get_field('lsBtnName'); 
	$lsBtnLink = get_field('lsBtnLink'); 
?>
<?php if ($last_section_content) { ?>
<section id="section3" data-anchor="page3" class="section section-teal subpage-section">
    <div class="wrapper clear fadeIn wow">
		<div class="top-text text-center large-text" data-wow-delay="0.5s">
			<?php echo $last_section_content ?>

			<?php if ($lsBtnName && $lsBtnLink) { ?>
				<div class="buttondiv"><a class="morebtn" href="<?php echo $lsBtnLink ?>"><?php echo $lsBtnName ?></a></div>
			<?php } ?>
		</div>
	</div>
</section>
<?php } ?>