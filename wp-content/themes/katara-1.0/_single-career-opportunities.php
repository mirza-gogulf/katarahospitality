<?php
    get_header();
    the_post();
    get_sidebar('careers-search');
?>
	<section class="grid_6 content col-span-1">
		<header class="gen-content-header">
		    <h1 class="ttl-36"><?php echo __( 'Careers', "Katara" ); ?></h1>
		    <p class="tag-line-16"><?php echo __( 'Work with us', "Katara" ); ?></p>
		</header>

		<ul class="grid_6 alpha one-col-list press-list">
		    <li class="one-col-list-item career-li" id="carrer-<?php the_ID(); ?>">
                <h2 class="sub-ttl-22"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p class="date"><?php the_date('jS F Y'); ?></p>

                <?php
                    the_content();
                    
                    $job_reference = get_post_meta( $post->ID, 'job_reference', TRUE );
                    $job_positions = get_post_meta( $post->ID, 'job_positions', TRUE );
                    $job_experience = get_post_meta( $post->ID, 'job_experience', TRUE );
                    $job_level = get_post_meta( $post->ID, 'job_level', TRUE );
                    $job_studies = get_post_meta( $post->ID, 'job_studies', TRUE );
                    $job_place = get_post_meta( $post->ID, 'job_place', TRUE );
            		$job_employment = get_post_meta( $post->ID, 'job_employment', TRUE );
            		$job_level = get_post_meta( $post->ID, 'job_level', TRUE );
            		$job_department = get_post_meta( $post->ID, 'job_department', TRUE );
            		$job_location = get_post_meta( $post->ID, 'job_location', TRUE );
            		$hotel_map = get_post_meta( $post->ID, 'job_experience', TRUE );
            		$job_creation = get_post_meta( $post->ID, 'job_creation', TRUE );
            		$job_beginning = get_post_meta( $post->ID, 'job_beginning', TRUE );
                ?>
                <br />
                <table class="job-table grad-bg" width="400" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="first"><strong><?php echo __( 'Reference', "Katara" ); ?></strong></td>
                        <td class="first"><?php echo $job_reference; ?></td>
                    </tr> 
                    <tr>
                        <td><strong><?php echo __( 'Contract type', "Katara" ); ?></strong></td>
                        <td><?php _e( ucwords( str_replace( "-", " ", $job_employment ) ), "Katara" ); ?></td>
                    </tr>
                     <tr>
                        <td><strong><?php echo __( 'Level', "Katara" ); ?></strong></td>
                        <td><?php _e( ucwords( str_replace( "-", " ", $job_level ) ), "Katara" ); ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Job(s)', "Katara" ); ?></strong></td>
                        <td><?php echo find_and_replace_arabic_numbers($job_positions); ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Experience required', "Katara" ); ?></strong></td>
                        <td><?php echo find_and_replace_arabic_numbers($job_experience); ?> <?php echo ( $job_experience > 1 ) ? __( 'years', "Katara" ): __( 'year', "Katara" ); ?></td>
                    </tr>
                     <tr>
                        <td><strong><?php echo __( 'Department', "Katara" ); ?></strong></td>
                        <td><?php _e( ucwords( str_replace( "-", " ", $job_department ) ), "Katara" ); ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Working place', "Katara" ); ?></strong></td>
                        <td><?php echo $job_place; ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Job beginning on', "Katara" ); ?></strong></td>
                        <td><?php echo $job_beginning; ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __( 'Creation date', "Katara" ); ?></strong></td>
                        <td><?php echo $job_creation; ?></td>
                    </tr>
                </table>

                <a href="<?php bloginfo('url'); ?>/access/application-form/?job_id=<?php echo get_the_ID(); ?>" class="btn open-iframe-modal inlineBlock"><?php echo __( 'Apply now', "Katara" ); ?></a>

            </li>
		</ul>
	</section>
<?php
    get_sidebar('careers');
    get_footer();
?>