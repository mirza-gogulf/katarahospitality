<?php get_header(); ?>

	<section class="k-section k-section-about">
		<div class="container">
			<div class="title-holder">
				<h3>Our Partners</h3>
			</div>

			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="row-partner">
						<ul class="d-flex flex-wrap align-items-center">


						<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

						<?php if( has_post_thumbnail() ) { 
						$imgUrl = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) , 'full' ); ?>
						<li>
							<img src="<?php echo $imgUrl ?>" class="img-fluid" alt="partner">
						</li>
						<?php } ?>

						<?php endwhile; endif; ?>

						</ul>
					</div>
				</div>
			</div>	
		</div>
	</section>
		
<?php get_footer(); ?>