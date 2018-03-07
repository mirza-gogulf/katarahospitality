<?php //GET parameters
$searchText = isset( $_POST['_s'] ) ? esc_html( $_POST['_s'] ) : '';
$job_employment_type = isset( $_POST['job_employment'] ) ? esc_html( $_POST['job_employment'] ) : '';
$job_level = isset( $_POST['job_level'] ) ? esc_html( $_POST['job_level'] ) : '';
$job_department = isset( $_POST['job_department'] ) ? esc_html( $_POST['job_department'] ) : '';
$job_location = isset( $_POST['job_location'] ) ? esc_html( $_POST['job_location'] ) : '';

$postType = 'career-opportunities';
$allTypeOfEmploy = katara_post_meta_values_list( 'job_employment', $postType ); 
$allLevels = katara_post_meta_values_list( 'job_level', $postType ); 
$allDept = katara_post_meta_values_list( 'job_department', $postType );
$allLocat = katara_post_meta_values_list( 'job_location', $postType );  


?>

<div class="left-sidebar" id="left-sidebar">
	<nav>
		<span class="left-sidebar-close" id="left-sidebar-close"><img src="<?php echo KATARA_IMG ?>/icon/ico-close.svg" width="26" height="26" alt=""></span>

		<div class="press-login-form">
		<a href="javascript:;"><?php _e('Search Careers', 'katara')?> </a>
		<form method="post" class="form-contact login_form">
			<div class="form-group">
			<input name="_s" class="form-control" type="text" placeholder="<?php _e('search...', 'katara')?>" value="<?php echo $searchText ?>">
			</div>
			<?php if( $allTypeOfEmploy ) : ?>
			<div class="form-group">
				<select name="job_employment" class="form-control custom-select">
					<option value=""><?php _e('Type of Employment', 'katara')?> </option>
					<?php foreach ( $allTypeOfEmploy as $employType ) {
						$chk = ( $job_employment_type == $employType ) ? 'selected' : '';

						if( $employType )
						echo sprintf( '<option value="%s" %s>%s</option>', $employType , $chk, ucfirst( str_replace('-', ' ', $employType ) ) );
					} ?>
				</select>
			</div>
			<?php endif;
			if( $allLevels ) : ?>
			<div class="form-group">
				<select name="job_level" class="form-control custom-select">
					<option value=""><?php _e('Level', 'katara')?> </option>
					<?php foreach ( $allLevels as $level ) {
						$chk = ( $job_level == $level ) ? 'selected' : '';

						if( $level )
						echo sprintf( '<option value="%s" %s>%s</option>', $level , $chk, ucfirst( str_replace('-', ' ', $level ) ) );
					} ?>
				</select>
			</div>
			<?php endif; 
			if( $allDept ) : ?>
			<div class="form-group">
				<select name="job_department" class="form-control custom-select">
					<option value=""><?php _e('Department', 'katara')?></option>
					<?php foreach ( $allDept as $dept ) {
						$chk = ( $job_department == $dept ) ? 'selected' : '';

						if( $dept )
						echo sprintf( '<option value="%s" %s>%s</option>', $dept ,$chk, ucfirst( str_replace('-', ' ', $dept ) ) );
					} ?>
				</select>
			</div>
			<?php endif; 
			if ( $allLocat ) : ?>
			<div class="form-group">
				<select name="job_location" class="form-control custom-select">
					<option value=""><?php _e('Location', 'katara')?></option>
					<?php foreach ( $allLocat as $loc ) {
						$chk = ( $job_location == $loc ) ? 'selected' : '';

						if( $loc )
						echo sprintf('<option value="%s" %s>%s</option>', $loc, $chk, $loc );
					} ?>
				</select>
			</div>
		<?php endif; ?>
			<div class="btn-holder">
				<button type="submit" id="" class="btn btn-login"><?php _e('Go', 'katara')?></button>
			</div>
		</form>

		</div>
	</nav>

	
</div>