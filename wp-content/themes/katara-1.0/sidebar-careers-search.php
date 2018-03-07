<?php 
    global $sub_nav;
    $sub_nav = TRUE;
?>

<aside class="aside-left">
    <nav role="navi">
	    <form action="<?php bloginfo('url'); ?>/careers/" method="get">
	        <ul class="sub-menu">
	            <li>
	                <div class="sub-menu-lvl-1">
		                <label><?php _e( 'Search Careers', "Katara" ); ?></label>
    				    <input type="text" id="careers-search-tb" class="search-tb inlineBlock" name="search" data-placeholder="<?php echo __( 'Search', "Katara" );?>" value="<?php echo ( isset( $_GET['search'] ) ) ? $_GET['search']: __( 'Search', "Katara" );?>" >
    			        <input type="submit" id="careers-search-btn" class="search-btn inlineBlock" name="submit" value="<?php echo __( 'Go', "Katara" );?>">
				    </div>
	            </li>    				    
			    <li class="sub-menu-acord-li-lvl-2">
            	    <p class="sub-menu-lvl-2"><?php echo __( 'Type of Employment', "Katara" ); ?></p>
                    <?php
                        $employment = array(
                           'full-time' => __( 'Full Time', "Katara" ),
                           'part-time' => __( 'Part Time', "Katara" ),
                           'temporary' => __( 'Temporary', "Katara" ),
                           'permanent' => __( 'Permanent', "Katara" )
                        );

                        $live_employments = get_career_filter( 'job_employment' );
                    ?>
            	    <ul class="sub-menu-list-lvl-3">
                        <?php foreach ( $live_employments as $key ) { ?>
                            <?php if ( isset($employment[$key->meta_value]) ) : $emp_value = $key->meta_value; ?>
                                <li>
                                    <p class="sub-menu-lvl-3">
                                        <span class="dummy-cb inlineBlock <?php if ( isset($_GET['job-filter-employment']) && in_array( $emp_value, $_GET['job-filter-employment'] )) echo 'active'; ?>">
                                            <input class="inlineBlock" type="checkbox" name="job-filter-employment[]" id="job-filter-<?php echo $emp_value; ?>" <?php if ( isset($_GET['job-filter-employment']) && in_array( $emp_value, $_GET['job-filter-employment'] )) echo 'checked="checked"'; ?> value="<?php echo $emp_value; ?>" />
                                        </span>
                                        <label for="job-filter-<?php echo $emp_value; ?>" class="inlineBlock"><?php echo $employment[$key->meta_value]; ?></label> 
                                    </p>
                                </li>
                            <?php endif; ?>
                        <?php } ?>
                	</ul>
                </li>
                <li class="sub-menu-acord-li-lvl-2">
            	    <p class="sub-menu-lvl-2"><?php echo __( 'Level', "Katara" ); ?></p>
                    <?php
                        $employment = array(
                           'executive' => __( 'Executive', "Katara" ) ,
                           'manager' => __( 'Manager', "Katara" ),
                           'supervisor' => __( 'Supervisor', "Katara" ),
                           'officer' => __( 'Officer', "Katara" ),
                           'admin' => __( 'Admin', "Katara" )
                        );
                        $live_employments = get_career_filter( 'job_level' );
                    ?>
                    <ul class="sub-menu-list-lvl-3">
                        <?php foreach ( $live_employments as $key ) { ?>
                            <?php if ( isset($employment[$key->meta_value]) ) : $emp_value = $key->meta_value; ?>
                                <li>
                                    <p class="sub-menu-lvl-3">
                                        <span class="dummy-cb inlineBlock <?php if ( isset($_GET['job-filter-level']) && in_array( $emp_value, $_GET['job-filter-level'] )) echo 'active'; ?>">
                                            <input class="inlineBlock" type="checkbox" name="job-filter-level[]" id="job-filter-<?php echo $emp_value; ?>" <?php if ( isset($_GET['job-filter-level']) && in_array( $emp_value, $_GET['job-filter-level'] )) echo 'checked="checked"'; ?> value="<?php echo $emp_value; ?>" />
                                        </span>
                                        <label for="job-filter-<?php echo $emp_value; ?>" class="inlineBlock"><?php echo $employment[$key->meta_value]; ?></label> 
                                    </p>
                                </li>
                            <?php endif; ?>
                        <?php } ?>
                    </ul>
                </li>
                <li class="sub-menu-acord-li-lvl-2">
            	    <p class="sub-menu-lvl-2"><?php echo __( 'Department', "Katara" ); ?></p>
                    <?php
                        $employment = array(
                            'human-resources' => __( 'Human Resources', 'Katara' ),
                            'procurement' => __( 'Procurement', 'Katara' ),
                            'information-technology' => __( 'Information Technology', 'Katara' ),
                            'business-development' => __( 'Business Development', 'Katara' ),
                            'internal-audit' => __( 'Internal Audit', 'Katara' ),
                            'legal' => __( 'Legal', 'Katara' ),
                            'chairmans-office' => __( 'Chairman\'s Office', 'Katara' ),
                            'ceos-office' => __( 'CEO\'s Office', 'Katara' ),
                           'administration' => __( 'Administration', "Katara" ) ,
                           'finance' => __( 'Finance', "Katara" ),
                           'operation' => __( 'Operation', "Katara" ),
                           'it' => __( 'IT', "Katara" ),
                           'marketing' => __( 'Marketing', "Katara" ),
                           'hr' => __( 'HR', "Katara" )
                        );
                        $live_employments = get_career_filter( 'job_department' );
                    ?>
                    <ul class="sub-menu-list-lvl-3">
                        <?php foreach ( $live_employments as $key ) { ?>
                            <?php if ( isset($employment[$key->meta_value]) ) : $emp_value = $key->meta_value; ?>
                                <li>
                                    <p class="sub-menu-lvl-3">
                                        <span class="dummy-cb inlineBlock <?php if ( isset($_GET['job-filter-department']) && in_array( $emp_value, $_GET['job-filter-department'] )) echo 'active'; ?>">
                                            <input class="inlineBlock" type="checkbox" name="job-filter-department[]" id="job-filter-<?php echo $emp_value; ?>" <?php if ( isset($_GET['job-filter-department']) && in_array( $emp_value, $_GET['job-filter-department'] )) echo 'checked="checked"'; ?> value="<?php echo $emp_value; ?>" />
                                        </span>
                                        <label for="job-filter-<?php echo $emp_value; ?>" class="inlineBlock"><?php echo $employment[$key->meta_value]; ?></label> 
                                    </p>
                                </li>
                            <?php endif; ?>
                        <?php } ?>
                    </ul>
                </li>
                
                <li class="sub-menu-acord-li-lvl-2">
            	    <p class="sub-menu-lvl-2"><?php _e( 'Location', 'Katara'); ?></p>
            	    <?php
            	        $location = array(
            	            __("Egypt", "Katara"),
                            __("Sharm El Sheikh", "Katara"),
                            __("Doha, Qatar", "Katara"),
                            __("Mesaieed", "Katara")
            	        );
                        $live_location = get_career_filter( 'job_location' );
            	    ?>
                    <ul class="sub-menu-list-lvl-3">
                        <?php foreach ( $live_location as $key ) { $emp_value = $key->meta_value; ?>
                            <?php if ( in_array( $key->meta_value, $location ) ) : ?>
                                <li>
                                    <p class="sub-menu-lvl-3">
                                        <span class="dummy-cb inlineBlock <?php if ( isset($_GET['job-filter-location']) && in_array( $emp_value, $_GET['job-filter-location'] )) echo 'active'; ?>">
                                            <input class="inlineBlock" type="checkbox" name="job-filter-location[]" id="job-filter-<?php echo $emp_value; ?>" <?php if ( isset($_GET['job-filter-location']) && in_array( $emp_value, $_GET['job-filter-location'] )) echo 'checked="checked"'; ?> value="<?php echo $emp_value; ?>" />
                                        </span>
                                        <label for="job-filter-<?php echo $emp_value; ?>" class="inlineBlock"><?php echo $emp_value; ?></label> 
                                    </p>
                                </li>
                            <?php endif; ?>
                        <?php } ?>
                    </ul>
                </li>
		    </ul>
	    </form>
    </nav>
</aside>