<?php

$rtitle = 'Admin Login | Technohouse'; //  set page title
$rtype = '';
include 'r.header.php';
?>


<div id="login-page">
	<div class="container">
		<form class="form-login" action="" method="post">
			<h2 class="form-login-heading r-bgred">sign in now</h2>
			<p style="color:#F00; padding-top:20px;" align="center">
			<div class="login-wrap">
				<input type="text" name="username" class="form-control" placeholder="User ID" autofocus required>
				<br>
				<input type="password" name="password" class="form-control" placeholder="Password" required><br >
				<input  name="adminlogin" class="btn btn-theme btn-block r-bgred" type="submit">
			</div>
		</form>	  	
	</div>
</div>

    
<script type="text/javascript" src="superadmin/assets/js/jquery.backstretch.min.js"></script>
<script>
	$.backstretch("superadmin/assets/img/login-bg.jpg", {speed: 500});
</script>

<?php include 'r.footer.php'; ?>