<?php
    global $wpdb, $page_block_ids;

    $num_per_page = 10;

    $page_slug = 'request-access';

    // Access Types
    $sql = "SELECT DISTINCT access.access_type
        FROM kat_access AS access
        WHERE 1=1
        GROUP BY access.access_type
        ORDER BY access.access_type ASC";
    $access_types = $wpdb->get_results( $sql );
    
    // Access dates
    $sql = "SELECT DISTINCT YEAR(access.access_datetime) as date_year, MONTH(access.access_datetime) as date_month
        FROM kat_access AS access
        WHERE 1=1
        ORDER BY access.access_datetime DESC";
    $access_dates = $wpdb->get_results( $sql );

    // Date
	$access_filter_date = ( isset( $_GET['access_datetime'] ) && $_GET['access_datetime'] != "" ) ? trim( $_GET['access_datetime'] ): FALSE;
	$date_sql = ( $access_filter_date ) ? "AND access_datetime LIKE '$access_filter_date%'": "";
	
	// Type
	$access_filter_type = ( isset( $_GET['access_type'] ) && $_GET['access_type'] != "" ) ? trim( $_GET['access_type'] ): "";
	$type_sql = ( $access_filter_type != "" ) ? "AND access_type = '$access_filter_type'": "";

    // Page
	$page = 0;
	if(isset($_GET['paged']))
		$page = $_GET['paged'];

    // LIMIT
	$start_num = $page * $num_per_page;
	$limit = " LIMIT $start_num,$num_per_page";
	
	$access_details_sql = "SELECT SQL_CALC_FOUND_ROWS access.*, user.*
        FROM kat_access AS access
        LEFT JOIN $wpdb->users AS user ON ( access.access_user_id = user.ID )
        WHERE 1=1
        $date_sql
        $type_sql
        ORDER BY access.access_datetime DESC
        $limit";
    $access_details = $wpdb->get_results( $access_details_sql );
    
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
	<h2>Access Control</h2>

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

	<form method="get" action="admin.php?page=<?php echo $page_slug?>" id="posts-filter">
		<input type="hidden" name="page" value="<?php echo $page_slug?>" />
		
		<div class="tablenav">
			<select class="postform" id="access_type" name="access_type">
			    <option value="">All Request Areas</option>
			    <?php foreach( $access_types as $type ) { ?>
					<option value="<?php echo $type->access_type; ?>" <?php if ( $access_filter_type == $type->access_type ) echo 'selected="selected"'; ?> ><?php echo get_access_area( $type->access_type ); ?></option>
				<?php } ?>
			</select>

			<select class="postform" id="access_datetime" name="access_datetime">
				<option value="">All Dates</option>
				<?php foreach($access_dates as $date) { $sql_date = date("Y-m", mktime(0, 0, 0, $date->date_month, 1, $date->date_year)); ?>
					<option value="<?php echo $sql_date; ?>" <?php if ( $access_filter_date == $sql_date ) echo 'selected="selected"'; ?> ><?php echo date( "F, Y", mktime( 0, 0, 0, $date->date_month, 1, $date->date_year ) ); ?></option>
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
					<th scope="col">User</th>
					<th scope="col">Email</th>
					<th scope="col">Area</th>
					<th scope="col">Date</th>
				</tr>
			</thead>
			<tfoot>
				<tr class="thead">
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">User</th>
					<th scope="col">Email</th>
					<th scope="col">Area</th>
					<th scope="col">Date</th>
				</tr>
			</tfoot>
			<tbody class="list:user user-list" id="users">
			    <?php if ( ! empty( $access_details ) ) { ?>
    				<?php $alt = 0; foreach ( $access_details  as $row ) : ?>
    					<tr <?php if ( $alt % 2 ) echo 'class="alternate"'; ?> id="log-<?php echo $row->log_id; ?>">
    						<td>
    							<p><?php echo $row->access_firstname; ?></p>
    							<div class="row-actions">
    						        <span class="view"><a rel="permalink" title="View Request" href="<?php echo admin_url(); ?>admin.php?page=<?php echo $page_slug; ?>&amp;view_id=<?php echo $row->access_id; ?>">View Request</a> | </span>
									<span class="delete"><a href="<?php echo admin_url( "admin.php?page=$page_slug&amp;delete_id=$row->access_id" ); ?>" onclick="return showNotice.warn();" class="submitdelete">Delete</a></span>
    						    </div>
    						</td>
    						<td><p><?php echo $row->access_lastname; ?></p></td>
    						<td>
    						    <?php
    						        $user_info = get_access_user( $row->ID, $row->access_type, $row->access_email );
    						        
    						        //pre( $user_info );
    						        if ( ! $user_info['success'] ) { ?>
    						        <p><?php echo $user_info['message']; ?></p>
    						        <p><a href="<?php echo admin_url().'admin.php?page='.$page_slug.'&amp;email='.$row->access_email.'&amp;add_access='.$row->access_type.'&amp;user_id='.$row->ID.'&amp;acc_id='.$row->access_id; ?>">Give User Access</a></p>
    						    <?php } else { ?>
    						        <p><?php echo $user_info['message']; ?></p>
    						    <?php } ?>
    						</td>
    						<td><p><?php echo $row->access_email; ?></p></td>
    						<td><p><?php echo get_access_area( $row->access_type ); ?></p></td>
    						<td><p><?php echo date( "d/m/Y H:i", strtotime( $row->access_datetime ) ); ?></p></td>
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