<?php

$rtitle = 'Account | Technohouse'; //  set page title
$rtype = '';
include '../r.header.php';
$userId = $_SESSION['id'];
$userRet = mysqli_query($con, "select * from users where id ='$userId'");
$a = mysqli_fetch_array($userRet);
if( RTYPE == 'admin' || RTYPE == 'superadmin' ){
    header("Location: ".RSITE.RTYPE.'/dashboard.php');
	exit;
}
?>

<link href = "<?=RSITE;?>css/postmember.css" rel = "stylesheet" type = "text/css">
<link href = "<?=RSITE;?>assets/css/main.css" rel = "stylesheet" >
<link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet" />

<section id="container" >
    
    <?php 
      $bannertitle="Account"; 
      include '../r.header.client.php'; 
    ?>
    <div class="container rsg-padTB20">
      <div class="row">
          <h3><i class="fas fa-arrow-circle-right"></i> Update Profile</h3>
      </div>
      <div class="row">
          <div class="content-panel rsg-pad5 r-wid100">
              <form class="form-horizontal style-form" name="form1" method="post" action="" onSubmit="return valid();">
                  <p style="color:#F00" class="rsg-pad5"><?= isset($_SESSION['msg'])?$_SESSION['msg']:'';?><?php echo $_SESSION['msg']="";?></p>

                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">First Name</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="fname" value="<?=$a['fname'];?>" required>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Last Name</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="lname" value="<?=$a['lname'];?>" required>
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">ID Number</label>
                      <div class="col-sm-10">
                          <input type="number" class="form-control" name="id_number" value="<?=$a['id_number'];?>" disabled>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Course</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="course" value="<?=$a['course'];?>" required>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Email Address</label>
                      <div class="col-sm-10">
                          <input type="email" class="form-control" name="email" value="<?=$a['email'];?>" required>
                      </div>
                  </div>

                  <div style="margin-left:100px;">
                      <input type="submit" name="SubmitMemberUpdateProfile" value="Change" class="btn btn-theme">
                  </div>
              </form>
          </div>
      </div>
    </div>
    <div class="container rsg-padTB20">
      <div class="row">
          <h3><i class="fas fa-arrow-circle-right"></i> Change Password</h3>
      </div>
      <div class="row">
          <div class="content-panel rsg-pad5 r-wid100">
              <form class="form-horizontal style-form" name="form1" method="post" action="" onSubmit="return valid();">
                  <p style="color:#F00" class="rsg-pad5"><?= isset($_SESSION['msg'])?$_SESSION['msg']:'';?><?php echo $_SESSION['msg']="";?></p>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Old Password</label>
                      <div class="col-sm-10">
                          <input type="password" class="form-control" name="oldpass" value="" required>
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">New Password</label>
                      <div class="col-sm-10">
                          <input type="password" class="form-control" name="newpass" required minlength="8" maxlength="32" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Confirm Password</label>
                      <div class="col-sm-10">
                          <input type="password" class="form-control" name="confirmpassword" required minlength="8" maxlength="32" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                      </div>
                  </div>

                  <div style="margin-left:100px;">
                      <input type="submit" name="SubmitMemberNewPassword" value="Change" class="btn btn-theme">
                  </div>
              </form>
          </div>
      </div>
    </div>

		

</section>

<?php include '../r.footer.php';