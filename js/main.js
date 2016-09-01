jQuery(document).ready(function($){
/*===========================================================
	Custom javaScript functions - (wp_theme)
=============================================================*/



/*===================================
	Simple Preloader
===================================*/
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});


/*=================================
	Walker Menu 
===================================*/
 	$('ul.nav li.dropdown').hover(function() {
 		// Hover Open
		$(this).find(' > .dropdown-menu').stop(true, true).delay(200).fadeIn().css("margin-left", "10px").css("margin-top", "5px");
	}, 
		// Move mouse from hover field - Close
	function() {
		$(this).find(' > .dropdown-menu').stop(true, true).delay(200).fadeOut();
	});


/*=================================
	Responsive Slides
===================================*/
  // Background Images (Header)
	$("#slider2").responsiveSlides({
		auto: true,
		pager: false,
		nav: false,
		speed: 1200,
	});
    
  // Gallery Post Format Slider
	$(".portfolio-gallery-posts").responsiveSlides({
		auto: false,
		pager: false,
		nav: true,
		speed: 1200,
		navigationText: false,
		pagination: true,
		prevText: '<i class="fa fa-angle-left"></i>',
		nextText: '<i class="fa fa-angle-right"></i>',
	});



/*==========================================
	NAVBAR - Creating Dinamically Menu
============================================*/
$(window).scroll(function(){
	var top = $(document).scrollTop();
	var batas = $('#owl-header').height();
		//alert(batas);	
	if( top > batas ){
		$('.main-menu').addClass('tiny');
		$('.main-menu').css('opacity','1');
	}
		else{
			$('.main-menu').removeClass('tiny');
		}
});


/*===========================================
	Masonry - Aligning posts
=============================================*/
function masonry_start(){
	$('.masonry-container').masonry({
		itemSelector: ' .portfolio-article',
		columnWidth: '.portfolio-article',
		transitionDuration: 400
	});
}
	$('.masonry-container').imagesLoaded(function() {
		masonry_start();
	});

	$(window).resize(function(){
		$('.masonry-container').masonry('destroy');
		if( $(window).width() >= 768 ){
			masonry_start();
			//alert($(window).width());
		}
	});



 
/*===========================================
	OWL Carousel
=============================================*/
// Header Section
	var owl = $("#owl-header");
	owl.owlCarousel({
    	paginationSpeed: 7000,
      	autoPlay: 7000,
      	singleItem : true,
     	mouseDrag: false
  });
// Maybe Interesting Section
  var owl = $("#owl-demo");
 
  owl.owlCarousel({
      items : 3, //3 items above 1000px browser width
      itemsDesktop : [1000,5], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,3], // betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0
      itemsMobile: [470,1], // itemsMobile disabled - inherit from itemsTablet option
      paginationSpeed: 7000,
      autoPlay: 7000
  });
 

 

/*===========================================
	Subscribe User - form
=============================================*/
$('.portfolio_subscriber_submit').click(function(e){
	e.preventDefault();

	var name  = $('#portfolio_name').val();
	var email = $('#portfolio_email').val();
	var lastName = $('#portfolio_lastName').val();

	$.ajax({
		url: PORTFOLIO_SUBSCRIBE.ajax_url,
		method: 'POST',
		data: {
			action: 'portfolio_subscribe',
			name: name,
			email: email,
			lastName: lastName,
			security: PORTFOLIO_SUBSCRIBE.security
		},
		dataType: 'JSON',
		success: function( response ){
			if ( !response.error) {
				$('#portfolio-subscribe-form')[0].reset();
				$("#subscribe-answer").html('<div class="alert alert-success" role="alert"><span class="fa fa-check-circle"></span> '+response.success+'</div>').hide().fadeIn("slow");
	       		setTimeout( function(){ 
	       			$("#subscribe-answer").fadeOut(5000); 
	       		}, 3000);
			}
				else {
					$('#portfolio-subscribe-form')[0].reset();
					$("#subscribe-answer").html('<div class="alert alert-warning" role="alert"><span class="fa fa-check-circle"></span> '+response.error+'</div>').hide().fadeIn("slow");
		       		setTimeout( function(){ 
		       			$("#subscribe-answer").fadeOut(5000); 
		       		}, 3000);

	       		console.log( name + ", " + email );
				}

		},
		error: function( error ){
       		console.log( name + ", " + email );
		}

	});

});


/*===========================================
	Contact Page - Sending Message
=============================================*/
$('.submit-contact-message').click(function(e){
	e.preventDefault();
	$.ajax({
		url: PORTFOLIO_SUBSCRIBE.ajax_url,
		method: "POST",
		data: {
			action: 'contact',
			name: $('#name').val(),
			email: $('#email').val(),
			message: $('#message').val(),
		},
		dataType: "JSON",
		success: function( response ){
			if( !response.error ){
				$('.send_result').html( '<div class="alert alert-success" role="alert"><span class="fa fa-check-circle"></span> '+response.success+'</div>' );
				$('#contact-page-form')[0].reset();
			}
			else{
				$('.send_result').html( '<div class="alert alert-danger" role="alert"><span class="fa fa-times-circle"></span> '+response.error+'</div>' );
			}
		}
	})
});

/*==========================================
	SUPER SLIDER - banner rotator
============================================*/
$('#slides').superslides({
	animation: "fade",
	play: 10000,
	slide_easing: 'easeInOutCubic',
	slide_speed: 800,
	pagination: true,
	hashchange: false,
	scrollable: true
});

// WOW Initialization
	new WOW().init();


});