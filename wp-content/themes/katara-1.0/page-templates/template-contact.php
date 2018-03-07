<?php
/*
Template Name: Contact page layout
Template Post Type: page
*/
get_header(); ?>

	<?php
	if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
	
	 	<div class="content-inner-holder">

	 		<?php 
	 		get_template_part( 'template-parts/sidebar/sidebar', 'contact' );
	 		get_template_part( 'template-parts/page/contact/content', 'contact' ); ?>

		</div>

	<?php endwhile; endif; ?>


<?php get_footer();
