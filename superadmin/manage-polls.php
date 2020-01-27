<?php
$rtitle = 'Manage Polls | Dashboard'; //  set page title
$rtype = 'superadmin';
include '../r.header.php';

if( RTYPE != 'superadmin' ){ $rsg->admin_login_redirect(); }

if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != '')) { header ("Location: index.php"); }

echo '<section id="container" >';
    include 'temps/r.head_nav.php'; 
    include 'temps/r.side_nav.php';
    include 'temps/r.manage_polls.php';
echo '</section>';

include '../r.footer.php';