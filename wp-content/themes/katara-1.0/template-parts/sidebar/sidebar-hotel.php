<div class="left-sidebar" id="left-sidebar">
	<nav>
		<span class="left-sidebar-close" id="left-sidebar-close"><img src="<?php echo KATARA_IMG ?>/icon/ico-close.svg" width="26" height="26" alt=""></span>
		<ul class="sidemenu" id="sidemenu">
			<?php $regions = kataraRegions(); //get all regions
			if ( $regions && count( $regions ) > 0 ) : 
				foreach ( $regions as $key => $reg ) :
 
				$countries = kataraCountryByRegion( $key ); //get country by region key ?>
				 	
				<li class="region <?php echo ( $countries ) ? 'has_submenu_child' : '' ?>"><a href="#" data-reg="<?php echo $key ?>"><?php _e( $reg, 'katara' ) ?></a>
					<?php if ( $countries && count( $countries ) > 0 ) { 
						echo '<ul class="sidemenu-sub">';
						foreach ( $countries as $key => $country ) { ?>
						 	
								<li class=""><a href="<?php echo home_url( '/hotels?_c='.$country->slug ) ?>"><?php echo $country->name; ?></a>
								</li>
						<?php }
						echo '</ul>';
						} ?>
				</li>

		<?php endforeach;
		endif; ?>
			
		</ul>
	</nav>
</div>