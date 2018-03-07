<?php
    get_header(); ?>
		
	
        <div class="content-inner-holder">

        <?php 
        get_template_part( 'template-parts/sidebar/sidebar', 'news' );

        if ( have_posts() ) : while( have_posts() ) : the_post(); 

        get_template_part( 'template-parts/single/news/content', 'news' );

        endwhile; endif; ?>

        </div>
        <script type="text/javascript">
            jQuery( '.navbar-light .navbar-nav .menu-item-2856' ).addClass( 'current-menu-item' ); 
        </script>


<?php
    get_footer();
?>