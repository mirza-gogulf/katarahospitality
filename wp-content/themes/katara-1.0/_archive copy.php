<?php
    get_header();
    get_sidebar('navi');
    
    $object = get_queried_object();
?>
    <section class="grid_6 content col-span-1">
		<header class="gen-content-header">
		    <h1 class="ttl-36">
				<?php if ( is_day() ) : ?>
    				<?php _e( 'Daily Archives', "Katara" ) ?>: <?php the_date(); ?>
    			<?php elseif ( is_month() ) : ?>
    			    <?php
    			        if ( is_press_office_or_tender() )
    			        {
    			            if ( ($_GET['pt']) == 'tender' )
    			            {
    			                $the_date = get_the_date( 'F Y' );
    			                
    			                if(is_arabic())
                                {
                                    global $Ar;
                                    $time = strtotime($the_date);
                                    $fix = $Ar->dateCorrection($time);
                                    $Ar->setMode(2);
                                    $the_date = find_and_replace_arabic_numbers($Ar->date('M Y', $time, $fix));
                                }
    			                
    			                echo __( 'Tenders - Monthly Archives', "Katara" ).": ".$the_date;
    			            }
    			            elseif ( ($_GET['pt']) == 'press_release' )
    			            {
    			                $the_date = get_the_date( 'F Y' );
    			                
    			                if(is_arabic())
                                {
                                    global $Ar;
                                    $time = strtotime($the_date);
                                    $fix = $Ar->dateCorrection($time);
                                    $Ar->setMode(2);
                                    $the_date = find_and_replace_arabic_numbers($Ar->date('M Y', $time, $fix));
                                }
    			                
    			                echo __( 'Latest News - Monthly Archives', "Katara" ).": ".$the_date;
    			            }
    			        }
    			        else
    			        {
    			            $the_date = get_the_date( 'F Y' );
			                
			                if(is_arabic())
                            {
                                global $Ar;
                                $time = strtotime($the_date);
                                $fix = $Ar->dateCorrection($time);
                                $Ar->setMode(2);
                                $the_date = find_and_replace_arabic_numbers($Ar->date('M Y', $time, $fix));
                            }
    			            
    			            echo __( 'Monthly Archives:', "Katara" )." ".$the_date;
    			        }
    			    ?>
    			<?php elseif ( is_year() ) : ?>
    				<?php echo __( 'Yearly Archives', "Katara" ).": ".find_and_replace_arabic_numbers(get_the_date( 'Y' )); ?>
    			<?php elseif ( is_post_type_archive() ) : ?>
    				<?php echo __( post_type_archive_title('', false), "Katara" ); ?>
    			<?php else : ?>
    			    <?php
    			        if ( is_category() )
		                {
		                    echo __( "Category", "Katara" ).": ".single_cat_title( '', false );
		                }
		                elseif ( is_tax('locations') )
		                {
		                    echo __( "Location", "Katara" ).": ".single_cat_title( '', false );
		                }
    			        else
    			        {
    			            echo __( 'Blog Archives', "Katara" );
    			        }
    			    ?>
    			<?php endif; ?>
			</h1>
		    <p class="tag-line-16">
		        <?php
		            if ( get_archive_type() == 'press_release' || isset($_GET['pt'])  && $_GET['pt'] == 'press_release' )
		            {
		                echo __( 'We are busy', "Katara" );
		            }
		            elseif ( get_archive_type() == 'tender' || isset($_GET['pt'])  && $_GET['pt'] == 'tender')
		            {
		                echo __( 'We are the partner of choice', "Katara" );
		            }
		            elseif ( get_archive_type() == 'career-opportunities' )
		            {
		                echo __( 'We are constantly developing talent', "Katara" );
		            }
		        ?>
		    </p>
		    <p>
		        <?php
		            if ( get_archive_type() == 'press_release' || isset($_GET['pt'])  && $_GET['pt'] == 'press_release' )
		            {
		                echo __( 'We are carefully, but relentlessly extending our influence throughout the world of hospitality. This is what we\'ve been up to recently.', "Katara" );
		            }
		            elseif ( get_archive_type() == 'tender' || isset($_GET['pt'])  && $_GET['pt'] == 'tender')
		            {
		                echo __( 'We live our corporate life to very exacting standards and only partner with companies who share similar values. That being said, we are always open to meeting new people, discussing innovative ways of working all in a bid to set standards ever higher.', "Katara" );
		            }
		            elseif ( get_archive_type() == 'career-opportunities' )
		            {
		                echo __( 'We are constantly developing talent', "Katara" );
		            }
		        ?>
		    </p>
		    <?php
	            if ( get_archive_type() == 'press_release' || isset($_GET['pt'])  && $_GET['pt'] == 'press_release' )
	            {
	                $contact_press = get_option('contact_press');
	                echo '<p>'.__( 'For press enquiries', "Katara" ).':<br />'.nl2br( linkify_email( $contact_press ) ).'<br />Email: <a href="'.home_url("/").'contact-us/?c=media#contact">Press department</a></p>';
	            }
	            
	        ?>
		</header>

		<?php if ( have_posts() ) : ?>
		    
			<ul class="grid_6 alpha one-col-list press-list">
    		    <?php
    		        while ( have_posts() ) :
    		            the_post();
    				    
    				    if ( get_archive_type() == 'press_release' || isset($_GET['pt'])  && $_GET['pt'] == 'press_release' )
    		            {
    		                get_template_part( "modules/post", "press-office" ); 
    		            }
    		            elseif ( get_archive_type() == 'tender'  || isset($_GET['pt'])  && $_GET['pt'] == 'tender' )
    		            {
    		                get_template_part( "modules/post", "tender" );
    		            }
    		            elseif ( get_archive_type() == 'career-opportunities' )
    		            {
    		                get_template_part( "modules/post", "career" ); 
    		            }
    				endwhile;
    			?>
			</ul>
			
			<?php katara_content_nav( 'nav-below' ); ?>
			
		<?php else : ?>
		    
			<ul>
		        <li class="one-col-list-item career-li" id="carrer-<?php the_ID(); ?>">
                    <h2 class="sub-ttl-22"><?php echo __( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', "Katara" ); ?></h2>
                </li>
		    </ul>
			
		<?php endif; ?>

	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>