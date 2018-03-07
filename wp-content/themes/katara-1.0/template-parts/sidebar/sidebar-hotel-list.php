<?php global $currRegionSlug, $currCountryID; //global values initialized from hotel listing page 

$currHotel = '';
if( is_single() ) {
$currHotel = get_the_ID();
// get country of hotel
$terms = wp_get_post_terms( $currHotel, 'locations' );
	if ( $terms && is_array( $terms ) ) {
		//$terms = array_shift( $terms );
		if( isset(  $terms[1] ) ) {
			$terms = $terms[1];
		} else { $terms = $terms[0]; }

		$currCountryID = $terms->term_id; 
	    $currRegionSlug = get_field( 'kat_region', $terms->taxonomy.'_'.$currCountryID );

	} 

}
?>

<div class="left-sidebar" id="left-sidebar">
	<nav>
		<span class="left-sidebar-close" id="left-sidebar-close"><img src="<?php echo KATARA_IMG ?>/icon/ico-close.svg" width="26" height="26" alt=""></span>
		<ul class="sidemenu" id="sidemenu">
			<?php $regions = kataraRegions(); //get all regions
			if ( $regions && count( $regions ) > 0 ) : 
				foreach ( $regions as $key => $reg ) :
 
				$sCountries = kataraCountryByRegion( $key ); //get country by region key 
				$regionClass = ( $sCountries ) ? 'has_submenu_child' : ''; 
				$regionClass .= ( $currRegionSlug == $key ) ? ' current_sidemenu_item open' : '';  ?>

				<li class="<?php echo $regionClass ?>"><a href="#" data-reg="<?php echo $key ?>"><?php _e( $reg, 'katara' ) ?></a>

					<?php if ( $sCountries && count( $sCountries ) > 0 ) { 
						echo '<ul class="sidemenu-sub">';
						foreach ( $sCountries as $key => $sCountry ) { 
							$sCountryID = $sCountry->term_id; 
							$sHotelByCntryQuery = kataraGetPost( 'hotels', '', -1, array( $sCountryID ) );
							$countryClass = ( $sCountryID == $currCountryID ) ? ' current_sidemenu_item' : ''; 
						 		
						 		if ( $sHotelByCntryQuery -> have_posts() ) : ?>
						 			<li class="has_submenu_child <?php echo $countryClass ?>">
									<a href="<?php echo home_url( '/hotels?_c='.$sCountry->slug ) ?>"><?php echo $sCountry->name; ?> </a> 
									<ul class="sidemenu-sub">
										<?php while ( $sHotelByCntryQuery -> have_posts() ) : $sHotelByCntryQuery -> the_post(); ?>

											<li class="<?php echo ( $currHotel == get_the_ID() ) ? 'current_sidemenu_item' : '' ?>"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>

										<?php endwhile; ?>
										
									</ul>
						 		<?php else : ?>
						 			<li class="<?php echo $countryClass ?>">
									<a href="<?php echo home_url( '/hotels?_c='.$sCountry->slug ) ?>"><?php echo $sCountry->name; ?> </a> 

								<?php endif;
								wp_reset_postdata(); ?>

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