<?php
    if ( isset( $_GET['view_id'] ) && $_GET['view_id'] != '' )
    {
        include(TEMPLATEPATH."/includes/admin/job-applications/job-application-view.php");
    }
    else
    {
        include(TEMPLATEPATH."/includes/admin/job-applications/job-applications-list.php");
    }
?>