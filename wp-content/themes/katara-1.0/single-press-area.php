<?php
    get_header();
    get_sidebar('press-area');

    $current_cat = FALSE;
    if ( isset( $_GET['t'] ) )
    {
        $is_term = term_exists( $_GET['t'], 'asset_category' );
        $term = new stdClass;

        if ( isset( $is_term['term_id'] ) )
        {
            $current_cat = $is_term['term_id'];
            $term = get_term( $current_cat, 'asset_category', OBJECT );
        }
            
    }
    elseif ( is_singular( 'press-area' ) )
    {
    	$the_terms = get_the_terms( get_the_ID(), 'asset_category' );
    	foreach( $the_terms as $the_term )
    	{
    		if ( $the_term->parent != 0 )
    		{
    			$current_cat = $the_term->term_id;
            	$term = $the_term;
    		}
    	}
    }
    else
    {
        $asset_catgory = get_asset_catgory();

        if ( isset( $asset_catgory->term_id ) )
            $current_cat = $asset_catgory->term_id;
            $term = $asset_catgory;
    }
?>
	<section class="grid_6 content col-span-1">
		<header class="gen-content-header">
		    <h1 class="ttl-36"><?php _e( 'Brand Assets', 'Katara' ); ?></h1>
            <?php if ( isset( $term->name ) ) : ?>
                <p class="tag-line-16"><?php echo $term->name; ?></p>
            <?php endif; ?>
		</header>

        <?php if ( is_user_logged_into_section( 'press-office' ) ) { ?>
            <?php if ( have_posts() ) : ?>
                <ul class="grid_6 alpha one-col-list img-asset-list">
                    <li class="two-col-list-item">
                        <ul class="file-thumb-list">
                            <?php
                                $count = 1;
                                while ( have_posts() ) : the_post();
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'size-143-143' );
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
                                    $dl_link = $rekeyed_array[0];
                            ?>
                                <li <?php if ( $count % 3 == 0 ) echo 'class="end"';?>>
                                    <a href="<?php echo $dl_link->guid; ?>" class="img-dl-btn">
                                        <img src="<?php echo $thumb[0]; ?>" class="file-thumb" width="140" height="140" alt="<?php the_title(); ?>">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/dl-icon.png" class="dl-icon" width="25" height="25" alt="<?php _e( 'download', 'Katara' ); ?>">
                                    </a>
                                    <p><?php the_title(); ?></p>
                                </li>
                                <!-- START NEW LIST //-->
                                <?php if ( $count % 3 == 0 ) : ?>
                                        </ul>
                                        <div class="clearBoth">&nbsp;</div>
                                    </li>
                                    <li class="two-col-list-item">
                                        <ul class="file-thumb-list">
                                <?php endif; ?>
                            <?php
                                $count++;
                                endwhile;
                            ?>
                        </ul>
                        <div class="clearBoth">&nbsp;</div>
                    </li>
                </ul>
            <?php endif; ?>
        <?php } else { ?>
            <p><?php echo __( 'You need to be registered to view brand assets.', "Katara" ); ?></p>    

            <a href="#" class="more open-modal login-link inlineBlock"><?php echo __( 'Login', "Katara" ); ?></a>
            <a href="<?php echo get_bloginfo('url'); ?>/access/request-press-office/" class="more open-iframe-modal inlineBlock"><?php echo __( 'Request access', "Katara" ); ?></a>
        <?php } ?>
	</section><!-- #primary -->
<?php get_sidebar( 'press-area-meta' ); ?>
<?php get_footer(); ?>