<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
		</div>
		<?php endif; ?>
	</header>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			$args = array(
				//'before' => '<div class="page-link"><span>' . __( 'Pages:', "Katara" . '</span>',
				//'after' => '</div>'
			);
			wp_link_pages( $args );
		?>
	</div>
</article>
