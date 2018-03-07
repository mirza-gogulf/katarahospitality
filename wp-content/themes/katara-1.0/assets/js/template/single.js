var geoCoords = '['+ sObj.latlon +']';
var geoCoordsObj = JSON.parse(geoCoords);
var markerIcon = KAT.def_marker;


  function initMap() {
    if (geoCoordsObj.length) {
      var myLatLng = {lat: geoCoordsObj[0], lng: geoCoordsObj[1]};
      var zoom = 9;

      var mapStyles = [{"featureType":"administrative","elementType":"all","stylers":[{"saturation":-100}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"saturation":-100},{"lightness":50},{"visibility":"simplified"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"lightness":30}]},{"featureType":"road.local","elementType":"all","stylers":[{"lightness":40}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]},{"featureType":"water","elementType":"labels","stylers":[{"lightness":-25},{"saturation":-100}]}];

      var map = new google.maps.Map(document.getElementById('single-map'), {
        zoom: zoom,
        center: myLatLng,
        styles: mapStyles
      });

      var marker = new google.maps.Marker({
       position: myLatLng,
       map: map,
       icon: markerIcon,
       title: ''
      });
    }
  }