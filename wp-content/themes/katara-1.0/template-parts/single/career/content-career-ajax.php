<?php global $post;
$id = $post->ID; ?>
<div class="title-holder">
	<strong class="title-top"><?php _e( 'Careers', 'katara' ) ?></strong>
	<h3><?php echo $post->post_title ?></h3>
	<span class="title-info"><?php echo __( 'Posted on', 'katara').' : '. get_the_date( $id ); ?></span>
</div>
<div class="row b-career-detail">

	<div class="col-lg-12 b-career-detail-left">

		<div class="col-lg-4 b-career-detail-right">
				<div class="job-info">
					<ul>
						<?php 
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
			<p><?php the_field( 'career_role_objective', $id ) ?></p>
			<strong class="title"><?php _e( 'Detailed roles and responsibilities', 'katara' ) ?></strong>
			<?php echo wpautop( $post->post_content ) ?>
		</div>
	</div>
	
</div>