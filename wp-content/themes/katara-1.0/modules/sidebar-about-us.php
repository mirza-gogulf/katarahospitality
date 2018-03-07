<?php
    $about_us_id = get_page_id_from_path( '/about-us' );
    $company_profile_id = get_page_id_from_path( '/about-us/company-profile' );
    $our_values_id = get_page_id_from_path( '/about-us/our-values' );

    $asset_management_id = get_page_id_from_path( '/about-us/asset-management/' );
    $developer_id = get_page_id_from_path( '/about-us/developer/' );
    $operator_id = get_page_id_from_path( '/about-us/operator/' );
?>

<?php
    $args = array(
        'post__in' => array( $asset_management_id, $developer_id, $operator_id ),
        'post_type' => 'page',
    );
    $loop = new WP_Query( $args );
?>
<?php if ( is_search() ) : ?>
    <h3 class="ttl-19 fade-line aside-ttl"><?php echo __( 'Business area', "Katara" ); ?></h3>
<?php else : ?>
    <h3 class="ttl-19 fade-line aside-ttl"><?php echo __( 'Areas', "Katara" ); ?></h3>
<?php endif; ?>

<ul class="aside-r-list">
    <?php while( $loop->have_posts() ) : $loop->the_post(); ?>
        <li>
    	    <p><a class="sub-ttl-12" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>

    	    <?php
    	        global $post;
    	        fake_excerpt( $post->post_content, 146 );
    	    ?>

            <a href="<?php the_permalink(); ?>" class="more"><?php echo __( 'Read more', "Katara" ); ?></a>
        </li>
    <?php endwhile; wp_reset_postdata(); ?>
</ul>