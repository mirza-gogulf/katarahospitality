<div class="inner-content">
	<section class="k-section k-section-tender-detail">

		<div class="news-sort d-flex align-items-start justify-content-between">
			<div class="title-holder">
				<strong class="title-top"><?php _e( 'Tenderse', 'katara' ) ?></strong>
				<h3><?php the_title() ?></h3>
			</div>
		</div>
		<div class="text-holder">
			<?php the_content() ?>
		</div>
		<div class="btn-holder">
			<?php $prev_post = get_previous_post();
			if($prev_post) {
			   echo sprintf( '<a href="%s" data-pid ="%s" class="btn btn-primary-square btn-nav">%s</a>', get_permalink($prev_post->ID), $prev_post->ID, __( 'prev', 'katara' ) );
			}

			$next_post = get_next_post();
			if($next_post) {
			   echo sprintf( '<a href="%s" data-pid="%s" class="btn btn-primary-square btn-nav">%s</a>', get_permalink($next_post->ID), $next_post->ID,  __( 'next', 'katara' ) ); 
			} ?>

		</div>

	</section>
</div>
