<?php get_header(); the_post(); ?>
<?php get_sidebar('navi'); ?>

    <article class="grid_6 content col-span-1">
		<header class="gen-content-header">
		    <h1 class="ttl-36"><?php the_title(); ?></h1>
		    <p class="tag-line-16"><?php echo __( 'We are inspired', "Katara" ); ?></p>
		</header>
		<?php the_content(); ?>
	</article>

<?php get_sidebar(); ?>
<?php get_footer(); ?>