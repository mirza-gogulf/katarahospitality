<div class="inner-content">
	<section class="k-section k-section-career">
		<div class="title-holder">
			<h3><?php the_title() ?></h3>
			<span class="title-info"><?php echo get_post_meta( get_the_ID(), 'page_sub_title', true ) ?> </span>
		</div>
		<div class="text-holder">
			<?php the_content(); ?>
		</div>
		<?php $careerQuery = kataraGetCareers( 'career-opportunities' );
		if ( $careerQuery -> have_posts() ) : ?>
		<div class="career-card-holder">
			<?php while ( $careerQuery -> have_posts() ) : $careerQuery -> the_post();  

			get_template_part( 'template-parts/loop/loop', 'career' ); 
		
			endwhile; ?>
		</div>
		<?php endif; ?>
	</section>
</div>