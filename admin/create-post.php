<?php
error_reporting(0);

$rtitle = 'Create Post | Admin Dashboard'; //  set page title
$rtype = 'admin';
include '../r.header.php';

if( RTYPE != 'admin' ){ $rsg->admin_login_redirect(); }

echo '<section id="container" >';
    include '../superadmin/temps/r.head_nav.php'; 
    include '../superadmin/temps/r.side_nav.php';
    include '../superadmin/temps/r.create-post.php';
echo '</section>';

include '../r.footer.php';
