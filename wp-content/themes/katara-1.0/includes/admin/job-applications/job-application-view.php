<?php
    global $wpdb;

    $application_id = $_GET['view_id'];
    
    $sql = "SELECT career.*
        FROM  kat_careers AS career
        JOIN $wpdb->posts AS job ON ( job.ID = career.application_job_id )
        WHERE application_id = '$application_id'
        LIMIT 1";
    $katara_contacts = $wpdb->get_results( $sql );

    $key_array = array();
    $key_array['application_job_id'] = "Job Title";
    $key_array['application_firstname'] = "First Name";
    $key_array['application_lastname'] = "Last Name";
    $key_array['application_nationality'] = "Nationality";
    $key_array['application_dob'] = "Date of birth";
    $key_array['application_country'] = "Country";
    $key_array['application_city'] = "City";
    $key_array['application_mobile'] = "Mobile number";
    $key_array['application_number'] = "Daytime contact number";
    $key_array['application_education'] = "Educational qualification";
    $key_array['application_experience'] = "Years of experience";
    $key_array['application_resume'] = "Resume";
    $key_array['application_intent'] = "Intent";
    $key_array['application_datetime'] = "Date submitted";
?>
<?php foreach ($katara_contacts as $katara_contacts) { ?>
<div class="wrap" id="ad-manager">
	<div class="icon32" id="icon-users"><br/>
	</div>
	<h2>Job Application</h2>

	<table class="form-table">
		<tbody>
				<?php foreach ($katara_contacts as $application_key => $application_value) { 
				if(!empty($application_value) && ($application_key != "application_id" && $application_key != 'application_type')) {
					
					if ( $application_key == 'application_job_id' )
						$application_value = get_the_title($application_value);
					
					if($application_key=='application_dob')
						$application_value = date("d/m/Y", strtotime($application_value));
	
					if($application_key=='application_datetime')
						$application_value = date("d/m/Y", strtotime($application_value));
						
					if ( $application_key == 'application_resume' || $application_key == 'application_intent' )
						$application_value = '<a href="'.$application_value.'" target="_blank">Download</a>';
				?>
				<tr valign="top">
					<th scope="row"><?php echo $key_array[$application_key]; ?></th>
					<td scope="row"><?php echo $application_value; ?></td>
				</tr>
			<?php }} ?>
		</tbody>
	</table>
	<form action="admin.php" method="get">
		<input type="hidden" value="<?php echo $katara_contacts->application_id; ?>" name="alert_id" />
		<input type="hidden" value="careers" name="page" />
		<p class="submit"><a href="admin.php?page=job-applications" title="Back">Back</a></p>
	</form>
</div>
<?php } ?>