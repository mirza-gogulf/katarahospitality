<?php
    $post_ID = (is_singular()) ? get_the_ID(): 0;
    
    $args = array(
        'orderby' => 'name',
        'order' => 'ASC',
        'fields' => 'all'
    );
    $business_areas = wp_get_object_terms( $post_ID, 'business_area', $args );
    $slugs = array();
    foreach($business_areas as $area)
    {
        $slugs[] = $area->slug;
    }

    $areas = get_business_areas_by_slug( $slugs );
    
    if ( ! empty( $areas ) ) : 
?>

<h2 class="ttl-19 fade-line aside-ttl"><?php echo __( 'Business Areas', "Katara" ); ?></h2>
<ul class="aside-r-list">
    <?php foreach( $areas as $area ) : ?>
            <li>
        	    <p><a class="sub-ttl-12" href="<?php echo get_permalink( $area->ID ); ?>"><?php echo get_the_title( $area->ID ); ?></a></p>
        	    <?php fake_excerpt( $area->post_content, 146 ); ?>
                <a href="<?php echo get_permalink( $area->ID ); ?>" class="more"><?php echo __( 'Read more', "Katara" ); ?></a>
            </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>