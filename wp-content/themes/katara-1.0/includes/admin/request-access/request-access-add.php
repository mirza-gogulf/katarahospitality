<?php
    global $wpdb, $ln_site_details;
    
    $user_email = trim($_GET['email']);        
    $user_email = str_replace( ' ', '+', $user_email);
    $access_key = $_GET['add_access'];
    $access_id = $_GET['acc_id'];
    $access_type_arr = get_access_type( $access_key );

    if ( isset( $_POST['action'] ) && $_POST['action'] == 'send' && isset( $_POST['message'] ) && isset( $_POST['send_to'] ) )
    {
        $contact_from = get_bloginfo('name').' <'.NO_REPLY.'>';
        $contact_to = $_POST['send_to'];
        $contact_message = $_POST['message'];
        $contact_subject = __( 'Request access' ).' - '.__( $access_type_arr->title );
        form_mail_to( $contact_from, $contact_to, $contact_subject, $contact_message );

        redirect( admin_url( 'admin.php?page=request-access' ) );
        exit;
    }
    
    $sql = "SELECT user.*, usermeta.meta_value as access_$access_key
        FROM $wpdb->users AS user
        LEFT JOIN $wpdb->usermeta AS usermeta ON ( user.ID = usermeta.user_id AND usermeta.meta_key = 'access_$access_key' )
        WHERE 1=1
        AND user.user_email = '$user_email'
        LIMIT 1";

    $user = $wpdb->get_row( $sql );

    $new_user = ( $user == NULL ) ? TRUE : FALSE;
    
    if ( $user == NULL )
    {
        $password = wp_generate_password( 12, FALSE, FALSE );

        $access_row = get_access_row( $access_id );

        $pre_login = "{$access_row->access_firstname}-{$access_row->access_lastname}-{$access_id}";

        if ( ! preg_match( '/^[a-z0-9]+/iD', $pre_login ) )
        {
            $user_login = trim( strtolower( "Katara-{$access_id}" ) );
        }
        else
        {
            $user_login = trim( strtolower( $pre_login ) );
        }

        $userdata = array(
            'user_pass' => $password,
            'user_login' => $user_login ,
            'user_nicename' => trim( $access_row->access_firstname.' '.$access_row->access_lastname ),
            'user_email' => $access_row->access_email,
            'display_name' => trim( $access_row->access_firstname.' '.$access_row->access_lastname ),
            'first_name' => $access_row->access_firstname,
            'last_name' => $access_row->access_lastname
        );
        
        $user_id = wp_insert_user( $userdata );

        if ( ! isset($user_id->errors) )
        {
            add_user_meta( $user_id, 'access_'.$access_key, TRUE, TRUE );
            $wpdb->update( 'kat_access', $data = array( 'access_user_id' => $user_id ), array( 'access_email' => $user_email ) );
        }

        $user = get_userdata( $user_id );
    }
    elseif ( isset( $user->ID ) )
    {
        $user_id = $user->ID;
        add_user_meta( $user_id, 'access_'.$access_key, TRUE, TRUE );
    }

    $access_url = home_url( "/".$access_type_arr->slug."/" );

    $message = "";

    if ( $access_key == 1 )
    {
        if ( is_arabic() )
        {
            $message .= 'لقد تم قبول طلبك للوصول إلى منطقة الصحافة لكتارا للضيافة،سوف تجد تفاصيل تسجيل الدخول الخاصة بك أدناه./'.":\n\n";
            $message .= $ln_site_details[AR_SITE_ID]->siteurl .'/press-office/'. "\n";
        }
        else
        {
            $message .= __('Your request to access the Katara Press Area has been accepted please find your log in details below', 'Katara').":\n\n";
            $message .= $ln_site_details[EN_SITE_ID]->siteurl .'/press-office/'. "\n";
        }
    }
    elseif ( $access_key == 2 )
    {
        if ( is_arabic() )
        {
            $message .= 'لقد تم قبول طلبك للوصول إلى منطقة المناقصات لكتارا للضيافة، سوف تجد تفاصيل تسجيل الدخول الخاصة بك أدناه'.":\n\n";
            $message .= $ln_site_details[AR_SITE_ID]->siteurl .'/careers/'. "\n";
        }
        else
        {
            $message .= __('Your request to access the Katara Careers Area has been accepted please find your login details below', 'Katara').":\n\n";
            $message .= $ln_site_details[EN_SITE_ID]->siteurl .'/careers/'. "\n";
        }
    }
    elseif ( $access_key == 3 )
    {
        if ( is_arabic() )
        {
            $message .= 'لقد تم قبول طلبك للوصول إلى منطقة الوظائف كتارا للضيافة، سوف تجد تفاصيل تسجيل الدخول الخاصة بك أدناه.'.":\n\n";
            $message .= $ln_site_details[AR_SITE_ID]->siteurl .'/tenders/'. "\n";
        }
        else
        {
            $message .= __('Your request to access the Katara Tenders Area has been accepted please find your log in details below', 'Katara').":\n\n";
            $message .= $ln_site_details[EN_SITE_ID]->siteurl .'/tenders/'. "\n";
        }

    }

    $message .= ( (is_arabic()) ? 'اسم المستخدم': __( 'Username', 'Katara' ) ).": ".$user->user_login."\n";



    if ( $new_user )
    {
        if ( is_arabic() )
        {
            $message .= "الكلمة السرية : ".$password;
        }
        else
        {
            $message .= __("Password"). ": ".$password;
        }
    }
?>
<div class="wrap" id="ad-manager">
    <div class="icon32" id="icon-users"><br/></div>
    <h2>Request Access</h2>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><strong>Username</strong></th>
                    <td scope="row"><?php echo $user->user_login; ?></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><strong>User email</strong></th>
                    <td scope="row"><?php echo $user->user_email; ?></td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="message"><strong>Email</strong></label>
                    </th>
                    <td>
                        <textarea class="large-text" cols="45" rows="5" id="message" name="message"><?php echo $message; ?></textarea>
                    </td>
                </tr>
            </tbody>
        </table>

        <input type="hidden" name="action" value="send" />
        <input type="hidden" name="send_to" value="<?php echo $user->user_email; ?>" />

        <p class="submit">
            <input type="submit" class="button-primary" value="Send Email" />
        </p>
    </form>
</div>
