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


	$(window).scroll(function() {    
	    var scroll = $(window).scrollTop();
	     //>=, not <=
	   if (scroll >= 200) {
	        $("body").addClass('scrolled');
	        // $(".tagline.orig").removeClass('animated');
	        // $(".tagline.clone span").removeClass('animated');
	    } else {
	    	$("body").removeClass('scrolled');
	    	$(".tagline.orig").addClass('animated');
	    	$(".tagline.clone span").addClass('animated');
	    }
	}); //missing );


	$(document).on("click",".menutoggle",function(e){
		e.preventDefault();
		$(".mtoggle").toggleClass('open');
	});

	$(document).on("click","#mainmenu > li > a",function(e){
		e.preventDefault();
		$(this).toggleClass('open');
		$(this).parents('li').toggleClass('open');
		$(this).next().stop(true, true).slideToggle(400); 
	    return false;    
	});

	if( $("#mainmenu > li.current-menu-parent").length ) {
		$("#mainmenu > li.current-menu-parent > a").addClass('open');
	}

	var homepage_anchors = ['#contact'];
	$("#mainmenu a").each(function(){
		var href = $(this).attr('href');
		if($.inArray(href, homepage_anchors) !== -1) {
			var newURL = siteURL + href;
			$(this).attr('href',newURL);
		}
	});



	$('a[href*="#"]')
		.not('[href="#"]')
		.not('[href="#0"]')
		.click(function(event) {
		if (
		  location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
		  && 
		  location.hostname == this.hostname
		) {
		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
		  // Does a scroll target exist?
		  if (target.length) {
		    event.preventDefault();
		    $('html, body').animate({
		      scrollTop: target.offset().top
		    }, 1000, function() {
		      var $target = $(target);
		      if ($target.is(":focus")) { 
		        return false;
		      } else {
		        $target.attr('tabindex','-1'); 
		      };
		    });
		  }
		}
	});


	var wow = new WOW();
    wow.init();

	WOW.prototype.addBox = function(element){
	    this.boxes.push(element);
	};

	// $('.wow').on('scrollSpy:exit', function() {
	// 	$(this).css({
	// 	 'visibility': 'hidden',
	// 	 'animation-name': 'none'
	// 	}).removeClass('animated');
	// 	wow.addBox(this);
	// }).scrollSpy();

	/* CONTACT FORM hide Label */
	$(document).on("focus",".contact-text .ginput_container input, .contact-text .ginput_container textarea",function(){
		var wrapper = $(this).parents("li.gfield");
		wrapper.find(".gfield_label").addClass('on-focus');
	});
	$(document).on("focusout blur",".contact-text .ginput_container input, .contact-text .ginput_container textarea",function(){
		var wrapper = $(this).parents("li.gfield");
		var str = $(this).val();
		var txtVal = str.replace(/\s/g,'');
		if( txtVal=='' ) {
			$(this).val("");
			wrapper.find(".gfield_label").removeClass('on-focus');
		} 
	});

});// END #####################################    END