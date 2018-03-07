<li class="one-col-list-item" id="board-<?php the_ID(); ?>">
	<h2 class="sub-ttl-22"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<?php the_excerpt(); ?>
	<a href="<?php the_permalink(); ?>" class="more"><?php echo __( 'Read More', "Katara" ); ?></a>
</li>