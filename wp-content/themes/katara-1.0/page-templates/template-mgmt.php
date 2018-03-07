<?php
/*
Template Name: Mgmt page layout
Template Post Type: page
*/
get_header(); ?>
	
	<div class="content-inner-holder">

	<?php
		get_template_part( 'template-parts/sidebar/sidebar', 'page' );
		get_template_part( 'template-parts/page/mgmt/content', 'mgmt' ); ?>

	</div>
	<script type="text/javascript">
		jQuery( '.navbar-light .navbar-nav .menu-item-2714' ).addClass( 'current-page-ancestor' );
	</script>

<?php get_footer();
