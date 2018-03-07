<?php
    get_header();
    global $sub_nav;
    
    the_post();
    
    $page_sub_title = get_post_meta( $post->ID, 'page_sub_title', TRUE );
?>
 <?php
            $contact_address = get_option('contact_address');
            $contact_tel = get_option('contact_tel');
            $contact_fax = get_option('contact_fax');
            $contact_email = get_option('contact_email');
            $contact_press = get_option('contact_press');
        ?>
        <div class="grid_9 full content">
    <article class="grid_6 content col-span-2">
        <header class="gen-content-header">
            <h1 class="ttl-36"><?php the_title(); ?></h1>
            <?php if (is_page( 'our-history' ) ) : ?>
                <p class="tag-line-16"><?php echo ( $page_sub_title ) ? $page_sub_title: __( 'We are pioneers', "Katara" ); ?></p>
            <?php elseif (is_page( 'our-management' ) ) : ?>
                <p class="tag-line-16"><?php echo ( $page_sub_title ) ? $page_sub_title: __( 'We are only as good as our people', "Katara" ); ?></p>
            <?php elseif ( $page_sub_title ) : ?>
                <p class="tag-line-16"><?php echo $page_sub_title; ?></p>
            <?php endif; ?>
        </header>
        <div class="cms-content press-content">
            <?php the_content(); ?>
        </div>
    </article>
    </div>
<aside class="grid_3 aside-right press_contact-side" role="complementary">
        <h3 class="ttl-19 fade-line aside-ttl"><?php _e( 'Address', "Katara" ); ?></h3>
        <ul class="aside-r-list">
            <li>
                <p><?php echo nl2br($contact_address); ?></p>
            </li>
        </ul>
        <h3 class="ttl-19 fade-line aside-ttl"><?php _e( 'Directions', "Katara" ); ?></h3>
        <ul class="aside-r-list">
            <li>
                <p><a target="_blank" href="<?php bloginfo('url'); ?>/wp-content/uploads/2015/12/KH-Lusail-City_location-map-071215.pdf"><?php _e( 'Download directions as a PDF', "Katara" ); ?></a></p>
            </li>
        </ul>
    
        <h3 class="ttl-19 fade-line aside-ttl"><?php _e( 'Telephone', "Katara" ); ?></h3>
        <ul class="aside-r-list">
            <li>
                <p><?php _e( '', "Katara" ); ?> <?php echo $contact_tel; ?><br/>
                <?php //_e( 'Fax', "Katara" ); ?> <?php //echo $contact_fax; ?></p>
            </li>
        </ul>

    </aside>
    <!-- END : SIDEBAR //-->
 <?php   get_footer(); ?>