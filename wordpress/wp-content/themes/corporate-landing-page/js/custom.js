// owl-carousel
jQuery(document).ready(function(){
	jQuery(".owl-carousel").owlCarousel({
	  items: 1,
	  loop: true,
	  autoplay: true,
	  animateOut: corporate_landing_page_slider_data.animation_out,
	  animateIn: corporate_landing_page_slider_data.animation_in,
	  dots: false,
	  // smartSpeed: 1000,
		autoplayTimeout: 5000,
		autoplayHoverPause: false
	});
});