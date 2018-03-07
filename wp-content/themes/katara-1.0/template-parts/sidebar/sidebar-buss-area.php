<?php
$term = get_queried_object();
$currTerm = $term->term_id;
$currPar = $term->parent;
if( empty( $currPar ) ) { $currPar = $currTerm; }
?>
<div class="left-sidebar" id="left-sidebar">
	<nav>
		<span class="left-sidebar-close" id="left-sidebar-close"><img src="<?php echo KATARA_IMG ?>/icon/ico-close.svg" width="26" height="26" alt=""></span>
		<ul class="sidemenu" id="sidemenu">
			<?php $busstax = 'business_area';
				$bussAreas = kataraTaxonomyTermList( $busstax ); 
				if ( $bussAreas && count( $bussAreas )  > 0 ) : 
					foreach ($bussAreas as $key => $barea) {
					$child_terms = get_term_children( $barea->term_id, $barea->taxonomy );
				
					$currClass = ( $child_terms ) ? 'has_submenu_child' : ''; 
					$currClass .= ( $currPar == $barea->term_id ) ? ' current_sidemenu_item open' : '';  ?>

					<li class="<?php echo $currClass ?>"><a href="<?php echo get_term_link( $barea->term_id, $busstax ) ?>"><?php echo $barea->name ?></a>

					<?php if ( $child_terms && count( $child_terms ) > 0 ) { 
						echo '<ul class="sidemenu-sub">';
						foreach ( $child_terms as $cterm ) { 

							$childInfo = get_term_by( 'id', $cterm, $busstax );
							$currChildClass = ( $currTerm == $cterm ) ? ' current_sidemenu_item' : ''; ?>

						 		<li class="<?php echo $currChildClass ?>">
									<a href="<?php echo get_term_link( $cterm, $busstax ) ?>"><?php echo $childInfo->name; ?> </a> 
								</li>
								
						<?php }
						echo '</ul>';
						} ?>
					</li>
			<?php }
		endif; ?>
		
		</ul>
	</nav>
</div>