<?php
    get_header();
    get_sidebar('navi');
    global $sub_nav;
?>
		<div class="six00<?php if(!$sub_nav){ echo ' no-sub-nav';}?>">
			<div id="content" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'single' ); ?>
				<?php endwhile;  ?>
			</div>
		</div>
<?php
    get_sidebar();
    get_footer();
?>