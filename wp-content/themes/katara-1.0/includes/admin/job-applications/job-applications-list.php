<?php
    global $wpdb;

    $num_per_page = 10;
    
    $page_slug = 'job-applications';

    // Contact dates
    $sql = "SELECT DISTINCT YEAR(career.application_datetime) as date_year, MONTH(career.application_datetime) as date_month
        FROM kat_careers AS career
        WHERE 1=1
        ORDER BY career.application_datetime DESC";
    $application_dates = $wpdb->get_results( $sql );

    // Date
	$contact_filter_date = ( isset( $_GET['contact_datetime'] ) && $_GET['contact_datetime'] != "" ) ? trim( $_GET['contact_datetime'] ): FALSE;
	$date_sql = ( $contact_filter_date ) ? "AND contact_datetime LIKE '$contact_filter_date%'": "";

    // Page
	$page = 0;
	if(isset($_GET['paged']))
		$page = $_GET['paged'];

    // LIMIT
	$start_num = $page * $num_per_page;
	$limit = " LIMIT $start_num,$num_per_page";
	
	$application_details_sql = "SELECT SQL_CALC_FOUND_ROWS career.*, job.post_title AS job_title
        FROM kat_careers AS career
        JOIN $wpdb->posts AS job ON ( job.ID = career.application_job_id )
        WHERE 1=1
        $date_sql
        ORDER BY career.application_datetime DESC
        $limit";
    $application_details = $wpdb->get_results( $application_details_sql );
    
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
	<h2>Careers</h2>

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
			<select class="postform" id="contact_datetime" name="contact_datetime">
				<option value="">All Dates</option>
				<?php foreach($application_dates as $date) { $sql_date = date("Y-m", mktime(0, 0, 0, $date->date_month, 1, $date->date_year)); ?>
					<option value="<?php echo $sql_date; ?>" <?php if ( $contact_filter_date == $sql_date ) echo 'selected="selected"'; ?> ><?php echo date( "F, Y", mktime( 0, 0, 0, $date->date_month, 1, $date->date_year ) ); ?></option>
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
					<th scope="col">Job Title</th>
					<th scope="col">Date</th>
				</tr>
			</thead>
			<tfoot>
				<tr class="thead">
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Job Title</th>
					<th scope="col">Date</th>
				</tr>
			</tfoot>
			<tbody class="list:user user-list" id="users">
			    <?php if ( ! empty( $application_details ) ) { ?>
    				<?php $alt = 0; foreach ( $application_details  as $row ) : ?>
    					<tr <?php if ( $alt % 2 ) echo 'class="alternate"'; ?> id="contact-<?php echo $row->contact_id; ?>">
    						<td>
    						    <p><?php echo $row->application_firstname; ?></p>
    						    <div class="row-actions">
    						        <span class="view">
    						            <a rel="permalink" title="View Details" href="<?php echo admin_url(); ?>admin.php?page=<?php echo $page_slug; ?>&amp;view_id=<?php echo $row->application_id; ?>">View Details</a>
    						        </span>
    						    </div>
    						</td>
    						<td><p><?php echo $row->application_lastname; ?></p></td>
    						<td>
    						    <p><?php echo $row->job_title; ?></p>
    						    <div class="row-actions">
    						        <span class="view">
    						            <a rel="permalink" title="View Job" target="_blank" href="<?php bloginfo('url'); ?>?p=<?php echo $row->application_job_id; ?>">View Job</a>
    						        </span>
    						    </div>
    						</td>
    						<td><p><?php echo date( "d/m/Y H:i", strtotime( $row->application_datetime ) ); ?></p></td>
    					</tr>
    				<?php $alt++; endforeach; ?>
    			<?php } else { ?>
    			    <tr class="no-items"><td colspan="4" class="colspanchange">No information found.</td></tr>
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