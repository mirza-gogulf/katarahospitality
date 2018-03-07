<?php
get_header(); 
$term = get_queried_object(); ?>

	<div class="content-inner-holder">

	<?php get_template_part( 'template-parts/sidebar/sidebar', 'buss-area' ); ?>

	<div class="inner-content">
		<section class="k-section k-section-hotels">
			<div class="title-holder">
				<strong class="title-top"><?php _e( 'Our Hotels', 'katara' ) ?> <?php //echo ' - ' .$currRegionName ?></strong>
				<h3><?php echo $term->name; ?></h3>
			</div>

			<div class="row">

				<?php 
						 		
					if ( have_posts() ) : 

						while ( have_posts() ) : the_post(); 

							get_template_part( 'template-parts/loop/loop', 'hotel' ); 
						
						endwhile;

				endif; ?>
				
			</div>
		</section>
	</div>

	</div>


<?php get_footer();
