<?php get_header(); ?>
    
    <div class="content-inner-holder">

    <?php
        get_template_part( 'template-parts/sidebar/sidebar', 'page' );

        if( have_posts() ) : while( have_posts() ) : the_post();

            get_template_part( 'template-parts/single/tender/content', 'tender' ); 

        endwhile; endif; ?>

    </div>
    <script type="text/javascript">
		jQuery( '.navbar-light .navbar-nav .menu-item-2716' ).addClass( 'current-menu-item' ); 
        jQuery( '#sidemenu .par-2847' ).addClass( 'current_sidemenu_item' ); 

	</script>

<?php get_footer();
