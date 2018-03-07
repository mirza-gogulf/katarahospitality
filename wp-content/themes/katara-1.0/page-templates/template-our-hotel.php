<?php
/*
Template Name: Our Hotel layout
Template Post Type: page
*/
get_header(); ?>
	
	<div class="content-inner-holder">

	<?php
		get_template_part( 'template-parts/sidebar/sidebar', 'hotel' );

		if( have_posts() ) : while( have_posts() ) : the_post();

			get_template_part( 'template-parts/page/hotel/content', 'hotel' ); 

		endwhile; endif; ?>

	</div>

<?php get_footer();
