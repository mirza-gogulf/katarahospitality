<?php
    if ( isset( $_GET['delete_id'] ) && $_GET['delete_id'] != '' )
    {
        global $wpdb;

        $delete_id = $_GET['delete_id'];

        $sql = "DELETE FROM kat_access WHERE access_id = '$delete_id'";
        $wpdb->query( $sql );

        $url = admin_url( "admin.php?page=request-access" );
        redirect($url);
        exit;
    }
    elseif ( isset( $_GET['view_id'] ) && $_GET['view_id'] != '' )
    {
        include( TEMPLATEPATH."/includes/admin/request-access/request-access-view.php" );
    }
    elseif ( isset( $_GET['email'] ) && isset( $_GET['add_access'] ) && isset( $_GET['user_id'] ) && isset( $_GET['acc_id'] ) )
    {
        include( TEMPLATEPATH."/includes/admin/request-access/request-access-add.php" );
    }
    else
    {
        if ( isset( $_GET['email'] ) && isset( $_GET['add_access'] ) && isset( $_GET['user_id'] ) && isset( $_GET['acc_id'] ) )
        {   
            global $wpdb;
            
            $user_email = $_GET['email'];
            $access_key = $_GET['add_access'];
            $access_id = $_GET['acc_id'];
            
            $sql = "SELECT user.*, usermeta.meta_value as access_$access_key
                FROM $wpdb->users AS user
                LEFT JOIN $wpdb->usermeta AS usermeta ON ( user.ID = usermeta.user_id AND usermeta.meta_key = 'access_$access_key' )
                WHERE 1=1
                AND user.user_email = '$user_email'
                LIMIT 1";
            $user = $wpdb->get_row( $sql );

            if ( $user == NULL )
            {
                $access_row = get_access_row( $access_id );
                
                $userdata = array(
                    'user_pass' => $access_row->access_email,
                    'user_login' => trim( strtolower( $access_row->access_firstname.'-'.$access_id ) ),
                    'user_nicename' => trim( $access_row->access_firstname.' '.$access_row->access_lastname ),
                    'user_email' => $access_row->access_email,
                    'display_name' => trim( $access_row->access_firstname.' '.$access_row->access_lastname ),
                    'first_name' => $access_row->access_firstname,
                    'last_name' => $access_row->access_lastname
                );
                
                $user_id = wp_insert_user( $userdata );
                
                if ( ! isset($user_id['errors']) )
                {
                    add_user_meta( $user_id, 'access_'.$access_key, TRUE, TRUE );
                    $wpdb->update( 'kat_access', $data = array( 'access_user_id' => $user_id ), array( 'access_email' => $user_email ) );
                }
            }
            elseif ( isset( $user->ID ) )
            {
                $user_id = $user->ID;
                add_user_meta( $user_id, 'access_'.$access_key, TRUE, TRUE );
            }
            
            redirect( admin_url().'admin.php?page=request-access' );
        }

        include( TEMPLATEPATH."/includes/admin/request-access/request-access-list.php" );
    }
?>