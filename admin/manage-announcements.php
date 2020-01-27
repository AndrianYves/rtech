<?php
$rtitle = 'Manage Announcements | Dashboard'; //  set page title
$rtype = 'admin';
include '../r.header.php';

if( RTYPE != 'admin' ){ $rsg->admin_login_redirect(); }

if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != '')) { header ("Location: index.php"); }

echo '<section id="container" >';
    include '../superadmin/temps/r.head_nav.php'; 
    include '../superadmin/temps/r.side_nav.php';
    include '../superadmin/temps/r.manage_announcements.php';
echo '</section>';

include '../r.footer.php';