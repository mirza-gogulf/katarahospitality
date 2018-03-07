<?php 
    global $sub_nav, $wp_query;
    $query_vars = $wp_query->query_vars;
    $sub_nav = TRUE;
    $subfolder = ( is_arabic() )? 'rtl/': '';
    $single_id = ( is_singular() ) ? get_the_ID(): FALSE;
?>

<aside class="aside-left">
    <nav <?php if(uri_segments(1)=="our-hotels" || ( uri_segments(1)=="ar" && uri_segments(2)=="our-hotels" ) ) echo 'id="hotels-nav"'; ?> role="navi">
        
        <?php if ( is_post_type_archive( array('press_release', 'tender') ) || is_press_office_or_tender() ) { ?>
            <?php
                $post_type = "post";
                if ( is_post_type_archive('press_release') || is_press_office_or_tender() == "press_release" )
                {
                    $post_type = "press_release";
                }
                elseif ( is_post_type_archive('tender') || is_press_office_or_tender() == "tender" )
                {
                    $post_type = "tender";
                }
            ?>
            <ul class="sub-menu" id="menu-category">
                <li>
                    <span class="sub-menu-lvl-1"><?php echo __( "Category", "Katara" ); ?></span>
                    <ul class="sub-menu-list-lvl-3">
                        <?php
                            $categories = get_taxonomy_by_post_type($post_type, 'category');
                            foreach ($categories as $category) :
                                $sidebar = is_category( $category );
                                $active = ( $sidebar ) ? 'active': '';
                                
                                echo '<li>'.
                                    '<a class="sub-menu-lvl-3 slidingDoors '.$active.'" href="'.get_term_link($category->slug, $category->taxonomy).'?pt='.$post_type.'" title="'.$category->name.'">'.
                                        '<img src="'.get_bloginfo( 'template_url' ).'/assets/img/lvl-3-sub-nav-t.png" class="btnT" alt="">'.
                                        '<span class="inlineBlock">'.$category->name.'</span>'.
                                        '<img src="'.get_bloginfo( 'template_url' ).'/assets/img/'.$subfolder.'lvl-3-sub-nav-r.png" class="lvl-3-arrow" alt="">'.
                            		    '<img src="'.get_bloginfo( 'template_url' ).'/assets/img/lvl-3-sub-nav-b.png" class="btnB" alt="">'.
                                    '</a>'.
                                '</li>';
                            endforeach;
                        ?>
                    </ul>
                </li>    
            </ul>
    
            <ul class="sub-menu" id="menu-date">
                <li>
                    <span class="sub-menu-lvl-1"><?php echo __( "Date", "Katara" ); ?></span>
                    <ul class="sub-menu-list-lvl-3">
                    	<?php
                	        $dates = get_dates_by_post_type($post_type);

                	        foreach ($dates as $archive) {
                	            $month = mktime(0, 0, 0, $archive->month, 1, 2005);
                	            $the_date = date('F', $month).' '.$archive->year;

                                if(is_arabic())
                                {
                                    global $Ar;
                                    $time = strtotime($the_date);
                                    $fix = $Ar->dateCorrection($time);
                                    $Ar->setMode(2); 
                                    $the_date = find_and_replace_arabic_numbers($Ar->date('M Y', $time, $fix));
                                }
                	            
                	            if ( isset( $query_vars['year'] ) && $query_vars['year'] == $archive->year && isset( $query_vars['monthnum'] ) && $query_vars['monthnum'] == $archive->month )
                	            {
                	                $active = 'active';
                	            }
                	            else
                	            {
                	                $active = '';
                	            }

                	            echo '<li>'.
                	                '<a class="sub-menu-lvl-3 slidingDoors '.$active.'" href="'.get_month_link( $archive->year, $archive->month ).'?pt='.$post_type.'" title="'.$the_date.'">'.
                	                    '<img src="'.get_bloginfo( 'template_url' ).'/assets/img/lvl-3-sub-nav-t.png" class="btnT" alt="">'.
                	                    '<span class="inlineBlock">'.$the_date.' ('.find_and_replace_arabic_numbers($archive->posts).')</span>'.
                	                    '<img src="'.get_bloginfo( 'template_url' ).'/assets/img/'.$subfolder.'lvl-3-sub-nav-r.png" class="lvl-3-arrow" alt="">'.
                            		    '<img src="'.get_bloginfo( 'template_url' ).'/assets/img/lvl-3-sub-nav-b.png" class="btnB" alt="">'.
                	                '</a>'.
                	            '</li>';
                	        }
                        ?>
                    </ul>
                </li>     
            </ul>

            <ul class="sub-menu" id="menu-locations">
                <li>
                    <span class="sub-menu-lvl-1"><?php echo __( "Locations", "Katara" ); ?></span>
                    <ul class="sub-menu-list-lvl-3">
                    <?php
                        $locations = get_taxonomy_by_post_type($post_type, 'locations', true);

                        foreach ($locations as $location) :
                            $tax = is_tax( 'locations', $location->slug );
                            $active = ( $tax ) ? 'active': '';
                            echo '<li>'.
                                '<a class="sub-menu-lvl-3 slidingDoors '.$active.'" href="'.get_term_link($location->slug, $location->taxonomy).'?pt='.$post_type.'" title="'.$location->name.'">'.
                                    '<img src="'.get_bloginfo( 'template_url' ).'/assets/img/lvl-3-sub-nav-t.png" class="btnT" alt="">'.
                                    '<span class="inlineBlock">'.$location->name.'</span>'.
                                    '<img src="'.get_bloginfo( 'template_url' ).'/assets/img/'.$subfolder.'lvl-3-sub-nav-r.png" class="lvl-3-arrow" alt="">'.
                        		    '<img src="'.get_bloginfo( 'template_url' ).'/assets/img/lvl-3-sub-nav-b.png" class="btnB" alt="">'.
                                '</a>'.
                            '</li>';
                        endforeach;
                    ?>
                    </ul>
                </li>     
            </ul>

        <?php } elseif(uri_segments(1)=="about-us" || ( uri_segments(1)=="ar" && uri_segments(2)=="about-us" ) ) { ?>
            <?php
                $about_us = get_page_by_path( '/about-us/' );
                $our_future = get_page_by_path( '/about-us/our-future/' );
                $our_management = get_page_by_path( '/about-us/our-management/' );
                $our_executives = get_page_by_path( '/about-us/our-management/our-executives/' );
                $our_board = get_page_by_path( '/about-us/our-management/our-board/' );
                $corporate_social_responsibility = get_page_by_path( '/about-us/corporate-social-responsibility/' );
                $qatarisation = get_page_by_path( '/about-us/qatarisation/' );
                $asset_management = get_page_by_path( '/about-us/asset-management/' );
                $developer = get_page_by_path( '/about-us/developer/' );
                $operator = get_page_by_path( '/about-us/operator/' );
                $our_values = get_page_by_path( '/about-us/our-values/' );
            ?>
            <ul id="menu-about-us" class="sub-menu">
                <li>
                    <a class="sub-menu-lvl-1 <?php echo ( is_page( 'about-us' ) ) ? 'active': '';?>" href="<?php echo get_page_link( $about_us->ID ); ?>"><?php echo $about_us->post_title; ?></a>
                    <ul>
                    	<li class="sub-menu-acord-li-lvl-2">
                    	    <a class="sub-menu-lvl-2 <?php echo ( is_page( 'our-history' ) ) ? 'active': '';?>" href="<?php bloginfo( 'url' ); ?>/about-us/our-history/"><?php echo __( "Our History", "Katara" ); ?></a>
                    	</li>
                    	<li class="sub-menu-acord-li-lvl-2">
                    	    <a class="sub-menu-lvl-2 <?php echo ( is_page( $our_future->post_name ) ) ? 'active': '';?>" href="<?php echo get_page_link( $our_future->ID ); ?>"><?php echo $our_future->post_title; ?></a>
                    	</li>
                        <li class="sub-menu-acord-li-lvl-2">
                            <a class="sub-menu-lvl-2 <?php echo ( is_page( $our_values->post_name ) ) ? 'active': '';?>" href="<?php echo get_page_link( $our_values->ID ); ?>"><?php echo $our_values->post_title; ?></a>
                        </li>
                    	<li class="sub-menu-acord-li-lvl-2">
                    	    <a class="sub-menu-lvl-2 <?php echo ( is_page( $our_management->post_name ) ) ? 'active': '';?>" href="<?php echo get_page_link( $our_management->ID ); ?>"><?php echo $our_management->post_title; ?></a>
                    	    <ul class="sub-menu-list-lvl-3">
                        		<li>
                        		    <a class="sub-menu-lvl-3 slidingDoors <?php echo ( is_page( $our_executives->post_name ) ) ? 'active': '';?>" href="<?php echo get_page_link( $our_executives->ID ); ?>">
                        		        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/lvl-3-sub-nav-t.png" class="btnT" alt="">
                        		        <span class="inlineBlock"><?php echo $our_executives->post_title; ?></span>
                        		        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $subfolder; ?>lvl-3-sub-nav-r.png" class="lvl-3-arrow" alt="">
                        		        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/lvl-3-sub-nav-b.png" class="btnB" alt="">
                        		    </a>
                        		</li>
                        		<li>
                        		    <a class="sub-menu-lvl-3 slidingDoors <?php echo ( is_page( $our_board->post_name ) ) ? 'active': '';?>" href="<?php echo get_page_link( $our_board->ID ); ?>">
                        		        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/lvl-3-sub-nav-t.png" class="btnT" alt="">
                        		        <span class="inlineBlock"><?php echo $our_board->post_title; ?></span>
                        		        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $subfolder; ?>lvl-3-sub-nav-r.png" class="lvl-3-arrow" alt="">
                        		        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/lvl-3-sub-nav-b.png" class="btnB" alt="">
                        		    </a>
                        		</li>
                        	</ul>
                        </li>
                        <li class="sub-menu-acord-li-lvl-2">
                            <a class="sub-menu-lvl-2 <?php echo ( is_page( $corporate_social_responsibility->post_name ) ) ? 'active': '';?>" href="<?php echo get_page_link( $corporate_social_responsibility->ID ); ?>"><?php echo $corporate_social_responsibility->post_title; ?></a>
                        </li>
                         <li class="sub-menu-acord-li-lvl-2">
                            <a class="sub-menu-lvl-2 <?php echo ( is_page( $qatarisation->post_name ) ) ? 'active': '';?>" href="<?php echo get_page_link( $qatarisation->ID ); ?>"><?php echo $qatarisation->post_title; ?></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="sub-menu-lvl-1 <?php echo ( is_page( $asset_management->post_name ) ) ? 'active': '';?>" href="<?php echo get_page_link( $asset_management->ID ); ?>"><?php echo $asset_management->post_title; ?></a>
                </li>
                <li>
                    <a class="sub-menu-lvl-1 <?php echo ( is_page( $developer->post_name ) ) ? 'active': '';?>" href="<?php echo get_page_link( $developer->ID ); ?>"><?php echo $developer->post_title; ?></a>
                </li>
                <li>
                    <a class="sub-menu-lvl-1 <?php echo ( is_page( $operator->post_name ) ) ? 'active': '';?>" href="<?php echo get_page_link( $operator->ID ); ?>"><?php echo $operator->post_title; ?></a>
                </li>
            </ul>
        <?php } else if(uri_segments(1)=="our-hotels" || ( uri_segments(1)=="ar" && uri_segments(2)=="our-hotels" ) ) { ?>
            <?php if ( isset( $_GET['ba'] ) ) : ?>
                <?php $statues = get_hotel_statues(); ?>
                <ul id="menu-our-hotels" class="sub-menu">
                    <?php foreach ( $statues as $status ) : ?>
                        <li class="sub-menu-acord-li-lvl-2">
                            <!-- <span class="sub-menu-lvl-1"></span> -->
                            <?php
                                $closed = TRUE;
                                $single_hotel_status = get_post_meta( $single_id, 'hotel_status', TRUE );

                                if ( isset( $_GET['a'] ) && $_GET['a'] != '' )
                                {
                                    $pos = strpos( $status->value, $_GET['a'] );
                                    if ( $pos !== FALSE )
                                        $closed = FALSE;
                                }
                                elseif ( $single_hotel_status == $status->value)
                                {
                                    $closed = FALSE; 
                                }
                            ?>
                            <a href="#" class="sub-menu-acord-lvl-1 accordian-btn"><?php _e($status->label, "Katara"); ?></a>
                            <ul class="accordian-menu sub-menu-list-lvl-3 <?php if ( $closed ) echo 'closed';?>" data-state="0">
                                    <?php
                                        $args = array(
                                            'post_type' => 'hotels',
                                            'posts_per_page' => -1,
                                            'meta_key' => 'hotel_status',
                                            'meta_value' => $status->value
                                        );
                                        $loop = new WP_Query( $args );

                                        while( $loop->have_posts() ) : $loop->the_post();
                                        $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'names');
                                       
                                    ?>
                            	    <li>
                            	        <a class="sub-menu-lvl-3 slidingDoors <?php if ( $single_id == get_the_ID() ) echo 'active'; ?>" href="<?php echo get_permalink( get_the_ID() ); ?>?ba=1<?php if ( isset( $_GET['a'] ) ) echo '&amp;a='.$_GET['a']; ?>" title="<?php echo esc_attr(get_the_title( get_the_ID() )); ?>">
                            	            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/lvl-3-sub-nav-t.png" class="btnT" alt="">
                            	            <span class="inlineBlock"><?php echo get_the_title( get_the_ID() ); ?></span>
                            	            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $subfolder; ?>lvl-3-sub-nav-r.png" class="lvl-3-arrow" alt="">
                            		        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/lvl-3-sub-nav-b.png" class="btnB" alt="">
                            	        </a>
                            	    </li>
                                <?php endwhile; wp_reset_postdata(); ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <?php
                    global $post;
                    $hotels = get_hotels();

                    $current_region = get_post_meta($post->ID, 'hotel_region', true);

                    $current_location_args = array('orderby' => 'name', 'order' => 'ASC', 'parent' => 0);
                    $current_locations = wp_get_object_terms( $post->ID, 'locations', $current_location_args );
        
                    $selected_location = "";
                    foreach($current_locations as $current_location)
                    {
                        if ($current_location->parent == 0)
                        {
                            $selected_location =  $current_location->name;
                            break;
                        }
                    }
                ?> 
                <ul id="menu-our-hotels" class="sub-menu">
                    <?php foreach($hotels as $name => $region) : ?>
                        <li>
                            <?php
                                if ( $name == "region-middle-east")
                                {
                                    $title = __( "Middle East", "Katara" );
                                }
                                elseif ( $name == "region-africa")
                                {
                                    $title = __( "Africa", "Katara" );
                                }
                                elseif ( $name == "region-asia")
                                {
                                    $title = __( "Asia", "Katara" );
                                }
                                elseif ( $name == "region-europe")
                                {
                                    $title = __( "Europe", "Katara" );
                                }
                            ?>
                            <span class="sub-menu-lvl-1"><?php echo $title; ?></span>
                            <!-- LOCATION -->
                            <?php if ( ! empty($region) ) { ?>
                                <ul class="">
                                    <?php foreach ($region as $location => $hotels) : ?>
                                    <li id="nav-itm-<?php echo str_replace(' ','-',$location); ?>" class="sub-menu-acord-li-lvl-2">
                                        <a href="#" class="sub-menu-acord-lvl-2 accordian-btn"><?php echo $location; ?></a>
                                        <!-- HOTEL -->
                                        <?php
                                            $closed = TRUE;

                                            foreach( $hotels as $hotel )
                                            {
                                                if ( $hotel->ID == $single_id )
                                                    $closed = FALSE;
                                            }
                                        ?>
                                        <ul class="accordian-menu sub-menu-list-lvl-3 <?php if ( $closed ) echo 'closed';?>" data-state="0">
                                            <?php foreach( $hotels as $hotel) : ?>
                                                <?php
                                                    $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'names');
                                                ?>
                                        	    <li>
                                        	        <a class="sub-menu-lvl-3 slidingDoors <?php if ( $single_id == $hotel->ID ) echo 'active'; ?>" href="<?php echo get_permalink($hotel->ID); ?>" title="<?php echo esc_attr(get_the_title($hotel->ID)); ?>">
                                        	            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/lvl-3-sub-nav-t.png" class="btnT" alt="">
                                        	            <span class="inlineBlock"><?php echo get_the_title($hotel->ID); ?></span>
                                        	            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $subfolder; ?>lvl-3-sub-nav-r.png" class="lvl-3-arrow" alt="">
                                        		        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/lvl-3-sub-nav-b.png" class="btnB" alt="">
                                        	        </a>
                                        	    </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <!-- END : HOTEL -->
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php } ?>
                            <!-- END : LOCATION -->
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?> 
        <?php } else { ?>
            <?php $sub_nav = FALSE; ?>
        <?php } ?>
    </nav>
</aside>