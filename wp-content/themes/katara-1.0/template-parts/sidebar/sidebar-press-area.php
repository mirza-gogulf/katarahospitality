<?php $assTaxonomy = 'asset_category';
$currParentID = null;
$currTermID = null;

if ( isset( $_GET['_t'] ) ) {
    $curr_term = term_exists( $_GET['_t'], $assTaxonomy );  //returns term ID   
    $currTermID = $curr_term['term_id'];
    $term = get_term( $currTermID , $assTaxonomy );
    $currParentID = ( $term->parent == 0 ) ? $term : $term->parent;
}



$pressAreaCat = kataraTaxonomyTermList( $assTaxonomy ); ?>

<div class="left-sidebar" id="left-sidebar">
	<nav>
		<span class="left-sidebar-close" id="left-sidebar-close"><img src="<?php echo KATARA_IMG ?>/icon/ico-close.svg" width="26" height="26" alt=""></span>

		<?php if( $pressAreaCat && count( $pressAreaCat ) > 0 ) {
		$firstOutLi = true;
		foreach ( $pressAreaCat as $key => $nrCat ) { 

			$currParentID = ( empty( $currParentID ) && $firstOutLi  ) ? $nrCat->term_id: $currParentID;

			$childpAreaCat = kataraTaxonomyTermList( 'asset_category', '','','','', $nrCat->term_id );
			$childClass = ( $childpAreaCat ) ? 'has_submenu_child' : ''; 
			$childClass .= ( $currParentID == $nrCat->term_id ) ? ' current_sidemenu_item open' : ''; ?>


		<ul class="sidemenu" id="sidemenu">
			<li class="<?php echo $childClass ?> "><a href="#"><?php echo $nrCat->name ?></a>

				<?php if ( $childpAreaCat && count( $childpAreaCat ) > 0 ) { ?>

				<ul class="sidemenu-sub">
					<?php global $firstcatID;
					$firstInLi = true;
					$firstCcatID = ''; 
					foreach ( $childpAreaCat as $key => $cCat ) { 

					$currTermID = ( empty( $currTermID ) && $firstInLi && $firstOutLi ) ? $cCat->term_id : $currTermID;

					if( $firstInLi && $firstOutLi ) { $firstcatID = $cCat->term_id; } 

					$currTermCls = ( $currTermID == $cCat->term_id ) ? 'current_sidemenu_item': ''; ?>
					
						 	<li class="<?php echo $currTermCls ?>"><a href="<?php echo home_url().'/press-areas/?_t='.$cCat->slug ?>"><?php echo $cCat->name ?></a></li>

					<?php if( $firstInLi ) { $firstInLi = false; }
					} ?>
				</ul>
								
				<?php 
			} ?>

			</li>

		</ul>
		<?php if( $firstOutLi ) { $firstOutLi = false; }
			}  //endforeach
		} ?>

		<?php if( is_user_logged_in() ){ 
			$current_user = wp_get_current_user();
			$username = $current_user->user_login; ?>
		    <ul><li class="logged-info"><span>You are currently logged in as: </br><?php echo $username ?></span></li>
			<li><a href="<?php echo wp_logout_url( home_url('/news') ); ?>">Logout</a></li></ul>
		<?php } ?>

	</nav>
</div>