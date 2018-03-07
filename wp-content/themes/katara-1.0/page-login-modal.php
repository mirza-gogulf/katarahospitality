<?php

//__( 'You need to be logged in to view this area.', "Katara" );

?>
<!DOCTYPE html>
<!--[if IE 6]><html id="ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html id="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
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
        	$access_email = ( isset( $_POST['access_email'] ) && $_POST['access_email'] != '' ) ? $_POST['access_email']: FALSE;
        	
        	$error = FALSE;
        	$success = FALSE;
        	$data = array();

            if ( isset( $_POST['submit'] ) )
            {
        	    if  ( ! $access_firstname || ! $access_lastname || ! $access_email )
            	{
            	    $error = '<p>'.__( 'All fields should be filled in.', "Katara" ).'</p>';
            	}
            	else
            	{
            	    $data = request_careers( $access_firstname, $access_lastname, $access_email );
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
            	<header class="entry-header">
            		<h1 class="ttl-36"><?php echo __( 'Request access', "Katara" ); ?></h1>
                    <p><?php echo __( 'Request access to restricted areas.', "Katara" ); ?></p>
            	</header>
                <form class="contact-form grad-bg" action="<?php bloginfo('url'); ?>/wp-login.php" method="post">

        		    <div class="half-block">
                        <label><?php echo __( 'Username', "Katara" ); ?></label><input class="required" type="password" name="pwd" value="Password" />
                        <span class="error"></error>
                    </div>

                    <div class="half-block omega">
                        <label><?php echo __( 'Password', "Katara" ); ?></label><input class="required" type="password" name="pwd" value="Password" />
                        <span class="error"></error>
                    </div>
    				
    				<div class="clearBoth">&nbsp;</div>
    				
                    <div class="right-block">
                        <a href="#" class="inlineBlock secondry-btn" onClick="window.top.closeModal();return false;"><?php echo __( 'Cancel', "Katara" ); ?></a>
                        <input type="submit" id="modal-login-btn" value="<?php echo __( 'Login', "Katara" ); ?>" />
                    </div>						
    			</form>
    		</div><!-- #content -->
    	
    		
    	<?php } ?>
    	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
        <script src="<?php bloginfo('template_url'); ?>/assets/js/common.js" type="text/javascript"></script>
    </body>
</html>