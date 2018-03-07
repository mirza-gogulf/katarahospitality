<?php
    global $wpdb;

    $access_id = $_GET['view_id'];
    
    $sql = "SELECT access.*, user.ID
        FROM  kat_access AS access
        LEFT JOIN $wpdb->users AS user ON ( access.access_user_id = user.ID )
        WHERE access_id = '$access_id'
        LIMIT 1";
    $katara_access = $wpdb->get_row( $sql );

    $key_array = array();
    $key_array['access_firstname'] = "First Name";
    $key_array['access_lastname'] = "Last Name";
    $key_array['access_company'] = "Company";
    $key_array['access_email'] = "Email";
    $key_array['access_message'] = "Message";
    $key_array['access_job_title'] = "Job Title";
    $key_array['access_document'] = "Document";
    $key_array['access_password'] = "Password";
    $key_array['access_status'] = "Status";
    $key_array['access_user_id'] = "User";
    $key_array['access_type'] = "Type";
    $key_array['access_datetime'] = "Date submitted";

    $page_slug = 'request-access';
?>
<div class="wrap" id="ad-manager">
	<div class="icon32" id="icon-users"><br/>
	</div>
	<h2>Request Access</h2>

	<table class="form-table">
		<tbody>
				<?php
					foreach ($katara_access as $application_key => $application_value)
					{ 
						if( ! empty( $application_value ) && ( $application_key != "access_id" && $application_key != 'application_type' && $application_key != 'ID' ) )
						{

							if ( $application_key == 'access_type' )
								$application_value = get_access_type( $application_value )->title;
			
							if($application_key=='access_datetime')
								$application_value = date("d/m/Y g:ia", strtotime($application_value));
								
							if ( $application_key == 'access_document' )
								$application_value = '<a href="'.$application_value.'" target="_blank">Download</a>';

							if ( $application_key == 'access_user_id' )
								$application_value = '<a href="'.admin_url( 'user-edit.php?user_id='.$application_value ).'">View User</a>';
				?>
						<tr valign="top">
							<th scope="row"><?php echo $key_array[$application_key]; ?></th>
							<td scope="row"><?php echo $application_value; ?></td>
						</tr>
			<?php
						}
					}
			?>
			<tr valign="top">
				<th scope="row">&nbsp;</th>
				<td scope="row">
					<?php
				        $user_info = get_access_user( $katara_access->ID, $katara_access->access_type, $katara_access->access_email );
				        
				        //pre( $user_info );
				        if ( ! $user_info['success'] ) { ?>
				        <p><?php echo $user_info['message']; ?></p>
				        <p><a class="button-primary" href="<?php echo admin_url().'admin.php?page='.$page_slug.'&amp;email='.$katara_access->access_email.'&amp;add_access='.$katara_access->access_type.'&amp;user_id='.$katara_access->ID.'&amp;acc_id='.$katara_access->access_id; ?>">Give User Access</a></p>
				    <?php } else { ?>
				        <p><?php echo $user_info['message']; ?></p>
				    <?php } ?>
				</td>
			</tr>
		</tbody>
	</table>
	
	<form action="admin.php" method="get">
		<input type="hidden" value="<?php echo $katara_access->access_id; ?>" name="alert_id" />
		<input type="hidden" value="careers" name="page" />
		<p class="submit"><a href="admin.php?page=request-access" title="Back">Back</a></p>
	</form>
</div>
