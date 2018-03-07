<h2 class="ttl-19 fade-line aside-ttl"><?php echo __( 'Log Out', "Katara" ); ?></h2>
<div class="login-cont logged-in">
    <?php
        global $current_user;
        get_currentuserinfo();

        $name = trim( $current_user->user_firstname.' '.$current_user->user_lastname );
        $username = trim( $current_user->user_login );
        
        if ( $name )
        {
            $display = $name;
        }
        else
        {
            $display = $username;
        }
        
        $redirect_link =  curPageURL();
    ?>
    <?php if ( is_user_logged_into_section( 'press-office' ) && ! is_post_type_archive('press-area') ) { ?>
        <?php if ( is_post_type_archive('press_release') || is_press_office_or_tender() == "press_release" ) : ?>
            <a class="more p-a" href="<?php echo home_url( '/press-area/' ); ?>"><?php echo __( 'View Press Area', "Katara" ); ?></a>
        <?php endif; ?>
    <?php } ?>

	<p><?php echo __( 'You are currently logged in as:', "Katara" ); ?></p>

	<p><strong><?php echo $display; ?></strong></p>

	<a class="btn inlineBlock" href="<?php echo wp_logout_url( $redirect_link ); ?>"><?php echo __( 'Log Out', "Katara" ); ?></a>
</div>