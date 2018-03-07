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
            // SET FORM VAULES
            $application_job_id = FALSE;
            $application_firstname = FALSE;
            $application_lastname = FALSE;
            $application_nationality = FALSE;
            $application_dob = FALSE;
            $application_country = FALSE;
            $application_city = FALSE;
            $application_mobile = FALSE;
            $application_number = FALSE;
            $application_education = FALSE;
            $application_experience = FALSE;
            $application_resume = FALSE;
            $application_intent = FALSE;

            $error = FALSE;
            $success = FALSE;
            $data = array();

            if ( isset( $_POST['submit'] ) )
            {
                if ( !isset($_POST['contact_field_form']) || !wp_verify_nonce($_POST['contact_field_form'],'contact_field_form') )
                {
                   $error = 'Sorry, your nonce did not verify.';
                }
                else
                {
                    // SET VALUES FROM FORM
                    if(isset($_POST['application_job_id']))
                        $application_job_id = strip_slashes_if_required($_POST['application_job_id']);

                    if(isset($_POST['application_firstname']))
                        $application_firstname = strip_slashes_if_required($_POST['application_firstname']);

                    if(isset($_POST['application_lastname']))
                        $application_lastname = strip_slashes_if_required(trim($_POST['application_lastname']));

                    if(isset($_POST['application_nationality']))
                        $application_nationality = strip_slashes_if_required($_POST['application_nationality']);

                    if(isset($_POST['application_dob']))
                        $application_dob = strip_slashes_if_required($_POST['application_dob']);

                    if(isset($_POST['application_country']))
                        $application_country = strip_slashes_if_required($_POST['application_country']);

                    if(isset($_POST['application_city']))
                        $application_city = strip_slashes_if_required($_POST['application_city']);

                    if(isset($_POST['application_mobile']))
                        $application_mobile = strip_slashes_if_required($_POST['application_mobile']);

                    if(isset($_POST['application_number']))
                        $application_number = strip_slashes_if_required($_POST['application_number']);

                    if(isset($_POST['application_education']))
                        $application_education = strip_slashes_if_required($_POST['application_education']);

                    if(isset($_POST['application_experience']))
                        $application_experience = strip_slashes_if_required($_POST['application_experience']);

                    // VALIDATE

                    if ( empty( $application_firstname ) )
                    {
                        $application_firstname = FALSE;
                        $error = '<p class="error">'.__( 'Please enter your first name.', "Katara" ).'</p>';
                    }
                    elseif ( ! is_arabic() && ! preg_match( '/^[a-z ]+/iD', $application_firstname ) )
                    {
                        $error = '<p class="error">'.__( 'Please enter a valid name.', "Katara" ).'</p>';
                    }
                    elseif ( empty( $application_lastname ) )
                    {
                        $application_lastname = FALSE;
                        $error = '<p class="error">'.__( 'Please enter your last name.', "Katara" ).'</p>';
                    }
                    elseif ( ! is_arabic() && ! preg_match('/^[a-z ]+/iD', $application_lastname ) )
                    {
                        $error = '<p class="error">'.__( 'Please enter a valid last name.', "Katara" ).'</p>';
                    }
                    elseif ( empty( $application_nationality ) )
                    {
                        $application_nationality = FALSE;
                        $error = '<p class="error">'.__( 'Please enter your nationality', "Katara" ).'</p>';
                    }
                    elseif ( empty( $application_dob ) )
                    {
                        $application_dob = FALSE;
                        $error = '<p class="error">'.__( "Please enter a valid date of birth", "Katara" ).'</p>';
                    }
                    elseif ( empty( $application_country ) )
                    {
                        $application_country = FALSE;
                        $error = '<p class="error">'.__( 'Please select a country', "Katara" ).'</p>';
                    }
                    elseif ( empty( $application_city ) )
                    {
                        $application_city = FALSE;
                        $error = '<p class="error">'.__( 'Please enter a city', "Katara" ).'</p>';
                    }
                    elseif ( empty( $application_mobile ) )
                    {
                        $application_mobile = FALSE;
                        $error = '<p class="error">'.__( 'Please enter a valid contact number', "Katara" ).'</p>';
                    }
                    elseif ( empty( $application_number ) )
                    {
                        $application_number = FALSE;
                        $error = '<p class="error">'.__( 'Please enter a valid contact number', "Katara" ).'</p>';
                    }
                    elseif ( empty( $application_education ) )
                    {
                        $application_education = FALSE;
                        $error = '<p class="error">'.__( 'Please select your qualifications', "Katara" ).'</p>';
                    }
                    elseif ( empty( $application_experience ) )
                    {
                        $application_experience = FALSE;
                        $error = '<p class="error">'.__( 'Please select your experience', "Katara" ).'</p>';
                    }



                    // RESUME

                    if ( ! isset( $_FILES['application_resume']['name'] ) || ( $_FILES['application_resume']['name'] == '' ) )
                    {
                        $error = '<p class="error">'.__( 'Please upload a resume' ).'</p>';
                    }
                    elseif ( ! isset( $_FILES['application_intent']['name'] ) || ( $_FILES['application_intent']['name'] == '' ) )
                    {
                        $error = '<p class="error">'.__( 'Please upload a letter of intent' ).'</p>';
                    }

                    //$print = compact( 'application_firstname','application_lastname', 'application_nationality', 'application_dob', 'application_country', 'application_city', 'application_mobile', 'application_number', 'application_education', 'application_experience' );

                    if ( isset( $_FILES['application_resume'] ) && $_FILES['application_resume']['name'] != '' && $application_firstname && $application_lastname && $application_nationality && $application_dob && $application_country && $application_city && $application_mobile && $application_number && $application_education && $application_experience )
                    {

                        $extension = pathinfo($_FILES['application_resume']['name']);
                        $extension = $extension['extension'];

                        if ($_FILES['application_resume']['size'] > 10097152 || $_FILES['application_resume']['size'] <= 0)
                        {
                            $error = '<p class="error">'.__("File too large must be under 10 MB" ).'</p>';
                        }
                        elseif($extension=='doc' || $extension=='docx' || $extension=='pdf')
                        {
                            $file = wp_upload_bits( $_FILES['application_resume']['name'], NULL, file_get_contents( $_FILES['application_resume']['tmp_name'] ) );

                            if ( isset( $file['url'] ) && $file['url'] != '' )
                            {
                                $application_resume = $file['url'];
                            }
                            else
                            {
                                $error = '<p class="error">'.__( 'There was an error uploading your file', "Katara" ).'</p>';
                            }
                        }
                        else
                        {
                            $error = '<p class="error force-ltr">'.__("File either needs to be a PDF (.pdf) or a Word document (.doc)", "Katara" ).'</p>';
                        }
                    }
                    
                    // INTENT

                    if ( isset( $_FILES['application_intent'] ) && $_FILES['application_intent']['name'] != '' && $application_firstname && $application_lastname && $application_nationality && $application_dob && $application_country && $application_city && $application_mobile && $application_number && $application_education && $application_experience )
                    {
                        $extension = pathinfo($_FILES['application_intent']['name']);
                        $extension = $extension['extension'];

                        if ($_FILES['application_intent']['size'] > 10097152 || $_FILES['application_intent']['size'] <= 0)
                        {
                            $error = '<p class="error">'.__("File too large must be under 10 MB" ).'</p>';
                        }
                        elseif($extension=='doc' || $extension=='docx' || $extension=='pdf')
                        {
                            $file = wp_upload_bits( $_FILES['application_intent']['name'], NULL, file_get_contents( $_FILES['application_intent']['tmp_name'] ) );

                            if ( isset( $file['url'] ) && $file['url'] != '' )
                            {
                                $application_intent = $file['url'];
                            }
                            else
                            {
                                $error = '<p class="error">'.__( 'There was an error uploading your file', "Katara" ).'</p>';
                            }
                        }
                        else
                        {
                            $error = '<p class="error force-ltr">'.__("File either needs to be a PDF (.pdf) or a Word document (.doc)", "Katara" ).'</p>';
                        }
                    }
                    else
                    {
                        $application_intent = FALSE;
                    }

                    if ( ! $error )
                    {
                        //FIX DATE
                        list($day, $month, $year) = explode( '-', $application_dob);
                        $application_dob = $year."-".$month."-".$day;

                        $data = apply_career( $application_firstname, $application_lastname, $application_nationality, $application_dob, $application_country, $application_city, $application_mobile, $application_number, $application_education, $application_experience, $application_resume, $application_intent, $application_job_id );

                        if ( isset( $data['success'] ) && $data['success'] == FALSE )
                        {
                            $error = $data['message'];
                        }
                        elseif ( isset( $data['success'] ) && $data['success'] == TRUE )
                        {
                            $success = TRUE;
                        }
                    }
                }
            }
        ?>
        
        <?php
            if ( $success )
            {
                get_template_part( 'modules/thank-you' );
            }
            elseif ( isset( $_GET['job_id'] ) && $_GET['job_id'] != '' )
            {
                $job_id = $_GET['job_id'];
        ?>
            <div class="form-page" role="main">
                <header class="entry-header fade-line">
                    <h1 class="ttl-36"><?php echo __( 'Application Form', "Katara" ); ?></h1>
                </header>
                
                <p><?php echo __( 'Please complete the following form to apply for this position.', "Katara" ); ?></p>
                
                <form action="" class="" method="post" enctype="multipart/form-data">
                    <div id="job_title" class="grad-bg contact-form">
                        <h2 class="sub-ttl-18"><?php echo get_the_title( $job_id ); ?></h2>
                        <br />
                        <input type="hidden" value="<?php echo $job_id; ?>" name="application_job_id" />
                        <p><?php echo __( 'Reference', "Katara" ); ?>: <?php echo get_post_meta( $job_id, 'job_reference', TRUE ); ?></p>
                        <p><?php echo __( 'Location', "Katara" ); ?>: <?php echo get_post_meta( $job_id, 'job_location', TRUE ); ?></p>
                    </div>
                    
                    <div class="grad-bg contact-form">
                        <div class="half-block">
                            <label><?php echo __( 'First name', "Katara" ); ?></label><input class="required" type="text" name="application_firstname" value="<?php echo $application_firstname; ?>" />
                            <span class="error"></span>
                        </div>

                        <div class="half-block omega">
                            <label><?php echo __( 'Last name', "Katara" ); ?></label><input class="required" type="text" name="application_lastname" value="<?php echo $application_lastname; ?>" />
                            <span class="error"></span>
                        </div>

                        <div class="half-block">
                            <label><?php _e( 'Nationality', "Katara" ); ?></label><input class="required" type="text" name="application_nationality" value="<?php echo $application_nationality; ?>" />
                            <span class="error"></span>
                        </div>
                    
                        <div class="half-block omega">
                            <label style="display:block"><?php echo __( 'Date of birth (DD MM YYYY)', "Katara" ); ?></label>
                            <input class="required number small dob" maxlength="2" type="text" id="tb-day" value="" />
                            <input class="required number small dob" maxlength="2" type="text" id="tb-month" value="" />
                            <input class="required number med dob" maxlength="4" type="text" id="tb-year" value="" />
                            <input class="required" type="hidden" id="application_dob" name="application_dob" value="<?php echo $application_dob; ?>" />
                            <span style="display:block;clear:both;" class="error"></span>
                        </div>
                    
                        <div class="half-block">
                            <label><?php echo __( 'Address country', "Katara" ); ?></label>
                            <p class="dummy-select required">
                                <span><?php _e( 'Please select a country', "Katara" ); ?></span>
                                <select name="application_country">
                                    <option value=""><?php echo _e( 'Please select a country', "Katara" ); ?></option>
                                    <option value="AF"><?php echo _e( 'Afghanistan', "Katara" ); ?></option>
                                    <option value="DZ"><?php echo _e( 'Algeria', "Katara" ); ?></option>
                                    <option value="DZ"><?php echo _e( 'Albania', "Katara" ); ?></option>
                                    <option value="AS"><?php echo _e( 'American Samoa', "Katara" ); ?></option>
                                    <option value="AD"><?php echo _e( 'Andorra', "Katara" ); ?></option>
                                    <option value="AO"><?php echo _e( 'Angola', "Katara" ); ?></option>
                                    <option value="AI"><?php echo _e( 'Anguilla', "Katara" ); ?></option>
                                    <option value="AQ"><?php echo _e( 'Antarctica', "Katara" ); ?></option>
                                    <option value="AG"><?php echo _e( 'Antigua and Barbuda', "Katara" ); ?></option>
                                    <option value="AR"><?php echo _e( 'Argentina', "Katara" ); ?></option>
                                    <option value="AM"><?php echo _e( 'Armenia', "Katara" ); ?></option>
                                    <option value="AW"><?php echo _e( 'Aruba', "Katara" ); ?></option>
                                    <option value="AU"><?php echo _e( 'Australia', "Katara" ); ?></option>
                                    <option value="AT"><?php echo _e( 'Austria', "Katara" ); ?></option>
                                    <option value="AZ"><?php echo _e( 'Azerbaijan', "Katara" ); ?></option>
                                    <option value="BS"><?php echo _e( 'Bahamas', "Katara" ); ?></option>
                                    <option value="BH"><?php echo _e( 'Bahrain', "Katara" ); ?></option>
                                    <option value="BD"><?php echo _e( 'Bangladesh', "Katara" ); ?></option>
                                    <option value="BB"><?php echo _e( 'Barbados', "Katara" ); ?></option>
                                    <option value="BY"><?php echo _e( 'Belarus', "Katara" ); ?></option>
                                    <option value="BE"><?php echo _e( 'Belgium', "Katara" ); ?></option>
                                    <option value="BZ"><?php echo _e( 'Belize', "Katara" ); ?></option>
                                    <option value="BJ"><?php echo _e( 'Benin', "Katara" ); ?></option>
                                    <option value="BM"><?php echo _e( 'Bermuda', "Katara" ); ?></option>
                                    <option value="BT"><?php echo _e( 'Bhutan', "Katara" ); ?></option>
                                    <option value="BO"><?php echo _e( 'Bolivia', "Katara" ); ?></option>
                                    <option value="BA"><?php echo _e( 'Bosnia and Herzegovina', "Katara" ); ?></option>
                                    <option value="BW"><?php echo _e( 'Botswana', "Katara" ); ?></option>
                                    <option value="BR"><?php echo _e( 'Brazil', "Katara" ); ?></option>
                                    <option value="IO"><?php echo _e( 'British Indian Ocean Territory', "Katara" ); ?></option>
                                    <option value="BN"><?php echo _e( 'Brunei Darussalam', "Katara" ); ?></option>
                                    <option value="BG"><?php echo _e( 'Bulgaria', "Katara" ); ?></option>
                                    <option value="BF"><?php echo _e( 'Burkina Faso', "Katara" ); ?></option>
                                    <option value="BI"><?php echo _e( 'Burundi', "Katara" ); ?></option>
                                    <option value="KH"><?php echo _e( 'Cambodia', "Katara" ); ?></option>
                                    <option value="CM"><?php echo _e( 'Cameroon', "Katara" ); ?></option>
                                    <option value="CA"><?php echo _e( 'Canada', "Katara" ); ?></option>
                                   <option value="CV"><?php echo _e( 'Cape Verde', "Katara" ); ?></option>
                                    <option value="CF"><?php echo _e( 'Central African Republic', "Katara" ); ?></option>
                                    <option value="TD"><?php echo _e( 'Chad', "Katara" ); ?></option>
                                    <option value="CL"><?php echo _e( 'Chile', "Katara" ); ?></option>
                                    <option value="CN"><?php echo _e( 'China', "Katara" ); ?></option>
                                    <option value="CO"><?php echo _e( 'Colombia', "Katara" ); ?></option>
                                    <option value="KM"><?php echo _e( 'Comoros', "Katara" ); ?></option>
                                    <option value="CG"><?php echo _e( 'Congo', "Katara" ); ?></option>
                                    <option value="CD"><?php echo _e( 'Congo, The Democratic Republic of the', "Katara" ); ?></option>
                                    <option value="CK"><?php echo _e( 'Cook Islands', "Katara" ); ?></option>
                                    <option value="CR"><?php echo _e( 'Costa Rica', "Katara" ); ?></option>
                                    <option value="CI"><?php echo _e( 'Cote d\'Ivoire', "Katara" ); ?></option>
                                    <option value="HR"><?php echo _e( 'Croatia', "Katara" ); ?></option>
                                    <option value="CU"><?php echo _e( 'Cuba', "Katara" ); ?></option>
                                    <option value="CY"><?php echo _e( 'Cyprus', "Katara" ); ?></option>
                                    <option value="CZ"><?php echo _e( 'Czech Republic', "Katara" ); ?></option>
                                    <option value="DK"><?php echo _e( 'Denmark', "Katara" ); ?></option>
                                    <option value="DJ"><?php echo _e( 'Djibouti', "Katara" ); ?></option>
                                    <option value="DM"><?php echo _e( 'Dominica', "Katara" ); ?></option>
                                    <option value="DO"><?php echo _e( 'Dominican Republic', "Katara" ); ?></option>
                                    <option value="EC"><?php echo _e( 'Ecuador', "Katara" ); ?></option>
                                    <option value="EG"><?php echo _e( 'Egypt', "Katara" ); ?></option>
                                    <option value="SV"><?php echo _e( 'El Salvador', "Katara" ); ?></option>
                                    <option value="GQ"><?php echo _e( 'Equatorial Guinea', "Katara" ); ?></option>
                                    <option value="ER"><?php echo _e( 'Eritrea', "Katara" ); ?></option>
                                    <option value="EE"><?php echo _e( 'Estonia', "Katara" ); ?></option>
                                    <option value="ET"><?php echo _e( 'Ethiopia', "Katara" ); ?></option>
                                    <option value="FO"><?php echo _e( 'Faroe Islands', "Katara" ); ?></option>
                                    <option value="FJ"><?php echo _e( 'Fiji', "Katara" ); ?></option>
                                    <option value="FI"><?php echo _e( 'Finland', "Katara" ); ?></option>
                                    <option value="FR"><?php echo _e( 'France', "Katara" ); ?></option>
                                    <option value="GF"><?php echo _e( 'French Guiana', "Katara" ); ?></option>
                                    <option value="PF"><?php echo _e( 'French Polynesia', "Katara" ); ?></option>
                                    <option value="TF"><?php echo _e( 'French Southern Territories', "Katara" ); ?></option>
                                    <option value="GA"><?php echo _e( 'Gabon', "Katara" ); ?></option>
                                    <option value="GM"><?php echo _e( 'Gambia', "Katara" ); ?></option>
                                    <option value="GE"><?php echo _e( 'Georgia', "Katara" ); ?></option>
                                    <option value="DE"><?php echo _e( 'Germany', "Katara" ); ?></option>
                                    <option value="GH"><?php echo _e( 'Ghana', "Katara" ); ?></option>
                                    <option value="GI"><?php echo _e( 'Gibraltar', "Katara" ); ?></option>
                                    <option value="GR"><?php echo _e( 'Greece', "Katara" ); ?></option>
                                    <option value="GL"><?php echo _e( 'Greenland', "Katara" ); ?></option>
                                    <option value="GD"><?php echo _e( 'Grenada', "Katara" ); ?></option>
                                    <option value="GP"><?php echo _e( 'Guadeloupe', "Katara" ); ?></option>
                                    <option value="GU"><?php echo _e( 'Guam', "Katara" ); ?></option>
                                    <option value="GT"><?php echo _e( 'Guatemala', "Katara" ); ?></option>
                                    <option value="GG"><?php echo _e( 'Guernsey', "Katara" ); ?></option>
                                    <option value="GN"><?php echo _e( 'Guinea', "Katara" ); ?></option>
                                    <option value="GW"><?php echo _e( 'Guinea-Bissau', "Katara" ); ?></option>
                                    <option value="GY"><?php echo _e( 'Guyana', "Katara" ); ?></option>
                                    <option value="HT"><?php echo _e( 'Haiti', "Katara" ); ?></option>
                                    <option value="HM"><?php echo _e( 'Heard Island and McDonald Islands', "Katara" ); ?></option>
                                    <option value="VA"><?php echo _e( 'Holy See (Vatican City State)', "Katara" ); ?></option>
                                    <option value="HN"><?php echo _e( 'Honduras', "Katara" ); ?></option>
                                    <option value="HK"><?php echo _e( 'Hong Kong', "Katara" ); ?></option>
                                    <option value="HU"><?php echo _e( 'Hungary', "Katara" ); ?></option>
                                    <option value="IS"><?php echo _e( 'Iceland', "Katara" ); ?></option>
                                    <option value="IN"><?php echo _e( 'India', "Katara" ); ?></option>
                                    <option value="ID"><?php echo _e( 'Indonesia', "Katara" ); ?></option>
                                    <option value="IR"><?php echo _e( 'Iran, Islamic Republic of', "Katara" ); ?></option>
                                    <option value="IQ"><?php echo _e( 'Iraq', "Katara" ); ?></option>
                                    <option value="IE"><?php echo _e( 'Ireland', "Katara" ); ?></option>
                                    <option value="IM"><?php echo _e( 'Isle of Man', "Katara" ); ?></option>
                                    <option value="IL"><?php echo _e( 'Israel', "Katara" ); ?></option>
                                    <option value="IT"><?php echo _e( 'Italy', "Katara" ); ?></option>
                                    <option value="JM"><?php echo _e( 'Jamaica', "Katara" ); ?></option>
                                    <option value="JP"><?php echo _e( 'Japan', "Katara" ); ?></option>
                                    <option value="JE"><?php echo _e( 'Jersey', "Katara" ); ?></option>
                                    <option value="JO"><?php echo _e( 'Jordan', "Katara" ); ?></option>
                                    <option value="KZ"><?php echo _e( 'Kazakhstan', "Katara" ); ?></option>
                                    <option value="KE"><?php echo _e( 'Kenya', "Katara" ); ?></option>
                                    <option value="KI"><?php echo _e( 'Kiribati', "Katara" ); ?></option>
                                    <option value="KP"><?php echo _e( 'Korea, Democratic People\'s Republic of', "Katara" ); ?></option>
                                    <option value="KR"><?php echo _e( 'Korea, Republic of', "Katara" ); ?></option>
                                    <option value="KW"><?php echo _e( 'Kuwait', "Katara" ); ?></option>
                                    <option value="KG"><?php echo _e( 'Kyrgyzstan', "Katara" ); ?></option>
                                    <option value="LA"><?php echo _e( 'Lao People\'s Democratic Republic', "Katara" ); ?></option>
                                    <option value="LV"><?php echo _e( 'Latvia', "Katara" ); ?></option>
                                    <option value="LB"><?php echo _e( 'Lebanon', "Katara" ); ?></option>
                                    <option value="LS"><?php echo _e( 'Lesotho', "Katara" ); ?></option>
                                    <option value="LR"><?php echo _e( 'Liberia', "Katara" ); ?></option>
                                    <option value="LY"><?php echo _e( 'Libyan Arab Jamahiriya', "Katara" ); ?></option>
                                    <option value="LI"><?php echo _e( 'Liechtenstein', "Katara" ); ?></option>
                                    <option value="LT"><?php echo _e( 'Lithuania', "Katara" ); ?></option>
                                    <option value="LU"><?php echo _e( 'Luxembourg', "Katara" ); ?></option>
                                    <option value="MO"><?php echo _e( 'Macao', "Katara" ); ?></option>
                                    <option value="MK"><?php echo _e( 'Macedonia, The Former Yugoslav Republic of', "Katara" ); ?></option>
                                    <option value="MG"><?php echo _e( 'Madagascar', "Katara" ); ?></option>
                                    <option value="MW"><?php echo _e( 'Malawi', "Katara" ); ?></option>
                                    <option value="MY"><?php echo _e( 'Malaysia', "Katara" ); ?></option>
                                    <option value="MV"><?php echo _e( 'Maldives', "Katara" ); ?></option>
                                    <option value="ML"><?php echo _e( 'Mali', "Katara" ); ?></option>
                                    <option value="MT"><?php echo _e( 'Malta', "Katara" ); ?></option>
                                    <option value="MH"><?php echo _e( 'Marshall Islands', "Katara" ); ?></option>
                                    <option value="MQ"><?php echo _e( 'Martinique', "Katara" ); ?></option>
                                    <option value="MR"><?php echo _e( 'Mauritania', "Katara" ); ?></option>
                                    <option value="MU"><?php echo _e( 'Mauritius', "Katara" ); ?></option>
                                    <option value="YT"><?php echo _e( 'Mayotte', "Katara" ); ?></option>
                                    <option value="MX"><?php echo _e( 'Mexico', "Katara" ); ?></option>
                                    <option value="FM"><?php echo _e( 'Micronesia, Federated States of', "Katara" ); ?></option>
                                    <option value="MD"><?php echo _e( 'Moldova', "Katara" ); ?></option>
                                    <option value="MC"><?php echo _e( 'Monaco', "Katara" ); ?></option>
                                    <option value="MN"><?php echo _e( 'Mongolia', "Katara" ); ?></option>
                                    <option value="ME"><?php echo _e( 'Montenegro', "Katara" ); ?></option>
                                    <option value="MS"><?php echo _e( 'Montserrat', "Katara" ); ?></option>
                                    <option value="MA"><?php echo _e( 'Morocco', "Katara" ); ?></option>
                                    <option value="MZ"><?php echo _e( 'Mozambique', "Katara" ); ?></option>
                                    <option value="MM"><?php echo _e( 'Myanmar', "Katara" ); ?></option>
                                    <option value="NA"><?php echo _e( 'Namibia', "Katara" ); ?></option>
                                    <option value="NR"><?php echo _e( 'Nauru', "Katara" ); ?></option>
                                    <option value="NP"><?php echo _e( 'Nepal', "Katara" ); ?></option>
                                    <option value="NL"><?php echo _e( 'Netherlands', "Katara" ); ?></option>
                                    <option value="AN"><?php echo _e( 'Netherlands Antilles', "Katara" ); ?></option>
                                    <option value="NC"><?php echo _e( 'New Caledonia', "Katara" ); ?></option>
                                    <option value="NZ"><?php echo _e( 'New Zealand', "Katara" ); ?></option>
                                    <option value="NI"><?php echo _e( 'Nicaragua', "Katara" ); ?></option>
                                    <option value="NE"><?php echo _e( 'Niger', "Katara" ); ?></option>
                                    <option value="NG"><?php echo _e( 'Nigeria', "Katara" ); ?></option>
                                    <option value="NU"><?php echo _e( 'Niue', "Katara" ); ?></option>
                                    <option value="NF"><?php echo _e( 'Norfolk Island', "Katara" ); ?></option>
                                    <option value="MP"><?php echo _e( 'Northern Mariana Islands', "Katara" ); ?></option>
                                    <option value="NO"><?php echo _e( 'Norway', "Katara" ); ?></option>
                                    <option value="OM"><?php echo _e( 'Oman', "Katara" ); ?></option>
                                    <option value="PK"><?php echo _e( 'Pakistan', "Katara" ); ?></option>
                                    <option value="PW"><?php echo _e( 'Palau', "Katara" ); ?></option>
                                    <option value="PS"><?php echo _e( 'Palestinian Territory, Occupied', "Katara" ); ?></option>
                                    <option value="PA"><?php echo _e( 'Panama', "Katara" ); ?></option>
                                    <option value="PG"><?php echo _e( 'Papua New Guinea', "Katara" ); ?></option>
                                    <option value="PY"><?php echo _e( 'Paraguay', "Katara" ); ?></option>
                                    <option value="PE"><?php echo _e( 'Peru', "Katara" ); ?></option>
                                    <option value="PH"><?php echo _e( 'Philippines', "Katara" ); ?></option>
                                    <option value="PN"><?php echo _e( 'Pitcairn', "Katara" ); ?></option>
                                    <option value="PL"><?php echo _e( 'Poland', "Katara" ); ?></option>
                                    <option value="PT"><?php echo _e( 'Portugal', "Katara" ); ?></option>
                                    <option value="PR"><?php echo _e( 'Puerto Rico', "Katara" ); ?></option>
                                    <option value="QA"><?php echo _e( 'Qatar', "Katara" ); ?></option>
                                    <option value="RE"><?php echo _e( 'R&#233;union', "Katara" ); ?></option>
                                    <option value="RO"><?php echo _e( 'Romania', "Katara" ); ?></option>
                                    <option value="RU"><?php echo _e( 'Russian Federation', "Katara" ); ?></option>
                                    <option value="RW"><?php echo _e( 'Rwanda', "Katara" ); ?></option>
                                    <option value="BL"><?php echo _e( 'Saint Barth&#233;lemy', "Katara" ); ?></option>
                                    <option value="SH"><?php echo _e( 'Saint Helena', "Katara" ); ?></option>
                                    <option value="KN"><?php echo _e( 'Saint Kitts and Nevis', "Katara" ); ?></option>
                                    <option value="LC"><?php echo _e( 'Saint Lucia', "Katara" ); ?></option>
                                    <option value="MF"><?php echo _e( 'Saint Martin', "Katara" ); ?></option>
                                    <option value="PM"><?php echo _e( 'Saint Pierre and Miquelon', "Katara" ); ?></option>
                                    <option value="VC"><?php echo _e( 'Saint Vincent and the Grenadines', "Katara" ); ?></option>
                                    <option value="WS"><?php echo _e( 'Samoa', "Katara" ); ?></option>
                                    <option value="SM"><?php echo _e( 'San Marino', "Katara" ); ?></option>
                                    <option value="ST"><?php echo _e( 'Sao Tome and Principe', "Katara" ); ?></option>
                                    <option value="SA"><?php echo _e( 'Saudi Arabia', "Katara" ); ?></option>
                                    <option value="SN"><?php echo _e( 'Senegal', "Katara" ); ?></option>
                                    <option value="RS"><?php echo _e( 'Serbia', "Katara" ); ?></option>
                                    <option value="SC"><?php echo _e( 'Seychelles', "Katara" ); ?></option>
                                    <option value="SL"><?php echo _e( 'Sierra Leone', "Katara" ); ?></option>
                                    <option value="SG"><?php echo _e( 'Singapore', "Katara" ); ?></option>
                                    <option value="SK"><?php echo _e( 'Slovakia', "Katara" ); ?></option>
                                    <option value="SI"><?php echo _e( 'Slovenia', "Katara" ); ?></option>
                                    <option value="SB"><?php echo _e( 'Solomon Islands', "Katara" ); ?></option>
                                    <option value="SO"><?php echo _e( 'Somalia', "Katara" ); ?></option>
                                    <option value="ZA"><?php echo _e( 'South Africa', "Katara" ); ?></option>
                                    <option value="GS"><?php echo _e( 'South Georgia and the South Sandwich Islands', "Katara" ); ?></option>
                                    <option value="ES"><?php echo _e( 'Spain', "Katara" ); ?></option>
                                    <option value="LK"><?php echo _e( 'Sri Lanka', "Katara" ); ?></option>
                                    <option value="SD"><?php echo _e( 'Sudan', "Katara" ); ?></option>
                                    <option value="SR"><?php echo _e( 'Suriname', "Katara" ); ?></option>
                                    <option value="SJ"><?php echo _e( 'Svalbard and Jan Mayen', "Katara" ); ?></option>
                                    <option value="SZ"><?php echo _e( 'Swaziland', "Katara" ); ?></option>
                                    <option value="SE"><?php echo _e( 'Sweden', "Katara" ); ?></option>
                                    <option value="CH"><?php echo _e( 'Switzerland', "Katara" ); ?></option>
                                    <option value="SY"><?php echo _e( 'Syrian Arab Republic', "Katara" ); ?></option>
                                    <option value="TW"><?php echo _e( 'Taiwan, Province of China', "Katara" ); ?></option>
                                    <option value="TJ"><?php echo _e( 'Tajikistan', "Katara" ); ?></option>
                                    <option value="TZ"><?php echo _e( 'Tanzania, United Republic of', "Katara" ); ?></option>
                                    <option value="TH"><?php echo _e( 'Thailand', "Katara" ); ?></option>
                                    <option value="TL"><?php echo _e( 'Timor-Leste', "Katara" ); ?></option>
                                    <option value="TG"><?php echo _e( 'Togo', "Katara" ); ?></option>
                                    <option value="TK"><?php echo _e( 'Tokelau', "Katara" ); ?></option>
                                    <option value="TO"><?php echo _e( 'Tonga', "Katara" ); ?></option>
                                    <option value="TT"><?php echo _e( 'Trinidad and Tobago', "Katara" ); ?></option>
                                    <option value="TN"><?php echo _e( 'Tunisia', "Katara" ); ?></option>
                                    <option value="TR"><?php echo _e( 'Turkey', "Katara" ); ?></option>
                                    <option value="TM"><?php echo _e( 'Turkmenistan', "Katara" ); ?></option>
                                    <option value="TC"><?php echo _e( 'Turks and Caicos Islands', "Katara" ); ?></option>
                                    <option value="TV"><?php echo _e( 'Tuvalu', "Katara" ); ?></option>
                                    <option value="UG"><?php echo _e( 'Uganda', "Katara" ); ?></option>
                                    <option value="UA"><?php echo _e( 'Ukraine', "Katara" ); ?></option>
                                    <option value="AE"><?php echo _e( 'United Arab Emirates', "Katara" ); ?></option>
                                    <option value="GB"><?php echo _e( 'United Kingdom', "Katara" ); ?></option>
                                    <option value="US"><?php echo _e( 'United States', "Katara" ); ?></option>
                                    <option value="UM"><?php echo _e( 'United States Minor Outlying Islands', "Katara" ); ?></option>
                                    <option value="UY"><?php echo _e( 'Uruguay', "Katara" ); ?></option>
                                    <option value="UZ"><?php echo _e( 'Uzbekistan', "Katara" ); ?></option>
                                    <option value="VU"><?php echo _e( 'Vanuatu', "Katara" ); ?></option>
                                    <option value="VE"><?php echo _e( 'Venezuela', "Katara" ); ?></option>
                                    <option value="VN"><?php echo _e( 'Viet Nam', "Katara" ); ?></option>
                                    <option value="VG"><?php echo _e( 'Virgin Islands, British', "Katara" ); ?></option>
                                    <option value="VI"><?php echo _e( 'Virgin Islands, U.S.', "Katara" ); ?></option>
                                    <option value="WF"><?php echo _e( 'Wallis and Futuna', "Katara" ); ?></option>
                                    <option value="EH"><?php echo _e( 'Western Sahara', "Katara" ); ?></option>
                                    <option value="YE"><?php echo _e( 'Yemen', "Katara" ); ?></option>
                                    <option value="ZM"><?php echo _e( 'Zambia', "Katara" ); ?></option>
                                    <option value="ZW"><?php echo _e( 'Zimbabwe', "Katara" ); ?></option>
                                </select>
                            <p>    
                            <span class="error"></span>
                        </div>
                    
                        <div class="half-block omega">
                            <label><?php echo __( 'City', "Katara" ); ?></label><input type="text" class="required" name="application_city" value="<?php echo $application_city; ?>" />
                            <span class="error"></span>
                        </div>
                    
                        <div class="half-block">
                            <label><?php echo __( 'Mobile number', "Katara" ); ?></label><input type="text" class="required validate-number" name="application_mobile" value="<?php echo $application_mobile; ?>" />
                            <span class="error"></span>
                        </div>
                    
                        <div class="half-block omega">
                            <label><?php echo __( 'Daytime contact number', "Katara" ); ?></label><input type="text" class="required validate-number" name="application_number" value="<?php echo $application_number; ?>" />
                            <span class="error"></span>
                        </div>

                        <div class="half-block">
                            <label><?php echo __( 'Educational qualification', "Katara" ); ?></label>
                            <p class="dummy-select required">
                                <span><?php echo __( 'Select educational qualification', "Katara" ); ?></span>
                                <select name="application_education">
                                    <option value=""><?php echo __( 'Select educational qualification', "Katara" ); ?></option>
                                    <option value="Doctoral degree"><?php echo __( 'Doctoral degree', "Katara" ); ?></option>
                                    <option value="Master degree"><?php echo __( 'Master degree', "Katara" ); ?></option>
                                    <option value="College / University diploma"><?php echo __( 'College / University diploma', "Katara" ); ?></option>
                                    <option value="Diploma / short course"><?php echo __( 'Diploma / short course', "Katara" ); ?></option>
                                    <option value="High school"><?php echo __( 'High school', "Katara" ); ?></option>
                                    <option value="Elementary school"><?php echo __( 'Elementary school', "Katara" ); ?></option>
                                </select>
                            </p>
                            <span class="error"></span>
                        </div>
                    
                        <div class="half-block omega">
                            <label><?php echo __( 'Years of experience', "Katara" ); ?></label>
                            <p class="dummy-select required">
                                <span><?php echo __( 'Select years of experience', "Katara" ); ?></span>
                                <select name="application_experience">
                                    <option value=""><?php echo __( 'Select years of experience', "Katara" ); ?></option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="3">3</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="more"><?php echo __( 'more', "Katara" ); ?></option>
                                </select>
                            </p>
                            <span class="error"></span>
                        </div>
                        <div class="clearBoth">&nbsp;</div>
                    </div>
                    
                    <div class="grad-bg contact-form">
                        <div class="half-block">
                            <label><?php echo __( 'Upload area', "Katara" ); ?></label>
                            <p class="dummy-file required">
                                <span class="file-name"><?php echo __( 'Resume', "Katara" ); ?></span>
                                <span class="file-btn-text"><?php echo __( 'Choose file', "Katara" ); ?></span>
                                <input type="file" name="application_resume" id="file" />
                            </p>
                            
                            <span class="error"></span>
                        </div>
                    
                        <div class="half-block omega">
                            <label>&nbsp;</label>
                            <p class="dummy-file required">
                                <span class="file-name"><?php echo __( 'Letter of intent', "Katara" ); ?></span>
                                <span class="file-btn-text"><?php echo __( 'Choose file', "Katara" ); ?></span>
                                <input type="file" name="application_intent" id="file" />
                            </p>
                            <span class="error"></span>
                        </div>
                        <div class="clearBoth">&nbsp;</div>
                        <p class="input-hint force-ltr"><?php echo __( 'File either needs to be a PDF (.pdf) or a Word document (.doc)', "Katara" ); ?></p>
                        
                        <div class="right-block">
                            <p class="error"><?php if ( $error ) echo $error; ?></p>
                            <a href="#" class="inlineBlock secondry-btn" onClick="window.top.closeModal();return false;"><?php echo __( 'Cancel', "Katara" ); ?></a>
                            <input type="submit" name="submit" class="submit-btn validate" value="<?php _e( 'Submit', "Katara" ); ?>" />
                        </div>
                    </div>

                    <?php wp_nonce_field('contact_field_form','contact_field_form'); ?>
                </form>
            </div><!-- #content -->
        <?php
            }
            else
            {
                get_template_part( 'modules/no-job-id' );
            }
        ?>
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
        <script src="<?php bloginfo('template_url'); ?>/assets/js/<?php echo(is_arabic())? 'rtl' : 'common' ; ?>.js" type="text/javascript"></script>   
        
    </body>
</html>