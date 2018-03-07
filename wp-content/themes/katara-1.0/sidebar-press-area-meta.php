<aside id="secondary" class="grid_3_vr aside-right" role="complementary">
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
</aside>