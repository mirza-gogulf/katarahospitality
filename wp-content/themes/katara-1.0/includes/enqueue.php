<?php

/**
 * Enqueue scripts and styles.
 */
function katara_scripts() {

	wp_enqueue_style( 'katara-style', get_stylesheet_uri() );

	// SSL
	$ssl = is_ssl() ? 'https:' : 'http:';

	// Cloudfare
	$cf = $ssl . '//cdnjs.cloudflare.com/ajax/libs/';

	if( is_arabic() ){
		wp_enqueue_style( 'kat-bootstrap-rtl', KATARA_CSS . '/bootstrap-rtl.css', array(), null )	;
	}else {	
		wp_enqueue_style( 'kat-bootstrap', KATARA_CSS . '/bootstrap.css', array(), null );
	}
	wp_enqueue_style( 'kat-slick', KATARA_CSS . '/slick.css', array(), null );
	wp_enqueue_style( 'kat-basictable', KATARA_CSS . '/basictable.css', array(), null );
	wp_enqueue_style( 'kat-style', KATARA_ASS_URI . '/dist/css/style.min.css', array(), null );
	wp_enqueue_style( 'kat-custom-style', KATARA_ASS_URI . '/css/custom.css', array(), null );

	if( is_arabic() ){
		wp_enqueue_style( 'kat-arabic-style', KATARA_ASS_URI . '/css/arabic.css', array(), null );
	}

	//JS Load Start
	wp_deregister_script( 'jquery' ); // Dequeue the default WP jQuery
	wp_enqueue_script( 'jquery', $ssl . '//code.jquery.com/jquery-2.2.4.min.js', array(), null, false );
	//	KATARA_JS . '/jquery-3.2.1.min.js', array(), null, false );

	wp_enqueue_script( 'kat-popper', KATARA_JS . '/popper.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'kat-bootstrap', KATARA_JS . '/bootstrap.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'kat-slick', KATARA_JS . '/slick.min.js', array( 'jquery' ), null, false );
	wp_enqueue_script( 'kat-basictable', KATARA_JS . '/jquery.basictable.min.js', array( 'jquery' ), null, true );

	if( ! is_front_page() ){
	wp_enqueue_script( 'kat-theia', KATARA_JS . '/theia-sticky-sidebar.min.js', array( 'jquery' ), null, true );
		if( !is_page_template( array('page-templates/template-about.php', 'page-templates/template-mgmt.php' ))){
			wp_enqueue_script( 'kat-left-menu', KATARA_JS . '/left-menu.js', array( 'jquery' ), null, true );
		}
	}
	
	wp_enqueue_script( 'kat-custom', KATARA_JS . '/custom.js', array( 'jquery' ), null, true );
	wp_localize_script(
		'kat-custom', 'KAT', array(
			'ajaxurl'  => admin_url( 'admin-ajax.php' ),
			'prev_det' => KATARA_IMG. '/icon/ico-preview-detail.png',
			'next_det' => KATARA_IMG. '/icon/ico-next-detail.png',
			'def_marker'   => KATARA_IMG. '/icon/marker.png',
			'frontMarker' => KATARA_IMG. '/icon/marker-white.png',
			'loader'   => KATARA_IMG. '/loader1.gif',
			'is_arabic' => is_arabic(),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	} 

}
add_action( 'wp_enqueue_scripts', 'katara_scripts' );



add_action('wp_print_scripts', 'katara_conditional_scripts'); // Add Conditional Page Scripts

function katara_conditional_scripts() {
	$loadMap = false;
	$loadTimeline = false;

	if ( is_home() || is_front_page() ){
		$loadMap = true;
		$loadTimeline = true;
		$fmapCountries = kataraFrontMapCountryData();

		wp_enqueue_script( 'kat-count', KATARA_JS . '/countUp.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'kat-front', KATARA_JS . '/template/front.js', array( 'jquery' ), null, true );
		wp_localize_script( 'kat-front', 'fObj', array( 'fCountries' => $fmapCountries, 'siteUrl' => home_url() ) );

	}
	elseif( is_page_template( array( 'page-templates/template-contact.php' ) ) ) {
		$loadMap = true;
		$mapParameter = get_field( 'cntact_map_latlong' , get_the_ID() );  

		wp_enqueue_script( 'kat-contact', KATARA_JS . '/template/contact.js', array( 'jquery' ), null, true );
		wp_localize_script( 'kat-contact', 'cObj', array( 'latlon' => $mapParameter ) );
	}
	elseif( is_page_template( array( 'page-templates/template-mgmt.php' ) ) ) {
		wp_enqueue_script( 'kat-mgmt', KATARA_JS . '/template/mgmt.js', array( 'jquery' ), null, true );
	}
	elseif( is_page_template( array( 'page-templates/template-our-hotel.php' ) ) ){
		$loadMap = true;
		wp_enqueue_script( 'kat-our-hotel', KATARA_JS . '/template/our-hotel.js', array( 'jquery' ), null, true );
	}

	if( is_singular( 'hotels' ) ){
		$loadMap = true;
		$mapParameter = get_field( 'hotel_map', get_the_ID() );
		wp_enqueue_script( 'kat-single', KATARA_JS . '/template/single.js', array( 'jquery' ), null, true );
		wp_localize_script( 'kat-single', 'sObj', array( 'latlon' => $mapParameter ) );
	}

	if( is_singular( array( 'tender', 'press_release', 'press_room' ) ) ){
		wp_enqueue_script( 'kat-detail', KATARA_JS . '/template/detail.js', array( 'jquery' ), null, true );
	}

	if( is_singular( 'career-opportunities' ) ){
		wp_enqueue_script( 'kat-detail-career', KATARA_JS . '/template/single-career.js', array( 'jquery' ), null, true );
	}

	if( is_page( 'history-future' ) || $loadTimeline ){
		wp_enqueue_script( 'kat-timeline', KATARA_JS . '/template/timeline.js', array( 'jquery' ), null, true );
	}

	if( $loadMap ){
		wp_enqueue_script( 'imac-map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAUqxxIEevWUPjp6VT3_NIchiMBrO-34gE&callback=initMap', array(), null, true );
	}
}