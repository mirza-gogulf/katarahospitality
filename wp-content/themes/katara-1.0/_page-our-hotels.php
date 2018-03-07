<?php
    get_header();
    $statues = array( 'under-development', 'owned', 'operated' );
    $regions = array( 'middle-east', 'europe', 'asia', 'africa' )
?>
    <div class="hotel-filter">
        <a href="<?php bloginfo( 'url' ); ?>/our-hotels/" class="slidingDoors2 inlineBlock <?php echo ( ! isset( $_GET['ba'] ) ) ? 'active': ''; ?>" id="hotel-filter-region">
            <span class="btnL">&nbsp;</span>
            <?php _e( 'By Region', "Katara" ); ?>
            <span class="btnR">&nbsp;</span>
        </a>
        <a href="<?php bloginfo( 'url' ); ?>/our-hotels/?ba=1" class="slidingDoors2 inlineBlock <?php echo ( isset( $_GET['ba'] ) ) ? 'active': ''; ?>" id="hotel-filter-business">
            <span class="btnL">&nbsp;</span>
            <?php _e( 'By Business Area', "Katara" ); ?>
            <span class="btnR">&nbsp;</span>
        </a>
    </div>

    <?php get_sidebar('navi'); ?>
    
    <?php if ( isset( $_GET['a'] ) && in_array( $_GET['a'], $statues ) ) : ?>
        <section class="grid_6 content col-span-1">
    		<header class="gen-content-header">
    		    <h1 class="ttl-36">
    		        <?php
    		            if ( $_GET['a'] == 'owned' )
    		            {
    		                echo __( 'Owned', "Katara" );
    		            }
    		            elseif ( $_GET['a'] == 'operated' )
    		            {
    		                echo __( 'Operated', "Katara" );
    		            }
    		            elseif ( $_GET['a'] == 'under-development' )
    		            {
    		                echo __( 'Under Development', "Katara" );
    		            }
        		    ?>
    		    </h1>
    		    
    		    <?php
		            if ( $_GET['a'] == 'operated' )
		            {
		                echo '<p class="tag-line-16">'.__( 'Katara Hospitality is also a major hotel and resort operator in its own right with its expanding business hotel brand, Merweb.', "Katara" ).'</p>';
		            }
		        ?>
    		    
    		</header>

    		<?php
    		    $args = array(
                    'post_type' => 'hotels',
                    'posts_per_page' => -1,
                    'meta_key' => 'hotel_status',
                    'meta_value' => 'status-'.$_GET['a']
                );
                $loop = new WP_Query( $args );

    		    if ( $loop->have_posts() ) :
    		?>
    			<ul class="grid_6 alpha one-col-list press-list">
        		    <?php
                        while ( $loop->have_posts() ) :
                            $loop->the_post();
                            get_template_part( 'modules/hotel-excerpt' );
                        endwhile;
                        wp_reset_postdata();
                    ?>
    			</ul>
    		<?php else : ?>
    			<ul>
    		        <li class="one-col-list-item career-li" id="carrer-<?php the_ID(); ?>">
                        <h2 class="sub-ttl-22"><?php echo __( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', "Katara" ); ?></h2>
                    </li>
    		    </ul>
    		<?php endif; ?>
    	</section>
        <?php get_sidebar(); ?>
    <?php elseif ( isset( $_GET['r'] ) && in_array( $_GET['r'], $regions ) ) :?>
        <section class="grid_6 content col-span-1">
            <header class="gen-content-header">
                <h1 class="ttl-36">
                    <?php
                        if ( $_GET['r'] == 'middle-east' )
                        {
                            echo __( 'Middle East', "Katara" );
                        }
                        elseif ( $_GET['r'] == 'europe' )
                        {
                            echo __( 'Europe', "Katara" );
                        }
                        elseif ( $_GET['r'] == 'asia' )
                        {
                            echo __( 'Asia', "Katara" );
                        }
                        elseif ( $_GET['r'] == 'africa' )
                        {
                            echo __( 'Africa', "Katara" );
                        }
                    ?>
                </h1>
            </header>
            <?php
                $args = array(
                    'post_type' => 'hotels',
                    'posts_per_page' => -1,
                    'meta_key' => 'hotel_region',
                    'meta_value' => 'region-'.$_GET['r']
                );
                $loop = new WP_Query( $args );

                if ( $loop->have_posts() ) :
            ?>
                <ul class="grid_6 alpha one-col-list press-list">
                    <?php
                        while ( $loop->have_posts() ) :
                            $loop->the_post();
                            get_template_part( 'modules/hotel-excerpt' );
                        endwhile;
                        wp_reset_postdata();
                    ?>
                </ul>
            <?php else : ?>
                <ul>
                    <li class="one-col-list-item career-li" id="carrer-<?php the_ID(); ?>">
                        <h2 class="sub-ttl-22"><?php echo __( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', "Katara" ); ?></h2>
                    </li>
                </ul>
            <?php endif; ?>
        </section>
        <?php get_sidebar(); ?>
    <?php else : ?>
        <section class="grid_9 content col-span-2">
    		<?php the_post(); ?>
            
            <div class="hotel-hero-map">
                <a href="<?php bloginfo('url'); ?>/our-hotels/?r=europe" id="hotel-map-europe"><?php _e( 'Europe', "Katara" ); ?></a>
                <a href="<?php bloginfo('url'); ?>/our-hotels/?r=africa" id="hotel-map-africa"><?php _e( 'Africa', "Katara" ); ?></a>
                <a href="<?php bloginfo('url'); ?>/our-hotels/?r=asia" id="hotel-map-asia"><?php _e( 'Asia', "Katara" ); ?></a>
                <a href="<?php bloginfo('url'); ?>/our-hotels/?r=middle-east" id="hotel-map-middle-east"><?php _e( 'Middle East', "Katara" ); ?></a>
            </div>
            
    		<article class="grid_6 alpha content">
    		    <h1 class="ttl-23 fade-line"><?php the_title(); ?></h1>
    		    <?php the_content(); ?>
    		</article>

            <aside class="grid_3_vr omega aside-right">
                <h2 class="ttl-19 fade-line align-aside-ttl"><?php echo __( 'View by business area', "Katara" ); ?></h2>
                <a href="<?php bloginfo( 'url' ); ?>/our-hotels/?ba=1&amp;a=under-development" class="more"><?php echo __( 'Under development', "Katara" ); ?></a>
                <a href="<?php bloginfo( 'url' ); ?>/our-hotels/?ba=1&amp;a=owned" class="more"><?php echo __( 'Owned', "Katara" ); ?></a>
                <a href="<?php bloginfo( 'url' ); ?>/our-hotels/?ba=1&amp;a=operated" class="more"><?php echo __( 'Operated', "Katara" ); ?></a>
            </aside>    
        </section>
    <?php endif; ?>

<?php get_footer(); ?>