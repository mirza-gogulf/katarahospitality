<?php 
$menu = 'Sidebar'; 
$items = wp_get_nav_menu_items( $menu );  
$curr_pageID = get_the_ID(); 
$curr_pageParentID = wp_get_post_parent_id( $curr_pageID ); 
if( empty( $curr_pageParentID ) ){ $curr_pageParentID = $curr_pageID; } ?>

<div class="left-sidebar" id="left-sidebar">
	<nav>
		<span class="left-sidebar-close" id="left-sidebar-close"><img src="<?php echo KATARA_IMG ?>/icon/ico-close.svg" width="26" height="26" alt=""></span>
		<ul class="sidemenu" id="sidemenu">

			<?php $firstCount = 0;
			foreach ($items as $parent): 

				$fcls = ''; 
				$parentLink = '';
				if( $parent->menu_item_parent == 0 ) {  //check its main root without having its parent
					$parentmenuID = $parent->ID;
					$_parent_title = ( $parent->post_title ) ? $parent->post_title : $parent->title; 
					$parentType = $parent->type;
					if( $parentType == "taxonomy"){
						$taxonomy = $parent->object;
						$parentLink = get_term_link( (int) $parent->object_id, $taxonomy );
				
					} else { $parentLink = get_the_permalink( $parent->object_id); } 

					$fcls = "par-{$parentmenuID}"; 

					// check for first child
					$firstLevel_kids = return_child_menuItems($parentmenuID);

					if($firstLevel_kids) { $fcls .= " has_submenu_child"; }
					
					if ( $curr_pageParentID == $parent->object_id ) {
						$fcls .= ' current_sidemenu_item';
						if( $firstLevel_kids ){
							$fcls .= ' open';
						}
					}
					?>

				<li class="<?php echo $fcls ?>"><a href="<?php echo $parentLink ?>"><?php echo $_parent_title ?></a>

					<?php if ( $firstLevel_kids ) { 
						echo '<ul class="sidemenu-sub">';
						foreach ($firstLevel_kids as $key => $fkid) { 
							
							$firstLevelmenuID = $fkid['ID'];
							$firstLevelTitle = $fkid['post_title']; 
							$firstLevelIcon = get_field('main_icon_class', $fkid['post_ID']); //'main_icon_img',
							$firstLevelLink = $fkid['url'];
		                    
		                    // check for second child(grandchild)
							$secondLevel_kids = return_child_menuItems($firstLevelmenuID);
							$factive_cls = ( $curr_pageID == $fkid['post_ID'] ) ? ' current_sidemenu_item' : '';?>
							<li class="<?php echo $factive_cls ?>"><a href="<?php echo $firstLevelLink ?>"><?php echo $firstLevelTitle ?></a></li>

							<?php }
						echo '</ul>';
						} ?>
				</li>

			<?php }
			endforeach; ?>

		</ul>
	</nav>
</div>