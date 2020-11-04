<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php //$nonce = wp_create_nonce('my-nonce'); ?>
	<meta http-equiv="Content-Security-Policy" content="default-src 'none' ; 


    font-src        https: 'self' 'unsafe-inline'
                    *.googleapis.com 
                    *.gstatic.com
                    *.typekit.net
                    *.fontawesome.com
                    *.google.com 
                    data:;

    img-src         https: 'self' 'unsafe-inline'
                    *.gravatar.com
                    *.fontawesome.com
                    *.google.com
                    *.facebook.com  
                    data:;

    style-src       https: 'unsafe-inline' 
                    *.googleapis.com 
                    *.typekit.net ;

    script-src      'self' 'unsafe-inline'
                    *.googleapis.com
                    *.fontawesome.com  ;

    manifest-src    'self' ;

    script-src-elem 'self' 'unsafe-inline'
                    *.facebook.net
                    *.google-analytics.com
                    *.googleapis.com
                    *.fontawesome.com
                    *.googletagmanager.com
                    *.google-analytics.com
                    *.google.com ;

    style-src-elem  'self' 'unsafe-inline'
                    *.typekit.net
                    *.fontawesome.com
                    *.googleapis.com ;

    frame-src       *.facebook.com
                    *.google.com
                    *.gstatic.com ;

    connect-src     *.google-analytics.com 
                    *.google-analytics.com 
                    https://stats.g.doubleclick.net ;
    child-src 'none' ; 
    object-src 'none' ;
    frame-ancestors 'none' ; ">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url') ?>/css/jquery.fullpage.min.css">


<!--
<script defer src="<?php bloginfo( 'template_url' ); ?>/assets/svg-with-js/js/fontawesome-all.js"></script>
-->
<script >var siteURL = '<?php echo get_site_url();?>';</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144338734-1"></script>
<script >
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-144338734-1');
</script>


<?php wp_head(); ?>
</head>
<?php 
$parent_id = '';
if(is_singular('team')) {
	$parent_id = get_the_page_id('team');
}
else if( is_singular('post') ) {
	$parent_id = get_the_page_id('blog');
}
else if( is_singular('resources') ) {
	$parent_id = get_the_page_id('resources');
}
else if( is_singular('newsletters') ) {
	$parent_id = get_the_page_id('newsletter');
}
else if( is_singular('press') ) {
	$parent_id = get_the_page_id('press-room');
}
$banner = ($parent_id) ? get_field('banner',$parent_id) : get_field('banner');
$has_banner = ($banner) ? 'hasHero':'noHero';
?>

<body <?php body_class($has_banner); ?>>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'acstarter' ); ?></a>

<div id="page" class="site">

	<?php get_template_part('template-parts/navigation'); ?>
	
	<div id="content" class="contentwrapper clear">


