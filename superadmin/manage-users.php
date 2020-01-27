<?php

$rtitle = 'Manage Users | Dashboard'; //  set page title
$rtype = 'superadmin';
include '../r.header.php';
if( RTYPE != 'superadmin' ){ $rsg->admin_login_redirect(); }

$pa = 'Manage Users';
if( isset($_GET['manage']) ){
	if( $_GET['manage']=='admins' ){
		$pa = 'Manage Administrators';
	}elseif($_GET['manage']=='students' ){
		$pa = 'Manage Students';
	}elseif($_GET['manage']=='requests' ){
		$pa = 'Manage Requests';
	}else{
		$pa = 'Manage Users';
	}
}else{
	header("Location: ".RSITE.RTYPE.'/manage-users.php?manage=all');
	exit;
}





if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != '')) { header ("Location: index.php"); }

echo '<section id="container" >';
    include 'temps/r.head_nav.php'; 
    include 'temps/r.side_nav.php';
    include 'temps/r.manage_users.php';
echo '</section>';

include '../r.footer.php';