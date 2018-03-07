<?php
/*
Template Name: Home page layout
Template Post Type: page
*/
get_header(); ?>

	<?php
	if ( have_posts() ) : while( have_posts() ) : the_post(); 

	get_template_part( 'template-parts/front/content', 'intro' );
    get_template_part( 'template-parts/front/content', 'our-hotel' );
    get_template_part( 'template-parts/front/content', 'history' );
    get_template_part( 'template-parts/front/content', 'news' );
    get_template_part( 'template-parts/front/content', 'partner' ); 
    get_template_part( 'template-parts/front/content', 'map-modal' ); 


	endwhile; endif; ?>


<?php get_footer();
