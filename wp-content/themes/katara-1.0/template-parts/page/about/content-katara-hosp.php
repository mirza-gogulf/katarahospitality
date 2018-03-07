<div class="inner-content">
	<section class="k-section k-section-about">
		<div class="title-holder">
			<h3><?php the_title() ?></h3>
		</div>
		<?php if( has_post_thumbnail() ) { 
		$imgUrl = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) , 'full' ); ?>
		<div class="image-holder">
			<img src="<?php echo $imgUrl ?>" class="img-fluid" alt="">
		</div>
		<?php } ?>
		<div class="text-holder">
			<?php the_content() ?>
		</div>
		<!-- <div class="we-are">
			<h3><?php _e( 'We are', 'katara' ) ?></h3>

			<?php $parentPageID =  wp_get_post_parent_id( get_the_ID() );
			// get child pages
			$args = array(
							'sort_order' => 'asc',
							'sort_column' => 'menu_order',
							'exclude' => get_the_ID(),
							'parent' => $parentPageID,
							'number' => '',
							'post_type' => 'page',
							'post_status' => 'publish'
						); 
			$pages = get_pages($args);  
			if ( $pages ) { ?>

			<ul>
				<?php foreach( $pages as $page ) { 
					$subTitle = get_post_meta( $page->ID, 'page_sub_title', true );
					if( empty( $subTitle) ) { $subTitle =  $page->post_title; }
					echo sprintf('<li><a href="%s">%s</a></li>', get_page_link( $page->ID ), $subTitle );
					} ?>
			
			</ul>
			<?php } ?>

		</div> -->
	</section>
</div>