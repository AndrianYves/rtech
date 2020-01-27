<?php
error_reporting(0);

$rtitle = 'Create Poll | Superadmin Dashboard'; //  set page title
$rtype = 'superadmin';
include '../r.header.php';

if( RTYPE != 'superadmin' ){ $rsg->admin_login_redirect(); }

echo '<section id="container" >';
    include 'temps/r.head_nav.php'; 
    include 'temps/r.side_nav.php';
    include 'temps/r.create-poll.php';
echo '</section>';

include '../r.footer.php';
