<?php
    get_header();
    get_sidebar('navi');
?>
    <article class="grid_9 content col-span-2">
        <header class="gen-content-header">
		    <h1 class="ttl-36"><?php the_title(); ?></h1>
		</header>
        <?php get_template_part( "modules/page", "board-members" ); ?>
    </article>
<?php    
    get_sidebar();
    get_footer();
?>