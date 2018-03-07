<?php get_header(); ?>
<?php get_sidebar('navi'); ?>
        
		<div class="six00">
			<div id="content" role="main">
			    <article id="post-195" class="post-195 page type-page status-publish hentry">
			        <?php the_post(); ?>
                	<header class="entry-header">
                		<h1 class="entry-title"><?php the_title(); ?></h1>
                	</header><!-- .entry-header -->

                	<div class="entry-content">
                		<?php the_content(); ?>
                	</div>
                
                </article>

			</div>
		</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>