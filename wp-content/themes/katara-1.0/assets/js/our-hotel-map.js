var mapStyles = [{"featureType":"administrative","elementType":"all","stylers":[{"saturation":-100}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"saturation":-100},{"lightness":50},{"visibility":"simplified"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"lightness":30}]},{"featureType":"road.local","elementType":"all","stylers":[{"lightness":40}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]},{"featureType":"water","elementType":"labels","stylers":[{"lightness":-25},{"saturation":-100}]}];

function initMap() {
	map = new google.maps.Map(document.getElementById('ourhotel-map'), {
		zoom: 3,
		center: {lat: 29.707991, lng: 69.759004},
		styles: mapStyles
	});

	setMarkers(map);
}
var hotels = [
	['qutar katara', 25.021564, 51.899534, 4],
	['thailand katara', 1.259901, 104.229473, 5],
	['Cronulla katara', 16.332925 , 100.681942, 3],
	['france katara', 46.584213, 1.396123, 2],
	['italy katara', 43.178973, 11.952659, 1]
];
function setMarkers(map) {
	var image = {
		url: 'assets/images/icon/marker.png',
		// This marker is 20 pixels wide by 32 pixels high.
		size: new google.maps.Size(26, 36),
		// The origin for this image is (0, 0).
		origin: new google.maps.Point(0, 0),
		// The anchor for this image is the base of the flagpole at (0, 32).
		anchor: new google.maps.Point(0, 36)
		};
		var shape = {
		coords: [0, 0, 26, 0, 26, 36, -2, 34],
		type: 'poly'
	};

	 var contentString = '<div class="hotel-info-holder" id="content">'+
            '<div id="bodyContent">'+
            '<div class="hotel-body">'+
            '<div class="image-holder">'+
            '<img src="assets/images/img-info.jpg" class="img-fluid" alt="image">'+
            '</div>'+
            '<div class="text-holder">'+
            '<strong class="hotel-info-title">The Peninsula Paris</strong>'+
            '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquet turpis posuere ligula faucibus tempus. Proin sapien odio, luctus ut accumsan sed, sollicitudin at mauris. In hac habitasse platea dictumst. Nam vulputate molestie lectus sed faucibus. Vestibulum pharetra sapien velit, eu commodo purus condimentum id. Quisque laoreet magna sit amet velit dignissim condimentum. Nulla ac dui ac enim porttitor lobortis. Aenean non aliquam massa. Morbi condimentum vestibulum tincidunt. </p>'+
            '<div class="btn-holder">'+
            '<a href="#" class="btn btn-primary-square">start exploring</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>';

            var infowindow = new google.maps.InfoWindow({
            	content: contentString,
            	maxWidth: 900
            });

	for (var i = 0; i < hotels.length; i++) {
		var hotel = hotels[i];
		var marker = new google.maps.Marker({
			position: {lat: hotel[1], lng: hotel[2]},
			map: map,
			icon: image,
			shape: shape,
			title: hotel[0],
			zIndex: hotel[3]
		});

		// google.maps.event.addListener(marker, 'click', (function(marker, i) {
		// 	infowindow.setContent(hotels[i][0], hotels[i][6]);
		// 	infowindow.open(map, marker);
		// 	marker.setIcon("assets/images/icon/marker-selected.png");
		// })(marker, i));

		marker.addListener('click', function() {
          // infowindow.open(map, marker);
           marker.setIcon("assets/images/icon/marker-selected.png");
           console.log('click marker');
           $('#outerhotel-popup').toggleClass('open');
        });
	}
}

jQuery(document).ready(function($) {
	$('.hotel-close').click(function() {
		$('#outerhotel-popup').removeClass('open');
	});
});