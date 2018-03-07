<div class="inner-content">
	<section class="k-section k-section-hotels">
		<div class="title-holder">
			<?php $regionName = '';
			//get country ID of hotel located
			$terms = wp_get_post_terms( get_the_ID(), 'locations' );
			if ( $terms && is_array( $terms ) ) {

				$countryID = '';
				$countryTax = '';
				foreach ( $terms as $key => $loc ) {
					if( $loc->parent == 0 ){
						$countryID = $loc->term_id;
						$countryTax = $loc->taxonomy;
					}
				}
				$regionName = get_field( 'kat_region', $countryTax.'_' .$countryID );
			} 
			if( $regionName ) { 
			$allKataraReg = kataraRegions(); ?>
			<strong class="title-top">Other Hotels in <?php echo $allKataraReg[$regionName] ?></strong>
			<?php } ?>
			<h3><?php the_title() ?></h3>
		</div>
		<?php $gallery = array();
			// Get Photos
		    $attachment_args = array(
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'post_type' => 'attachment',
				'post_parent' => get_the_ID(),
				'post_mime_type' => 'image'
			);
			$post_attachments = get_children( $attachment_args );
			if ( $post_attachments && count( $post_attachments ) > 0 ){
				$c = 0;
				foreach ($post_attachments as $key => $attach) {
					$imgSrc = wp_get_attachment_image_src( $attach->ID, 'full' );
					$gallery[$c++]['url'] = $imgSrc[0];
				}

			} else{

				$gallery = get_field( 'hotel_gallery' ); 
			}

		
		if ( $gallery && count( $gallery ) > 0 ) : ?>
		<div class="gallery-holder">
			<div class="singlepage-carousel">
				<?php foreach ( $gallery as $key => $img ) { ?>
				<div class="singlepage-carousel-item">
					<img src="<?php echo aq_resize( $img['url'], 1269, 671, true, true, true ) ?>" class="img-fluid" alt="hotel-gallery">
				</div>
				<?php } ?>
			</div>
			<div class="singlepage-carousel-nav">
				<?php foreach ( $gallery as $key => $img ) { ?>
				<div class="singlepage-carousel-nav-item">
					<img src="<?php echo aq_resize( $img['url'], 200, 105, true, true, true ) ?>" class="img-fluid" alt="gallery-nav">
				</div>
				<?php } ?>
			</div>
		</div>
		<?php endif; ?>

		<div class="desc-holder">
			<div class="desc-holder-left">
				<?php the_content(); ?>
			</div>
			<div class="desc-holder-right">
				<?php $sid = get_the_ID();
				$websiteUrl = get_post_meta( $sid, 'hotel_website_url', true );
				$fax = get_post_meta( $sid, 'hotel_fax', true );
				$phone = get_post_meta( $sid, 'hotel_phone', true );
				$email = get_post_meta( $sid, 'hotel_email', true );
				$address = get_post_meta( $sid, 'hotel_address', true );

				if( !empty( $websiteUrl ) ) { ?>
				<div class="btn-holder">
					<a href="<?php echo $websiteUrl ?>" target="_blank" class="btn btn-primary-square"><?php _e( 'visit website', 'katara' ) ?></a>
				</div>
				<?php } 
				if ( !empty( $address ) ) { ?>
				<div class="address-holder">
					<address><?php echo nl2br( $address ) ?></address>
				</div>
				<?php } ?>
				<ul class="contact-info">
					<?php if ( !empty( $phone ) ) {
					echo sprintf( '<li><span>%1$s:</span><a href="tel:%2$s">%2$s</a></li>' , __( 'Phone', 'katara' ), $phone );
					}	
					if ( !empty( $fax ) ) { 
					echo sprintf( '<li><span>%s:</span>%s</li>', __( 'Fax', 'katara' ), $fax);
					}
					if ( !empty( $email ) ) { 
					echo sprintf( '<li><span>%1$s:</span><a href="mailto:%2$s">%2$s</a></li>' , __( 'Email', 'katara' ), $email );
					} ?>
				</ul>
			</div>
		</div>
	</section>
</div>
<?php $mapParameter = get_post_meta( $sid, 'hotel_map', true );
if( $mapParameter ) { ?>
<div class="single-map-holder">
	<div class="single-map" id="single-map"></div>
</div>
<?php } ?>