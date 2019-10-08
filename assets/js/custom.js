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

	var windowTop = $(window).scrollTop();
	if (windowTop >= 200) {
		$("body").addClass('scrolled');
	}

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
		$("body").toggleClass('menu-open');
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

	/* Close Side Navigation */
	$(document).on('click', function (e) {
		var target = e.target;
		var parent = target.offsetParent;

		if( $(target).hasClass('menutoggle') || $(parent).hasClass('menutoggle') ) {
			//return false;
		} else {
			if ($(e.target).closest("#sideNav").length === 0) {
		        $(".mtoggle").removeClass('open');
				$("body").removeClass('menu-open');
		    }
		}
	    
	});

	var homepage_anchors = ['#contact'];
	$("a").each(function(){
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
	var gforms = [".contact-text .ginput_container input",".contact-text .ginput_container textarea", "#gform_2 .ginput_container input", "#gform_2 .ginput_container textarea"];
	console.log( gforms );

	$(gforms).each(function(k){
		var selector = gforms[k];

		$(document).on("focus", selector,function(){
			var wrapper = $(this).parents("li.gfield");
			wrapper.find(".gfield_label").addClass('on-focus');
		});

		$(document).on("focusout blur",selector,function(){
			var wrapper = $(this).parents("li.gfield");
			var str = $(this).val();
			var txtVal = str.replace(/\s/g,'');
			if( txtVal=='' ) {
				$(this).val("");
				wrapper.find(".gfield_label").removeClass('on-focus');
			} 
		});
	});

	// $(document).on("focus",".contact-text .ginput_container input, .contact-text .ginput_container textarea",function(){
	// 	var wrapper = $(this).parents("li.gfield");
	// 	wrapper.find(".gfield_label").addClass('on-focus');
	// });

	// $(document).on("focusout blur",".contact-text .ginput_container input, .contact-text .ginput_container textarea",function(){
	// 	var wrapper = $(this).parents("li.gfield");
	// 	var str = $(this).val();
	// 	var txtVal = str.replace(/\s/g,'');
	// 	if( txtVal=='' ) {
	// 		$(this).val("");
	// 		wrapper.find(".gfield_label").removeClass('on-focus');
	// 	} 
	// });


	/* Subscription hide Label */
	$(document).on("focus",".subscribe .ginput_container input, .subscribe .ginput_container textarea",function(){
		var wrapper = $(this).parents("li.gfield");
		wrapper.find(".gfield_label").addClass('on-focus');
	});
	$(document).on("focusout blur",".subscribe .ginput_container input, .subscribe .ginput_container textarea",function(){
		var wrapper = $(this).parents("li.gfield");
		var str = $(this).val();
		var txtVal = str.replace(/\s/g,'');
		if( txtVal=='' ) {
			$(this).val("");
			wrapper.find(".gfield_label").removeClass('on-focus');
		} 
	});

	if( $('#pagination').length ) {
		if( typeof $('#pagination').attr('data-section') != 'undefined' ) {
			$('#pagination a').each(function(){
				var hash = $('#pagination').attr('data-section');
				var link = $(this).attr('href');
				$(this).attr('href',link+hash);
			});
		}
	}

	if( $("ul.gform_fields li.gfield").length ) {
		$("ul.gform_fields li.gfield").each(function(){
			var target = $(this);
			if( target.find('select').length ) {
				target.addClass('selectField');
			}
		});
	}

	$("#shareitBtn").hover(
		function(){
			var social = $(this).attr('data-rel');
			$(social).addClass('show');
			$(this).addClass('active');
		}, function() {

		}
	);

	$(document).click("#shareitBtn",function(e) { 
	    var social = $(this).attr('data-rel');
		$(social).addClass('show');
		$(this).addClass('active');
	});

	// $(".socialshare .wp-share-button").hover(
	// 	function(){

	// 	}, function() {
	// 		$(".social-buttons").removeClass('show');
	// 	}
	// );

	$(document).click(function(e) { 
	    var container = $("#shareitBtn");
	    // If the target of the click isn't the container
	    if(!container.is(e.target) && container.has(e.target).length === 0){
	        $(".social-buttons").removeClass('show');
	        $("#shareitBtn").removeClass('active');
	    }
	});
	

});// END #####################################    END