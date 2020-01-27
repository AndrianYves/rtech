<?php
session_start();
include_once 'r.posts.php';

// checking session is valid for not 
if( isset($_SESSION['id']) === false ){	
	if( strpos($uri,'login') ){
		
	}elseif( strpos($uri,'admin') ){
		header('location:logout.php');
	}
}else{
	// for deleting user
	if( $rtype == 'superadmin' || $rtype == 'admin' ){
		if(isset($_GET['id'])) {
			$adminid=$_GET['id'];
			$msg=mysqli_query($con,"delete from users where id='$adminid'");
            if($msg){
                $retArr['msg'] = $rsg->HTML_1('Success','Deleted!','');
            }else{
                $retArr['msg'] = $rsg->HTML_1('Error','Error updating record. Please try again later or contact your administrator.','');
            }
		}
	}
}

$rtitle = ( isset($rtitle) ) ? $rtitle : 'Techno';
$rtitle = ( $rtitle == '') ? 'Techno' : $rtitle;

?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Technohouse">
        <meta name="author" content="TTGrp">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <link href = "postadmin/css/styles.css" rel = "stylesheet" type = "text/css">

        <title><?=$rtitle;?></title>

        <link rel = "stylesheet" type = "text/css" href = "https://fonts.googleapis.com/css?family=Raleway">
        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="<?=RSITE;?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?=RSITE;?>css/fontawesome_font.min.css" rel="stylesheet" />
        <link href="<?=RSITE;?>superadmin/assets/css/style.css" rel="stylesheet">
        <link href="<?=RSITE;?>css/style-responsive.css" rel="stylesheet">
        <link href="<?=RSITE;?>css/tblsorter.theme.default.css" rel='stylesheet' type='text/css' />
        <link href="<?=RSITE;?>css/fontawesome_font.min.css" rel='stylesheet' type='text/css' />
        <link href="<?=RSITE;?>css/r.css" rel='stylesheet' type='text/css' />
    </head>
    <body>
            
        <div class="rsg-preloader">
            <div class="rsg-loadingMsg"> Please wait... </div>
            <div class="rsg-loading"><div class="rsg-loading-in"></div></div>
        </div>