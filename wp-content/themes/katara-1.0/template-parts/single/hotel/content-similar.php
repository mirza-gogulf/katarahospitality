<?php $hotelID = get_the_ID(); 
$termID = '';
$termName = '';
//get country ID of hotel located
$terms = wp_get_post_terms( $hotelID, 'locations' );
if ( $terms && is_array( $terms ) ) {
	//$terms = array_shift( $terms );
	if( isset(  $terms[1] ) ) {
		$terms = $terms[1];
	} else { $terms = $terms[0]; }

	$termID = $terms->term_id; 
	$termName = $terms->name;
} ?>
 
<div class="inner-content bg-inner-secondary">
	<div class="k-section k-section-other">
		<div class="title-holder">
			<?php echo sprintf( '<h3>%s </h3>' , __( 'Our other hotels in ', 'katara' ) . $termName ); ?>
		</div>
		<div class="row">
			<?php $similarHotQuery = getSimilarHotels( array( $termID ), $hotelID ); 

				if ( $similarHotQuery -> have_posts() ) : 

					while ( $similarHotQuery -> have_posts() ) :  $similarHotQuery -> the_post(); 

					get_template_part( 'template-parts/loop/loop', 'hotel' ); 

					endwhile;
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif;
				wp_reset_postdata(); ?>

		
		</div>
	</div>
</div>