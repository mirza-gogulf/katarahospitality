<div class="inner-content">
	<section class="k-section k-section-history-future">
		<div class="text-holder">
			<h3><?php the_field( 'history_first_section_title' ) ?></h3>
			<?php the_content(); ?>
		</div>
		<div class="text-holder" id="future">
			<h3><?php the_field( 'history_second_section_title' ) ?></h3>
			<?php the_field( 'second_section_desc' ) ?>
		</div>
		<div class="btn-holder">
			<a href="" id="v-timeline" class="btn btn-primary-square"><?php the_field( 'history_view_timel_btn_text' ) ?></a>
		</div>
		<div class="k-section k-section-timeline" id="k-section-timeline">
			<span class="close-timeline"><i>X</i> <?php _e( 'close timeline', 'katara' ); ?> </span>

			<?php get_template_part( 'template-parts/timeline/content', 'timeline' ); ?>

		</div>
	</section>
</div>