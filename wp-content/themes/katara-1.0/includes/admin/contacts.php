<?php
    if ( isset( $_GET['view_id'] ) && $_GET['view_id'] != '' )
    {
        include(TEMPLATEPATH."/includes/admin/contacts/contact-view.php");
    }
    else
    {
        include(TEMPLATEPATH."/includes/admin/contacts/contacts-list.php");
    }
?>