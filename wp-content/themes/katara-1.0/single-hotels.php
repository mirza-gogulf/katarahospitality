<?php get_header(); ?>

<div class="content-inner-holder">

	<?php get_template_part( 'template-parts/sidebar/sidebar', 'hotel-list' );

	if ( have_posts() ) : while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/single/hotel/content', 'hotel' );
	get_template_part( 'template-parts/single/hotel/content', 'similar' );

	endwhile; endif; ?>

</div>
<?php get_footer(); ?>