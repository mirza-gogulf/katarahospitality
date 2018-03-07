<?php 
$partnerQuery = kataraGetPost( 'partners', '', 16 ); 
if ( $partnerQuery -> have_posts() ) : ?>
	
<div class="k-section k-section-partner">
	<div class="container">
		<div class="title-holder">
			<h2><?php the_field( 'front_partner_section_title' ) ?></h2>
		</div>
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div class="row-partner">
					<ul class="d-flex flex-wrap align-items-center">
						<?php while ( $partnerQuery -> have_posts() ) : $partnerQuery -> the_post(); 
						if ( has_post_thumbnail() ) {
							$pImg = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'full');  
							echo sprintf('<li><img src="%s" class="img-fluid" alt="image"></li>', $pImg );
						}
						endwhile; ?> 
						
					</ul>
				</div>
				<!-- <div class="btn-holder">
					<a href="<?php echo home_url('/partners') ?>" class="btn btn-primary-round"><?php _e('see all partners', 'katara' )?></a>
				</div> -->
			</div>
		</div>
	</div>
</div>

<?php endif;
wp_reset_postdata(); ?>