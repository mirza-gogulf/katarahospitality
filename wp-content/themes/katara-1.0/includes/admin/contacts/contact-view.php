<?php
    global $wpdb;

    $contact_id = $_GET['view_id'];
    
    $sql = "SELECT *
        FROM  kat_contact
        WHERE contact_id = '$contact_id' LIMIT 1";
    $katara_contacts = $wpdb->get_results( $sql );

    $key_array = array();
    $key_array['contact_first_name'] = "First Name";
    $key_array['contact_last_name'] = "Last Name";
    $key_array['contact_datetime'] = "Date submitted";
    $key_array['contact_subject'] = "Subject";
    $key_array['contact_email'] = "Email";
    $key_array['contact_message'] = "Message";
    $key_array['contact_department'] = "Department";
    $key_array['contact_company'] = "Company";
?>
<?php foreach ($katara_contacts as $katara_contacts) { ?>
<div class="wrap" id="ad-manager">
	<div class="icon32" id="icon-users"><br/>
	</div>
	<h2><?php echo $katara_contacts->contact_department; ?></h2>

	<table class="form-table">
		<tbody>
				<?php foreach ($katara_contacts as $contact_key => $contact_value) { 
				if(!empty($contact_value) && ($contact_key != "contact_id" && $contact_key != 'contact_type')) {
					
					if($contact_key=='contact_datetime')
						$contact_value = date("d/m/Y", strtotime($contact_value));
						
					if($contact_key=='contact_message')
						$contact_value = nl2br($contact_value);
				?>
				<tr valign="top">
					<th scope="row"><?php echo $key_array[$contact_key]; ?></th>
					<td scope="row"><?php echo $contact_value; ?></td>
				</tr>
			<?php }} ?>
		</tbody>
	</table>
	<form action="admin.php" method="get">
		<input type="hidden" value="<?php echo $katara_contacts->contact_id; ?>" name="alert_id" />
		<input type="hidden" value="careers" name="page" />
		<p class="submit"><a href="admin.php?page=contact-list" title="Back">Back</a></p>
	</form>
</div>
<?php } ?>