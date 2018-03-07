(function($){

jQuery(document).ready(function() {
	function initSideMenu() {
		$('.sidemenu-sub').hide();
		$('#sidemenu li a').on('click', function(){
			var checkElement = $(this).next();

			// remove open class
			$(this).parent('.has_submenu_child').siblings('.has_submenu_child.open').removeClass('open');

			if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
				checkElement.slideUp('normal');
				$(this).parent('.has_submenu_child').removeClass('open');
				return false;
			}

			if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
				$('#sidemenu ul:visible').not(checkElement.parentsUntil('#sidemenu')).slideUp('normal');
				checkElement.slideDown('normal');
				// add open class
				$(this).parent('.has_submenu_child').addClass('open');
				return false;
			}
		});

		$('.current_sidemenu_item').parentsUntil('#sidemenu').slideDown('normal');
	}

	$('body').append('<div class="menu-overlay"></div>');
	$('#trig-left').on('click', function(){
		$('.left-sidebar').toggleClass('open');
		$('.menu-overlay').toggleClass('overlay-active');
	});

	// sidebar close button trigger
	// remove open class and hide sidebar
	$('#left-sidebar-close').on('click', function(){
		$('.left-sidebar').removeClass('open');
		$('.menu-overlay').removeClass('overlay-active');
	});

	$('.menu-overlay').on('click', function(){
		$('.left-sidebar').removeClass('open');
		$('.menu-overlay').removeClass('overlay-active');
	});


	jQuery('.left-sidebar').theiaStickySidebar({
		additionalMarginTop: 130
	});


	
	initSideMenu();
});

})(jQuery);
