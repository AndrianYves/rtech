<?php

$rtitle = 'Manage Users | Dashboard'; //  set page title
$rtype = 'admin';

include '../r.header.php';
if( RTYPE != 'admin' ){ $rsg->admin_login_redirect(); }

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
    include '../superadmin/temps/r.head_nav.php'; 
    include '../superadmin/temps/r.side_nav.php';
    include '../superadmin/temps/r.manage_users.php';
echo '</section>';

include '../r.footer.php';