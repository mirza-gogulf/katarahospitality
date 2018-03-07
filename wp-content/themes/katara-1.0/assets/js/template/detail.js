(function($){

	$(document).ready(function() {

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
		

		function detailPagination() {


			$( '.k-section .btn-nav' ).click(function(e){
				e.preventDefault();

				$('html, body').animate({
					scrollTop: $('.k-section').offset().top }, 1000);

				$('.k-section').html( '<div class="detail-loader-wrap"><img src="'+ KAT.loader + '" alt="loader"></div>' )
				var postID = $(this).attr( 'data-pid' );

				if ( postID ){
					var data = {
		                action: 'ajaxLoadTenderDetailData', // this action hook will be fired
		                // other parameters 
		                pid : postID,
		            };
		            $.post( KAT.ajaxurl, data, function(response) {

		            	if(response){
		            		
		            			$('.k-section').html( response ).fadeIn();

		            			showTimeline();
		            			detailPagination();
		            		
		            	}

		            });
				}
			});
		};

		detailPagination();

	});	

})(jQuery);