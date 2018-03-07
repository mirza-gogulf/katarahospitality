<?php 
/*
Template Name: News page layout
Template Post Type: page
*/
get_header(); ?>

		<div class="content-inner-holder">

	 	<?php 
	 	get_template_part( 'template-parts/sidebar/sidebar', 'news' );

		if( have_posts() ) : while( have_posts() ) : the_post();

	 	get_template_part( 'template-parts/page/news/content', 'news' );
		
		endwhile; endif; ?>

		</div>

<?php get_footer(); ?>