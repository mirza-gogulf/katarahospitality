(function($){


	$(document).ready(function() {

		//Timeline Year
		$( '.history-left .year-list li a').click(function(e){	

		e.preventDefault();
		$('.history-block .history-right').html( '<img src="'+ KAT.loader +'" alt="loader">' );

		$('.history-block .history-left li').removeClass( 'active' );
		$(this).parent('li').addClass( 'active' );

		var yr = $(this).data('yid');
		if ( yr ) {
			var data = {
                    action: 'ajaxLoadTimelineData', // this action hook will be fired
                    // other parameters 
                    yr : yr,
                };
                $.post( KAT.ajaxurl, data, function(response) {

                	if(response){
                		$('.history-block .history-right').html( response ).fadeIn();
                	}

                });
            }
		});

	});
	
})(jQuery);