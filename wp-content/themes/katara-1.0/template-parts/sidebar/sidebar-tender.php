<?php //GET parameters
$yr = isset( $_POST['yr'] ) ? intval( $_POST['yr'] ) : '';
$mh = isset( $_POST['mh'] ) ? intval( $_POST['mh'] ) : '';  
$category = isset( $_POST['category'] ) ? intval( $_POST['category'] ) : '';
$location = isset( $_POST['location'] ) ? intval( $_POST['location'] ) : '';

//categories
$catHavingtender = [];
$allcats = kataraTaxonomyTermList( 'category' );
//get only category having tender post type
if( $allcats ) { 
	foreach ( $allcats as $cat ) {
		$tender_post = get_posts(array(
							    'post_type' => 'tender',
							    'post_status'=> 'publish',
							    'tax_query' => array(
							        array(
							        'taxonomy' => 'category',
							        'field' => 'term_id',
							        'terms' => $cat->term_id )
							    ))
					);
		if( $tender_post ) {
			$catHavingtender[] = $cat;
		}
	}
}

$alllocations = kataraTaxonomyTermList( 'locations' );  
$locHavingtender = [];
//get only locations having tender post type
if( $alllocations ) { 
	foreach ( $alllocations as $tloc ) {
		$tender_post = get_posts(array(
							    'post_type' => 'tender',
							    'post_status'=> 'publish',
							    'tax_query' => array(
							        array(
							        'taxonomy' => 'locations',
							        'field' => 'term_id',
							        'terms' => $tloc->term_id )
							    ))
					);
		if( $tender_post ) {
			$locHavingtender[] = $tloc;
		}
	}
}
?>

<div class="left-sidebar" id="left-sidebar">
	<nav>
		<span class="left-sidebar-close" id="left-sidebar-close"><img src="<?php echo KATARA_IMG ?>/icon/ico-close.svg" width="26" height="26" alt=""></span>

		<div class="press-login-form">
		<a href="javascript:;"><?php _e('Search Tenders', 'katara')?> </a>
		<form method="post" class="form-contact login_form">
			
			<div class="form-group">
				<select name="category" class="form-control custom-select">
					<option value=""><?php _e('Category', 'katara')?> </option>
					<?php if( $catHavingtender ) :
					foreach ( $catHavingtender as $cat ) {
						$chk = ( $category == $cat->term_id ) ? 'selected' : '';

						if( $cat )
						echo sprintf( '<option value="%s" %s>%s</option>', $cat->term_id , $chk, ucfirst( $cat->name )  );
					} endif; ?>
				</select>
			</div>
			

			<div class="form-group">
				<select name="location" class="form-control custom-select">
					<option value=""><?php _e('Locations', 'katara')?> </option>
					<?php if( $locHavingtender ) :
					foreach ( $locHavingtender as $loc ) {
						$chk = ( $location == $loc->term_id ) ? 'selected' : '';

						if( $loc )
						echo sprintf( '<option value="%s" %s>%s</option>', $loc->term_id , $chk, ucfirst( $loc->name ) );
					} endif; ?>
				</select>
			</div>
			

			<input type="hidden" name="mh" value="<?php echo $mh ?>">
			<input type="hidden" name="yr" value="<?php echo $yr ?>">
			
			<div class="btn-holder">
				<button type="submit" id="" class="btn btn-login"><?php _e('Go', 'katara')?></button>
			</div>
		</form>

		</div>
	</nav>

	
</div>