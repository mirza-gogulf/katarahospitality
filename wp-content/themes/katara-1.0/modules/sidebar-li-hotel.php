<?php
    global $post_ID;
    
    $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'names');
    $location = join(", ",wp_get_object_terms( $post_ID, 'locations', $args ));
?>
<li>
    <?php
        //logo
        $logo_id = get_post_thumbnail_id( get_the_ID() );
        
        // Get Photos
        $attachment_args = array(
    		'orderby' => 'menu_order',
    		'order' => 'ASC',
    		'post_type' => 'attachment',
    		'post_parent' => get_the_ID(),
    		'post_mime_type' => 'image',
    		//'exclude' => $logo_id,
    		'numberposts' => 1
    	);
    	$post_attachments = get_children( $attachment_args );
    ?>
    <?php if ( $post_attachments ) : ?>
    	<?php foreach ( $post_attachments as $attachment ) : $image = wp_get_attachment_image_src( $attachment->ID, 'size-220-82' ); $src = $image[0]; ?>
            <a class="aside-list-hero" href="<?php echo get_permalink(); ?>">
	            <img width="220" height="82" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" />
	        </a>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <h3 class="sub-ttl-12"><a href="<?php echo get_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?><?php if(!empty($location)) { echo ", ".$location; } ?></a></h3>
    
    <?php the_excerpt(); ?>
    
    <a href="<?php echo get_permalink(); ?>" class="more"><?php echo __( 'Read more', "Katara" ); ?></a>
</li>