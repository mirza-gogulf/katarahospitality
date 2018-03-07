<?php
    get_header();
    the_post();

    //set form vaules
    $contact = new stdClass;
    $contact->contact_first_name = FALSE;
    $contact->contact_last_name = FALSE;
    $contact->contact_company = FALSE;
    $contact->contact_email = FALSE;
    $contact->contact_department = FALSE;
    $contact->contact_subject = FALSE;
    $contact->contact_message = FALSE;

    $error = FALSE;
    $updated = FALSE;

    if ( isset( $_POST['submit'] ) )
    {
        if ( !isset($_POST['contact_field_form']) || !wp_verify_nonce($_POST['contact_field_form'],'contact_field_form') )
        {
           $error = __( "There was an error please try again.", "Katara" );
        }
        else
        {

            // SET VALUES FROM FORM
            if(isset($_POST['contact_first_name']))
                $contact->contact_first_name = strip_slashes_if_required($_POST['contact_first_name']);

            if(isset($_POST['contact_last_name']))
                $contact->contact_last_name = strip_slashes_if_required($_POST['contact_last_name']);

            if(isset($_POST['contact_company']))
                $contact->contact_company = strip_slashes_if_required(trim($_POST['contact_company']));

            if(isset($_POST['contact_email']))
                $contact->contact_email = strip_slashes_if_required($_POST['contact_email']);

            if(isset($_POST['contact_department']))
                $contact->contact_department = strip_slashes_if_required($_POST['contact_department']);

            if(isset($_POST['contact_subject']))
                $contact->contact_subject = strip_slashes_if_required($_POST['contact_subject']);

            if(isset($_POST['contact_message']))
                $contact->contact_message = strip_slashes_if_required($_POST['contact_message']);

            // VALIDATE

            if ( empty( $contact->contact_first_name ) )
            {
                $contact->contact_first_name = '';
                $error = __( 'Please enter your first name.', "Katara" );
            }
            elseif ( ! is_arabic() && ! preg_match( '/^[a-z ]+/iD', $contact->contact_first_name ) )
            {
                $error = __( 'Please enter a valid name.', "Katara" );
            }
            elseif ( empty( $contact->contact_last_name ) )
            {
                $contact->contact_last_name = '';
                $error = __( 'Please enter your last name.', "Katara" );
            }
            elseif ( ! is_arabic() && ! preg_match('/^[a-z ]+/iD', $contact->contact_last_name ) )
            {
                $error = __( 'Please enter a valid last name.', "Katara" );
            }
            elseif ( empty( $contact->contact_company ) )
            {
                $contact->contact_company = '';
                $error = __( 'Please enter your company name.', "Katara" );
            }
            elseif ( ! is_arabic() && ! preg_match('/^[a-z ]+/iD', $contact->contact_company ) )
            {
                $error = __( 'Please enter a valid company name.', "Katara" );
            }
            elseif ( empty( $contact->contact_email ) )
            {
                $contact->contact_email = "";
                $error = __( "Please enter your email.", "Katara" );
            }
            elseif ( ! is_email( $contact->contact_email ) )
            {
                $error = __( "Please enter a valid email address.", "Katara" );
            }
            elseif ( empty( $contact->contact_subject ) )
            {
                $contact->contact_subject = '';
                $error = __( 'Please enter your subject.', "Katara" );
            }
            elseif ( ! is_arabic() && ! preg_match('/^[a-z ]+/iD', $contact->contact_subject ) )
            {
                $error = __( 'Please enter a valid subject.', "Katara" );
            }
            elseif ( empty( $contact->contact_message ) )
            {
                $contact_message = "";
                $error = __( "Please enter your message.", "Katara" );
            }
            elseif ( ! is_arabic() && ! preg_match( '/^[a-z0-9]+/iD', $contact->contact_message ) )
            {
                $error = __( "Please enter a valid message.", "Katara" );
            }

            if ( empty( $error ) )
            {
                $to = get_option( 'contact_form' );

                $contact_subject = "We would like to thank you for contacting Katara Hospitality.";
                $contact_message = "We would like to thank you for contacting Katara Hospitality.

Your request will be forwarded to the concerned department. You will be contacted directly should it be of interest for Katara Hospitality or its affiliated units.

Thank you, 
Katara Hospitality";

                if( is_arabic() )
                {
                    $contact_subject = "نود أن نشكركم على مراسلتكم كتارا للضيافة";
                    $contact_message = "نود أن نشكركم على مراسلتكم كتارا للضيافة.

سوف يتم إرسال طلبكم إلى القسم المختص لدينا. سيتم الإتصال بكم مباشرةً إذا كان طلبكم يناسب متطلبات كتارا للضيافة أو الوحدات التابعة لها.

شكرا لكم
كتارا للضيافة";
                }

                if ( $to == '' )
                    $to = get_bloginfo( 'admin_email' );

                if( $contact->contact_department == 'General' )
                {
                    $to = "info@katarahospitality.com";
                }
                else if ($contact->contact_department == 'Media') {
                    $to = "media@katarahospitality.com";

                    $contact_message = "We would like to thank you for contacting Katara Hospitality.

Editorial enquiries will be addressed within two working days.

For advertising opportunities, we will contact you directly should the proposal align with our marketing strategy.

Thank you, 
The MARCOM Team
Katara Hospitality";

                if( is_arabic() )
                {
                    $contact_message = "نود أن نشكركم على مراسلتكم كتارا للضيافة.

ستتم مراجعة طلباتكم التحريرية خلال يومين من ايام العمل.

لفرص الدعاية والإعلان ، سوف يتم التواصل معكم إن كان العرض ملائم مع إستراتيجية التسويق لدينا.

شكرا لكم
إدارة التسويق والاتصالات
كتارا للضيافة";
}
                }
                else if ($contact->contact_department == 'Investment' )
                {
                    $to = "investment@katarahospitality.com";
                    $contact_message = "We would like to thank you for contacting Katara Hospitality.

Katara Hospitality aims to create a portfolio of iconic hotels by acquiring and developing high-end properties in gateway destinations.

Your enquiry / proposal will be carefully reviewed. If this matches our investment criteria, we will contact you directly.

Thank you, 
The Business Development Team
Katara Hospitality";

                if( is_arabic() )
                {
                    $contact_message = "نود أن نشكركم على مراسلتكم كتارا للضيافة.

تهدف كتارا للضيافة لخلق مجموعة من الفنادق المميزة من خلال إكتساب وتطوير الوحدات الفاخرة في أهم المدن العالمية.

ستتم مراجعة طلبكم/عرضكم بعناية. وإذا كان عرض الاستثمار يخلق فرص جديدة مستدامة، سوف يتم التواصل معكم مباشرة.

شكراً لكم
إدارة تطوير الأعمال
كتارا للضيافة";
}
                }
                else if ($contact->contact_department == 'Careers' )
                {
                    $to = "careers@katarahospitality.com";
                    $contact_message = "Dear Candidate, 

We would like to thank you for contacting Katara Hospitality. 

Your resume will be reviewed by our Talent Selection Team. If your background matches any of our current openings, we will be in contact with you within the next two weeks. Otherwise, we will keep your resume in our active file for future consideration. 

We wish you success in your career endeavors.


Thank you, 
The Human Resources Team
Katara Hospitality";

                if( is_arabic() )
                {
                    $contact_message = "نود أن نشكركم على مراسلتكم كتارا للضيافة.

ستتم مراجعة طلبكم من قبل فريق الموارد البشرية. إذا كانت خبرتك وخلفيتك العملية تطابق أي من الوظائف المتاحة حالياً، سوف نكون على التواصل معكم في غضون الأسبوعين المقبلين. وفي حال عدم التواصل بكم فهذا يعني أن بياناتكم سوف يتم الاحتفاظ بها في ملف خاص للنظر فيه مستقبلاً.

شكراً لكم
إدارة الموارد البشرية
كتارا للضيافة";
}
                }
                else if ($contact->contact_department == 'Tenders' )
                {
                    $to = "tenders@katarahospitality.com";
                    $contact_message = "We would like to thank you for contacting Katara Hospitality.

Your enquiry / proposal will be carefully reviewed.

Active tender enquiries will be addressed within two working days.

For proposals, we will contact you directly should they match our requirements. If you are not contacted, please know that we will keep your data in file to be considered for future opportunities.

Thank you, 
The Procurement Team
Katara Hospitality";

                if( is_arabic() )
                {
                    $contact_message = "نود أن نشكركم على مراسلتكم كتارا للضيافة.

سوف يتم مراجعة طلبكم/عرضكم بعناية. 

طلبات المناقصة سوف تتم مراجعتها في خلال يومين من أيام العمل.

بالنسبة لمقترحاتكم، سوف يتم الإتصال معكم مباشرة في حالة تطابقها مع متطلبات الشركة لدينا. وفي حالة عدم التواصل بكم فهذا يعني أن بياناتكم سوف يتم الاحتفاظ بها في ملف خاص للنظر فيه مستقبلا. 


شكراً لكم
إدارة المشتريات 
كتارا للضيافة";
}
                }


                $contact_name = $contact->contact_first_name.' '.$contact->contact_last_name;
                $from = get_bloginfo('name').' <'.NO_REPLY.'>';
                $subject = $contact_name.__( ' has contacted you.', "Katara" );

                $updated = TRUE;

                $contact->contact_datetime = date( 'Y-m-d H:i:s');
                $contact->contact_status = 0;

                $contact_arr = (array) $contact;

                global $wpdb;
                $wpdb->insert( 'kat_contact', $contact_arr );
                email_contact($contact->contact_department, $contact_name, $from, 'Katara Contact Form'.' <'.$to.'>');

                // Send reply to user
            
                form_mail_to( 'Katara Hospitality <no-reply@katarahospitality.com>', $contact->contact_email, $contact_subject, $contact_message );

                // RESET VALUES

                $contact = new stdClass;
                $contact->contact_first_name = FALSE;
                $contact->contact_last_name = FALSE;
                $contact->contact_company = FALSE;
                $contact->contact_email = FALSE;
                $contact->contact_department = FALSE;
                $contact->contact_subject = FALSE;
                $contact->contact_message = FALSE;
            }
        }
    }

    $page_sub_title = get_post_meta( $post->ID, 'page_sub_title', TRUE );
?>

    <?php
        $area = "general";
        if( isset( $_GET['c'] ))
        {
             $area = $_GET['c'];
        }

        $area_str = ucwords( str_replace('-', ' ', $area) );
    ?>
    <div class="grid_9 full content contact-page">
        <header class="gen-content-header">
            <h1 class="ttl-36"><?php _e( 'Contact Us', "Katara" ); ?></h1>
            <p class="tag-line-16"><?php echo $page_sub_title; ?></p>
        </header>

        <form action="?c=<?php echo $area; ?>#contact" class="contact-form grad-bg" method="post" id="contact">
            <h2 class="ttl-23 fade-line"><?php _e( 'Contact us', 'Katara' ); ?></h2>
            <?php if ( $updated ) : ?>
                <div class="full-block">
                    <label><?php _e( 'Thank You', 'Katara' ); ?>, <?php _e( 'Your request has been sent.', 'Katara' ); ?> <?php _e( 'A member of our team will be in touch shortly.', 'Katara' ); ?></label>
                </div>
            <?php endif; ?>
            <div class="half-block">
                <label><?php _e( 'First name', "Katara" ); ?>:</label><input type="text" class="required" name="contact_first_name" value="<?php if ( $contact->contact_first_name ) echo $contact->contact_first_name; ?>">
                <span class="error"></span>
            </div>
            <div class="half-block omega">
                <label><?php _e( 'Last name', "Katara" ); ?>:</label><input type="text" class="required" name="contact_last_name" value="<?php if ( $contact->contact_last_name ) echo $contact->contact_last_name; ?>">
                <span class="error"></span>
            </div>
            <div class="half-block">
                <label><?php _e( 'Company', "Katara" ); ?>:</label><input type="text" class="required" name="contact_company" value="<?php if ( $contact->contact_company ) echo $contact->contact_company; ?>">
                <span class="error"></span>
            </div>
            <div class="half-block omega">
                <label><?php _e( 'Email', "Katara" ); ?>:</label><input type="email" class="required" name="contact_email" value="<?php if ( $contact->contact_email ) echo $contact->contact_email; ?>">
                <span class="error"></span>
            </div>
            <div class="half-block">
                <label><?php _e( 'Department', "Katara" ); ?>:</label>
                <p class="dummy-select required">
                    <span><?php _e( $area_str, "Katara" ); ?></span>
                    
                    <select name="contact_department">
                        <option value="General" <?php if($area=='general') { echo 'selected="selected"'; } ?>><?php _e( 'General', "Katara" ); ?></option>
                        <option value="Careers" <?php if($area=='careers') { echo 'selected="selected"'; } ?>><?php _e( 'Careers', "Katara" ); ?></option>
                        <option value="Media" <?php if($area=='media') { echo 'selected="selected"'; } ?>><?php _e( 'Media', "Katara" ); ?></option>
                        <option value="Investment" <?php if($area=='investment') { echo 'selected="selected"'; } ?>><?php _e( 'Investment', "Katara" ); ?></option>
                        <option value="Tenders" <?php if($area=='tenders') { echo 'selected="selected"'; } ?>><?php _e( 'Tenders', "Katara" ); ?></option>
                    </select>
                </p>    
                <span class="error"></span>
            </div>
            <div class="half-block omega">
                <label><?php _e( 'Message subject', "Katara" ); ?>:</label><input class="required" type="text" name="contact_subject" value="<?php if ( $contact->contact_subject ) echo $contact->contact_subject; ?>">
                <span class="error"></span>
            </div>
            <div class="full-block">
                <label><?php _e( 'Enter your message', "Katara" ); ?>:</label>
                <textarea name="contact_message" class="required" cols="7" rows="5"><?php if ( $contact->contact_message ) echo $contact->contact_message; ?></textarea>
                <span class="error"></span>
            </div>
            <div class="right-block">
                <span class="error"><?php if ( $error ) echo $error; ?></span>
                <input type="submit" class="submit-btn validate" name="submit" value="<?php _e( 'Submit', "Katara" ); ?>">
            </div>
            <?php wp_nonce_field('contact_field_form','contact_field_form'); ?>
        </form>
        <?php
            $contact_address = get_option('contact_address');
            $contact_tel = get_option('contact_tel');
            $contact_fax = get_option('contact_fax');
            $contact_email = get_option('contact_email');
            $contact_press = get_option('contact_press');
        ?>
        <div class="contact-page contact-map">
            <h2 class="ttl-23 fade-line"><?php _e( 'Our Location', 'Katara' ); ?></h2>
            <script>
                var contentString = '<h1 style="font-weight:700;padding-top:20px;margin-bottom:5px;"><?php _e( "Katara Hospitality", "Katara" ); ?></h1>'+
                  '<p><?php echo preg_replace('/^\s+|\n|\r|\s+$/m', '',nl2br($contact_address)); ?></p>' +
                  '<p><?php _e( 'Telephone', "Katara" ); ?>: <?php echo $contact_tel; ?><br/><?php _e( 'Fax', "Katara" ); ?>: <?php echo $contact_fax; ?></p>';
            </script>
            <!-- <iframe width="593" height="400" style="border:1px solid #e0dac1;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.uk/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Qatar+National+Hotels,+Doha,+Ad+Dawhah,+Qatar&amp;aq=0&amp;oq=Qatar+national+hot&amp;sll=25.280247,51.522446&amp;sspn=0.004535,0.005879&amp;ie=UTF8&amp;hq=Qatar+National+Hotels,&amp;hnear=Doha,+Qatar&amp;t=m&amp;cid=3203147267642612306&amp;ll=25.271399,51.536093&amp;spn=0.031047,0.061712&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>-->
            <p><?php echo __( 'Katara Hospitality head office has moved to Lusail City', "Katara" ); ?>. <a target="_blank" href="<?php bloginfo('url'); ?>/wp-content/uploads/2015/12/KH-Lusail-City_location-map-071215.pdf"><?php _e( 'Download directions as a PDF', "Katara" ); ?></a></p>
            <div id="map"></div>
        </div>
    </div>    

    <!-- SIDEBAR //-->
    
    <aside class="grid_3 aside-right" role="complementary">
        <h3 class="ttl-19 fade-line aside-ttl"><?php _e( 'Address', "Katara" ); ?></h3>
        <ul class="aside-r-list">
            <li>
                <p><?php echo nl2br($contact_address); ?></p>
            </li>
        </ul>
        <h3 class="ttl-19 fade-line aside-ttl"><?php _e( 'Directions', "Katara" ); ?></h3>
        <ul class="aside-r-list">
            <li>
                <p><a target="_blank" href="<?php bloginfo('url'); ?>/wp-content/uploads/2013/09/Katara-Hospitality-Building-Lusail-City.pdf"><?php _e( 'Download directions as a PDF', "Katara" ); ?></a></p>
            </li>
        </ul>
    
        <h3 class="ttl-19 fade-line aside-ttl"><?php _e( 'Telephone', "Katara" ); ?></h3>
        <ul class="aside-r-list">
            <li>
                <p><?php _e( 'Telephone', "Katara" ); ?>: <?php echo $contact_tel; ?><br/>
                <?php _e( 'Fax', "Katara" ); ?>: <?php echo $contact_fax; ?></p>
            </li>
        </ul>

    </aside>
    <!-- END : SIDEBAR //-->

<?php get_footer(); ?>