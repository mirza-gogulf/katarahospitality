<?php
/*
Template Name: Career Page layout
Template Post Type: page
*/
get_header(); ?>
	
	<div class="content-inner-holder">

	<?php
		get_template_part( 'template-parts/sidebar/sidebar', 'career' );

		if( have_posts() ) : while( have_posts() ) : the_post();

			get_template_part( 'template-parts/page/career/content', 'career' ); 

		endwhile; endif; ?>

	</div>

<?php get_footer();
