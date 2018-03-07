<!DOCTYPE html>
<!--[if IE 6]>
<html class="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html class="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html class="ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8) | !(IE 9)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/ios/apple-touch-icon-iphone.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/assets/images/ios/apple-touch-icon-ipad.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/assets/images/ios/apple-touch-icon-iphone4.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/assets/images/ios/apple-touch-icon-ipad3.png" />
    
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php wp_head();
    /* 
     <script type="text/javascript">
        BASE_URL = '<?php bloginfo('url'); ?>';
        TEMPLATE_URL = '<?php bloginfo('template_url'); ?>';
        window.requiredError = '<?php echo __( 'This field is required', "Katara" ); ?>';
        window.emailError = '<?php echo __( 'Must be a valid email address', "Katara" ); ?>';
        window.emailReqError = '<?php echo __( 'Please enter an email address', "Katara" ); ?>'
        window.firstNameError = '<?php echo __( 'Please enter a first name', "Katara" ); ?>';
        window.lastNameError = '<?php echo __( 'Please enter a last name', "Katara" ); ?>';
        window.nationalityError = '<?php echo __( 'Please enter your nationality', "Katara" ); ?>';
        window.dobError = '<?php echo __( 'Please enter a valid date of birth', "Katara" ); ?>';
        window.countryError = '<?php echo __( 'Please select a country', "Katara" ); ?>';
        window.cityError = '<?php echo __( 'Please enter a city', "Katara" ); ?>';
        window.phoneError = '<?php echo __( 'Please enter a valid contact number', "Katara" ); ?>';
        window.educationError = '<?php echo __( 'Please select your qualifications', "Katara" ); ?>';
        window.experienceError = '<?php echo __( 'Please select your experience', "Katara" ); ?>';
        window.uploadError = '<?php echo __( 'There was an error uploading your file', "Katara" ); ?>';
        window.userError = '<?php echo __( 'No such user found', "Katara" ); ?>';
        window.passwordError = '<?php echo __( 'Your password is incorrect', "Katara" ); ?>';
        window.loginError = '<?php echo __( 'Your user password combination returned no results', "Katara" ); ?>';
        window.moreText = '<?php echo __( 'Read more', "Katara" ); ?>';
        window.lessText = '<?php echo __( 'Less', "Katara" ); ?>';
    </script>
    <script type="text/javascript" src="//use.typekit.net/aze0odn.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    
        global $blog_id;
        $blog_details = get_blog_details( $blog_id );
    ?>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-30960964-1']);
        _gaq.push(['_setDomainName', '<?php echo $blog_details->domain; ?>']);
        _gaq.push(['_trackPageview']);

        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>

    <script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>

    <?php  */ ?>
</head>

<body <?php body_class(); ?>>
	<div id="wrapper" class="wrapper-inner">
		<!-- top-wrapper start-->
		<div class="top-wrapper">

			<?php get_template_part( 'template-parts/header/content', 'header' );

			if ( is_home() || is_front_page() ) { 
			get_template_part( 'template-parts/header/content', 'front-banner' );
			} ?>
		</div>
		<!-- top-wrapper end -->
		<main>
   