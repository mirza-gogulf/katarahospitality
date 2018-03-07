<?php
/*
Template Name: About page layout
Template Post Type: page
*/
get_header(); ?>
	
	<div class="content-inner-holder">

	<?php
		get_template_part( 'template-parts/sidebar/sidebar', 'page' );

		if( have_posts() ) : while( have_posts() ) : the_post();

		if( is_page( 'katara-hospitality' ) ){
			get_template_part( 'template-parts/page/about/content', 'katara-hosp' ); 

		}
		elseif ( is_page( 'history-future' ) ) {
			get_template_part( 'template-parts/page/about/content', 'history-future' ); 
		}
		else{
			get_template_part( 'template-parts/page/about/content', 'normal' ); 
		}

		endwhile; endif; ?>

	</div>
	<script type="text/javascript">
		jQuery( '.navbar-light .navbar-nav .menu-item-2714' ).addClass( 'current-page-ancestor' );
	</script>

<?php get_footer();
