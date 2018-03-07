<?php 
/*
Template Name: Press Area page layout
Template Post Type: page
*/

if( ! is_user_logged_in() ){
	wp_redirect( home_url('/news') );
	exit();
} 

get_header(); ?>

		<div class="content-inner-holder">

	 	<?php 
	 	get_template_part( 'template-parts/sidebar/sidebar', 'press-area' );

		if( have_posts() ) : while( have_posts() ) : the_post();

	 	get_template_part( 'template-parts/page/press-area/content', 'press-area' ); 

	 	endwhile; endif; ?>
		

		</div>

<?php get_footer(); ?>