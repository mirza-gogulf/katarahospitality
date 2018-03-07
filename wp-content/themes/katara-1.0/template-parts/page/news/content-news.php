<?php 
$postType = isset( $_GET['_pt'] ) ? esc_html( $_GET['_pt'] ) : 'press_release';
$newsArchive = katara_get_custom_archive( $postType );

//get first archive year
$firstYr = null;
$firstYr = ($newsArchive) ? (int) $newsArchive[0]->year : '';

$yr = isset( $_GET['yr'] ) ? intval( $_GET['yr'] ) : $firstYr;
$mh = isset( $_GET['mh'] ) ? intval( $_GET['mh'] ) : ''; 
$taxID = isset( $_GET['_t'] ) ? intval( $_GET['_t'] ) : ''; 
$taxonomy = ( $postType == 'press_room' ) ?  'press_room_cat' : 'category'; 

$locationID = isset( $_GET['_l'] ) ? intval( $_GET['_l'] ) : ''; 
?>

<div class="inner-content">
	<section class="k-section k-section-news k-section-history-future k-section-news-secondary">
		<div class="news-sort d-flex align-items-start justify-content-between">
			<div class="title-holder">
				<h3><?php echo ( $postType == 'press_release' ) ? get_the_title() : __('Press Room', 'katara');  ?></h3>
				<span class="title-info"><?php echo get_post_meta( get_the_ID(), 'page_sub_title', true ) ?></span>
			</div>
			<div class="news-sort-right d-flex align-items-center news-filter">
				<span class="text-dated"><?php _e( 'Dated', 'katara' ) ?></span>
				<div class="form-group">
					<?php $kataraMonths = katara_get_months(); ?>

					<select name="m" class="form-control custom-select">
						 <option value=""><?php _e( 'Month', 'katara' ); ?></option> 
  						 <?php foreach ( $kataraMonths as $key => $month ) { ?>
  						 	<option value="<?php echo $key ?>" <?php echo ( $mh == $key ) ? 'selected' : '' ?>><?php echo $month ?></option>
  						 <?php } ?>
					</select>
				</div>
				<div class="form-group">
					<select name="y" class="form-control custom-select">
						<option value="">Year</option>
						<?php if ( $newsArchive ) {
						foreach ( $newsArchive as $key => $archive ) { ?>

						<option value="<?php echo $archive->year ?>" <?php echo ( $yr == $archive->year ) ? 'selected' : '' ?>><?php echo $archive->year ?></option>

						<?php }
						} ?>
					</select>
				</div>
			</div>
		</div>
		
		<div class="text-holder">
			<?php the_content() ?>
		</div>
		<div class="news-card-holder" id="ajax-posts">

			<?php $args = array(
                 'post_type'     => $postType, 
                 'post_status'   => 'publish', 
                 'posts_per_page' => 6,
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
			//location exist
			if( $locationID ) {
				$args['tax_query'] = array(
										array(
											'taxonomy' => 'locations',
											'field'    => 'term_id',
											'terms'    => $locationID,
										),
									);
			}
			 

			$pQuery = new WP_Query( $args);
			$totalCount = $pQuery->found_posts; 
			$max_num_page = $pQuery->max_num_pages;

	    	if ( $pQuery->have_posts() ) : 
	    		global $firstNews;
	    		$firstNews = true;

	    		while ( $pQuery->have_posts() ) : $pQuery->the_post(); 

				get_template_part( 'template-parts/loop/loop', 'news' ); 

				endwhile; 

				

			endif;  

			wp_reset_postdata(); ?>

		</div>
		<div class="detail-loader-wrap">
			<img src="<?php echo KATARA_IMG . '/loader1.gif' ?>" id="loader" alt="loader">
		</div>

		<!-- Register Form -->
		<div class="k-section k-section-timeline" id="k-section-timeline">
			<span class="close-timeline"><i>X</i> <?php _e( 'close Form', 'katara' ); ?> </span>
			<div class="title-holder">
				<h3><?php _e( 'Request Access', 'katara' ) ?></h3>
			</div>
			<?php get_template_part( 'template-parts/page/news/content', 'register' ); ?>

		</div>

	</section>
</div>

<script type="text/javascript">
(function($){

	function showRegister() {
			$('.press-login-form .req-access').on('click', function(e){
				e.preventDefault();
				$('.k-section-timeline').addClass('open');

				$('html, body').animate({
					scrollTop: $("#k-section-timeline").offset().top
				}, 500);
				e.preventDefault();
			});
			$('.close-timeline').on('click', function(){
				$('.k-section-timeline').removeClass('open');
			});
		}
	showRegister();

	jQuery('.news-filter select').change(function(){
		var m = jQuery('select[name="m"]').val();
		var y = jQuery('select[name="y"]').val();
		var t = "<?php echo $taxID ?>";
		var pt= "<?php echo $postType ?>";

		if( m && y == '' ){
			//
		}
		else {
			window.location.href = "<?php echo get_the_permalink(); ?>?yr="+y+'&mh='+ m+'&_pt=' + pt +'&_t=' + t;
			return false;
		}
	});

	//loading more news starts
	$('#loader').hide();

		var count = 2;
		var tot_page = "<?php echo $max_num_page ?>";
        $(window).scroll(function(){
                if  ($(window).scrollTop() == $(document).height() - $(window).height() ) {
                	if ( count > tot_page ) {
                		return false;
                	} else{
                     load_posts();
                	}  
                	count++;           
                }
        }); 


	var pageNumber = 1;

	function load_posts(){

		pageNumber++;

		$('#loader').show('fast');

		var tot_blog_count = "<?php echo $totalCount ?>";
		var m = jQuery('select[name="m"]').val();
		var y = "<?php echo $yr ?>"; //jQuery('select[name="y"]').val();
		var t = "<?php echo $taxID ?>";
		var pt= "<?php echo $postType ?>";

	    var str = '&pageNumber=' + pageNumber + '&y=' + y + '&m=' + m + '&t=' + t + '&pt=' + pt +'&action=ajax_load_more_news';
	    $.ajax({
	    	type: "POST",
	    	dataType: "html",
	    	url: '<?php echo admin_url( 'admin-ajax.php' ) ?>',
	    	data: str, 
	    	success: function(data){
	    		$('#loader').hide('1000');
	    		if( data.length){
	    			$("#ajax-posts").append( data ).show('slow');
	    			
	    		} else{
	    			//
	    		}
	    	},
	    	error : function(jqXHR, textStatus, errorThrown) {
	         
	          }

	      });
	    return false;
	}



	//Form validation
	function validateForm(){

        var error = false;
        var check = Array();
        
        check.push($("#rtibet_registration_form input[name='rtibet_user_login']"));
        check.push($("#rtibet_registration_form input[name='rtibet_user_first']"));
        check.push($("#rtibet_registration_form input[name='rtibet_user_last']"));
        check.push($("#rtibet_registration_form input[name='rtibet_user_company']"));
        check.push($("#rtibet_registration_form input[name='rtibet_user_email']"));
        check.push($("#rtibet_registration_form #rtibet_user_msg"));

        var x = check.length;
        firsterrorfield = null;
        for (var i = 0; i < x; i++) {
            checking = check.shift();
            if (checking.val() == null || checking.val() == '') {
              checking.addClass('wpcf7-not-valid');  //parent().
              error = true;
              if (!firsterrorfield) firsterrorfield = checking;
            }
        }

        var str = /(^[a-zA-Z0-9]+[\._-]{0,1})+([a-zA-Z0-9]+[_]{0,1})*@([a-zA-Z0-9]+[-]{0,1})+(\.[a-zA-Z0-9]+)*(\.[a-zA-Z]{2,3})$/;
        checking = $("#rtibet_registration_form input[name='rtibet_user_email']");
        if( str.test(checking.val() ) ==false ) {
            checking.addClass('wpcf7-not-valid'); 
              error = true;
        }

        if (firsterrorfield) firsterrorfield.focus();
        if (!error)
            return true;
        else
            return false;

       }

       //Remove class has-error on Keypress
        $(".wpcf7-form input, .wpcf7-form textarea").keypress(function() {
          $(this).removeClass('wpcf7-not-valid');
        });
        
         //option A
        $('#rtibet_registration_form').submit(function(e){  //(.on('click', function(e) {

            var valid = validateForm();
            if( !valid ){
            	e.preventDefault();
                return false;
            } 

        });



})(jQuery);
</script>
