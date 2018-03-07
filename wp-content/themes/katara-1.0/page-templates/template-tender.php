<?php
/*
Template Name: Tender Page layout
Template Post Type: page
*/
get_header(); ?>
	
	<div class="content-inner-holder">

	<?php
		get_template_part( 'template-parts/sidebar/sidebar', 'tender' );

		if( have_posts() ) : while( have_posts() ) : the_post();

			get_template_part( 'template-parts/page/tender/content', 'tender' ); 

		endwhile; endif; ?>

	</div>

<?php get_footer();
