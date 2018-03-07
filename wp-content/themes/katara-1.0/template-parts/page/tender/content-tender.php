<?php $yr = isset( $_POST['yr'] ) ? intval( $_POST['yr'] ) : '';
$mh = isset( $_POST['mh'] ) ? intval( $_POST['mh'] ) : '';  
$cat = isset( $_POST['category'] ) ? intval( $_POST['category'] ) : '';
$loc = isset( $_POST['location'] ) ? intval( $_POST['location'] ) : '';
?>

<div class="inner-content">
	<section class="k-section k-section-tender">
		<div class="news-sort d-flex align-items-start justify-content-between">
			<div class="title-holder">
				<h3><?php the_title() ?></h3>
				<span class="title-info"><?php echo get_post_meta( get_the_ID(), 'page_sub_title', true ) ?></span>
			</div>
			<div class="news-sort-right d-flex align-items-center tender-filter">
				<span class="text-dated"><?php _e( 'Dated', 'katara' ) ?></span>
				
				<div class="form-group">
					<?php $tenderArchive = katara_get_custom_archive( 'tender' );
					$kataraMonths = katara_get_months(); ?>
					<select name="m" class="form-control custom-select">
					
						 <option value=""><?php _e( 'Month', 'katara' ); ?></option> 
  						 <?php foreach ($kataraMonths as $key => $month) { ?>
  						 	<option value="<?php echo $key ?>" <?php echo ( $mh == $key ) ? 'selected' : '' ?>><?php echo $month ?></option>
  						 <?php } ?>
					</select>
				</div>
				<div class="form-group">
					
					<select name="y" class="form-control custom-select">
						<option value=""><?php _e( 'Year', 'katara' ); ?></option>
						<?php if ( $tenderArchive ) {
						foreach ( $tenderArchive as $key => $archive ) { ?>

						<option value="<?php echo $archive->year ?>" <?php echo ( $yr == $archive->year ) ? 'selected' : '' ?>><?php echo $archive->year ?></option>

						<?php }
						} ?>
					</select>
				</div>
				
			</div>
		</div>
		
		<div class="text-holder">
			<?php the_content(); ?>
		</div>
		<?php $args = array(
                 'post_type'     => 'tender', 
                 'post_status'   => 'publish', 
                 'posts_per_page' => -1,
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

		if( $cat ) {
			$args['tax_query'] = array(
									array(
										'taxonomy' => 'category',
										'field'    => 'term_id',
										'terms'    => $cat,
									),
									);
		}

		if( $loc ) {
			$args['tax_query'] = array(
									array(
										'taxonomy' => 'locations',
										'field'    => 'term_id',
										'terms'    => $loc,
									),
									);
		}

		$tquery = new WP_Query( $args);

    	if ( $tquery->have_posts() ) : ?>

		<div class="career-card-holder">
			<?php while ( $tquery->have_posts() ) : $tquery->the_post(); 

			get_template_part( 'template-parts/loop/loop', 'tender' ); 

			endwhile; ?>

		</div>
		<?php endif;
		wp_reset_postdata(); ?>

	</section>
</div>

<script type="text/javascript">
	jQuery('.tender-filter select').change(function(){
		var m = jQuery('select[name="m"]').val();
		var y = jQuery('select[name="y"]').val();

		if( y ){
			jQuery( '.left-sidebar input[name="mh"]' ).val(m);
			jQuery( '.left-sidebar input[name="yr"]' ).val(y);

			jQuery( '.left-sidebar form' ).submit();
			//window.location.href = "<?php //echo get_the_permalink(); ?>?yr="+y + '&mh=' + m;
			return false;
		}
	});
</script>
