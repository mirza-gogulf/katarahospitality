<?php get_header(); ?>
	
	<div class="content-inner-holder">

	<?php
		get_template_part( 'template-parts/sidebar/sidebar', 'page' );

		if( have_posts() ) : while( have_posts() ) : the_post();

			get_template_part( 'template-parts/single/career/content', 'career' ); 

		endwhile; endif; ?>

	</div>

	<?php if( isset( $_GET['message'] )  && ( $_GET['message'] == "success" ) ) {  //on career form submit ?>
		<script type="text/javascript">
			jQuery('.k-section-timeline').addClass('open');
		</script>
	<?php } ?>
	<script type="text/javascript">
		jQuery( '.navbar-light .navbar-nav .menu-item-2855' ).addClass( 'current-menu-item' ); 
	</script>

<?php get_footer();
