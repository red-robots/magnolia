<?php
$phone_number = get_field('phone_number','option');  
// $address_1 = get_field('address_1','option');  
// $address_2 = get_field('address_2','option');  
// $address_3 = get_field('address_3','option');  
$address = array();
for($a=1; $a<=3; $a++) {
	$a_field = 'address_' . $a;
	$val = get_field($a_field,'option');
	if($val) {
		$address[] = $val;
	}
}

$linkedin = get_field('linkedin','option');
$facebook = get_field('facebook','option');
$twitter = get_field('twitter','option');

$arr = get_field('arr','option');
$disc = get_field('disclaimer','option');
$legal_disclaimer = get_field('legal_disclaimer','option');
?>
</div><!-- #content -->
	<footer id="footer" data-anchor="page6" class="section clear site-footer footer-section">
		<div class="wrapper">
			<div class="intro footer-info col-left">
				<h2 class="section-title wtm"><?php echo get_bloginfo('name'); ?><sup>TM</sup></h2>
				<?php if ($phone_number) { ?>
				<div class="phone"><?php echo $phone_number; ?></div>	
				<?php } ?>

				<?php if ($address) { ?>
					<?php foreach ($address as $adr) { ?>
						<div class="address"><?php echo $adr; ?></div>	
					<?php  } ?>
				<?php } ?>

				<?php if ($linkedin || $facebook || $twitter) { ?>
				<div class="social-links">
					<?php if ($linkedin) { ?>
					<a href="<?php echo $linkedin; ?>" target="_blank"><i class="fab fa-linkedin-in"></i><span class="sr-only">Linkedin</span></a>
					<?php } ?>
					<?php if ($facebook) { ?>
					<a href="<?php echo $facebook; ?>" target="_blank"><i class="fab fa-facebook-f"></i><span class="sr-only">Facebook</span></a>
					<?php } ?>
					<?php if ($twitter) { ?>
					<a href="<?php echo $twitter; ?>" target="_blank"><i class="fab fa-twitter"></i><span class="sr-only">Twitter</span></a>
					<?php } ?>
				</div>
				<?php } ?>

				<div class="copyright clear">
					&copy; <?php echo date('Y') ?> <?php echo get_bloginfo('name'); ?><sup>TM</sup>. <?php if($arr)echo $arr; ?>
				</div>
			</div>
		</div>
	</footer>


<?php wp_footer(); ?>

</body>
</html>
