<?php $our_hotels = get_page_by_path( '/our-hotels' ); ?>
<section class="k-section k-section-our">
	<?php if ( isset( $our_hotels->ID ) ) {  ?>
	<div class="our-hotel-block container">
		<div class="title-holder">
			<h2><?php echo $our_hotels->post_title; ?></h2>
		</div>
		<div class="row">
			<div class="col-lg-8 offset-lg-1">
				<div class="our-hotel-left">
					<div class="text-holder">
						 <?php echo fake_excerpt( $our_hotels->post_content ); ?>
					</div>
					<div class="btn-holder">
						<a href="#" class="btn btn-primary-round" data-toggle="modal" data-target="#mapModal"><?php _e( 'show map', 'katara' ) ?></a>
					</div>
				</div>
			</div>
			<div class="col-lg-2 offset-lg-1">
				<div class="our-hotel-view">
					<strong><?php _e( 'View by Business Area', 'Katara' ) ?>:</strong>
					<?php $busstax = 'business_area';
					$bussAreas = kataraTaxonomyTermList( $busstax ); 
					if ( $bussAreas && count( $bussAreas )  > 0 ) : 
					echo '<ul>';
						foreach ($bussAreas as $key => $barea) {
						echo sprintf( '<li><a href="%s">%s</a></li>', get_term_link( $barea->term_id, $busstax ), $barea->name );
						} 
					echo '</ul>';
					endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<div class="hotel-list-block">
		<div class="row">

			<?php $kataraRegions = kataraRegions(); 
			if ( $kataraRegions ) : 
				foreach ( $kataraRegions as $key => $kRegion ) { ?>

				 	<div class="col-lg-6 hotel-card">
						<div class="image-holder">
							<img src="<?php echo get_theme_mod( KATARA_PREFIX. $key .'_bg_image') ?>" class="img-fluid" alt="image hotel">
						</div>
						<div class="desc">
							<div class="title"><?php _e( $kRegion, 'katara' ) ?></div>

							<?php $regCountry = kataraCountryByRegion( $key );
							if ($regCountry && count( $regCountry ) > 0) : ?>
							<div class="desc-list">
								<?php foreach ( $regCountry as $key => $country ) {
									echo sprintf('<span><a href="%s">%s</a></span>', home_url().'/hotels?_c='. $country->slug, $country->name); 
								} ?>
								
							</div>
							<?php endif; ?>
						</div>
					</div>

				<?php } ?>

			<?php endif; ?>

		</div>
	</div>
</section>
<!-- section-our end -->