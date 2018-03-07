<?php if( isset( $_GET['message'] )  && $_GET['message'] == "success" ) { ?>
	<div class="msg-success">
		<p>Form submitted successfully!</p>
	</div>
<?php } ?>

<div class="career-form-holder d-flex align-items-start">
	
	<?php echo do_shortcode( '[gravityform id="2" name="Career Form" title="false" description="false" ajax="true"]' ); ?>
</div>