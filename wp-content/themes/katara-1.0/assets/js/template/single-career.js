(function($){

	$(document).ready(function() {

		function detailPagination() {


			$( '.k-section .btn-nav' ).click(function(e){
				e.preventDefault();


				$('.btn-holder').hide();

				$('html, body').animate({
					scrollTop: $('.k-section').offset().top }, 1000);

				$('.k-section .career-content-wrap').html( '<div class="detail-loader-wrap"><img src="'+ KAT.loader + '" alt="loader"></div>' )
				var postID = $(this).attr( 'data-pid' );

				if ( postID ){
					var data = {
		                action: 'ajaxLoadCareerDetailData', // this action hook will be fired
		                // other parameters 
		                pid : postID,
		            };

		            $.post( KAT.ajaxurl, data, function(response) {
		            	if(response){
		            			response = JSON.parse( response );
		            		
		            			$('.k-section .career-content-wrap').html( response.content ).fadeIn();
		            			$('.nav-buttons').html( response.navbtns ).fadeIn();

		            			$('.btn-holder').show();

		            			$('#k-section-timeline h3').html( response.pTitle );
		            			$('#gform_2 #input_2_9').val( response.pTitle );
								$('#gform_2 #input_2_10').val( postID );

		            			//showTimeline();
		            			detailPagination();
		            		
		            	}

		            });
				}
			});
		};

		detailPagination();

	});	

})(jQuery);