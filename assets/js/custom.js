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
		scrollingSpeed: 1000,
		responsiveWidth: 900,
		responsiveHeight: 700,
		autoScrolling: true,
		fitToSection: false,
		scrollOverflow: true,
		anchors: ['page1', 'page2', 'page3','page4'],
		afterLoad: function(anchorLink, index){
			var loadedSection = $(this);
			$("#site_logo").addClass("animateThis show");
			setTimeout(unAnimateLogo, 3000);
			loadedSection.find('.about').addClass('fadeInUp');
			//$("body").addClass('scrolled');
		},
		onLeave: function(anchorLink, index){
			$("#site_logo").removeClass('show');
			var loadedSection = $(this);
			loadedSection.find('.about').removeClass('fadeInUp');
			//$("body").removeClass('scrolled');
		}
	});

	// var myFullpage = new fullpage('#fullpage', {
 //        anchors: ['firstPage', 'secondPage', '3rdPage', '4thPage'],
 //        scrollOverflow: true
 //    });

	$(window).scroll(function() {    
	    var scroll = $(window).scrollTop();
	     //>=, not <=
	   if (scroll >= 300) {
	        $("body").addClass('scrolled');
	    } else {
	    	$("body").removeClass('scrolled');
	    }
	}); //missing );

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

$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top - 80
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          //$target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            //$target.focus(); // Set focus again
          };
        });
      }
    }
  });



});// END #####################################    END