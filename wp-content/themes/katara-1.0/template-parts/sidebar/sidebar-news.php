<?php $postType = isset( $_GET['_pt'] ) ? esc_html( $_GET['_pt'] ) : 'press_release';
$taxID = isset( $_GET['_t'] ) ? intval( $_GET['_t'] ) : ''; 
$yr = isset( $_GET['yr'] ) ? intval( $_GET['yr'] ) : '';
$mh = isset( $_GET['mh'] ) ? intval( $_GET['mh'] ) : ''; 

$pressReleaseCat = kataraTaxonomyTermList( 'category' );
$pressRoomCat = kataraTaxonomyTermList( 'press_room_cat' );

if( is_singular( 'press_room' ) ){
	$postType = 'press_room';
	$terms = wp_get_post_terms( get_the_ID(), 'press_room_cat', array('fields' => 'ids' ) );
	if( $terms ){ $taxID = $terms[0]; }
} else if ( is_singular( 'press_release' ) ) {
	$terms = wp_get_post_terms( get_the_ID(), 'category', array('fields' => 'ids' ) );
	if( $terms ){ $taxID = $terms[0]; }
}
?>
<div class="left-sidebar" id="left-sidebar">
	<nav>
		<span class="left-sidebar-close" id="left-sidebar-close"><img src="<?php echo KATARA_IMG ?>/icon/ico-close.svg" width="26" height="26" alt=""></span>
		<ul class="sidemenu" id="sidemenu">
			<li class="<?php echo ( $postType == 'press_release' ) ? 'current_sidemenu_item open' : '' ?> has_submenu_child "><a href="#"><?php _e( 'News Room', 'katara' ) ?></a>
				<ul class="sidemenu-sub">
					<li class="<?php echo ( $postType == 'press_release' && empty( $taxID ) ) ? 'current_sidemenu_item ' : '' ?>"><a href="<?php echo home_url( "/news?yr={$yr}&mh={$mh}" ) ?>"><?php _e( 'All', 'katara' ) ?></a></li>
					<?php if( $pressReleaseCat && count( $pressReleaseCat ) > 0 ) {
						foreach ( $pressReleaseCat as $key => $nrCat ) { ?>

						 	<li class="<?php echo ( $postType == 'press_release' && ( $taxID == $nrCat->term_id ) ) ? 'current_sidemenu_item ' : '' ?>"><a href="<?php echo home_url() .'/news?_t='.$nrCat->term_id.'&yr='.$yr.'&mh='.$mh ?>"><?php echo $nrCat->name ?></a></li>

						<?php } ?>
					
					<?php } ?>
				</ul>
			</li>
			<?php  /* <li class="<?php echo ( $postType == 'press_room' ) ? 'current_sidemenu_item open' : '' ?> has_submenu_child"><a href="<?php echo home_url() .'/news?_pt=press_room' ?>">غرفة الصحافة</a>
				<ul class="sidemenu-sub">
					<?php if( $pressRoomCat && count( $pressRoomCat ) > 0 ) {
						foreach ( $pressRoomCat as $key => $prCat ) { ?>

						 	<li class="<?php echo ( $postType == 'press_room' && ( $taxID == $prCat->term_id ) ) ? 'current_sidemenu_item ' : '' ?>"><a href="<?php echo home_url() .'/news?_pt=press_room&_t='.$prCat->term_id.'&yr='.$yr.'&mh='.$mh ?>"><?php echo $prCat->name ?></a></li>

						<?php } ?>
					
					<?php } ?>
				</ul>
			</li> */ ?>
			<?php if( is_user_logged_in() ){ 
				$current_user = wp_get_current_user();
				$username = $current_user->user_login; ?>

			    <li><a href="<?php echo home_url('/press-areas'); ?>"><?php _e( 'View Press Area', 'katara' ) ?></a></li>
			    <li class="logged-info"><span><?php _e( 'You are currently logged in as: ', 'katara' ) ?></br><?php echo $username ?></span></li>
				<li><a href="<?php echo wp_logout_url( get_the_permalink() ); ?>"><?php _e( 'Logout', 'katara' ) ?></a></li>
			<?php } ?>

		</ul>

		

		<?php if( !is_user_logged_in() ) { ?>

		
			<div class="press-login-form">
				<a href="javascript:void();">
				<?php
				_e( 'Press Area Login', 'katara'); ?></a>
				<p>To access the secure press area and view or download press assets please log in below, or request access.</p>
				<?php echo do_shortcode( '[rtibet_login_form]' ); ?>

				<a href="javascript:void()" class="req-access">Request Access</a>
				
			</div>
		<?php } ?>
	</nav>


</div>