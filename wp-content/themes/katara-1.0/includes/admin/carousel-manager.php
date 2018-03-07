<?php
    if ( $_GET['page'] == 'carousel-add' )
    {
        include( TEMPLATEPATH."/includes/admin/carousel-manager/carousel-manager-add.php" );
    }
    elseif ( isset( $_GET['edit_id'] ) && $_GET['edit_id'] != '' )
    {
        include( TEMPLATEPATH."/includes/admin/carousel-manager/carousel-manager-edit.php" );
    }
    elseif ( isset( $_GET['delete_id'] ) && $_GET['delete_id'] != '' )
    {
        global $wpdb;

        $delete_id = $_GET['delete_id'];

        $sql = "DELETE FROM kat_carousel WHERE caro_id = '$delete_id'";
        $wpdb->query( $sql );

        $url = admin_url( "admin.php?page=carousels" );
        redirect($url);
        exit;
    }
    else
    {
        include( TEMPLATEPATH."/includes/admin/carousel-manager/carousel-manager-list.php" );
    }
?>