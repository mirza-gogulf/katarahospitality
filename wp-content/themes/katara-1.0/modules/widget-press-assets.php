<?php
    global $post;
    $post_ID = $post->ID;
?>
<h2 class="ttl-19 fade-line aside-ttl"><a href="<?php echo home_url( '/press-area/' ); ?>"><?php echo __( 'Press Area', "Katara" ); ?></a></h2>
<ul class="aside-r-list">
    <?php if ( is_user_logged_into_section( 'press-office' ) ) { ?>
        <?php
            $linked_assets = get_post_meta($post_ID, 'press_asset', TRUE);
            $loop_args = array(
                'post__in' => explode( ',', $linked_assets ),
                'post_type' => 'press-area',
                'orderby' => 'date',
                'order' => 'DESC'
            );
            $loop = new WP_Query($loop_args);
        ?>
        <?php if ( $loop->have_posts() ) : ?>
            <?php while( $loop->have_posts() ) : $loop->the_post(); ?>
                <li>
                    <?php
                        $attachment_args = array(
                            'orderby' => 'menu_order',
                            'order' => 'ASC',
                            'post_type' => 'attachment',
                            'post_parent' => get_the_ID(),
                            'exclude' => get_post_thumbnail_id(),
                            'numberposts' => 1
                        );
                        $post_attachments = get_children( $attachment_args );
                        $rekeyed_array = array_values( $post_attachments );
                        $dl_link = $rekeyed_array[0]->guid;
                    ?>
                    <h3 class="sub-ttl-12"><?php the_title(); ?></h3>
                    
                    <?php the_excerpt(); ?>
                    
                    <a href="<?php echo $dl_link; ?>" class="more"><?php echo __( 'Download asset pack', "Katara" ); ?></a>
                </li>
            <?php endwhile; wp_reset_postdata(); ?>
        <?php else : ?>
            <li><?php _e( 'No assets have been attached to this press release.'); ?></li>
        <?php endif; ?>        
    <?php } else { ?>
        <li><?php echo __( 'To view and download associated press assets please either', "Katara" ); ?> <a class="open-modal" href="#"><?php echo __( 'log in', "Katara" ); ?></a>, <?php echo __( 'or', "Katara" ); ?> <a class="open-iframe-modal" href="<?php echo get_bloginfo('url'); ?>/access/request-press-office/"><?php echo __( 'request access', "Katara" ); ?></a>.</li>
    <?php } ?>
</ul>