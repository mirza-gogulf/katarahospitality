<?php
    global $wpdb;


    if(isset($_GET['mark_id']) && !empty($_GET['mark_id']))
	{
		$update_id = $_GET['mark_id'];
		$wpdb->update( 'kat_contact', array('contact_status' => '1'), array( 'contact_id' => $update_id ));
	}
	elseif(isset($_GET['unmark_id']) && !empty($_GET['unmark_id']))
	{
		$update_id = $_GET['unmark_id'];
		$wpdb->update( 'kat_contact', array('contact_status' => '0'), array( 'contact_id' => $update_id ));
	}

    $num_per_page = 10;
    
    $page_slug = 'contact-list';

    $where_dep = '';
    if(! current_user_can('manage_options'))
    {
    	$_GET['contact_department'] = get_current_user_role();	
    }

    if($cdep = get_current_user_role() &&  ! current_user_can('manage_options'))
    {
    	$where_dep = " AND contact.contact_department = '{$cdep}'";
    }
    // Contact Types
    $sql = "SELECT DISTINCT contact.contact_department
        FROM kat_contact AS contact
        WHERE 1=1
        ".$where_dep."
        ORDER BY contact.contact_department ASC";

    $contact_departments = $wpdb->get_results( $sql );
    
    // Contact dates
    $sql = "SELECT DISTINCT YEAR(contact.contact_datetime) as date_year, MONTH(contact.contact_datetime) as date_month
        FROM kat_contact AS contact
        WHERE 1=1
        ORDER BY contact.contact_datetime DESC";
    $contact_dates = $wpdb->get_results( $sql );

    // Contact statuses
    $sql = "SELECT DISTINCT contact_status
        FROM kat_contact AS contact
        WHERE 1=1
        ORDER BY contact.contact_datetime DESC";
    $contact_statuses = $wpdb->get_results( $sql );

    // Date
	$contact_filter_date = ( isset( $_GET['contact_datetime'] ) && $_GET['contact_datetime'] != "" ) ? trim( $_GET['contact_datetime'] ): FALSE;
	$date_sql = ( $contact_filter_date ) ? "AND contact_datetime LIKE '$contact_filter_date%'": "";
	
	// Type
	$contact_filter_department = ( isset( $_GET['contact_department'] ) && $_GET['contact_department'] != "" ) ? trim( $_GET['contact_department'] ): "";
	$type_sql = ( $contact_filter_department != "" ) ? "AND contact_department = '$contact_filter_department'": "";

	// Status
	$contact_filter_status = ( isset( $_GET['contact_status'] ) && $_GET['contact_status'] != "" ) ? trim( $_GET['contact_status'] ): "";
	$status_sql = ( $contact_filter_status != "" ) ? "AND contact_status = '$contact_filter_status'": "";

    // Page
	$page = 0;
	if(isset($_GET['paged']))
		$page = $_GET['paged'];

    // LIMIT
	$start_num = $page * $num_per_page;
	$limit = " LIMIT $start_num,$num_per_page";
	
	$contact_details_sql = "SELECT SQL_CALC_FOUND_ROWS contact.*
        FROM kat_contact AS contact
        WHERE 1=1
        $date_sql
        $type_sql
        $status_sql
        ORDER BY contact.contact_datetime DESC
        $limit";
    $contact_details = $wpdb->get_results( $contact_details_sql );
    
    $sql_found_rows = "SELECT FOUND_ROWS()";
    $num_results = $wpdb->get_var( $sql_found_rows );
    
    // Query String
	$query_string_arr = array();
	foreach($_GET as $key => $value)
	{
		if($key!="alert_id" && $key!="pending_id" && $key!="delete_id" && $key!="page" && $key!="paged")
			$query_string_arr[]= $key."=".$value;
		elseif($key="page")
			$query_string_arr[]= $key."=".$page_slug;
	}
	
	if(isset($force_contact_type))
		$query_string_arr[]='contact_type='.$force_contact_type;
	
	$query_string = join("&",$query_string_arr);
	
?>
<div class="wrap" id="ad-manager">
	<div class="icon32" id="icon-options-general"><br/>
	</div>
	<h2>Contacts</h2>

	<?php if ( isset( $success ) ) { ?>
		<div id="message" class="success fade">
			<p><?php echo $success; ?></p>
		</div>
	<?php } ?>
	
	<?php if ( isset( $err ) ) { ?>
		<div id="message" class="error fade">
			<p><?php echo $err; ?></p>
		</div>
	<?php } ?>

	<form method="get" action="admin.php?page=<?php echo $page_slug; ?>" id="posts-filter">
		<input type="hidden" name="page" value="<?php echo $page_slug; ?>" />
		
		<div class="tablenav">
			<select class="postform" id="contact_department" name="contact_department">
			    <option value="">All Departments</option>
			    <?php foreach( $contact_departments as $department ) { ?>
					<option value="<?php echo $department->contact_department; ?>" <?php if ( $contact_filter_department == $department->contact_department ) echo 'selected="selected"'; ?> ><?php echo $department->contact_department; ?></option>
				<?php } ?>
			</select>
		

			<select class="postform" id="contact_datetime" name="contact_datetime">
				<option value="">All Dates</option>
				<?php foreach($contact_dates as $date) { $sql_date = date("Y-m", mktime(0, 0, 0, $date->date_month, 1, $date->date_year)); ?>
					<option value="<?php echo $sql_date; ?>" <?php if ( $contact_filter_date == $sql_date ) echo 'selected="selected"'; ?> ><?php echo date( "F, Y", mktime( 0, 0, 0, $date->date_month, 1, $date->date_year ) ); ?></option>
				<?php } ?>
			</select>

			<select class="postform" id="contact_status" name="contact_status">
				<option value="">All Statues</option>
				<?php foreach($contact_statuses as $status) { ?>
					<option value="<?php echo $status->contact_status; ?>" <?php if ( $contact_filter_status == $status->contact_status ) echo 'selected="selected"'; ?> ><?php echo ( $status->contact_status == 1 ) ? 'Contacted': 'Uncontacted'; ?></option>
				<?php } ?>
			</select>
			<input type="submit" class="button-secondary" value="Filter" id="post-query-submit" />

			<div class="alignright">
				<!-- <h2><a class="button add-new-h2" href="<?php echo get_bloginfo('template_url').'/export-csv.php?'.$query_string; ?>">Export to CSV</a></h2>  //-->
			</div>

			<br class="clear"/>
		</div>
		
		<table cellspacing="0" class="widefat fixed">
			<thead>
				<tr class="thead">
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Status</th>
					<th scope="col">Email</th>
					<th scope="col">Department</th>
					<th scope="col">Date</th>
				</tr>
			</thead>
			<tfoot>
				<tr class="thead">
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Status</th>
					<th scope="col">Email</th>
					<th scope="col">Department</th>
					<th scope="col">Date</th>
				</tr>
			</tfoot>
			<tbody class="list:user user-list" id="users">
			    <?php if ( ! empty( $contact_details ) ) { ?>
    				<?php $alt = 0; foreach ( $contact_details  as $row ) : ?>
    					<tr <?php if ( $row->contact_status == '1' ) { echo ' style="background-color:#e6ffe6;"';} elseif ( $alt % 2 ) echo 'class="alternate"'; ?> id="contact-<?php echo $row->contact_id; ?>">
    						<td>
    						    <p><?php echo $row->contact_first_name; ?></p>
    						    <div class="row-actions">
    						    	<span class="view">
    						    		<?php
											echo '<a href="'.admin_url( 'admin.php?page=contact-list&amp;view_id='.$row->contact_id ).'">View Details</a> | ';
											
											if( $row->contact_status == 0 )
											{
												echo '<a href="'.admin_url( 'admin.php?page=contact-list&amp;mark_id='.$row->contact_id ).'">Mark as contacted</a>';
											}
											else
											{
												echo '<a href="'.admin_url( 'admin.php?page=contact-list&amp;unmark_id='.$row->contact_id ).'">Mark as uncontacted</a>';
											}
										?>
    						    	</span>
    						    </div>
    						</td>
    						<td><p><?php echo $row->contact_last_name; ?></p></td>
    						<td><p><?php echo ( $row->contact_status ) ? 'Contacted': 'Not contacted'; ?></p></td>
    						<td><p><?php echo $row->contact_email; ?></p></td>
    						<td><p><?php echo $row->contact_department; ?></p></td>
    						<td><p><?php echo date( "d/m/Y H:i", strtotime( $row->contact_datetime ) ); ?></p></td>
    					</tr>
    				<?php $alt++; endforeach; ?>
    			<?php } else { ?>
    			    <tr class="no-items"><td colspan="5" class="colspanchange">No information found.</td></tr>
    			<?php } ?>
			</tbody>
		</table>
		
		<div class="tablenav">
			<div class="tablenav-pages">
				<?php
					$num_pages = ceil($num_results / $num_per_page);
					for( $i=0; $i < $num_pages; $i++ )
					{
					if($i != $page) { ?>
						<a href="/wp-admin/admin.php?<?php echo $query_string; ?>&amp;paged=<?php echo $i; ?>" class="page-numbers"><?php echo $i+1; ?></a>
					<?php } else { ?>
						<span class="page-numbers current"><?php echo $i+1; ?></span>
					<?php } ?>
				<?php } ?>
				<br class="clear">
			</div>
			<br class="clear">
		</div>
		
	</form>
</div>
<br class="clear"/>
<div class="clear">&nbsp;</div>