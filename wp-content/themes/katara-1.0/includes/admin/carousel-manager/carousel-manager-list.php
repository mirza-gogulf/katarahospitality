<?php
    global $wpdb, $ln_site_details;

    $num_per_page = 10;

    $page_slug = 'carousels';

    // Sites
    $sql = "SELECT DISTINCT carousel.caro_site_id
        FROM kat_carousel AS carousel
        WHERE 1=1
        GROUP BY carousel.caro_site_id
        ORDER BY carousel.caro_id ASC";
    $caro_sites = $wpdb->get_results( $sql );

	// Type
	$caro_filter_site = ( isset( $_GET['caro_site_id'] ) && $_GET['caro_site_id'] != "" ) ? trim( $_GET['caro_site_id'] ): "";
	$site_sql = ( $caro_filter_site != "" ) ? "AND caro_site_id = '$caro_filter_site'": "";

    // Page
	$page = 0;
	if(isset($_GET['paged']))
		$page = $_GET['paged'];

    // LIMIT
	$start_num = $page * $num_per_page;
	$limit = " LIMIT $start_num,$num_per_page";
	
	$caro_details_sql = "SELECT SQL_CALC_FOUND_ROWS carousel.*
        FROM kat_carousel AS carousel
        WHERE 1=1
        $site_sql
        ORDER BY carousel.caro_datetime DESC
        $limit";
    $caro_details = $wpdb->get_results( $caro_details_sql );
    
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
	<div class="icon32" id="icon-themes"><br/>
	</div>
	<h2>
		Carousels
		<a href="<?php echo admin_url( 'admin.php?page=carousel-add' ); ?>" class="button add-new-h2">Add New</a>
	</h2>

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
			<select class="postform" id="caro_site_id" name="caro_site_id">
			    <option value="">All Sites</option>
			    <?php foreach( $caro_sites as $site ) { ?>
					<option value="<?php echo $site->caro_site_id; ?>" <?php if ( $caro_filter_site == $site->caro_site_id ) echo 'selected="selected"'; ?>><?php echo $ln_site_details[$site->caro_site_id]->blogname; ?></option>
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
					<th scope="col">Content</th>
					<th scope="col">Image</th>
					<th scope="col">Display Order</th>
					<th scope="col">Site</th>
				</tr>
			</thead>
			<tfoot>
				<tr class="thead">
					<th scope="col">Content</th>
					<th scope="col">Image</th>
					<th scope="col">Display Order</th>
					<th scope="col">Site</th>
				</tr>
			</tfoot>
			<tbody class="list:user user-list" id="users">
			    <?php if ( ! empty( $caro_details ) ) { ?>
    				<?php $alt = 0; foreach ( $caro_details  as $row ) : ?>
    					<tr <?php if ( $alt % 2 ) echo 'class="alternate"'; ?> id="log-<?php echo $row->caro_id; ?>">
    						<td>
    							<p><strong><?php echo $row->caro_title; ?></strong></p>
    							<p><?php echo nl2br( $row->caro_sub_title ); ?></p>
    							<p><?php echo $row->caro_description; ?></p>
    							<div class="row-actions">
    								<span class="edit"><a rel="permalink" title="Edit Carousel" href="<?php echo admin_url( "admin.php?page=$page_slug&amp;edit_id=$row->caro_id" ); ?>">Edit Carousel</a> | </span>
									<span class="delete"><a href="<?php echo admin_url( "admin.php?page=$page_slug&amp;delete_id=$row->caro_id" ); ?>" onclick="return showNotice.warn();" class="submitdelete">Delete</a></span>
    						    </div>
    						</td>
    						<td><p><img src="<?php echo $row->caro_image; ?>" alt="<?php echo $row->caro_title; ?>" width="300"/></p></td>
    						<td><p><?php echo $row->caro_order; ?></p></td>
    						<td><p><?php echo $ln_site_details[$row->caro_site_id]->blogname; ?></p></td>
    					</tr>
    				<?php $alt++; endforeach; ?>
    			<?php } else { ?>
    			    <tr class="no-items"><td colspan="4" class="colspanchange">No carousel slides found.</td></tr>
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