<!DOCTYPE html>
<!--[if IE 6]><html class="ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]>
<html class="ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8) | !(IE 9)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width" />
        <title><?php wp_title( '', true, 'right' ); ?></title>
    
        <script type="text/javascript" src="http://use.typekit.com/aze0odn.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
        
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css" />
        <?php if(is_arabic()) { ?>
             <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/assets/css/rtl.css" />
        <?php } ?>
        <!--[if lt IE 9]>
            <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script type="text/javascript">
           	BASE_URL = '<?php bloginfo('url'); ?>';
           	TEMPLATE_URL = '<?php bloginfo('template_url'); ?>';
           	window.requiredError = '<?php echo __( 'This field is required', "Katara" ); ?>';
           	window.emailError = '<?php echo __( 'Must be a valid email address', "Katara" ); ?>';
        </script>
    </head>

    <body class="no-img six20">
        <?php
            //set form vaules
            $access_firstname = ( isset( $_POST['access_firstname'] ) && $_POST['access_firstname'] != '' ) ? $_POST['access_firstname']: FALSE;
        	$access_lastname = ( isset( $_POST['access_lastname'] ) && $_POST['access_lastname'] != '' ) ? $_POST['access_lastname']: FALSE;
        	$access_company = ( isset( $_POST['access_company'] ) && $_POST['access_company'] != '' ) ? $_POST['access_company']: FALSE;
        	$access_email = ( isset( $_POST['access_email'] ) && $_POST['access_email'] != '' ) ? $_POST['access_email']: FALSE;
        	$access_message = ( isset( $_POST['access_message'] ) && $_POST['access_message'] != '' ) ? $_POST['access_message']: FALSE;
        	
        	$error = FALSE;
        	$success = FALSE;
        	$data = array();

            if ( isset( $_POST['submit'] ) )
            {
                if  ( ! $access_firstname || ! $access_lastname || ! $access_company || ! $access_email || ! $access_message )
            	{
            	    $error = '<p class="error">'.__( 'All fields should be filled in.', "Katara" ).'</p>';
            	}
            	else
            	{
            	    $data = request_press_office( $access_firstname, $access_lastname, $access_company, $access_email, $access_message );
            	}

            	if ( isset( $data['success'] ) && $data['success'] == FALSE )
            	{
            	    $error = $data['message'];
            	}
            	elseif ( isset( $data['success'] ) && $data['success'] == TRUE )
            	{
            	    $success = TRUE;
            	}
            }
        ?>
        
        <?php if ( $success ) { ?>
		    <?php get_template_part( 'modules/thank-you' ); ?>
    	<?php } else { ?>
    	    <div class="form-page" role="main">
            	<header class="entry-header fade-line">
            		<h1 class="ttl-36"><?php echo __( 'Request access', "Katara" ); ?></h1>
            	</header>
            	<p><?php echo __( 'Request access to restricted areas.', "Katara" ); ?></p>
                <form action="" class="contact-form grad-bg" method="post">
                    <div class="half-block">
                        <label><?php echo __( 'First name', "Katara" ); ?></label><input class="required" type="text" name="access_firstname" value="<?php echo $access_firstname; ?>" />
                        <span class="error"></span>
                    </div>

                    <div class="half-block omega">
                        <label><?php echo __( 'Last name', "Katara" ); ?></label><input class="required" type="text" name="access_lastname" value="<?php echo $access_lastname; ?>" />
                        <span class="error"></span>
                    </div>

                    <div class="half-block">
                        <label><?php echo __( 'Company', "Katara" ); ?></label><input class="required" type="text" name="access_company" value="<?php echo $access_company; ?>" />
                        <span class="error"></span>
                    </div>

                    <div class="half-block omega">
                        <label><?php echo __( 'E-mail address', "Katara" ); ?></label><input class="required" type="email" name="access_email" value="<?php echo $access_email; ?>" />
                        <span class="error"></span>
                    </div>

                    <div class="full-block">
                        <label><?php echo __( 'Please let us know what you intend to use the assets for:', "Katara" ); ?></label>
                        <textarea name="access_message" class="required" cols="7" rows="5"><?php echo $access_message; ?></textarea>
                        <span class="error"></span>
                    </div>
                    <div class="clearBoth">&nbsp;</div>
                    <div class="right-block">
                        <p class="error"><?php if ( $error ) echo $error; ?></p>
                        <a href="#" class="inlineBlock secondry-btn" onClick="window.top.closeModal();return false;"><?php echo __( 'Cancel', "Katara" ); ?></a>
                        <input type="submit" name="submit" class="submit-btn validate" value="<?php echo __( 'Submit', "Katara" ); ?>">
                    </div>

                    <?php wp_nonce_field('contact_field_form','contact_field_form'); ?>
                </form>
    		</div><!-- #content -->
    	<?php } ?>
    	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
        <script src="<?php bloginfo('template_url'); ?>/assets/js/<?php echo(is_arabic())? 'rtl' : 'common' ; ?>.js" type="text/javascript"></script>
    </body>
</html>