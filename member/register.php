<?php
$reg = $rsg->site_registration($con);
$dmsg 	= $reg['msg'];
$dates 	= $reg['dates'];
if( $dmsg=='Registration has ended.' ): 
?>

<div class="r_register">
	<div class="content-panel">	
		<h4><?=$dates;?></h4>
		<hr>
		<div class="card-content rsg-pad5 text-center">
			<strong class="r-f25"><?=$dmsg;?></strong>
		</div>
	</div>
</div>

<?php else:?>

<div class="r_register">
	<form name="registration" method="post" action="" enctype="multipart/form-data">

		<div class="form-row">
			
			<!-- First Name -->
			<div class="form-group text-left r-colwhite col-md-6">
				<label for="r_fname">First Name</label>
				<input type="text" class="form-control" id="r_fname" aria-describedby="r_fnameHelp" placeholder="Enter First Name" name="fname" required <?=isset($_POST['fname'])? 'value="'.$_POST['fname'].'"':''?> >
				<small id="r_fnameHelp" class="form-text r-opac8"></small>
			</div>
			
			<!-- Last Name -->
			<div class="form-group text-left r-colwhite col-md-6">
				<label for="r_lname">Last Name</label>
				<input type="text" class="form-control" id="r_lname" aria-describedby="r_lnameHelp" placeholder="Enter Last Name" name="lname" required <?=isset($_POST['lname'])? 'value="'.$_POST['lname'].'"':''?> >
				<small id="r_lnameHelp" class="form-text r-opac8"></small>
			</div>
		
			<!-- ID number -->
			<div class="form-group text-left r-colwhite col-md-6">
				<label for="r_idnumber">ID number</label>
				<input type="number" class="form-control" id="r_idnumber" aria-describedby="r_idnumberHelp" placeholder="Enter your ID number" name="idnumber" required pattern=".{7,}" maxlength="7">
				<small id="r_idnumberHelp" class="form-text r-opac8"></small>
			</div>

			<!-- Course & Year -->
			<div class="form-group text-left r-colwhite col-md-6">
				<label for="r_course">Course & Year</label>
				<input type="text" class="form-control" id="r_course" aria-describedby="r_courseHelp" placeholder="Enter your Course and Year (e.g. BSIT-I)" name="course" required <?=isset($_POST['course'])? 'value="'.$_POST['course'].'"':''?>>
				<small id="r_courseHelp" class="form-text r-opac8"></small>
			</div>

			<!-- Email -->
			<div class="form-group text-left r-colwhite col-md-12">
				<label for="r_email">Email address</label>
				<input type="email" class="form-control" id="r_email" aria-describedby="r_emailHelp" placeholder="Enter email" name="email" required>
				<small id="r_emailHelp" class="form-text r-opac8">We'll never share your email with anyone else.</small>
			</div>

			<!-- Password -->
			<div class="form-group text-left r-colwhite col-md-6">
				<label for="txtNewPassword">Password</label>
				<input type="password" class="form-control" id="txtNewPassword" aria-describedby="r_passwordHelp" name="password" required minlength="8" maxlength="32" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
				<small id="r_passwordHelp" class="form-text r-opac8"></small>
			</div>

			<!-- Repeat Password -->
			<div class="form-group text-left r-colwhite col-md-6">
				<label for="txtConfirmPassword">Repeat Password</label>
				<input type="password" onChange="isPasswordMatch();" class="form-control" id="txtConfirmPassword" aria-describedby="r_confirmpassHelp" name="confirmpass" required minlength="8" maxlength="32" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
				<small id="r_confirmpassHelp" class="form-text r-opac8"></small>
			</div>

			<!-- Password Checker -->
			<div class="form-group col-md-12">
				<div id="divCheckPassword"></div>
			</div>
		</div>
					
		<div class="sign-up">
			<input type="reset" value="Reset">
			<input type="submit" name="signup"  value="Sign Up" >
			<div class="clear"> </div>
		</div>

	</form>

</div>
<?php endif;