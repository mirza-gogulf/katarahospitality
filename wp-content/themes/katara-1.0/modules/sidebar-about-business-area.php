<?php
    global $post, $post_name, $post_ID;
    
    $post_name = $post->post_name;
    $post_ID = $post->ID;

    // ----- Hotels ----- //
	$loop_args = array(
		'post_type' => 'hotels',
		'orderby' => 'date',
		'business_area' => $post_name,
		'order' => 'DESC',
		'posts_per_page' => 3
	);
	$loop = new WP_Query($loop_args);
?>
<h2 class="ttl-19 fade-line aside-ttl"><a href="<?php bloginfo( 'url' ); ?>/our-hotels/"><?php echo __( 'Hotels', "Katara" ); ?></a></h2>
<ul class="aside-r-list">
    <?php
        if ( $loop->have_posts() ) :
            while ($loop->have_posts()): $loop->the_post();
                get_template_part( 'modules/sidebar', 'li-hotel' );
            endwhile;
        else :
    ?>
        <li><?php echo __( 'No Hotels', "Katara" ); ?></li>
    <?php endif; ?>
    <li>
        <a href="<?php echo home_url( '/our-hotels/' ); ?>" class="more"><?php echo __( 'See all', "Katara" ); ?></a>
    </li>  
</ul>

<?php
    // ----- Press Office ----- //
	$loop_args = array(
		'post_type' => 'press_release',
		'orderby' => 'date',
		'business_area' => $post_name,
		'order' => 'DESC',
		'limit' => 4
	);
	$loop = new WP_Query($loop_args);
?>

<h2 class="ttl-19 fade-line aside-ttl"><a href="<?php bloginfo( 'url' ); ?>/press-office/"><?php echo __( 'Press Office', "Katara" ); ?></a></h2>
<ul class="aside-r-list">
    <?php if ( $loop->have_posts() ) : ?>
        <?php while ($loop->have_posts()): $loop->the_post(); ?>
            <?php
        
                $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'names');
                $location = join(", ",wp_get_object_terms( $post_ID, 'locations', $args ));
            ?>
    	    <li>
    	        <p>
    		        <a class="sub-ttl-12" href="<?php echo get_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?>, <?php echo $location; ?></a>
    		        <br />
    		        <span class="date"><?php the_time('jS F Y', '<strong>', '</strong>'); ?></span>
    	        </p>
    	    </li>
        <?php endwhile; ?>
        <li>
            <a href="<?php bloginfo( 'url' ); ?>/press-office/" class="more"><?php echo __( 'See all', "Katara" ); ?></a>
        </li>
    <?php else : ?>
        <li><?php echo __( 'No Press Releases', "Katara" ); ?></li>
    <?php endif; ?>
</ul>