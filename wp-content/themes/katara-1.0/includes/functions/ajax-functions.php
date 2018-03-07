<?php
function ajaxLoadTimelineData(){

    $yr = ( isset( $_POST['yr'] ) ) ? (int) $_POST['yr'] : 0;

    header("Content-Type: text/html");

    if( $yr ) :

        $loop = kataraGetPost( 'history_timeline', $yr ); 
      
        if ( $loop -> have_posts() ) : 
        
    	    while ( $loop -> have_posts() ) : $loop -> the_post();

    	    	get_template_part( "template-parts/timeline/content", "timeline-data" );

    	    endwhile;

    	 else :
    	       _e( "No Result Found", 'katara' );  
        endif;  
        wp_reset_postdata(); 

    endif;
    wp_die();
}

add_action( 'wp_ajax_nopriv_ajaxLoadTimelineData', 'ajaxLoadTimelineData' );
add_action( 'wp_ajax_ajaxLoadTimelineData', 'ajaxLoadTimelineData' );

function ajax_load_more_news() {
    
    $yr = isset( $_POST['yr'] ) ? intval( $_POST['yr'] ) : '';
    $mh = isset( $_POST['mh'] ) ? intval( $_POST['mh'] ) : ''; 
    $taxID = isset( $_POST['t'] ) ? intval( $_POST['t'] ) : ''; 
    $postType = isset( $_POST['pt'] ) ? esc_html( $_POST['pt'] ) : 'press_release';
    $taxonomy = ( $postType == 'press_room' ) ?  'press_room_cat' : 'category';
    $page = isset( $_POST['pageNumber'] ) ? intval( $_POST['pageNumber'] ) : 1;

    $args = array(
             'post_type'     => $postType, 
             'post_status'   => 'publish', 
             'posts_per_page'=> 6,
             'paged'         => $page
             );

        if( $yr && empty( $mh ) ){
            $args['year'] = $yr;
        }
        
        if( $yr && $mh  ){
            $args['date_query'] = array(
                                        array(
                                            'after'     => $yr.'-'.$mh.'-1',
                                            'before'    => array(
                                                'year'  => $yr,
                                                'month' => $mh,
                                                'day'   => 30,
                                            ),
                                            'inclusive' => true,
                                        ), 
                                    );  
        }
        // If taxonomy term ID exist
        if( $taxID ) {
            $args['tax_query'] = array(
                                    array(
                                        'taxonomy' => $taxonomy,
                                        'field'    => 'term_id',
                                        'terms'    => $taxID,
                                    ),
                                );
        }

        $pQuery = new WP_Query( $args);

        if ( $pQuery->have_posts() ) : 

            while ( $pQuery->have_posts() ) : $pQuery->the_post(); 

            get_template_part( 'template-parts/loop/loop', 'news' ); 

            endwhile; 
        endif;  

        wp_reset_postdata(); 

    wp_die();
}

add_action( 'wp_ajax_nopriv_ajax_load_more_news', 'ajax_load_more_news' );
add_action( 'wp_ajax_ajax_load_more_news', 'ajax_load_more_news' );

function get_hotel_locinfo_by_region() {

    $reg = isset( $_POST['reg'] ) ? esc_html( $_POST['reg'] ) : '';

    $countryIds = array();
    $hotels = array();

    if( $reg ) {

        $countries = kataraCountryByRegion( $reg ); //get country by region key
        if ( $countries && count( $countries ) > 0 ) { 
                    
            foreach ( $countries as $key => $country ) {
                $countryIds[] = $country->term_id;
            }
        }

        if( $countryIds && count( $countryIds ) > 0 ){ 
            //get all hotel info from array of country IDs
            $sHotelByCntryQuery = kataraGetPost( 'hotels', '', -1, $countryIds );

            if ( $sHotelByCntryQuery -> have_posts() ) :
                $hCount = 0;
                while ( $sHotelByCntryQuery -> have_posts() ) : $sHotelByCntryQuery -> the_post();
                    $latLong = get_post_meta( get_the_ID(), 'hotel_map', true );
                    $hID = get_the_ID();
                    $piece = array();

                    if( $latLong ){
                        $piece = explode(",", $latLong);
                        $lat = $piece[0];
                        $long = $piece[1];

                        $hotels[$hID][0] = get_the_title();
                        $hotels[$hID][1] = (double) $lat;
                        $hotels[$hID][2] = (double) $long;
                        $hotels[$hID][3] = $hCount + 1;
                        
                        $hCount++;
                    }
                    
                endwhile;
            endif; 
            wp_reset_postdata();
        }

    }
    $hotels = json_encode($hotels);
    echo $hotels;

    wp_die();

}

add_action( 'wp_ajax_nopriv_get_hotel_locinfo_by_region', 'get_hotel_locinfo_by_region' );
add_action( 'wp_ajax_get_hotel_locinfo_by_region', 'get_hotel_locinfo_by_region' );


function get_hotel_details() {
    $hotelID = isset( $_POST['hotelID'] ) ? esc_html( $_POST['hotelID'] ) : '';
    $output = '';
    if( $hotelID ){

        $content_post = get_post( $hotelID );
        $content = $content_post->post_content;
        $hImg = wp_get_attachment_url( get_post_thumbnail_id( $hotelID ), 'full'); 
        $permalink = get_permalink( $hotelID );

        if( empty( $hImg ) ) { $hImg = 'http://katara.go-demo.com/wp-content/uploads/2016/02/Hotel-Park.jpg'; } 

        $output .= '<span class="hotel-close"><img src="'. KATARA_IMG .'/icon/ico-h-close.png" alt=""></span>';

        if ( $hImg ) { 
        $output .= '<div class="image-holder">
                <a href="'. $permalink .'"><img src="'. aq_resize( $hImg, 436, 347, true, true, true ) .'" class="img-fluid" alt="hotel"></a>
            </div>';
        } 

        $output .= '<div class="text-holder"><div class="v-middle">
            <strong class="hotel-info-title">'. get_the_title( $hotelID ) .'</strong>
            <p>'. $content .' </p>
            <div class="btn-holder">
                <a href="'. $permalink .'" class="btn btn-primary-square">start exploring</a>
            </div></div>
        </div>';

    }
    echo $output;
    wp_die();
}

add_action( 'wp_ajax_nopriv_get_hotel_details', 'get_hotel_details' );
add_action( 'wp_ajax_get_hotel_details', 'get_hotel_details' );


function ajaxLoadTenderDetailData() {

    $pid = isset( $_POST['pid'] ) ? (int) $_POST['pid']  : '';

    if( $pid ){

        global $post;
        $post = get_post( $pid );
        $title = $post->post_title;
        $content = $post->post_content;
        $postType = $post->post_type;

        ob_start(); 

                if( $postType == 'tender' ) { ?>

                <div class="news-sort d-flex align-items-start justify-content-between">
                    <div class="title-holder">
                        <!-- <strong class="title-top"><?php //_e( 'Tenderse', 'katara' ) ?></strong> -->
                        <h3><?php echo $title ?></h3>
                    </div>
                </div>

                <?php } else { //for press-release and press room ?>

                <div class="title-holder">
                    <h3><?php echo $title  ?></h3>
                    <span class="pub-date"><?php echo get_the_date( '', $pid ); ?></span>
                </div>

                <?php } 

                $nImg = wp_get_attachment_url( get_post_thumbnail_id( $pid ), 'full'); 
                if( $nImg) { ?>
                <div class="image-holder">
                    <img src="<?php echo $nImg ?>" class="img-fluid" alt="image">
                </div>
                <?php } ?>

                <div class="text-holder">
                    <?php echo wpautop( $content ); ?>
                </div>
                <div class="btn-holder">
                    <?php $prev_post = get_previous_post();
                    if($prev_post) {
                       echo sprintf( '<a href="%s" data-pid ="%s" class="btn btn-primary-square btn-nav">%s</a>', '#', $prev_post->ID, __( 'prev', 'katara' ) );
                    }

                    $next_post = get_next_post();
                    if($next_post) {
                       echo sprintf( '<a href="%s" data-pid="%s" class="btn btn-primary-square btn-nav">%s</a>', '#', $next_post->ID,  __( 'next', 'katara' ) ); 
                    } ?>

                </div>
        
        <?php
        
    } else{
        echo "Error occur!";
    }
   
    wp_die();
}

add_action( 'wp_ajax_nopriv_ajaxLoadTenderDetailData', 'ajaxLoadTenderDetailData' );
add_action( 'wp_ajax_ajaxLoadTenderDetailData', 'ajaxLoadTenderDetailData' );


function ajaxLoadCareerDetailData() {
    $pid = isset( $_POST['pid'] ) ? (int) $_POST['pid']  : '';
    $data = array();
    $jsonData = null;
    $output = '';
    $btnOutput = '';

    if( $pid ){

        global $post;
        $post = get_post( $pid );
        $id = $post->ID;
        $pTitle = $post->post_title;
        $contract = str_replace( '-', ' ', get_post_meta( $id, 'job_employment', true ) );

        // Enqueue the scripts and styles
        //gravity_form_enqueue_scripts (2, true);

        $output .= '<div class="title-holder"><strong class="title-top">'.  __( 'Careers', 'katara' ).'</strong><h3>' . $pTitle .' </h3><span class="title-info">'.  __( 'Posted on', 'katara').' : '. get_the_date( '', $id ) .'</span>
                </div><div class="row b-career-detail"><div class="col-lg-12 b-career-detail-left"><div class="col-lg-4 b-career-detail-right"><div class="job-info"><ul><li><strong>'. __( 'Contract type', 'katara' ) . '</strong>'.  ucfirst( $contract ) . '</li><li><strong>'. __( 'Level', 'katara' ) . '</strong>'.  ucfirst( get_post_meta( $id, 'job_level', true ) ) . '</li><li><strong>'. __( 'Experience required', 'katara' ) . '</strong>'.  intval( get_post_meta( $id, 'job_experience', true ) ) . ' Years</li><li><strong>'. __( 'Department', 'katara' ) . '</strong>'.  ucfirst( get_post_meta( $id, 'job_department', true ) ) . '</li><li><strong>'. __( 'Location', 'katara' ) . '</strong>'.  ucfirst( get_post_meta( $id, 'job_location', true ) ) . ' </li><li><strong>'. __( 'Joining date', 'katara' ) . '</strong>'. get_field( 'career_joining_date', $id ) . '</li></ul>
                                </div></div><div class="text-holder"><strong class="title">'. __( 'Role objective', 'katara' ) . '</strong><p>'. get_field( 'career_role_objective', $id ) . '</p><strong class="title">'. __( 'Detailed roles and responsibilities', 'katara' ) . '</strong>'.  wpautop( $post->post_content ) .'</div></div></div>';
        
        

        //navigation Buttons
        $prev_post = get_previous_post();
        if($prev_post) {
            $btnOutput .= sprintf( '<a href="%s" data-pid ="%s" class="btn btn-primary-square btn-nav">%s</a>', '#', $prev_post->ID, __( 'prev', 'katara' ) );
        }

        $next_post = get_next_post();
        if($next_post) {
            $btnOutput .= sprintf( '<a href="%s" data-pid="%s" class="btn btn-primary-square btn-nav">%s</a>', '#', $next_post->ID,  __( 'next', 'katara' ) ); 
        }   

        $data['content'] = $output;
        $data['navbtns'] = $btnOutput;
        $data['pTitle']  = $pTitle;

        $jsonData =  json_encode( $data );
        echo $jsonData;

    } else{
        echo "Error occur!";
    }   

     wp_die();
}

add_action( 'wp_ajax_nopriv_ajaxLoadCareerDetailData', 'ajaxLoadCareerDetailData' );
add_action( 'wp_ajax_ajaxLoadCareerDetailData', 'ajaxLoadCareerDetailData' );
