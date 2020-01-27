<section id="main-content">
    <section class="wrapper">
        
        <div class="container rsg-padTB20">
            <div class="row">
                <h3><i class="fas fa-arrow-circle-right"></i> Change Password</h3>
            </div>
            <div class="row">
                <div class="content-panel">
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
                            <input type="submit" name="SubmitNewPassword" value="Change" class="btn btn-theme">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</section>