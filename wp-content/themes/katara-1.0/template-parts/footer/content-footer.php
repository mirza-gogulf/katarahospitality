<footer>
<div class="footer-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-6 offset-lg-1 foo-logo">
                <img src="<?php echo get_theme_mod( KATARA_PREFIX . 'footer_logo' ) ?>" width="160" height="147" class="img-fluid" alt="image footer logo">
            </div>
            <div class="col-lg-3 col-md-6 foo-list foo-list-links">
                <h3><?php _e( 'Quick Links', 'katara' ) ?></h3>
                <?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => '' ) ); ?>

            </div>
            <div class="col-lg-3 col-md-6 foo-list">
                <h3><?php _e( 'Our Location', 'katara' ) ?></h3>
                <span class="d-direction">
                    <?php echo sprintf( '<a href="%s" target="_blank">%s</a> %s', get_theme_mod( KATARA_PREFIX . "direction_file" ), __( 'Download directions', 'katara' ), __( 'as a PDF', 'katara' ) ); ?>
                </span>
            </div>
            <div class="col-lg-2 col-md-6 foo-list foo-list-touch">
                <a href="<?php bloginfo('url') ?>/contact-us/"><h3><?php _e( 'Get in touch', 'katara' ) ?> </h3></a>
                <ul>
                    <li>
                    <?php echo sprintf( '<span>%2$s</span>', __( 'Address', 'katara') , get_theme_mod( KATARA_PREFIX . "footer_address" ) ); ?>
                    </li>
                    <li class="tel">
                        <?php echo sprintf( '<span>%1$s: </span> %2$s', __( 'Tel', 'katara'), get_theme_mod( KATARA_PREFIX . "footer_tel" ) ); ?>
                    </li>
                    <li class="fax">
                        <?php echo sprintf( '<span>%s: </span><span class="fax1">%s</span>', __( 'Fax', 'katara'), get_theme_mod( KATARA_PREFIX . "footer_fax" ) ); ?>
                    </li>
                </ul>
                <ul class="social-networks">
                     <?php echo sprintf( '<li><a href="%s" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>', get_theme_mod( KATARA_PREFIX . "footer_linkedin" ) ); 

                        echo sprintf('<li><a href="%s" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>', get_theme_mod( KATARA_PREFIX . "footer_twitter" ) );
                     ?>
                    
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="footer-bottom">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-10 offset-lg-1 copyright">
                <p>&copy; <?php echo date('Y') .' ' . __( 'Katara Hospitality. All rights reserved.', 'katara' ) ; ?></p>
                <p><?php _e( 'Site by', 'katara' ) ?>:<a href="http://go-gulf.com" target="_blank">GO-Gulf</a></p>
            </div>
        </div>
    </div>
</div>
</footer>