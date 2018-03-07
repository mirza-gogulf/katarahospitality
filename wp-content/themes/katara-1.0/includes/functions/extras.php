<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package katara
 */

if ( ! function_exists( 'kataraTaxonomyTermList' ) ) :
/*
 * Prints Custom Taxonomy 
 */
function kataraTaxonomyTermList($taxonomyName = '', $num = '', $meta_key = "", $meta_value = "", $compare = '=', $par = 0 ) {
  $termList = '';
  if( $taxonomyName ){
  	$args = array(
                    'taxonomy' => $taxonomyName,
                    'hide_empty' => true,
                    'parent'  => $par
                );

  	if( $num ){
  		$args['number'] = $num;
  	}

  	if ( $meta_key ) {
  		$args['meta_query'][] = array(
  								   'key'       => $meta_key,
							       'value'     => $meta_value,
							       'compare'   => $compare
  								);
  	}

    $termList = get_terms( $args );
    
  }
  return $termList;
  }
endif;

//Katara Global Region 
if ( ! function_exists( 'kataraRegions' ) ) :
	function kataraRegions(){
		$arrRegion = array(
						'me' => 'Middle East',
						'eu' => 'Europe',
						'as' => 'Asia',
						'af' => 'Africa'
					);

		return $arrRegion;
	}

endif;

if ( ! function_exists( 'katara_get_months' ) ) :
  function katara_get_months(){
    $arrMonth = array(
            '1' => 'Jan',
            '2' => 'Feb',
            '3' => 'Mar',
            '4' => 'Apr',
            '5' => 'May',
            '6' => 'Jun',
            '7' => 'Jul',
            '8' => 'Aug',
            '9' => 'Sep',
            '10'=> 'Oct',
            '11'=> 'Nov',
            '12'=> 'Dec'
           );

    return $arrMonth;
  }

endif;


//Returns country data for Front page map
if ( ! function_exists( 'kataraFrontMapCountryData' ) ) :

  function kataraFrontMapCountryData() {
      $locTaxonomy = 'locations';
      $countries = kataraTaxonomyTermList( $locTaxonomy, '' );
      $countryForMap = array();
      if ($countries && count( $countries ) > 0 ) {
        foreach ( $countries as $key => $cVal ) {
          $piece = array();
          $lat_long = get_field ( 'kat_country_lat_long', $locTaxonomy . '_'. $cVal->term_id );
          if( !empty( $lat_long) ) {
            $piece = explode(",", $lat_long);
                  $lat = $piece[0];
                  $long = $piece[1];

            $countryForMap[$cVal->slug][0] = $cVal->name;
            $countryForMap[$cVal->slug][1] = $lat;
            $countryForMap[$cVal->slug][2] = $long;
          }
        }
      }

      $mapCountries = json_encode($countryForMap);
      return $mapCountries;
  }

endif;

//Returns country by region meta key
if ( ! function_exists( 'kataraCountryByRegion' ) ) :

	function kataraCountryByRegion( $region = '' ){
		$args = array(
                    'taxonomy'   => 'locations',
                    'hide_empty' => false,
                    'parent'     => 0,
                    'meta_query' => array(
                    					array(
                    						 'key'       => 'kat_region',
        										     'value'     => $region,
        										     'compare'   => '='
                    					)
                    				)
                );
		$termList = get_terms( $args );
		return $termList;
	}

endif;

//Returns timeline data by year - term ID
if ( ! function_exists( 'kataraGetPost' ) ) :
  function kataraGetPost( $post_type = '', $yearID = '' , $num = -1 , $countryID = array() ){
    $args = array(
                 'post_type'     => $post_type, 
                 'post_status'   => 'publish', 
                 'posts_per_page' => $num,
                 );

    if( $yearID ) {
      $args['tax_query'][] = array(
                               'taxonomy' => 'history_year',
                               'field' => 'term_id',
                               'terms' => $yearID
                             );
    }

    if( $countryID ){
      $args['tax_query'][] = array(
                               'taxonomy' => 'locations',
                               'field' => 'term_id',
                               'terms' => $countryID,
                               'operator' => 'IN'
                             );
    }
  
    $query = new WP_Query( $args);
    return $query;
  }
endif;

//Career List
if ( ! function_exists( 'kataraGetCareers' ) ) :
  function kataraGetCareers( $post_type = '', $num = -1 ){

  $searchText = isset( $_POST['_s'] ) ? esc_html( $_POST['_s'] ) : '';
  $job_employment_type = isset( $_POST['job_employment'] ) ? esc_html( $_POST['job_employment'] ) : '';
  $job_level = isset( $_POST['job_level'] ) ? esc_html( $_POST['job_level'] ) : '';
  $job_department = isset( $_POST['job_department'] ) ? esc_html( $_POST['job_department'] ) : '';
  $job_location = isset( $_POST['job_location'] ) ? esc_html( $_POST['job_location'] ) : '';

  $args = array(
                 'post_type'     => $post_type, 
                 'post_status'   => 'publish', 
                 'posts_per_page' => $num,
                 );

  if( $searchText ) { 
    $args['s'] = $searchText;
  }

  if( $job_employment_type ){
    $args['meta_query'][] = array(
                              'key'     => 'job_employment',
                              'value'   => $job_employment_type,
                              'compare' => '='
                            );
  }

  if( $job_level ){
    $args['meta_query'][] = array(
                              'key'     => 'job_level',
                              'value'   => $job_level,
                              'compare' => '='
                            );
  }

  if( $job_department ){
    $args['meta_query'][] = array(
                              'key'     => 'job_department',
                              'value'   => $job_department,
                              'compare' => '='
                            );
  }

  if( $job_location ){
    $args['meta_query'][] = array(
                              'key'     => 'job_location',
                              'value'   => $job_location,
                              'compare' => 'LIKE'
                            );
  }
  
    $query = new WP_Query( $args);
    return $query;
  }
endif;


/* Disable WordPress Admin Bar for all users but admins. */
show_admin_bar(false);

// filter the Contact Gravity Forms button type
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
    return "<div class='btn-holder'><button class='btn btn-primary-square' id='gform_submit_button_{$form['id']}'>{$form['button']['text']}</button></div>";
}


function katara_get_custom_archive( $postType = '' ){

  if( empty($postType) ) { $postType = 'post'; }
  global $wpdb;
  $limit = 0;
  $year_prev = null;
  $months = $wpdb->get_results("SELECT DISTINCT MONTH( post_date ) AS month ,  YEAR( post_date ) AS year, COUNT( id ) as post_count FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = '{$postType}' GROUP BY year ORDER BY post_date DESC");
  return $months;
  
}

if ( !( function_exists('return_child_menuItems') ) ) :
// Return Child - Primary menu Item
function return_child_menuItems($parentID){
  $child_menu = array();
  $menu = 'Sidebar'; //'Primary Menu';
  $items = wp_get_nav_menu_items($menu);
  $c = 0;
  
  foreach ($items as $item):
    
    if($item->menu_item_parent == $parentID ){
      $child_menu[$c]['ID'] = $item->ID;
      $child_menu[$c]['post_title'] =( $item->post_title ) ? $item->post_title : $item->title; 
      $child_menu[$c]['post_ID'] = $item->object_id;
      $child_menu[$c]['object']  = $item->object;
      $child_menu[$c]['url']   = ( $item->object  == "custom" ) ? $item->url : get_the_permalink($item->object_id);
    }
    $c++;
    endforeach;
    return $child_menu;
  }
endif;

if ( !( function_exists('getSimilarHotels') ) ) :

  function getSimilarHotels( $countryID = array(), $exclude = '' ){
      $args = array(
                 'post_type'     => 'hotels', 
                 'post_status'   => 'publish', 
                 'posts_per_page'=> 3,
                 'post__not_in'  => array( $exclude )
                 );

      if( $countryID ){
        $args['tax_query'][] = array(
                                 'taxonomy' => 'locations',
                                 'field' => 'term_id',
                                 'terms' => $countryID,
                                 'operator' => 'IN'
                               );
      }
    
      $squery = new WP_Query( $args);
      return $squery;
  }

endif;

/*
* preload Gravity Forms' stylesheets in head
*/
add_action('wp_enqueue_scripts', function() {
    if (function_exists('gravity_form_enqueue_scripts')) {
        gravity_form_enqueue_scripts(1);
    }
});

// Add custom class on body
add_filter( 'body_class', 'custom_class' );
function custom_class( $classes ) {
  
    if ( is_arabic() ) {
        $classes[] = 'rtl';
    }
    else{
        $classes[] = 'en';
    }
    return $classes;
}

//gravity form phone field validate as number
if ( is_arabic() ) {
add_filter( 'gform_field_validation_2_5', 'custom_validation', 10, 4 );

} else {
add_filter( 'gform_field_validation_2_8', 'custom_validation', 10, 4 );

}

function custom_validation( $result, $value, $form, $field ) {
    $pattern = '/^[1-9][0-9]*$/';
    if ( $result['is_valid'] && ! preg_match( $pattern, $value ) ) {
        $result['is_valid'] = false;
        $result['message'] = 'Please enter a number only';
    }
    return $result;
}

//Gravity form redirect to applied job page after form submission
add_filter( 'gform_confirmation_2', 'redirect_to_custom_post', 10, 4 );

  function redirect_to_custom_post($confirmation, $form, $entry, $ajax){

    $job_appliedto_id = $entry[10]; // Get the ID of newly created post
    $url = get_permalink($job_appliedto_id).'?message=success';
    $confirmation = array( 'redirect' => $url );
    return $confirmation;
  }



//Disable scrolling of anchor on gravity form
add_filter( 'gform_confirmation_anchor', '__return_false' );

function page_filter($query) {
  if ( !is_admin() && $query->is_main_query() ) {

    if ( is_tax( 'business_area' ) ) {
      $query->set('post_type', array( 'hotels' ) );
    }

    if ( is_post_type_archive( 'partners' ) && $query->is_main_query() && !is_admin() ) {
        $query->set( 'posts_per_page', 100 );
    }

  }
}

add_action('pre_get_posts','page_filter');


/* function date_filter( $where = '', &$wp_query ) {

     global $wpdb;
     $yr = $wp_query->get( 'yr' );
     $mh = $wp_query->get( 'mh' );

     $bf = $yr.'-'.strtotime($mh).'-1';
     $af = $yr.'-'.strtotime($mh).'-30';

     if( $yr && $mh ) {
        // posts in the last 30 days
        $where .= ' AND '. $wpdb->posts .'.post_date >= '. $bf .' AND '. $wpdb->posts .'.post_date <= '. $af;
     }

    return $where;
} */

function katara_post_meta_values_list( $key = '', $type = 'post', $status = 'publish' ) {
    global $wpdb;

    if( empty( $key ) )
        return;

    $r = $wpdb->get_col( $wpdb->prepare( "
        SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND p.post_type = '%s'
    ", $key, $status, $type ) );

    return $r;
}