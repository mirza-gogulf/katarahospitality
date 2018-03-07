<?php
$current_cat = FALSE;
$term = new stdClass;

    if ( isset( $_GET['_t'] ) )
    {
        $is_term = term_exists( $_GET['_t'], 'asset_category' );  //returns term ID     
    } else {
        global $firstcatID;
	    $is_term['term_id'] = $firstcatID;
    } 

if ( isset( $is_term['term_id'] ) ) {
$current_cat = $is_term['term_id'];
$term = get_term( $current_cat, 'asset_category', OBJECT );            
}
 ?>

<div class="inner-content">
	<section class="k-section k-section-news k-section-news-secondary">
		<div class="news-sort d-flex align-items-start justify-content-between">
			<div class="title-holder">
				<h3><?php _e( 'Brand Assets', 'katara' ); ?></h3>
				<!-- <span class="title-info"><?php// echo get_post_meta( get_the_ID(), 'page_sub_title', true ) ?></span> -->
			</div>
			
		</div>
		
		<!-- <div class="text-holder">
			<?php //the_content() ?>
		</div> -->
		<div class="news-card-holder" id="ajax-posts">

	        <?php //press Area args
			        $args = array(
		            'post_type' => 'press-area',
		            'tax_query' => array(
		                array(
		                    'taxonomy' => 'asset_category',
		                    'field' => 'id',
		                    'terms' => $current_cat
		                )
		            )
			        );
			    $press_query = new WP_Query( $args); 

			    if ( $press_query->have_posts() ) : 

	    		while ( $press_query->have_posts() ) : $press_query->the_post(); 

				get_template_part( 'template-parts/loop/loop', 'press-area' ); 

				endwhile; endif; 

				?>

		</div>
		
	</section>
</div>