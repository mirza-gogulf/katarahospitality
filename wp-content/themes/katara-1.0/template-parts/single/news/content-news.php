<div class="inner-content">
	<section class="k-section k-section-about k-section-news-detail">

		<div class="title-holder">
			<h3><?php the_title() ?></h3>
			<span class="pub-date"><?php echo get_the_date(); ?></span>
		</div>
		<?php $nImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), 'full'); 
		if( $nImg) { ?>
		<div class="image-holder">
			<img src="<?php echo $nImg ?>" class="img-fluid" alt="">
		</div>
		<?php } ?>
		<div class="text-holder">
			<?php the_content(); ?>
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