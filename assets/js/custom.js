/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {
	
	var unAnimateLogo = function(){
	  $("#site_logo").removeClass('animateThis');
	};
	setTimeout(unAnimateLogo, 3000);

	$("#animateLogo").click(function(){
		$("#site_logo").addClass("animateThis");
		setTimeout(unAnimateLogo, 3000);
	});

	var animateTaglineBorder = function(){
	  $(".tagline.orig").addClass('animatedLine');
	};
	setTimeout(animateTaglineBorder, 3000);

	$('#fullpage').fullpage({
		scrollBar:false,
		lazyLoading:true,
		autoScrolling:true,
		scrollingSpeed: 1000,
		responsiveWidth: 900,
		responsiveHeight: 600,
		autoScrolling: true,
		fitToSection:false,
		afterLoad: function(anchorLink, index){
			var loadedSection = $(this);
			$("#site_logo").addClass("animateThis show");
			setTimeout(unAnimateLogo, 3000);
			loadedSection.find('.about').addClass('fadeInUp');
		},
		onLeave: function(anchorLink, index){
			$("#site_logo").removeClass('show');
			var loadedSection = $(this);
			loadedSection.find('.about').removeClass('fadeInUp');
		}
	});

	/*
	*
	*	Responsive iFrames
	*
	------------------------------------*/
	var $all_oembed_videos = $("iframe[src*='youtube']");
	
	$all_oembed_videos.each(function() {
	
		$(this).removeAttr('height').removeAttr('width').wrap( "<div class='embed-container'></div>" );
 	
 	});
	
	/*
	*
	*	Flexslider
	*
	------------------------------------*/
	$('.flexslider').flexslider({
		animation: "slide",
	}); // end register flexslider
	
	/*
	*
	*	Colorbox
	*
	------------------------------------*/
	$('a.gallery').colorbox({
		rel:'gal',
		width: '80%', 
		height: '80%'
	});

	
	/*
	*
	*	Equal Heights Divs
	*
	------------------------------------*/
	$('.js-blocks').matchHeight();

	/*
	*
	*	Wow Animation
	*
	------------------------------------*/
	new WOW().init();


	$(document).on("click","#toggleMenu",function(){
		$(this).toggleClass('open');
		$('.mobile-navigation').toggleClass('open');
		$('body').toggleClass('open-mobile-menu');
		$('.site-header .logo').toggleClass('fixed');
		var parentdiv = $(".mobile-navigation").outerHeight();
		var mobile_nav_height = $(".mobile-main-nav").outerHeight();
		if(mobile_nav_height>parentdiv) {
			$('.mobile-navigation').addClass("overflow-height");
		}
	});





// $('#fullpage').fullpage({
// 		scrollBar:true,
// 		lazyLoading:true,
// 		autoScrolling:false,
// 		responsiveWidth: 900,
// 		responsiveHeight: 500,
// 		scrollBar: true,
// 		fitToSection:false,
// 		parallax: true,
// 		parallaxOptions: {
// 			type: 'reveal',
// 			percentage: 62,
// 			property: 'translate'
// 		},
// 		afterLoad: function(anchorLink, index){
// 			var loadedSection = $(this);
			
// 		}
// 	});

// 	initialize(false);

// function initialize(hasScrollBar){
// 	new fullpage('#myContainer', {
// 		anchors: ['firstPage', 'secondPage', '3rdPage', '4thpage'],
// 		menu: '#menu',
// 		slidesNavigation: true,
// 		parallax: true,
// 		parallaxOptions: {
// 			type: 'reveal',
// 			percentage: 62,
// 			property: 'translate'
// 		},
// 		scrollingSpeed: 1000,
// 		autoScrolling: true,
// 		scrollBar: hasScrollBar,
// 		fitToSection:false
// 	});
// }



});// END #####################################    END