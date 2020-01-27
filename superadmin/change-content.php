<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$rtitle = 'Change Password | Superadmin Dashboard'; //  set page title
$rtype = 'superadmin';
include '../r.header.php';

if( RTYPE != 'superadmin' ){ $rsg->admin_login_redirect(); }

?>
    
<?php 
echo '<section id="container" >';
    include 'temps/r.head_nav.php'; 
    include 'temps/r.side_nav.php';
    include 'temps/r.change_content.php';
echo '</section>';

include '../r.footer.php';
