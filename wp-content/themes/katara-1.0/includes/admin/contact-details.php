<?php
	$updated = false;

	$contact_address = get_option('contact_address');
	$contact_tel = get_option('contact_tel');
	$contact_fax = get_option('contact_fax');
	$contact_email = get_option('contact_email');
	$contact_press = get_option('contact_press');

	$contact_job = get_option( 'contact_job' );
	$contact_form = get_option( 'contact_form' );
	$contact_press_email = get_option( 'contact_press_email' );
	$contact_tender = get_option( 'contact_tender' );
	$contact_career = get_option( 'contact_career' );

	if(isset($_POST['action']))
	{
		$updated = true;

		$contact_address = strip_slashes_if_required( $_POST['contactAddress'] );
		$contact_tel = strip_slashes_if_required( $_POST['contactTel'] );
		$contact_fax = strip_slashes_if_required( $_POST['contactFax'] );
		$contact_press = strip_slashes_if_required( $_POST['contactPress'] );
		$contact_email = strip_slashes_if_required( $_POST['contactEmail'] );

		$contact_job = strip_slashes_if_required( $_POST['contactJob'] );
		$contact_form = strip_slashes_if_required( $_POST['contactForm'] );
		$contact_press_email = strip_slashes_if_required( $_POST['contactPressEmail'] );
		$contact_tender = strip_slashes_if_required( $_POST['contactTender'] );
		$contact_career = strip_slashes_if_required( $_POST['contactCareer'] );

		update_option( 'contact_address', $contact_address );
		update_option( 'contact_tel', $contact_tel );
		update_option( 'contact_fax', $contact_fax );
		update_option( 'contact_press', $contact_press );
		update_option( 'contact_email', $contact_email );

		update_option( 'contact_job', $contact_job );
		update_option( 'contact_form', $contact_form );
		update_option( 'contact_press_email', $contact_press_email );
		update_option( 'contact_tender', $contact_tender );
		update_option( 'contact_career', $contact_career );
	}
?>
<div class="wrap">
	<div class="icon32" id="icon-options-general"><br/></div>
	<h2>Contact Details</h2>
	
	<?php if($updated) { ?>
		<div id="message" class="success fade">
			<p>Settings updated</p>
		</div>
	<?php } ?>
	
	<?php if(isset($err)) { ?>
		<div id="message" class="error fade" style="width:39.5em;">
			<p><?php echo $err ?></p>
		</div>
	<?php } ?>

	<form action="" method="post" enctype="multipart/form-data">

		<table class="form-table">

            <tr valign="top">
				<th scope="row"><label for="contactAddress">Address: </label></th>
				<td><textarea class="all-options" id="contactAddress" cols="50" rows="10" name="contactAddress"><?php if(!empty($contact_address)) { echo $contact_address; } ?></textarea></td>
			</tr>

			<tr valign="top">
				<th scope="row"><label for="contactTel">Telephone: </label></th>
				<td><input type="text" class="regular-text" name="contactTel" id="contactTel" value="<?php if(!empty($contact_tel)) { echo $contact_tel; } ?>" /></td>
			</tr>

			<tr valign="top">
				<th scope="row"><label for="contactFax">Fax: </label></th>
				<td><input type="text" class="regular-text" name="contactFax" id="contactFax" value="<?php if(!empty($contact_fax)) { echo $contact_fax; } ?>" /></td>
			</tr>
			
			<tr valign="top">
				<th scope="row"><label for="contactEmail">Email: </label></th>
				<td><input type="text" class="regular-text" name="contactEmail" id="contactEmail" value="<?php if(!empty($contact_email)) { echo $contact_email; } ?>" /></td>
			</tr>
			
			<tr valign="top">
				<th scope="row"><label for="contactPress">For press enquiries: </label></th>
				<td><textarea class="all-options" id="contactPress" cols="50" rows="10" name="contactPress"><?php if(!empty($contact_press)) { echo $contact_press; } ?></textarea></td>
			</tr>

			<tr valign="top">
				<th scope="row"><label for="contactJob">Job Applications: </label></th>
				<td><input type="text" class="regular-text" name="contactJob" id="contactJob" value="<?php if(!empty($contact_job)) { echo $contact_job; } ?>" /></td>
			</tr>

			<tr valign="top">
				<th scope="row"><label for="contactForm">Contact Us: </label></th>
				<td><input type="text" class="regular-text" name="contactForm" id="contactForm" value="<?php if(!empty($contact_form)) { echo $contact_form; } ?>" /></td>
			</tr>

			<tr valign="top">
				<th scope="row"><label for="contactPressEmail">Press Request: </label></th>
				<td><input type="text" class="regular-text" name="contactPressEmail" id="contactPressEmail" value="<?php if(!empty($contact_press)) { echo $contact_press_email; } ?>" /></td>
			</tr>

			<tr valign="top">
				<th scope="row"><label for="contactTender">Tender Request: </label></th>
				<td><input type="text" class="regular-text" name="contactTender" id="contactTender" value="<?php if(!empty($contact_tender)) { echo $contact_tender; } ?>" /></td>
			</tr>

			<tr valign="top">
				<th scope="row"><label for="contactCareer">Career Request: </label></th>
				<td><input type="text" class="regular-text" name="contactCareer" id="contactCareer" value="<?php if(!empty($contact_career)) { echo $contact_career; } ?>" /></td>
			</tr>

		</table>

		<input type="hidden" name="action" value="update" />

		<p class="submit">
			<input type="submit" class="button-primary" value="Save Changes" />
		</p>

	</form>
</div>