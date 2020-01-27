<?php

$rtitle = 'Registration Schedules | Admin Dashboard'; //  set page title
$rtype = 'admin';
include '../r.header.php';
if( RTYPE != 'admin' ){ $rsg->admin_login_redirect(); }
if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != '')) { header ("Location: index.php"); }

echo '<section id="container" >';
    include '../superadmin/temps/r.head_nav.php'; 
    include '../superadmin/temps/r.side_nav.php';
    include '../superadmin/temps/r.registration_schedule.php';
echo '</section>';

include '../r.footer.php';