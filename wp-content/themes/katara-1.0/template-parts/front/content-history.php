<section class="k-section k-section-future">
	<div class="container">
		<div class="title-holder">
			<h2><?php the_field( 'front_history_section_title' ) ?></h2>
		</div>
		<div class="future-block">
			<div class="row">
				<div class="col-lg-11 offset-lg-1">
					<div class="top-text">
						<p><?php the_field( 'front_history_section_desc' ) ?></p>
					</div>

					<?php get_template_part( 'template-parts/timeline/content', 'timeline' ); ?>

				</div>
			</div>
		</div>
	</div>
</section>
<!-- section-future end -->