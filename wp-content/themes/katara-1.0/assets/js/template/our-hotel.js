var mapStyles = [{"featureType":"administrative","elementType":"all","stylers":[{"saturation":-100}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"saturation":-100},{"lightness":50},{"visibility":"simplified"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"lightness":30}]},{"featureType":"road.local","elementType":"all","stylers":[{"lightness":40}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]},{"featureType":"water","elementType":"labels","stylers":[{"lightness":-25},{"saturation":-100}]}];

function initMap() {
	map = new google.maps.Map(document.getElementById('ourhotel-map'), {
		zoom: 3,
		center: {lat: 29.707991, lng: 69.759004},
		styles: mapStyles
	});
	//setMarkers(map);

}

var gmarkers = [];

function clearOverlays() {
	for (var i = 0; i < gmarkers.length; i++ ) {
	  gmarkers[i].setMap(null);
	}
	gmarkers.length = 0;
}


function setMarkers( map, hotels ) {
	
	var hotels = hotels;

	
	var bounds = new google.maps.LatLngBounds();

	var image = {
		url: hObj.marker,
		// This marker is 20 pixels wide by 32 pixels high.
		size: new google.maps.Size(26, 36),
		// The origin for this image is (0, 0).
		//origin: new google.maps.Point(0, 0),
		// The anchor for this image is the base of the flagpole at (0, 32).
		//anchor: new google.maps.Point(0, 36)
		};

	var shape = {
		coords: [0, 0, 26, 0, 26, 36, -2, 34],
		type: 'poly'
		};

	jQuery.each( JSON.parse( hotels ), function(index, item) { 
		

	    marker = new google.maps.Marker({
	      position: new google.maps.LatLng( item[1], item[2] ),
	      map: map,
	      icon: image,
	      //shape: shape,
	      title: item[0]
	    });

	    gmarkers.push( marker );

	    //extend the bounds to include each marker's position
        bounds.extend( marker.position );
        //marker on click
        google.maps.event.addListener(marker, 'click', (function(marker, index) {
                     
	            return function() {
	            		
					    //set clicked marker to black icon
	                  	marker.setIcon( hObj.marker_selc ); 
					   
	                        //ajax call start on m click
	                        if ( index ){
	                        
	                        	jQuery('#outerhotel-popup').removeClass('open');
	                       		var data = {
	                               action: 'get_hotel_details', 
	                               // other parameters 
	                               hotelID : index,
	                            };

	                            jQuery.post( KAT.ajaxurl, data, function(response) {
	                               
	                                if( response ){
	                               		jQuery('#outerhotel-popup').html( response );
	                               		jQuery('#outerhotel-popup').toggleClass('open');
	                                }

	                                //close popup box	
	                                jQuery('.hotel-close').click(function() {
									jQuery('#outerhotel-popup').removeClass('open');
									});
	                                
	                                // scroll a bit
	                                var target = jQuery("#ourhotel-map");                                                                  
	                                jQuery('html, body').animate({
	                                  scrollTop: target.offset().top + 50
	                                }, 1000);

	                            });  
	                        }
	            }

        })( marker, index ));

        var markerCluster = new MarkerClusterer(map, gmarkers);
        map.fitBounds(bounds);


	});

	//fake_latlong = new google.maps.LatLng( 71.706936, -42.604303 ),
	//bounds.extend(fake_latlong);
	//map.fitBounds(bounds);

}

(function($){


	jQuery('#sidemenu .region a').on("click",function(){

		jQuery('#outerhotel-popup').removeClass('open');
		var regionSlug = $(this).data('reg');

		if( regionSlug) {

			clearOverlays();

			var data = {
	                action: 'get_hotel_locinfo_by_region', // this action hook will be fired
	                // other parameters 
	                reg : regionSlug,
	            };
	            $.post( KAT.ajaxurl, data, function(response) {

	            	if(response){
	            		var hotelData = response;
	            		
	            		setMarkers( map, hotelData );
	            	}
	            });
        }

	});
	

	jQuery(document).ready(function($) {

		//make first region from slidebar click on load
		jQuery( '#sidemenu li:first a' ).trigger( 'click' );
		//jQuery( '#sidemenu li:first' ).addClass( 'current_sidemenu_item' );
		jQuery( '#sidemenu li:first' ).addClass( 'open' );
		jQuery( '#sidemenu li:first ul' ).show();


		$('.hotel-close').click(function() {
			$('#outerhotel-popup').removeClass('open');
		});
	});



})(jQuery);
