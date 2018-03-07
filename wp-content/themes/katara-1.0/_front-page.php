<?php
    get_header();
    
    $about_us = get_page_by_path( '/about-us' );
    $our_hotels = get_page_by_path( '/our-hotels' );
?>  
    <?php get_template_part( 'modules/homepage-carousel' ); ?>
        
        
    <div class="grid_8 full grad-bg content top-0">
    <!-- ANT CODE -->
    <div class="video-wrapper">
    <h2 class="ttl-19 fade-line"><?php _e( 'We are Katara Hospitality', 'Katara' ); ?></h2>
        <div class="video-holder">
            <script type="text/javascript">

                var params = { allowScriptAccess: "always", wmode: "transparent" };
                var atts = { id: "myytplayer" };
                <?php if( is_arabic() ) { ?>
                    swfobject.embedSWF("http://www.youtube.com/v/eh0wTCngjBI?enablejsapi=1&playerapiid=ytplayer&version=3",
                                       "ytapiplayer", "600", "338", "8", null, null, params, atts);
                <?php } else {  ?>
                    swfobject.embedSWF("http://www.youtube.com/v/XFbxpxwaGQ4?enablejsapi=1&playerapiid=ytplayer&version=3",
                                   "ytapiplayer", "600", "338", "8", null, null, params, atts);
                <?php } ?>
            </script>
            <div id="ytapiplayerhide" class="hide-video">
                <div id="ytapiplayer">
                    You need Flash player 8+ and JavaScript enabled to view this video.
                </div>
            </div>
            <a href="#" class="play-btn">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/video-still.jpg">
            </a>
        </div>
    </div>
    
    <!-- ANT CODE END -->

    
        <div class="home-4-grid">
            <?php if ( isset( $about_us->ID ) ) { ?>
                <?php
                    $about_us_banner_id = get_post_thumbnail_id( $about_us->ID );
                    $about_us_banner = wp_get_attachment_image_src( $about_us_banner_id, 'size-280-129' );
                    
                    if ( isset( $about_us_banner[0] ) )
                    {
                        //echo '<a href="'.get_bloginfo( 'url' ).'/about-us/"><img src="'.$about_us_banner[0].'" width="280" height="129" class="" alt="an image"></a>';
                    }
                ?>
                <h2 class="ttl-19 fade-line"><a href="<?php bloginfo( 'url' ); ?>/about-us/"><?php echo $about_us->post_title; ?></a></h2>
                <?php echo fake_excerpt( $about_us->post_content, 250 ); ?>
          
                <a href="<?php bloginfo( 'url' ); ?>/about-us/" class="more"><?php echo __( 'Read more', "Katara" ); ?></a>
            <?php } ?>
        </div>
        
        <div class="home-4-grid vr-l">
            <?php if ( isset( $our_hotels->ID ) ) {  ?>
                <?php
                    $our_hotels_banner_id = get_post_thumbnail_id( $our_hotels->ID );
                    $our_hotels_banner = wp_get_attachment_image_src( $our_hotels_banner_id, 'size-280-129' );
                    
                    if ( isset( $our_hotels_banner[0] ) )
                    {
                        //echo '<a href="'.get_bloginfo( 'url' ).'/our-hotels/"><img src="'.$our_hotels_banner[0].'" width="280" height="129" class="" alt="an image"></a>';
                    }
                ?>
                <h2 class="ttl-19 fade-line"><a href="<?php bloginfo( 'url' ); ?>/our-hotels/"><?php echo $our_hotels->post_title; ?></a></h2>
                <?php echo fake_excerpt( $our_hotels->post_content ); ?>
          
                <a href="<?php bloginfo( 'url' ); ?>/our-hotels/" class="more"><?php echo __( 'Read more', "Katara" ); ?></a>
            <?php } ?>
        </div>
    </div>
    
    <aside class="grid_4 omega aside-right top-0" role="complementary">
        <!--- ANT CODE added moving announcement-->
        <div class="">
            <h2 class="ttl-19 fade-line aside-ttl"><?php echo __( 'Our head office has moved', "Katara" ); ?></h2>
            <ul class="aside-r-list">
                <li><span class="sub-ttl-12"><?php echo __( 'Katara Hospitality head office has moved to Lusail City', "Katara" ); ?></span></li>
                <li>
                    <a href="<?php bloginfo( 'url' ); ?>/contact-us/#map" class="more"><?php echo __( 'Please click here for futher details & directions', "Katara" ); ?></a>
                </li>   
            </ul>
        </div>
        <!-- ANT END -->



        <h3 class="ttl-19 fade-line aside-ttl" style="margin-top:28px;"><a href="<?php bloginfo( 'url' ); ?>/press-office/"><?php echo __( 'Recent Press', "Katara" ); ?></a></h3>
        <?php
            $args = array(
                'post_type' => 'press_release',
                'posts_per_page' => 4,
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
                            <span class="date"><?php the_time( "jS F Y" ); ?></span>
                        </p>
                    </li>
                <?php endwhile; wp_reset_postdata(); ?>
                
                <li>
                    <a href="<?php bloginfo( 'url' ); ?>/press-office/" class="more"><?php echo __( 'See all', "Katara" ); ?></a>
                </li>    
            </ul>
        <?php } ?>
        
        <?php
            $args = array(
                'post_type' => 'tender',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC'
            );
            $loop = new WP_Query( $args );
            
            if ( $loop->have_posts() ) {
        ?>

        <h3 class="ttl-19 fade-line aside-ttl"><a href="<?php bloginfo( 'url' ); ?>/tenders/"><?php echo __( 'Recent Tenders', "Katara" ); ?></a></h3>
            <ul class="aside-r-list">
                <?php while ( $loop->have_posts()) : $loop->the_post(); ?>
                    <li>
                        <p>
                            <a class="sub-ttl-12" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <br />
                            <span class="date"><?php the_time( "jS F Y" ); ?></span>
                        </p>
                    </li>
                <?php endwhile; wp_reset_postdata(); ?>
                
                <li>
                    <a href="<?php bloginfo( 'url' ); ?>/tenders/" class="more"><?php echo __( 'See all', "Katara" ); ?></a>
                </li>    
            </ul>
        <?php } ?>
    </aside>
<?php
    get_sidebar();
    get_footer();
?>