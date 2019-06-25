<?php
$phone_number = get_field('phone_number','option');  
$address_1 = get_field('address_1','option');  
$address_2 = get_field('address_2','option');  
$address_3 = get_field('address_3','option');  

$linkedin = get_field('linkedin','option');
$facebook = get_field('facebook','option');
$twitter = get_field('twitter','option');

$arr = get_field('arr','option');
$disc = get_field('disclaimer','option');
?>
</div><!-- #content -->
	<footer id="footer" data-anchor="page6" class="section clear footer-section">
		<div class="wrapper">
			<div class="intro footer-info text-center">
				<h2 class="section-title"><?php echo get_bloginfo('name'); ?></h2>
				<?php if ($phone_number) { ?>
				<div class="phone"><?php echo $phone_number; ?></div>	
				<?php } ?>
				<?php if ($address_1) { ?>
				<div class="address add1"><?php echo $address_1; ?></div>	
				<?php } ?>
				<?php if ($address_2) { ?>
				<div class="address add2"><?php echo $address_2; ?></div>	
				<?php } ?>
				<?php if ($address_3) { ?>
				<div class="address add3"><?php echo $address_3; ?></div>	
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

				<div class="copyright">
					&copy; <?php echo date('Y') ?> <?php echo get_bloginfo('name'); ?><sup>TM</sup>. <?php if($arr)echo $arr; ?>
					<br><br>
					<?php if($disc)echo $disc; ?>
				</div>
			</div>
		</div>
	</footer>


<?php wp_footer(); ?>

</body>
</html>
