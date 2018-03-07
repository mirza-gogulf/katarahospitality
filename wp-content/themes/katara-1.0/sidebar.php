<?php
    $current_layout = 'contents';

    $post_name = (isset($post->post_name)) ? $post->post_name: "";
    $post_ID = (is_singular()) ? get_the_ID(): 0;
?>
<aside id="secondary" class="grid_3_vr aside-right" role="complementary">
    <?php if (is_singular('press_release')) : ?>
        <?php
            // ----- Hotels ----- //
            $linked_hotels = get_post_meta($post_ID, 'press_hotels', TRUE);
            $loop_args = array(
                'post__in' => explode(',', $linked_hotels),
                'post_type' => 'hotels',
                'orderby' => 'date',
                'order' => 'DESC',
                'posts_per_page' => 3
            );
            $loop = new WP_Query($loop_args);

            if ( $loop->have_posts() ) :
        ?>
            <h2 class="ttl-19 fade-line aside-ttl"><a href="<?php bloginfo( 'url' ); ?>/our-hotels/"><?php echo __( 'Hotels', "Katara" ); ?></a></h2>
            <ul class="aside-r-list">
                <?php
                    while ($loop->have_posts()):
                        $loop->the_post();
                        get_template_part( 'modules/sidebar', 'li-hotel' );
                    endwhile; wp_reset_postdata();
                ?>
                <li>
                    <a href="<?php echo home_url( '/our-hotels/' ); ?>" class="more"><?php echo __( 'See all', "Katara" ); ?></a>
                </li>  
            </ul>
        <?php endif; ?>

        <?php get_business_areas_widget( $post_ID ); ?>
        
        <?php if ( ! is_user_logged_into_section( 'press-office' ) ) { ?>
            <h2 class="ttl-19 fade-line aside-ttl"><?php echo __( 'Press Area Login', "Katara" ); ?></h2>
            <div class="login-cont">
                <p><?php echo __( 'To access the secure press area and view or download press assets please log in below, or request access.', "Katara" ); ?></p>
                <form class="grad-bg" action="" method="post">
                    <p class="error"><?php if ( get_area_login_error() ) echo get_area_login_error(); ?></p>
                    <input type="text" name="log" class="username" data-placeholder="<?php echo __( 'Username', "Katara" ); ?>" value="<?php echo __( 'Username', "Katara" ); ?>" />
                    <div style="position:relative;" class="dummy-pwd">
                        <input type="password" class="pwd" name="pwd" value="" />
                        <span><?php echo __( 'Password', "Katara" ); ?></span>
                    </div>
                    <input type="submit" class="login-submit" id="tenders-login-btn" value="<?php echo __( 'Login', "Katara" ); ?>" />
                    <input type="hidden" value="<?php echo curPageURL(); ?>" name="redirect_to"/>
                    <input type="hidden" value="area-login" name="action"/>
                    <input type="hidden" value="access_1" name="access-area" />
                    <?php wp_nonce_field('login_field_form','login_field_form'); ?>
                    <a class="open-iframe-modal more" href="<?php echo get_bloginfo('url'); ?>/access/request-press-office/"><?php echo __( 'Request access', "Katara" ); ?></a>
                </form>
            </div>
        <?php
            }
            else
            {
                get_template_part( 'modules/widget', 'user-meta' );
            }
        ?>

        <?php get_press_assets( $post_ID ); ?>

        

    <?php endif; ?>
    
    <?php if (is_singular('hotels')) : ?>

        <?php
            // ----- Press Office ----- //
            $linked_hotels = get_post_meta($post_ID, 'press_hotels', TRUE);
            
            $press_args = array(
                   'showposts' => 4,
                   'post_type' => 'press_release',
                   'meta_key' => 'press_hotels',
                   'meta_value' => $post_ID,
                   'meta_compare' => 'LIKE',
                   'category__not_in' => array( 77 )
               );

               //$press_loop = new WP_Query( $press_args );
            $loop = new WP_Query($press_args);
            
            if ( $loop->have_posts() ) :
        ?>                  
            <h2 class="ttl-19 fade-line aside-ttl"><a href="<?php bloginfo( 'url' ); ?>/press-office/"><?php echo __( 'Press Office', "Katara" ); ?></a></h2>
            <ul class="aside-r-list">
                <?php while ($loop->have_posts()): $loop->the_post(); ?>
                    <li>
                        <a class="sub-ttl-12" href="<?php echo get_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        <br />
                        <span class="date"><?php the_time('jS F Y'); ?></span>
                    </li>
                <?php endwhile; wp_reset_postdata(); ?>
                <li>
                    <a href="<?php bloginfo( 'url' ); ?>/press-office/" class="more"><?php echo __( 'See all', "Katara" ); ?></a>
                </li>
            </ul>
        <?php
            endif;
            
            get_business_areas_widget( $post_ID );
        ?>
    <?php endif; ?>
    

    <?php
        if ( is_page( array( 'asset-management', 'developer', 'operator', 'merweb' ) ) ) : 
            get_template_part( 'modules/sidebar-about-business-area' );
        elseif ( is_page( array( 'corporate-social-responsibility' ) ) ) : 
    ?>
    <?php
        // ----- Press Office ----- //
        $loop_args = array(
            'post_type' => 'press_release',
            'orderby' => 'date',
            'category_name' => 'corporate-social-responsibility',
            'order' => 'DESC',
            'limit' => 6
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
    <?php
        elseif ( is_page( 'press-area' ) ) :
    ?>
        <?php
            // ----- Press Office ----- //
            $loop_args = array(
                'post_type' => 'press_release',
                'orderby' => 'date',
                'category_name' => 'has-assets',
                'order' => 'DESC',
                'limit' => 10
            );
            $loop = new WP_Query($loop_args);
        ?>
        
        <h2 class="ttl-19 fade-line aside-ttl"><?php echo __( 'Latest Press Releases With Assets', "Katara" ); ?></h2>
        <ul class="aside-r-list">
            <?php while ($loop->have_posts()): $loop->the_post(); ?>
                <?php
                
                    $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'names');
                    $location = join(", ",wp_get_object_terms( $post_ID, 'locations', $args ));
                ?>
                <li>
                    <a class="sub-ttl-12" href="<?php echo get_permalink(); ?>?u=loggedin" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    <br />
                    <span class="date"><?php the_date('jS F Y'); ?></span>
                </li>
            <?php endwhile; ?>
        </ul>  
    <?php endif; ?>
    
    <?php if ((is_post_type_archive('press_release') || is_press_office_or_tender() == "press_release") && ! is_single()) : ?>
        <?php if ( ! is_user_logged_into_section( 'press-office' ) ) { ?>
            <h2 class="ttl-19 fade-line aside-ttl"><?php echo __( 'Press Area Login', "Katara" ); ?></h2>
            <div class="login-cont">
                <p><?php echo __( 'To access the secure press area and view or download press assets please log in below, or request access.', "Katara" ); ?></p>
                <form class="grad-bg" action="" method="post">
                    <p class="error"><?php if ( get_area_login_error() ) echo get_area_login_error(); ?></p>
                    <input type="text" name="log" class="username" data-placeholder="<?php echo __( 'Username', "Katara" ); ?>" value="<?php echo __( 'Username', "Katara" ); ?>" />
                    <div style="position:relative;" class="dummy-pwd">
                        <input type="password" class="pwd" name="pwd" value="" />
                        <span><?php echo __( 'Password', "Katara" ); ?></span>
                    </div>
                    <input type="submit" class="login-submit" id="tenders-login-btn" value="<?php echo __( 'Login', "Katara" ); ?>" />
                    <input type="hidden" value="<?php echo curPageURL(); ?>" name="redirect_to"/>
                    <input type="hidden" value="area-login" name="action"/>
                    <input type="hidden" value="access_1" name="access-area" />
                    <?php wp_nonce_field('login_field_form','login_field_form'); ?>
                    <a class="open-iframe-modal more" href="<?php echo get_bloginfo('url'); ?>/access/request-press-office/"><?php echo __( 'Request access', "Katara" ); ?></a>
                </form>
            </div>
        <?php
            }
            else
            {
                get_template_part( 'modules/widget', 'user-meta' );
            }
        ?>
    <?php elseif ( is_page('our-hotels') ) :?>
            <h2 class="ttl-19 fade-line align-aside-ttl"><?php echo __( 'View by business area', "Katara" ); ?></h2>
            <a href="<?php bloginfo( 'url' ); ?>/our-hotels/?ba=1&amp;a=under-development" class="more"><?php echo __( 'Under Development', "Katara" ); ?></a>
            <a href="<?php bloginfo( 'url' ); ?>/our-hotels/?ba=1&amp;a=owned" class="more"><?php echo __( 'Owned', "Katara" ); ?></a>
            <a href="<?php bloginfo( 'url' ); ?>/our-hotels/?ba=1&amp;a=operated" class="more"><?php echo __( 'Operated', "Katara" ); ?></a>
    <?php
        elseif  (is_page('about-us') ) :
            get_template_part( 'modules/sidebar', 'about-us' );
        endif;
    ?>
</aside><!-- #secondary .widget-area -->