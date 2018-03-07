<div class="inner-content">
	<section class="k-section k-section-contact">
		<div class="title-holder">
			<h3><?php the_field( 'cntact_page_title' ) ?></h3>
			<span class="title-info"><?php the_field( 'cntact_sub_title' ) ?></span>
		</div>
		<div class="text-holder">
			<?php the_content() ?>
		</div>
		<div class="contact-form-holder">

			<?php if( isset( $_GET['message'] )  && $_GET['message'] == "success" ) { ?>
				<div class="msg-success">
					<p><?php _e( 'Form submitted successfully!', 'katara' ); ?></p>
				</div>
			<?php }

			echo do_shortcode( '[gravityform id=1 title=false description=false ajax=true]' ); ?>

		</div>
	</section>
</div>
<!-- inner-content end -->
<div class="contact-map-holder">
	<div class="contact-map" id="contact-map"></div>
</div>
