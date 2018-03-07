var mapStyles = [{"featureType":"all","elementType":"geometry.fill","stylers":[{"weight":"2.00"}]},{"featureType":"all","elementType":"geometry.stroke","stylers":[{"color":"#9c9c9c"}]},{"featureType":"all","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"off"},{"hue":"#00ff40"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"hue":"#fff800"}]},{"featureType":"administrative","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#2c1e1e"}]},{"featureType":"administrative","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative.country","elementType":"geometry.fill","stylers":[{"saturation":"44"},{"hue":"#0071ff"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"color":"#441c1c"}]},{"featureType":"administrative.land_parcel","elementType":"geometry","stylers":[{"hue":"#00e3ff"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#a28830"}]},{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#7b7b7b"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#08082d"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#070707"}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]}];
function initMap() {
	map = new google.maps.Map(document.getElementById('front-map'), {
		zoom: 2,
		center: {lat: 29.707991, lng: 69.759004},
		styles: mapStyles,
		fullscreenControl: false
	});
	setMarkers(map);

}

//country datas for map
var countries = JSON.parse( fObj.fCountries );

function setMarkers( map ) {

	var image = {
		url: KAT.frontMarker,
		// This marker is 20 pixels wide by 32 pixels high.
		size: new google.maps.Size(26, 36),
		};

	//Create and open InfoWindow.
    var infoWindow = new google.maps.InfoWindow();

	jQuery.each( countries, function(index, item) { 
		
		//Info Window Content
		var cTitle = item[0];
    	var content = '<div id="info-window-content">'+ '<p><strong><a href="'+ fObj.siteUrl +'/hotels?_c='+ index + '">'+ cTitle.toUpperCase()  +'</a></strong></p></div>';

	    marker = new google.maps.Marker({
	      position: new google.maps.LatLng( item[1], item[2] ),
	      map: map,
	      icon: image,
	      title: item[0]
	    });

	    //Attach click event to the marker.
        (function ( marker, content ) {

            google.maps.event.addListener(marker, "click", function (e) {
                //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
                infoWindow.setContent( content );
                infoWindow.setOptions({maxWidth:100}); 
                infoWindow.open(map, marker);
            });

        })(marker, content);

	});
}

$('#mapModal').on('shown.bs.modal', function(e) {
    var element = $(e.relatedTarget);
    initMap();
   
});


(function($){

	$(document).ready(function() {

	function heroNumberIncrement() {
			var options = {
				  useEasing: true, 
				  useGrouping: true, 
				  separator: ',', 
				  decimal: '', 
			};
			var numAnim = new CountUp("targetElement", 0, 6976, 0, 2.5, options);
			var numAnim2 = new CountUp("targetElement2", 0, 34, 0, 2.5, options);
			var numAnim3 = new CountUp("targetElement3", 0, 7187, 0, 2.5, options);

			if (!numAnim.error) {
				numAnim.start();
			} else {
				console.error(numAnim.error);
			}
			if (!numAnim2.error) {
				numAnim2.start();
			} else {
				console.error(numAnim2.error);
			}
			if (!numAnim3.error) {
				numAnim3.start();
			} else {
				console.error(numAnim3.error);
			}
	}

	heroNumberIncrement();
});

})(jQuery);
