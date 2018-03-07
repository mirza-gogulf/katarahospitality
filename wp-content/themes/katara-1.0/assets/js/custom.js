(function($){
	// jQuery.noConflict();
	jQuery(document).ready(function(){
		var jQuery = $;

		// add class on nav item
		$('.navbar .navbar-nav li').addClass('nav-item');
		$('.navbar .navbar-nav li a').addClass('nav-link');

		function stickyHeader() {
			var navOffset = jQuery('header').offset().top + 50;

			jQuery('header').wrap('<div class="header-placeholder"></div>');
			jQuery('header-placeholder').height(jQuery('header').outerHeight());


			jQuery(window).scroll(function() {
				var scrollPos = jQuery(window).scrollTop();

				if(scrollPos >= navOffset) {
					jQuery('header').addClass('sticky');
				} else {
					jQuery('header').removeClass('sticky');
				}
			});

		}
			
		function heroCarousel() {
			var artl = false;
			if( KAT.is_arabic ) {
				artl = true;
			}
			$('.hero-banner').slick({
				dots: false,
				rtl: artl,
				arrows: false,
				infinite: true,
				speed: 300,
				slidesToShow: 1,
				responsive: [
				{
					breakpoint: 1199,
					settings: {
						dots: false
					}
				}
				]
			});
		}

		function scrollToSearch() {
			$(".scrollSearch").click(function() {
				$('html, body').animate({
					scrollTop: $(".search-block").offset().top - 104
				}, 1000);
			});

			$("#register-interest").click(function() {
				$('html, body').animate({
					scrollTop: $("#register-form").offset().top - 104
				}, 1000);
			});
		}

		function singleCarousel() {
			$('.singlepage-carousel').slick({
				dots: false,
				arrows: false,
				infinite: true,
				speed: 300,
				arrows: true,
				prevArrow:"<button type='button' class='slick-prev pull-left'><img src='"+ KAT.prev_det +"' alt='preview image'></button>",
				nextArrow:"<button type='button' class='slick-next pull-right'><img src='"+ KAT.next_det +"' alt='next image'></button>",
				slidesToShow: 1,
				asNavFor: '.singlepage-carousel-nav',
			});

			$('.singlepage-carousel-nav').slick({
				slidesToShow: 5,
				slidesToScroll: 1,
				asNavFor: '.singlepage-carousel',
				dots: false,
				arrows: false,
				centerMode: false,
				focusOnSelect: false,
				infinite: true,
				focusOnSelect: true,
				responsive: [
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 3,
					}
				}
				]
			});
		}

		// function managementDetailInfo() {
		// 	var cardClick = $('.b-management-card');
		// 	var cardDetail = $('.b-management-detail');

		// 	cardDetail.hide();

		// 	cardClick.on('click', function( event ){
		// 		cardClick.removeClass('active');

		// 		cardDetail.fadeIn('slow');
		// 		$(this).addClass('active');
		// 		event .preventDefault();
		// 	});
		// }

		function showTimeline() {
			$('#v-timeline').on('click', function(e){
				$('.k-section-timeline').addClass('open');

				$('html, body').animate({
					scrollTop: $("#k-section-timeline").offset().top
				}, 500);
				e.preventDefault();
			});
			$('.close-timeline').on('click', function(){
				$('.k-section-timeline').removeClass('open');
			});
		}

		function homeScrollToBtm() {
			$('#scrollDown').click(function(){
				$('html, body').animate({
					scrollTop: $("#k-section-about-katara").offset().top - 94
				}, 1000);
			});
		}
		
		function removeBlankP() {
			$('p').each(function() {
				var $this = $(this);
				if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
				$this.remove();
			});
		}
		$(document).ready(function() {
		$('table').wrap('<div class="table-holder"></div>');
			$('table').basictable({
				breakpoint: 768,
			});
		});
		

		// 
		heroCarousel();
		stickyHeader();
		singleCarousel();
		//managementDetailInfo();
		showTimeline();
		homeScrollToBtm();
		removeBlankP();

	});

})(jQuery);

// jQuery("#sidemenu li a").click(function(){
// 		link = jQuery(this).attr("href");
// 		window.location=link;
// })