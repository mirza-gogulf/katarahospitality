<?php 
    global $sub_nav;
    $sub_nav = TRUE;
?>

<aside class="aside-left">
    <nav role="navi">
	    <form action="<?php bloginfo( 'url' ); ?>" method="get">
	        <ul class="sub-menu">
	            <li>
	                <div class="sub-menu-lvl-1">
		                <label><?php echo __( 'Search Again', "Katara" ); ?></label>
    				    <input type="text" id="careers-search-tb" class="search-tb inlineBlock" name="s" value="<?php echo get_search_query(); ?>" >
    			        <input type="submit" id="careers-search-btn" class="search-btn inlineBlock" name="submit" value="<?php echo __( 'Go', "Katara" );?>">
				    </div>
	            </li>    				    
			    <li class="sub-menu-acord-li-lvl-2">
            	    <p class="sub-menu-lvl-2"><?php _e( 'Section', "Katara" ); ?></p>
            	    <ul class="sub-menu-list-lvl-3">
                		<li>
                		    <p class="sub-menu-lvl-3">
                		        <span class="dummy-cb inlineBlock <?php if ( isset($_GET['post_type']) && in_array( 'hotels', $_GET['post_type'] )) echo 'active'; ?>">
                		            <input class="" type="checkbox" <?php if ( isset($_GET['post_type']) && in_array( 'hotels', $_GET['post_type'] )) echo 'checked="checked"'; ?> name="post_type[]" id="job-filter-full-time" value="hotels" />
                		        </span>
                		        <label for="job-filter-full-time" class="inlineBlock"><?php _e( 'Our Hotels', "Katara" ); ?></label> 
                		    </p>
                		</li>
                		<li>
                		    <p class="sub-menu-lvl-3">
                		        <span class="dummy-cb inlineBlock <?php if ( isset($_GET['post_type']) && in_array( 'press_release', $_GET['post_type'] )) echo 'active'; ?>">
                		            <input class="" type="checkbox" <?php if ( isset($_GET['post_type']) && in_array( 'press_release', $_GET['post_type'] )) echo 'checked="checked"'; ?> name="post_type[]" id="job-filter-part-time" value="press_release" />
                		        </span>
                		        <label for="job-filter-part-time" class="inlineBlock"><?php _e( 'Press Office', "Katara" ); ?></label>
                		    </p>
                		</li>
                		<li>
                		    <p class="sub-menu-lvl-3">
                		        <span class="dummy-cb inlineBlock <?php if ( isset($_GET['post_type']) && in_array( 'tender', $_GET['post_type'] )) echo 'active'; ?>">
                		            <input class="" type="checkbox" <?php if ( isset($_GET['post_type']) && in_array( 'tender', $_GET['post_type'] )) echo 'checked="checked"'; ?> name="post_type[]" id="job-filter-temporary" value="tender" />
                		        </span>
                		        <label for="job-filter-temporary" class="inlineBlock"><?php _e( 'Tenders', "Katara" ); ?></label>
                		    </p>
                		</li>
                		<li>
                		    <p class="sub-menu-lvl-3">
                		        <span class="dummy-cb inlineBlock <?php if ( isset($_GET['post_type']) && in_array( 'career-opportunities', $_GET['post_type'] )) echo 'active'; ?>">
                		            <input class="" type="checkbox" <?php if ( isset($_GET['post_type']) && in_array( 'career-opportunities', $_GET['post_type'] )) echo 'checked="checked"'; ?> name="post_type[]" id="job-filter-permanent" value="career-opportunities" />
                		        </span>
                		        <label for="job-filter-permanent" class="inlineBlock"><?php _e( 'Careers', "Katara" ); ?></label>
                		    </p>
                		</li>
                	</ul>
                </li>
                
                <li class="sub-menu-acord-li-lvl-2">
                    <?php $categories = get_terms( 'category' ); ?> 
            	    <p class="sub-menu-lvl-2"><?php echo __( 'Category', "Katara" ); ?></p>
            	    <ul class="sub-menu-list-lvl-3">
            	        <?php foreach( $categories as $category ) { ?>
            	            <li>
                    		    <p class="sub-menu-lvl-3">
                    		        <span class="dummy-cb inlineBlock <?php if ( isset($_GET['cats']) && in_array( $category->term_id, $_GET['cats'] )) echo 'active'; ?>">
                    		            <input class="" type="checkbox" <?php if ( isset($_GET['cats']) && in_array( $category->term_id, $_GET['cats'] )) echo 'checked="checked"'; ?> name="cats[]" id="search-filter-<?php echo $category->slug; ?>" value="<?php echo $category->term_id; ?>"/>
                    		        </span>
                    		        <label for="search-filter-<?php echo $category->slug; ?>" class="inlineBlock"><?php echo $category->name; ?></label> 
                    		    </p>
                    		</li>
            	        <?php } ?>
                	</ul>
                </li>
                
                <li class="sub-menu-acord-li-lvl-2">
                    <?php 
                        $locations = get_terms( 'locations' );
                    ?> 
            	    <p class="sub-menu-lvl-2"><?php echo __( 'Location', "Katara" ); ?></p>
            	    <ul class="sub-menu-list-lvl-3">
            	        <?php foreach( $locations as $location ) { ?>
            	            <li>
                    		    <p class="sub-menu-lvl-3">
                    		        <span class="dummy-cb inlineBlock <?php if ( isset($_GET['location']) && in_array( $location->slug, $_GET['location'] )) echo 'active'; ?>">
                    		            <input class="" type="checkbox" name="location[]" <?php if ( isset($_GET['location']) && in_array( $location->slug, $_GET['location'] )) echo 'checked="checked"'; ?> id="search-filter-<?php echo $location->slug; ?>" value="<?php echo $location->slug; ?>"/>
                    		        </span>
                    		        <label for="search-filter-<?php echo $location->slug; ?>" class="inlineBlock"><?php echo $location->name; ?></label> 
                    		    </p>
                    		</li>
            	        <?php } ?>
                	</ul>
                </li>
		    </ul>
	    </form>
    </nav>
</aside>