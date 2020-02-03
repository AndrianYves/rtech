<?php
include_once 'r.functions.php';

// renew
if( isset($_rq['renew']) ) {
	$errors = '';
	$id		= $_rq['expireid'];
	$dayt      	= date("Y/m/d");
	$expdate 	= date('Y/m/d', strtotime('+6 months'));

	$sql = mysqli_query($con,"UPDATE users SET status = 'pending', expiry_date = '$expdate', posting_date = '$dayt' WHERE `id` = '$id'");
	echo $rsg->HTML_1('Success!','Your account request is now pending for approval. Please wait for confirmation. Thank you.','closemodalreload');
}

// Member Registration
if( isset($_rq['signup']) ) {
	$errors = '';
	$fname		= $_rq['fname'];
	$lname		= $_rq['lname'];
	$idnumber	= $_rq['idnumber'];
	$idNum 		= (string) $idnumber;
	// validate id number
	if( strlen($idNum) > 7 ){
		echo $rsg->HTML_1('Ooops!','ID Number should not exceed 7 numbers, please check and try again.','');
	}else{
		if( preg_match('/^\d+$/', $idnumber) == 0 ){	
			echo $rsg->HTML_1('Ugh!','No error, but please don\'t enter a negative sign in your ID number.','');
		}else{
			$course		= $_rq['course'];
			$email		= $_rq['email'];
			$pass		= $_rq['password'];
			$dayt      	= date("Y/m/d");
			$expdate 	= date('Y/m/d', strtotime('+6 months'));
			$enc_pass 	= password_hash($pass,PASSWORD_DEFAULT );
			$query_run_u = mysqli_query($con, "select * from users where id_number ='$idnumber'");
			if(mysqli_num_rows($query_run_u) > 0 ) {
				echo $rsg->HTML_1('Ooops!','ID Number entered alreay exists, Please check and try again.','');
			}else{
				$s = 'INSERT INTO users (fname, lname, id_number, course, email, password, expiry_date, posting_date) VALUES ("'.$fname.'", "'.$lname.'", '.abs($idnumber).', "'.$course.'", "'.$email.'", "'.$enc_pass.'", "'.$expdate.'", "'.$dayt.'")';
				if(mysqli_query($con, $s)){
					echo $rsg->HTML_1('Success!','Your account request is now pending for approval. Please wait for confirmation. Thank you.','closemodalreload');
				}else{
					echo $rsg->HTML_1('Error!','Error saving record. Please try again later or contact your administrator.','closemodalreload');
				}
			}
		}
	}	
}


// Login 
if(isset($_rq['login'])){
	$password 		= $_rq['password'];
	$userid 		= $_rq['uemail'];
	if( $userid=='' || $password=='' ){
		echo $rsg->HTML_1('Oops!','Please enter required fields.','closemodalreload');
	}elseif( isset($userid)===false || isset($password)===false ){
		echo $rsg->HTML_1('Oops!','Please enter required fields.','closemodalreload');
	}else{
		$ret = mysqli_query( $con,"SELECT * FROM users WHERE id_number='$userid' AND status = 'active'; ");
		$num = mysqli_fetch_array($ret);
		if($num>0){
				if( password_verify( $password, $num['password'] ) ){

					$expiration = strtotime($num['expiry_date']);
		            $now= strtotime(date('Y-m-d'));

		          if($expiration < $now) {
		        	$_SESSION['expiration'] = $num['id'];
		            header('location: expire.php');
		          } else {
		            $_SESSION['login'] 	= $_rq['uemail'];
					$_SESSION['id'] 	= $num['id'];
					$_SESSION['name'] 	= $num['fname'];
					$_SESSION['status'] = $num['status'];
					$_SESSION['userType'] = 'stud';
					$extra 	= "../index1.php";
					$host 	= $_SERVER['HTTP_HOST'];
					$uri 	= rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
					header("location:http://$host$uri/$extra");
					exit();
		          }

				}else{
					echo $rsg->HTML_1('Ooop!','Entered password or ID Number does not match.','');
				}
			
		}else{
			echo $rsg->HTML_1('Ooops!','Invalid Details Or Account is not yet confirmed. If you think this is wrong please contact an administrator. Thank you.','closemodalreload');
		}
	}
	
}

// Forgot Password
if(isset($_POST['send'])) {
	$femail=$_POST['femail'];
	$row1=mysqli_query($con,"select email,password from users where email='$femail'");
	$row2=mysqli_fetch_array($row1);
	if($row2>0){
		$email = $row2['email'];
		$subject = "Information about your password";
		$password=$row2['password'];
		$message = "Your password is ".$password;
		mail($email, $subject, $message, "From: $email");
		echo $rsg->HTML_1('Please check you email!','Your Password has been sent.','');
	}else{
		echo $rsg->HTML_1('Ooops!','Invalid Email. If you think this is wrong please contact an administrator. Thank you.','closemodalreload');
	}
}

// Change ADMIN Password
if(isset($_rq['SubmitNewPassword'])) {
	$userid 	 = $_SESSION['id'];
	$oldpass 	 = $_rq['oldpass'];
	$sql         = mysqli_query($con,"SELECT * FROM admin where id='$userid'");
	$num         = mysqli_fetch_array($sql);
	if($num>0){
		if( $oldpass == '1' ){
			$newpass = password_hash($_rq['newpass'],PASSWORD_DEFAULT );
			$ret = mysqli_query($con,"update admin set password='$newpass' where id='$userid'");
			echo $rsg->HTML_1('Great!','Password Changed Successfully.','closemodalreload');
		}else{
			if( password_verify($oldpass,$num['password']) ){
				$newpass = password_hash($_rq['newpass'],PASSWORD_DEFAULT );
				$ret = mysqli_query($con,"update admin set password='$newpass' where id='$userid'");
				echo $rsg->HTML_1('Great!','Password Changed Successfully.','closemodalreload');
			}else{
				echo $rsg->HTML_1('Oops!','Old Password not match.','closemodalreload');
			}
		}
		
	}else{
		echo $rsg->HTML_1('Oops!','Old Password not match.','closemodalreload');
	}
}

// Admin Login
if(isset($_rq['adminlogin'])){
 	$uname 	= $_rq['username'];
	$pass 	= $_rq['password'];
	if( $uname=='' || $pass=='' ){
		echo $rsg->HTML_1('Oops!','Please enter required fields.','closemodalreload');
	}elseif( isset($uname)===false || isset($pass)===false ){
		echo $rsg->HTML_1('Oops!','Please enter required fields.','closemodalreload');
	}else{
		$sql 	= mysqli_query($con,"SELECT * FROM admin where username='$uname'");
		$num 	= mysqli_fetch_array($sql);
		if($num>0){
			if( $pass == '1' ){
				if( $num['password']==1 ){
					$extra="dashboard.php";
					$_SESSION['loggedin'] 	= true;
					$_SESSION['login'] 		= $_rq['username'];
					$_SESSION['name'] 		= $_rq['username'];
					$_SESSION['id'] 		= $num['id'];
					$_SESSION['userType'] 	= $num['type'];
					if( $num['type'] == 'superadmin' ){
						echo "<script>window.location.href='superadmin/".$extra."'</script>";
					}else{
						echo "<script>window.location.href='admin/".$extra."'</script>";
					}
					exit();	
				}else{
					echo $rsg->HTML_1('Oops!','Password or username does not match.','closemodalreload');
				}
			}else{
				if( password_verify($pass,$num['password']) === true ){		
					$extra="dashboard.php";
					$_SESSION['loggedin'] 	= true;
					$_SESSION['login'] 		= $_rq['username'];
					$_SESSION['name'] 		= $_rq['username'];
					$_SESSION['id'] 		= $num['id'];
					$_SESSION['userType'] 	= $num['type'];
					if( $num['type'] == 'superadmin' ){
						echo "<script>window.location.href='superadmin/".$extra."'</script>";
					}else{
						echo "<script>window.location.href='admin/".$extra."'</script>";
					}
					exit();	
				}else{
					echo $rsg->HTML_1('Oops!','Password or username does not match.','closemodalreload');
				}
			}
			
		}else{
			echo $rsg->HTML_1('Oops!','Password or username does not match.','closemodalreload');
		}
	}
}

// Change Member Password   
if(isset($_rq['SubmitMemberNewPassword'])) {
	$userid 	 = $_SESSION['id'];
	$oldpass 	 = $_rq['oldpass'];
	$sql         = mysqli_query($con,"SELECT * FROM users where id='$userid'");
	$num         = mysqli_fetch_array($sql);
	if($num>0){
		if( $oldpass == '1' ){
			$newpass = password_hash($_rq['newpass'],PASSWORD_DEFAULT );
			$ret = mysqli_query($con,"update users set password='$newpass' where id='$userid'");
			echo $rsg->HTML_1('Great!','Password Changed Successfully.','closemodalreload');
		}else{
			if( password_verify($oldpass,$num['password']) ){
				$newpass = password_hash($_rq['newpass'],PASSWORD_DEFAULT );
				$ret = mysqli_query($con,"update users set password='$newpass' where id='$userid'");
				echo $rsg->HTML_1('Great!','Password Changed Successfully.','closemodalreload');
			}else{
				echo $rsg->HTML_1('Oops!','Old Password not match.','closemodalreload');
			}
		}
		
	}else{
		echo $rsg->HTML_1('Oops!','Old Password not match.','closemodalreload');
	}

}

// Change Member Profile   
if(isset($_rq['SubmitMemberUpdateProfile'])) {
	$userid 	= $_SESSION['id'];
	$fname		= $_rq['fname'];
	$lname 		= $_rq['lname'];
	$course 	= $_rq['course'];
	$email 	 	= $_rq['email'];
	$sql         = mysqli_query($con,"SELECT * FROM users where id='$userid'");
	$num         = mysqli_fetch_array($sql);
	if($num>0){
		$ret = mysqli_query($con,"update users set fname='$fname',lname='$lname',course='$course',email='$email' where id='$userid'");
		$_SESSION['login'] 	= $email;
		$_SESSION['name'] 	= $fname;
		echo $rsg->HTML_1('Great!','Profile Updated Successfully.','closemodalreload');
		
	}else{
		echo $rsg->HTML_1('Ooops!','Soemthing went wrong. If you think this is weird, please contact an administrator. Thank you.','closemodalreload');
	}

}

// Voting
if(isset($_rq['SubmitVote'])) {
	$v = $_rq['poll_answer'];	// answer ID
	$h = mysqli_query($con,"UPDATE poll_answers set votes=votes + 1 WHERE id='$v'");
	echo $rsg->HTML_redirect('Great!','Thank you for your response! You will be redirected back to the polls list.','closemodalredirect',RSITE.'poll.php');

}

// Registration Schedules
if(isset($_rq['update_reg_sched'])) {
	$i = isset($_rq['ids'])? $_rq['ids'] : 0;
	$s = $_rq['s_date'];
	$e = $_rq['e_date'];
	$creatorID = $_rq['creatorID'];

	$s1 = new DateTime($s);
	$e1 = new DateTime($e);

	if( $s1 > $e1 ){
		echo $rsg->HTML_1('Yo!','Start date is '.date('M d,Y', strtotime($s) ).' and end date is '.date('M d,Y', strtotime($e) ).'? Are you sure? That is not possible, sorry. Try checking your dates then try again.','closemodalreload');
	}else{
		$r = mysqli_query( $con,"SELECT * FROM reg_scheds");
		if( $r->num_rows > 0 ){
			$s = "UPDATE reg_scheds set start_date='$s',end_date='$e',creator='$creatorID' WHERE id='$i'";
		}else{
			$s = 'INSERT INTO reg_scheds (start_date, end_date, creator, inactive_message) VALUES ("'.$s.'", "'.$e.'", "'.$creatorID.'", "Sorry, registration period has ended. Please wait for it to be opened or inquire to any of the administrators. Thank You.")';	
		}

		if(mysqli_query($con, $s)){
			echo $rsg->HTML_1('Success!','Schedule has been set.','closemodalreload');
		}else{
			echo $rsg->HTML_1('Error!','Error saving record. Please try again later.','closemodalreload');
		}
	}

}
// Registration Schedule Message if inactive
if(isset($_rq['update_reg_sched_msg'])) {
	$i = isset($_rq['ids'])? $_rq['ids'] : 0;
	$creatorID 		= $_rq['creatorID'];
	$reg_sched_msg 	= $_rq['reg_sched_msg'];

	$r = mysqli_query( $con,"SELECT * FROM reg_scheds");
	if( $r->num_rows > 0 ){
		$s = "UPDATE reg_scheds set inactive_message='$reg_sched_msg',creator='$creatorID' WHERE id='$i'";
	}
	if(mysqli_query($con, $s)){
		echo $rsg->HTML_1('Success!','Message has been set.','closemodalreload');
	}else{
		echo $rsg->HTML_1('Error!','Error saving record. Please try again later.','closemodalreload');
	}
}

// Create post/announcements
if(isset($_rq['create_post_submit'])) {
	$post_title = $_rq['post_title'];
	$post_desc 	= $_rq['post_desc'];
	if( $post_title=='' || $post_desc=='' ){
		echo $rsg->HTML_1('Ooops!','Please fill in the required fields.','closemodalreload');
	}else{
		$s = 'INSERT INTO announcements (title, descriptions) VALUES ("'.$post_title.'", "'.$post_desc.'")';
		if( mysqli_query($con, $s) ){
			echo $rsg->HTML_1('Success!','Announcement has been created.','closemodalreload');
		}else{
			echo $rsg->HTML_1('Error!','Error creating record. Please try again later.','closemodalreload');
		}
	}	
}

// Create polls
if(isset($_rq['create_poll_submit'])) {
	if( isset( $_rq['poll_chois'] )==false || $_rq['poll_chois']=='' || isset( $_rq['poll_title'] )==false || $_rq['poll_title']=='' || isset( $_rq['poll_desc'] )==false || $_rq['poll_desc']=='' ){
		echo $rsg->HTML_1('Ooops!','Please fill in the required fields.','closemodalreload');
	}else{
		$poll_title = $_rq['poll_title'];
		$poll_desc 	= $_rq['poll_desc'];
		$poll_chois = explode(PHP_EOL, $_rq['poll_chois']);
		if( count($poll_chois)<2 ){
			echo $rsg->HTML_1('Ooops!','Please there should be minimum of two(2) answers for each polls.','closemodalreload');
		}else{
			$s = 'INSERT INTO polls (title, descriptions) VALUES ("'.$poll_title.'", "'.$poll_desc.'")';
			if( mysqli_query($con, $s) ){
				$pollID = mysqli_insert_id($con);
				foreach ( $poll_chois as $ans ) {
					if ( empty( $ans ) ) continue;
					$st = mysqli_query($con, 'INSERT INTO poll_answers (poll_id,title,votes) VALUES ("'.$pollID.'","'.$ans.'", "0")');
				}
				echo $rsg->HTML_1('Success!','Poll has been created.','closemodalreload');
			}else{
				echo $rsg->HTML_1('Error!','Error creating record. Please try again later.','closemodalreload');
			}
		}
		
	}

}

// Update Mission
if(isset($_rq['update_mission_submit'])) {
	$msg = $_rq['mission_msg'];
	if( $msg=='' ){
		echo $rsg->HTML_1('Ooops!','Please fill in the required fields.','closemodalreload');
	}else{
		$s = "UPDATE options set descriptions='$msg' WHERE name='mission'";
		if(mysqli_query($con, $s)){
			echo $rsg->HTML_1('Success!','Mission has been updated.','closemodalreload');
		}else{
			echo $rsg->HTML_1('Error!','Error saving record. Please try again later.','closemodalreload');
		}
	}
}

// Update Vision
if(isset($_rq['update_vision_submit'])) {
	$msg = $_rq['vision_msg'];
	if( $msg=='' ){
		echo $rsg->HTML_1('Ooops!','Please fill in the required fields.','closemodalreload');
	}else{
		$s = "UPDATE options set descriptions='$msg' WHERE name='vision'";
		if(mysqli_query($con, $s)){
			echo $rsg->HTML_1('Success!','Vision has been updated.','closemodalreload');
		}else{
			echo $rsg->HTML_1('Error!','Error saving record. Please try again later.','closemodalreload');
		}
	}
}

// Update Goals
if(isset($_rq['update_goals_submit'])) {
	$msg = $_rq['goals_msg'];
	if( $msg=='' ){
		echo $rsg->HTML_1('Ooops!','Please fill in the required fields.','closemodalreload');
	}else{
		$s = "UPDATE options set descriptions='$msg' WHERE name='goals'";
		if(mysqli_query($con, $s)){
			echo $rsg->HTML_1('Success!','Goals has been updated.','closemodalreload');
		}else{
			echo $rsg->HTML_1('Error!','Error saving record. Please try again later.','closemodalreload');
		}
	}
}