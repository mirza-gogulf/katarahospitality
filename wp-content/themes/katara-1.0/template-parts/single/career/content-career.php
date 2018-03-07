<div class="inner-content">
	<section class="k-section k-section-career k-section-history-future k-section-career-detail">

		<div class="career-content-wrap">

			<div class="title-holder">
				<strong class="title-top"><?php _e( 'Careers', 'katara' ) ?></strong>
				<h3><?php the_title() ?></h3>
				<span class="title-info"><?php echo __( 'Posted on', 'katara').' : '. get_the_date(); ?></span>
			</div>
			<div class="row b-career-detail">

				<div class="col-lg-12 b-career-detail-left">

					<div class="col-lg-4 b-career-detail-right">
							<div class="job-info">
								<ul>
									<?php $id = get_the_ID();
									$contract = str_replace( '-', ' ', get_post_meta( $id, 'job_employment', true ) ) ?>
									<li><strong><?php _e( 'Contract type', 'katara' ) ?></strong><?php echo ucfirst( $contract ) ?></li>
									<li><strong><?php _e( 'Level', 'katara' ) ?></strong><?php echo ucfirst( get_post_meta( $id, 'job_level', true ) ) ?></li>
									<li><strong><?php _e( 'Experience required', 'katara' ) ?></strong><?php echo intval( get_post_meta( $id, 'job_experience', true ) ) ?> Years</li>
									<li><strong><?php _e( 'Department', 'katara' ) ?></strong><?php echo ucfirst( get_post_meta( $id, 'job_department', true ) ) ?></li>
									<li><strong><?php _e( 'Location', 'katara' ) ?></strong><?php echo ucfirst( get_post_meta( $id, 'job_location', true ) ) ?> </li>
									<li><strong><?php _e( 'Joining date', 'katara' ) ?></strong><?php the_field( 'career_joining_date' ) ?></li>
								</ul>
							</div>
						</div>

					<div class="text-holder">
						<strong class="title"><?php _e( 'Role objective', 'katara' ) ?></strong>
						<p><?php the_field( 'career_role_objective' ) ?></p>
						<strong class="title"><?php _e( 'Detailed roles and responsibilities', 'katara' ) ?></strong>
						<?php the_content() ?>
					</div>
				</div>
				
			</div>

		</div>

		
		<div class="btn-holder">
			<a href="" id="v-timeline" class="btn btn-primary-square"><?php _e( 'apply now', 'katara' ) ?> </a>
		</div>

		 <div class="btn-holder nav-buttons">
            <?php $prev_post = get_previous_post();
            if($prev_post) {
               echo sprintf( '<a href="%s" data-pid ="%s" class="btn btn-primary-square btn-nav">%s</a>', '#', $prev_post->ID, __( 'prev', 'katara' ) );
            }

            $next_post = get_next_post();
            if($next_post) {
               echo sprintf( '<a href="%s" data-pid="%s" class="btn btn-primary-square btn-nav">%s</a>', '#', $next_post->ID,  __( 'next', 'katara' ) ); 
            } ?>

        </div>


		<div class="k-section k-section-timeline" id="k-section-timeline">
			<span class="close-timeline"><i>X</i> <?php _e( 'close form', 'katara' ); ?> </span>
			<div class="title-holder">
				<h3><?php the_title() ?></h3>
			</div>
			<?php get_template_part( 'template-parts/single/career/content', 'form' ); ?>
		</div>

		

	</section>
</div>
<script type="text/javascript">
	jQuery('#gform_2 #input_2_10').val( '<?php the_ID() ?>' );
	jQuery('#gform_2 #input_2_9').val( '<?php the_title() ?>' );
	jQuery( '#sidemenu li.par-2848' ).addClass( 'current_sidemenu_item' );
</script>