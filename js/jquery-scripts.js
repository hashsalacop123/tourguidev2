//===========SLICK JS===============
jQuery(document).ready(function($) {   
	  $('.slider-wrapper').slick({
	    dots: false,      // Remove the slide navigation dots
	    arrows: false,    // Remove the slide navigation arrows
	    infinite: true,   // Enable infinite looping of the images
	    speed: 600,       // Animation speed in milliseconds
	    fade: true,       // Use fade transition instead of slide
	    cssEase: 'linear',// Set the easing for the fade transition
	    autoplay: true,   // Enable automatic slideshow
	    autoplaySpeed: 2000, // Time between slide transitions in milliseconds
	    pauseOnHover: false, // Prevent pausing the slideshow on hover
	    pauseOnFocus: false, // Prevent pausing the slideshow on focus

	    // Add your additional options or callbacks if needed
	  });

			$('.latest-blogs').slick({
			  slidesToShow: 3,
			  slidesToScroll: 1,
			  autoplay: true,
			  autoplaySpeed: 15000,
			  responsive: [
			    {
			      breakpoint: 991,
			      settings: {
			        slidesToShow: 2,
			        slidesToScroll: 3,
			        infinite: true,
			        dots: true
			      }
			    },
			    {
			      breakpoint: 767,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 2
			      }
			    }],
			  prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
			  nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>'
			});


			$('.search-data').slick({
			  slidesToShow: 2,
			  slidesToScroll: 1,
			  autoplay: true,
			  autoplaySpeed: 15000,
			  prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
			  nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>'
			});


			$('.search-page').slick({
			  slidesToShow: 7,
			  slidesToScroll: 1,
			  autoplay: true,
			    infinite: true ,
			  autoplaySpeed: 10000,
			   responsive: [
			    {
			      breakpoint: 991,
			      settings: {
			        slidesToShow: 4,
			        slidesToScroll: 3,
			        infinite: true,
			        dots: true
			      }
			    },
			    {
			      breakpoint: 767,
			      settings: {
			        slidesToShow: 2,
			        slidesToScroll: 2
			      }
			    }],
			});
    $('.container-top-user-menu a').click(function(e) {
      // e.preventDefault();
      $(this).siblings('ul').toggleClass('show');
    });
	document.getElementById("mobile-menu").addEventListener("click", () => {
        Fancybox.show([{ src: "#menumobile-data", type: "clone" }]);
      }); 

	document.getElementById("quick-search").addEventListener("click", () => {
        Fancybox.show([{ src: "#more-destination", type: "clone" }]);
      }); 

});


