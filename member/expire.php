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
						

						<li class="resp-tab-item member_c member_login_tab_item" aria-controls="tab_item-1" role="tab"><div class="top-img"><img src="images/top-lock.png" alt=""/></div><span>Renewal</span></li>
						
						<div class="clear"></div>
					</ul> <!-- resp-tabs-list -->

					<div class="resp-tabs-container">
	
						<div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1" >
							<div class="facts">
								<div class="login">
									<div class="buttons"> </div>


									<form name="renew" action="" method="post">
										<input type="hidden" class="text" name="expireid" value="<?php echo $_SESSION['expiration'];?>" tabindex=1>
							          <h1 class="mb-4">
							            <strong>Your account is expired. Click button to renew</strong>
							          </h1>

										<div class="p-container">
											<div class="submit two"> <input type="submit" name="renew" value="Renew" > </div>
											<div class="clear"> </div>
										</div>

									</form>
									<a href="../index.php" class="btn btn-success wave effects">Home</a>
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