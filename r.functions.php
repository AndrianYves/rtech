<?php

define ('RSITEFOLDER',"/r.technohouse/");
$host = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

if(RSITEFOLDER==''){
	define('RSITE',$host.'/');
}else{
	define('RSITE',$host.RSITEFOLDER);
}
$_rq = $_POST; $_fl = $_FILES; $retArr = array( 'msg' => '', 'rq' => $_rq, 'fl' => $_fl, ); $rsg = new technoClass();
include 'conn/dbconnection.php';

if( isset($_SESSION['id']) ){
	$sesID = $_SESSION['id'];
	if( $_SESSION['userType']=='admin' || $_SESSION['userType']=='superadmin' ){
		$r = mysqli_query( $con,"SELECT * FROM admin WHERE id='$sesID'");
	}else{
		$r = mysqli_query( $con,"SELECT * FROM users WHERE id='$sesID'");
	}
	$n = mysqli_fetch_array($r);
	$_SESSION['loggedin'] 	= true;
	$_SESSION['id'] 		= $n['id'];
	if( $_SESSION['userType']=='admin' || $_SESSION['userType']=='superadmin' ){
		$_SESSION['login'] 		= $n['username'];
		$_SESSION['name'] 		= $n['username'];
		$_SESSION['userType'] 	= $n['type'];
		$_SESSION['status'] 	= $n['stat'];
		define('RTYPE', $n['type']);
	}else{
		$_SESSION['login'] 	= $n['email'];
		$_SESSION['name'] 	= $n['fname'];
		$_SESSION['status'] = $n['status'];
		define('RTYPE', 'stud');
	}
}else{ define('RTYPE', 'unset'); }

if( isset( $_rq['rsg_action'] ) ){

	// Change status of admin
	if( $_rq['rsg_action'] == 'changeAdminStat' ){
		$i = $_rq['i'];
		$t = $_rq['t'];
		if( $t == 'deac' ){
			$s = 'UPDATE admin set stat = "inactive" WHERE id = '.$i;
		}else{
			$s = 'UPDATE admin set stat = "active" WHERE id = '.$i;
		}
		if (mysqli_query($con, $s)) {
			$retArr['msg'] = $rsg->HTML_1('Success','Administrator status has been updated.','');
		}else{
			$retArr['msg'] = $rsg->HTML_1('Error','Error updating record. Please try again later or contact your administrator.','');
		}
	}

	// Change status of students
	elseif( $_rq['rsg_action'] == 'changeStudentStat' ){
		$i = $_rq['i'];
		$t = $_rq['t'];
		if( $t == 'deac' ){
			$s = 'UPDATE users set status = "inactive" WHERE id = '.$i;
		}else{
			$s = 'UPDATE users set status = "active" WHERE id = '.$i;
		}
		if (mysqli_query($con, $s)) {
			$retArr['msg'] = $rsg->HTML_1('Success','Student status has been updated.','');
		}else{
			$retArr['msg'] = $rsg->HTML_1('Error','Error updating record. Please try again later or contact your administrator.','');
		}
	}

	// Change status of all
	elseif( $_rq['rsg_action'] == 'changeAllStats' ){
		$g = $_rq['g'];
		$t = $_rq['t'];
		$y = $_rq['ar'];
		if( $t == 'deac_all' ){

			if( $g=='stud' ){
				$s = 'UPDATE users set status = "inactive" WHERE status="active"';
			}elseif($g=='admi'){
				$s = 'UPDATE admin set stat = "inactive" WHERE type = "admin"';
			}else{
				$s = 'UPDATE users set status = "inactive" WHERE status="active"';
				if ( mysqli_query($con, $s) ) {
					$note = 'success_stud_';
				}else{
					$note = 'error_stud_';
				}

				$s = 'UPDATE admin set stat = "inactive" WHERE type = "admin" AND stat="active"';
				if ( mysqli_query($con, $s) ) {
					$note .= 'success_admin';
				}else{
					$note .= 'error_admin';
				}
				$s = 'all';
			}
		}else{
			if( $g=='stud' ){
				$s = 'UPDATE users set status = "active" WHERE status="inactive"';
			}elseif($g=='admi'){
				$s = 'UPDATE admin set stat = "active" WHERE type = "admin" AND stat="inactive"';
			}elseif($g=='pending'){
				$s = 'UPDATE users set status = "active" WHERE status="pending"';
			}else{

				$s = 'UPDATE users set status = "active" WHERE status="inactive"';
				if ( mysqli_query($con, $s) ) {
					$note = 'success_stud_';
				}else{
					$note = 'error_stud_';
				}

				$s = 'UPDATE admin set stat = "active" WHERE type = "admin" AND stat="inactive"';
				if ( mysqli_query($con, $s) ) {
					$note .= 'success_admin';
				}else{
					$note .= 'error_admin';
				}
				$s = 'all';
			}
		}
		if( $s == 'all'){
			if (strpos($note, 'error') !== false) {
				$retArr['msg'] = $rsg->HTML_1('Error!','Error updating some records. Please try again later or contact your administrator.'. $note,'');
			}else{
				$retArr['msg'] = $rsg->HTML_1('Done!','All status has been updated.','');
			}
		}else{
			if( $y =='none' ){
				if ( mysqli_query($con, $s) ) {
					$retArr['msg'] = $rsg->HTML_1('Success!','Status has been updated.','');
				}else{
					$retArr['msg'] = $rsg->HTML_1('Error','Error updating record. Please try again later or contact your administrator.','');
				}
			}else{
				$errors = 0;
				foreach( $y as $v ){
					$b = (int)$v;
					if($g=='admi' && $t == 'acti_all'){
						$s = 'UPDATE admin set stat = "active" WHERE stat="inactive" AND id = '.$b;
					}elseif($g=='admi' && $t == 'deac_all'){
						$s = 'UPDATE admin set stat = "inactive" WHERE id = '.$b;
					}elseif($g=='stud' && $t == 'acti_all'){
						$s = 'UPDATE users set status = "active" WHERE status="inactive" AND id = '.$b;
					}elseif($g=='stud' && $t == 'deac_all'){
						$s = 'UPDATE users set status = "inactive" WHERE status="active" AND id = '.$b;
					}elseif($g=='pending' && $t == 'acti_all'){
						$s = 'UPDATE users set status = "active" WHERE status="pending" AND id = '.$b;
					}

					if ( mysqli_query($con, $s) ) {
					}else { $errors++; }
				}
				if( $errors>0 ){
					$retArr['msg'] = $rsg->HTML_1('Error','Error updating record. Please try again later or contact your administrator.','');
				}else{
					$retArr['msg'] = $rsg->HTML_1('Success!','Status has been updated.','');
				}
			}
		}
		
	}

	// Archive / Delete / Hide / Show post/announcement
	elseif( $_rq['rsg_action'] == 'announcementActions' ){
		$i = $_rq['i'];
		$t = $_rq['t'];
		$y = $_rq['ar'];

		if( $y =='none' ){
			if( $t == 'hid' ){
				$s = 'UPDATE announcements set status = "inactive" WHERE id = '.$i;
			}elseif($t=='del'){
				$s = 'UPDATE announcements set status = "archived" WHERE id = '.$i;
			}elseif($t=='sho'){
				$s = 'UPDATE announcements set status = "active" WHERE id = '.$i;
			}elseif($t=='delAll'){
				$s = 'UPDATE announcements set status = "archived"';
			}elseif($t=='hideAll'){
				$s = 'UPDATE announcements set status = "inactive"';
			}elseif($t=='showAll'){
				$s = 'UPDATE announcements set status = "active"';
			}elseif($t=='delAllArchived'){
				$s = 'DELETE FROM announcements WhERE status = "archived"';
			}elseif($t=='delArchived'){
				$s = 'DELETE FROM announcements WhERE status = "archived" AND id = '.$i;
			}
			if (mysqli_query($con, $s)) {
				$retArr['msg'] = $rsg->HTML_1('Success','Announcement/Post has been updated.','');
			}else{
				$retArr['msg'] = $rsg->HTML_1('Error','Error updating record. Please try again later or contact your administrator.','');
			}
		}else{
			$errors = 0;
			foreach( $y as $v ){
				$b = (int)$v;
				if($t == 'delAll'){
					$s = 'UPDATE announcements set status = "archived" WHERE id = '.$b;
				}elseif( $t == 'showAll'){
					$s = 'UPDATE announcements set status = "active" WHERE id = '.$b;
				}elseif($t == 'delAllArchived'){
					$s = 'DELETE FROM announcements WHERE status = "archived" AND id = '.$b;
				}elseif($t == 'hideAll'){
					$s = 'UPDATE announcements set status = "inactive" WHERE id = '.$b;
				}elseif($t == 'pollsArchive'){
					$s = 'UPDATE polls set status = "archived" WHERE id = '.$b;
				}

				if ( mysqli_query($con, $s) ) {
				}else { $errors++; }
			}
			if( $errors>0 ){
				$retArr['msg'] = $rsg->HTML_1('Error','Error updating record. Please try again later or contact your administrator.','');
			}else{
				$retArr['msg'] = $rsg->HTML_1('Success!','Status has been updated.','');
			}
		}
	}

	// Archive / Delete Polls
	elseif( $_rq['rsg_action'] == 'pollsActions' ){
		$i = $_rq['i'];
		$t = $_rq['t'];
		$y = $_rq['ar'];

		if( $y =='none' ){
			if( $t == 'arch' ){
				$s = 'UPDATE polls set status = "archived" WHERE id = '.$i;
			}elseif($t=='del'){
				$s = 'UPDATE polls set status = "archived" WHERE id = '.$i;
			}elseif($t=='sho'){
				$s = 'UPDATE polls set status = "active" WHERE id = '.$i;
			}elseif($t=='delAll'){
				$s = 'UPDATE polls set status = "archived"';
			}elseif($t=='hideAll'){
				$s = 'UPDATE polls set status = "inactive"';
			}elseif($t=='showAll'){
				$s = 'UPDATE polls set status = "active"';
			}elseif($t=='delAllArchived'){
				$s = 'DELETE FROM polls WhERE status = "archived"';
			}elseif($t=='delArchived'){
				$s = 'DELETE FROM polls WhERE status = "archived" AND id = '.$i;
			}

			if (mysqli_query($con, $s)) {
				$retArr['msg'] = $rsg->HTML_1('Success','Poll has been updated.','');
			}else{
				$retArr['msg'] = $rsg->HTML_1('Error','Error updating record. Please try again later or contact your administrator.','');
			}
		}else{
			$errors = 0;
			foreach( $y as $v ){
				$b = (int)$v;
				if($t == 'delAllArchived'){
					$s = 'DELETE FROM polls WhERE status = "archived" AND id = '.$b;
				}elseif( $t == 'delArchived'){
					$s = 'DELETE FROM polls WhERE status = "archived" AND id = '.$i;
				}

				if ( mysqli_query($con, $s) ) {
				}else { $errors++; }
			}
			if( $errors>0 ){
				$retArr['msg'] = $rsg->HTML_1('Error','Error updating record. Please try again later or contact your administrator.','');
			}else{
				$retArr['msg'] = $rsg->HTML_1('Success!','Status has been updated.','');
			}
		}
	}

	// Change Password
	elseif( $_rq['rsg_action'] == 'changeAllStatsss' ){
		
	}

	// Hard Reload Page
	elseif( $_rq['rsg_action'] == 'hardReloadPage' ){
		$rsg->pageReloadPostRemove();
	}

	$rsg->ret($retArr);

}

class technoClass{
    
    function HTML_1($title,$content,$class){
        return '<div class="rsg_popup '.$class.' active">
                    <div class="rsg_BlackBG5"></div>
                    <div class="customContainer rsgPopupContainer">
                        <div class="col- col-100 flex-wrap">
                            <h1><b>'.$title.'</b></h1>
                        </div>
                        <div class="rsgBlock">
                            <label> '.$content.' </label>
                        </div>
                        <div class="rsgBlock">
                            <hr>
                            <button class="rsgBtn dark-blue rsg_closePopup" type="button"> Close </button>
                        </div>
                    </div>
                </div> ';
	}	

	function HTML_2($title,$content,$class){
        return '<div class="rsg_popup '.$class.' active">
                    <div class="rsg_BlackBG5" onclick="closemodalreload()"></div>
                    <div class="customContainer rsgPopupContainer">
                        <div class="col- col-100 flex-wrap">
                            <h1><b>'.$title.'</b></h1>
                        </div>
                        <div class="rsgBlock">
                            <label> '.$content.' </label>
                        </div>
                        <div class="rsgBlock">
                            <hr>
                            <button class="rsgBtn dark-blue rsg_closePopup" type="button" onclick="closemodalreload()"> Close </button>
                        </div>
                    </div>
                </div> ';
	}	

	function HTML_redirect($title,$content,$class,$redirect){
        return '<div class="rsg_popup '.$class.' active" url="'.$redirect.'">
                    <div class="rsg_BlackBG5"></div>
                    <div class="customContainer rsgPopupContainer">
                        <div class="col- col-100 flex-wrap">
                            <h1><b>'.$title.'</b></h1>
                        </div>
                        <div class="rsgBlock">
                            <label> '.$content.' </label>
                        </div>
                        <div class="rsgBlock">
                            <hr>
                            <button class="rsgBtn dark-blue rsg_closePopup" type="button"> Cool! </button>
                        </div>
                    </div>
                </div> ';
	}	

    function ret($a){
        $a['rq'] = '';$a['fl'] = '';
        header('Content-Type: application/json');
        echo json_encode($a); die();
    }
	
	function pageReloadPostRemove(){
		if (!isset($_SESSION)) { session_start(); }
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_SESSION['postdata'] = $_POST;
			unset($_POST);
			header("Location: ".$_SERVER['PHP_SELF']);
			exit;
		}
	}

	function logout(){
		session_start();
		unset($_SESSION['login']);
		unset($_SESSION['id']);
		unset($_SESSION['name']);
		unset($_SESSION['status']);
		session_unset();
		header("Location: ".RSITE);
		exit;
	}

	function admin_login_redirect(){
		$u = RSITE;
		if( isset( $_SESSION['userType'] ) ){
			if( RTYPE == 'unset' ){
				$u = RSITE.'member/index.php?do=member_login';
			}elseif( RTYPE == 'admin' ){
				$u = RSITE.'admin/dashboard.php';
			}elseif( RTYPE == 'superadmin' ){
				$u = RSITE.'superadmin/dashboard.php';
			}elseif( RTYPE == 'stud' ){
				$u = RSITE.'member/account.php';
			}
		}else{
			unset($_SESSION['login']);
			unset($_SESSION['id']);
			unset($_SESSION['name']);
			unset($_SESSION['status']);
			session_unset();
		}
		header("Location: ".$u);
		exit;
	}

	function user_restrict_dashboard(){
		$u = RSITE;
		if( isset( $_SESSION['userType'] ) ){
			if( RTYPE == 'admin' ){
				$u = RSITE.'admin/dashboard.php';
			}elseif( RTYPE == 'superadmin' ){
				$u = RSITE.'superadmin/dashboard.php';
			}elseif( RTYPE == 'stud' ){
				$u = RSITE.'member/account.php';
			}
		}else{
			unset($_SESSION['login']);
			unset($_SESSION['id']);
			unset($_SESSION['name']);
			unset($_SESSION['status']);
			session_unset();
		}
		header("Location: ".$u);
		exit;
	}

	function site_options($con,$name){
		$r 	= mysqli_query( $con,"SELECT * FROM options WHERE name = '$name'");
		$selena 	= mysqli_fetch_array($r);
		$msg = ( $r->num_rows > 0 ) ? $selena['descriptions'] : '';
		return $msg;
	}

	function site_polls($con){
		$ret = mysqli_query($con,"SELECT * FROM polls p LEFT JOIN poll_answers a ON p.id = a.poll_id");
		$arr = array();
		while($row=mysqli_fetch_array($ret)){

			$ansArr = array();
			$ansArr[$row['id']] = array(
				'ansID'		=> $row['id'],
				'ansTitle'	=> $row[6],
				'ansVotes'	=> $row['votes'],
			);

			if( isset($arr[$row[0]]) ){
				$arr[ $row[0] ]['pollanswers'][ $row['id'] ] = array(
					'ansID'		=> $row['id'],
					'ansTitle'	=> $row[6],
					'ansVotes'	=> $row['votes'],
				);
			}else{
				$arr[$row[0]] = array(
					'polldesc' 		=>  $row['descriptions'],
					'polltitle'		=>  $row[1],
					'pollanswers' 	=>  $ansArr,
					'pollstats' 	=>  $row['status']
				);
			}
		}
		return $arr;
	}

	function site_registration($con){
		$arr 	= array();
		$r 		= mysqli_query( $con,"SELECT * FROM reg_scheds");
		$estes 	= mysqli_fetch_array($r);
		$dt  = new DateTime();
		if( $r->num_rows > 0 ){
			$sdate 	= $estes['start_date'];
			$edate 	= $estes['end_date'];
			$edate1 = new DateTime($edate);
			$arr['dates'] 	= date('M d,Y', strtotime($sdate) ) .' - '. date('M d,Y', strtotime($edate) );
			$arr['msg'] 	= ( $dt > $edate1 )?'Registration has ended.':'Registration still ongoing.';
		}else{
			$arr['dates'] = 'Schedule not set.'; $arr['msg'] = '';
		}
		return $arr;
	}

}