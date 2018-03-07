<?php
    the_post();

    $board_args = array(
       'post_parent' => get_the_ID(),
       'post_type' => 'page',
       'orderby' => 'menu_order',
       'order' => 'ASC',
       'nopaging' => TRUE
    );
    $board_loop = new WP_Query( $board_args );
?>

	<ul id="board-members" class="grid_9 alpha two-col-list">
	    <?php while( $board_loop->have_posts() ) : $board_loop->the_post(); ?>
	    <li class="two-col-list-item" id="board-<?php the_ID(); ?>">
	        <?php
	            $job_title = get_post_meta( get_the_ID(), 'page_sub_title', TRUE );
                
	            if ( has_post_thumbnail() )
	            {
	                $thumb_id = get_post_thumbnail_id( $post->ID );
					$image = wp_get_attachment_image_src( $thumb_id, 'size-143-143' );
					$img_src = ( isset( $image[0] ) ) ? $image[0]: FALSE;
				}
				else
				{
				   $img_src =  FALSE;
				}
	        ?>
			<div class="grid_2 alpha">
	        	<?php if ( $img_src ) : ?>
		            <img class="profile-pic" src="<?php echo $img_src; ?>" alt="<?php the_title(); ?>" />
		    	<?php else : ?>
		    		&nbsp;
		    	<?php endif; ?>
			</div>

	        <div class="grid_7 omega">
                <h2 class="ttl-23"><?php the_title(); ?></h2>
                <?php if ( $job_title ) { ?>
                    <p class="tag-line-16"><?php echo $job_title; ?></p>
                <?php } ?>
                <div class="expanding-cont" data-closed-h="59" data-state="0">
                    <div>
                    <?php the_content(); ?>
                    </div>
                </div>
                <a href="#" class="more expand"><?php echo __( 'Read More', "Katara" ); ?></a>
	        </div>
	        <div class="clearFloat">&nbsp;</div>
	        
	    </li>
	    <?php endwhile; wp_reset_postdata(); ?>
	</ul>