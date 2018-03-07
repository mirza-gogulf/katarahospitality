<div class="ourhotel-map-holder">
	<div class="ourhotel-map" id="ourhotel-map"></div>
	<div class="outerhotel-popup" id="outerhotel-popup">
		
	</div>
</div>

<?php

wp_localize_script(
		'kat-our-hotel', 'hObj', array(
			'marker' => KATARA_IMG. '/icon/marker.png',
			'marker_selc' => KATARA_IMG. '/icon/marker-selected.png',

		)
	); 

wp_enqueue_script( 'imac-map-cluster', 'https://cdnjs.cloudflare.com/ajax/libs/markerclustererplus/2.1.4/markerclusterer.min.js', array(), null, true );
?>

