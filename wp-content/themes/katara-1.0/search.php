<?php
    global $wp_query, $wp_rewrite, $paged;
    
    if ( isset($_GET['s']) )
    {
        $query_args = $wp_query->query_vars;
        
        $cat = FALSE;
        $location = FALSE;
        
        if ( isset( $_GET['cats'] ) && ! empty( $_GET['cats'] ) )
        {
            $cat = implode( ',', $_GET['cats'] );
        }
        
        if ( isset( $_GET['location'] ) && ! empty( $_GET['location'] ) )
        {
            $location = array(
                'relation' => 'OR',
                array(
        			'taxonomy' => 'locations',
        			'field' => 'slug',
        			'terms' => $_GET['location']
        		),
            );
        }
        
        if ( $cat != FALSE )
            $query_args['cat'] = $cat;
            
        if ( $location != FALSE )
            $query_args['tax_query'] = $location;

        if ( $cat != FALSE || $location != FALSE )
        {
            $wp_query->query($query_args);
        }
    }
    
    get_header();
    get_sidebar('search');
?>
	<section class="grid_6 content col-span-1">
		<header class="gen-content-header">
		    <h1 class="ttl-36"><?php echo __( 'Search Results', "Katara" ); ?></h1>
		    <p class="tag-line-16"><?php echo __( 'Search Results for', "Katara" ); ?>: <?php echo get_search_query(); ?></p>
		</header>

		<?php if ( have_posts() ) : ?>
		    
			<ul class="grid_6 alpha one-col-list press-list">
    		    <?php
    		        while ( have_posts() ) :
    		            the_post();
    		            get_template_part( "modules/post", "press-office" ); 
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

	</section>
    
    <aside class="grid_3_vr aside-right" role="complementary">
    	<h3 class="ttl-19 fade-line aside-ttl"><a href="<?php echo home_url( '/press-office/' ); ?>"><?php echo __( 'Recent Press', "Katara" ); ?></a></h3>
        <?php
            $args = array(
                'post_type' => 'press_release',
                'posts_per_page' => 2,
                'orderby' => 'date',
				'order' => 'DESC'
            );
            $loop = new WP_Query( $args );
            
            if ( $loop->have_posts() ) {
        ?>
            <ul class="aside-r-list">
                <?php while ( $loop->have_posts()) : $loop->the_post(); ?>
					<li>
    		            <p>
        			        <a class="sub-ttl-12" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        			        <br />
        			        <span class="date"><?php the_time( "jS F, Y" ); ?></span>

        			    </p>
    		        </li>
				<?php endwhile; wp_reset_postdata(); ?>
		        
                <li>
                    <a href="<?php echo home_url( '/press-office/' ); ?>" class="more"><?php echo __( 'See all', "Katara" ); ?></a>
                </li>    
		    </ul>
        <?php } ?>

	    <?php get_template_part( 'modules/sidebar-about-us' ); ?>
    </aside>
<?php get_footer(); ?>