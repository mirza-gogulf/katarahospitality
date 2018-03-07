<?php
    // Logo
    $logo_id = get_post_thumbnail_id( get_the_ID() );
    $logo = wp_get_attachment_image_src( $logo_id, 'size-80-80' );
    // Get Photos
    $attachment_args = array(
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_type' => 'attachment',
		'post_parent' => get_the_ID(),
		'post_mime_type' => 'image'
	);
	$post_attachments = get_children( $attachment_args );
	// Get Locations
    $args = array( 
        'orderby' => 'name',
        'order' => 'ASC',
        'fields' => 'names'
    );
    $location = get_hotel_location( get_the_ID() ); 
    
    // Website Link
    $website_url = get_post_meta( $post->ID, 'hotel_website_url', TRUE );
	
	$hotel_email = get_post_meta( $post->ID, 'hotel_email', TRUE );
	$hotel_fax = get_post_meta( $post->ID, 'hotel_fax', TRUE );
	$hotel_phone = get_post_meta( $post->ID, 'hotel_phone', TRUE );
	$hotel_address = get_post_meta( $post->ID, 'hotel_address', TRUE );
	$hotel_map = get_post_meta( $post->ID, 'hotel_map', TRUE );
	$hotel_reservations = get_post_meta( $post->ID, 'hotel_reservations', TRUE );
	$hotel_sales = get_post_meta( $post->ID, 'hotel_sales', TRUE );
	$hotel_sales_fax = get_post_meta( $post->ID, 'hotel_sales_fax', TRUE );

    if ( ! $hotel_email && ! $hotel_fax && ! $hotel_phone && ! $hotel_address && ! $hotel_reservations && ! $hotel_sales && ! $hotel_sales_fax )
    {
        $has_location = FALSE;
    }
    else
    {
        $has_location = TRUE;
    }

    if ( ! $hotel_map )
    {
        $has_map = FALSE;
    }
    else
    {
        $has_map = TRUE;
    }
?>
<article class="grid_9 content full col-span-2" id="hotel-<?php the_ID(); ?>">
	<header class="logo-content-header grid_9">
		
		<h1 class="ttl-36"><?php the_title(); ?></h1>
	    <p class="tag-line-16"><?php echo $location; ?></p>
	</header>

	<?php if ( $post_attachments ) : ?>
	    <?php if(count($post_attachments) > 1) { ?>
    	<div class="grid_9 omega caro hotel-caro" data-position="0">
    	    <ul class="reel">
                <?php $pos1 = 0; foreach ( $post_attachments as $attachment ) : $image = wp_get_attachment_image_src( $attachment->ID, 'size-710-299' ); $src = $image[0]; ?>
                    <li <?php if($pos1==0){ echo 'class="active"'; } ?>><img src="<?php echo $src; ?>" width="710" height="299" alt="<?php the_title(); ?>"></li>
                <?php $pos1++;  endforeach; ?>
            </ul>
            <nav class="caro-nav">
                <ul>
                    <?php $pos = 0; foreach ( $post_attachments as $attachment ) : ?>
                        <li data-number="<?php echo $pos; ?>"><a class="caro-nav-btn hide-text <?php echo ($pos == 0)? 'active' : ''; ?>" href="#"><?php echo $pos; ?></a></li>
                    <?php $pos++; endforeach; ?>
                </ul>    
            </nav>
        </div>
        <?php } else { ?>
            <?php $pos1 = 0; foreach ( $post_attachments as $attachment ) : $image = wp_get_attachment_image_src( $attachment->ID, 'size-710-299' ); $src = $image[0]; ?>
                <img src="<?php echo $src; ?>" class="hero-img hotel" width="710" height="299" alt="<?php the_title(); ?>">
            <?php $pos1++;  endforeach; ?>
        <?php } ?>
    <?php endif; ?>
    
    <div class="grid_6 content">
	    <h4 class="ttl-23 fade-line"><?php echo __( 'Overview', "Katara" ); ?></h4>
	    <?php the_content(); ?>
	    
	    <?php if ( $website_url ) { ?>
		    <a href="<?php echo $website_url; ?>" class="btn inlineBlock m20b" target="_blank"><?php echo __( 'Visit Website', "Katara" ); ?></a>
		<?php } ?>

        <?php if ( $has_location || $has_map ) : ?>
    	    <h4 class="ttl-23 fade-line"><?php echo __( 'Location', "Katara" ); ?></h4>

            <?php
                $src = get_iframe_src( $hotel_map );
                
                if ( $src )
                {
                    echo '<iframe class="hotel-map" src="'.$src.'" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="438" height="260"></iframe>';
                }
            ?>

            <?php if ( $has_location ) : ?>
        	    <div class="grad-bg hotel-address-tab">

            	    <div class="grid_5 omega">
            	        <?php
            	            if ( $hotel_address )
            	            {
            	                echo '<p class="m10l">'.nl2br( $hotel_address ).'</p>';
            	            }
            	        ?>
            	        <p class="p-grid-l m10l">
            	            <?php
            	                if ( $hotel_phone ) echo __( 'Phone', "Katara" ).'<br/>';
            	                if ( $hotel_reservations ) echo __( 'Reservations', "Katara" ).'<br/>';
            	                if ( $hotel_fax ) echo __( 'Fax', "Katara" ).'<br/>';
                                if ( $hotel_email ) echo __( 'Email', "Katara" ).'<br/>';
                                if ( $hotel_sales ) echo __( 'Sales', "Katara" ).'<br/>';
                                if ( $hotel_sales_fax ) echo __( 'Sales Fax', "Katara" );
                            ?>
            	        </p>
            	        <p class="p-grid-r">
            	            <?php
            	                if ( $hotel_phone ) echo $hotel_phone.'<br/>';
            	                if ( $hotel_reservations ) echo $hotel_reservations.'<br/>';
            	                if ( $hotel_fax ) echo $hotel_fax.'<br/>';
                                if ( $hotel_email ) echo '<a href="mailto:'.$hotel_email.'">'.$hotel_email.'</a><br />';
                                if ( $hotel_sales ) echo $hotel_sales.'<br/>';
                                if ( $hotel_sales_fax ) echo $hotel_sales_fax;
                            ?>
                        </p> 
            	    </div> 
            	    <div class="clearBoth">&nbsp;</div>
        	    </div>
            <?php endif; ?>
        <?php endif; ?>
	</div>
		
	<?php get_sidebar(); ?>		
</article>