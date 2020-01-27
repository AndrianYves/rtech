<?php 

session_start();
// include("../admin/request/functions.php");
include_once '../r.posts.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Login System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Elegent Tab Forms,Login Forms,Sign up Forms,Registration Forms,News latter Forms,Elements"./>

	

	<link href="<?=RSITE;?>css/bootstrap.min.css" rel='stylesheet' type='text/css' />
	<link href="<?=RSITE;?>css/style.css" rel='stylesheet' type='text/css' />
	<link href="<?=RSITE;?>css/r.css" rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600,700,200italic,300italic,400italic,600italic|Lora:400,700,400italic,700italic|Raleway:400,500,300,600,700,200,100' rel='stylesheet' type='text/css'>
	<link href="<?=RSITE;?>css/fontawesome_font.min.css" rel="stylesheet" />
	
</head>
<body>
		<div class="main member_login_page">
			<h1>TECHNO HAUS</h1>
			<div class="sap_tabs">	
				<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">

					<ul class="resp-tabs-list">
						
						<li class="resp-tab-item member_c member_register_tab_item" aria-controls="tab_item-0" role="tab"> <div class="top-img"><img src="images/top-note.png" alt=""/></div><span>Register</span> </li>
						<li class="resp-tab-item member_c member_login_tab_item" aria-controls="tab_item-1" role="tab"><div class="top-img"><img src="images/top-lock.png" alt=""/></div><span>Login</span></li>
						<li class="resp-tab-item lost member_c member_forpass_tab_item" aria-controls="tab_item-2" role="tab"><div class="top-img"><img src="images/top-key.png" alt=""/></div><span>Forgot Password</span></li>
						<div class="clear"></div>
					</ul> <!-- resp-tabs-list -->

					<div class="resp-tabs-container">
						<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0" >
							<div class="facts">
								<?php
									
									include 'register.php';
								?>

							</div>
						</div>		
						<div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1" >
							<div class="facts">
								<div class="login">
									<div class="buttons"> </div>
									<form name="login" action="" method="post">
										<i class=" icon email" ></i>
										<input type="text" class="text" name="uemail" value="" placeholder="Enter your registered id number"  tabindex=1>

										<i class=" icon lock" ></i>
										<input type="password" value="" name="password" placeholder="Enter valid password" tabindex=0>

										<div class="p-container">
											<div class="submit two"> <input type="submit" name="login" value="LOG IN" > </div>
											<div class="clear"> </div>
										</div>

									</form>
								</div>
							</div> 
						</div> 			        					 

						<div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1" >
							<div class="facts">
								<div class="login">
									<div class="buttons"></div>
									<form name="login" action="" method="post">
										<input type="text" class="text" name="femail" value="" placeholder="Enter your registered email" required  >
										<a href="#" class=" icon email"></a>	
										<div class="submit three">
											<input type="submit" name="send" onClick="myFunction()" value="Send Email" >
										</div>
									</form>
								</div>
							</div>           	      
						</div>	

					</div>	<!-- resp-tabs-container -->

				</div> <!-- horizontalTab -->
			</div> <!-- sap_tabs -->
		</div> <!-- main -->
		
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/jquery.min.js"></script>
		<script src="../js/easyResponsiveTabs.js" type="text/javascript"></script>
		<script src="../js/r.js"></script>
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#horizontalTab').easyResponsiveTabs({
					type: 'default',       
					width: 'auto', 
					fit: true 
				});
			});
		</script>
	</body>
</html>