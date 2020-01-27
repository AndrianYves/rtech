<div class="rsg-preloader rsg-remove-onload">
	<div class="rsg-loadingMsg"> Please wait... </div>
	<div class="rsg-loading"><div class="rsg-loading-in"></div></div>
</div>
<header id="header">
	<div class="inner">
		<a href="<?=RSITE;?>" class = 'logo'> <img src="<?=RSITE;?>assets/logo.jpg"> </a>
		<nav id="nav">
			<a href="<?=RSITE;?>">Home</a>
			<?php if( isset($_SESSION['id']) ): ?>
				<a href="<?=RSITE;?>poll.php">Poll</a>
				<a href="<?=RSITE;?>announcement.php"><i class="fas fa-poll-h"></i> &nbsp;  <?php
$now = date('Y-m-d');
                $sql = mysqli_query($con, " SELECT count(*) as total from announcements where DATEDIFF('".$now."', timestamp) < '1'");
                 $row = mysqli_fetch_assoc($sql);
                 $number = $row['total'];
                 if ($number > '0'){
                  echo '<span class="badge red z-depth-1 mr-1">'.$number.'</span>';
                 }
                ?>Announcement</a>
				<div class="rsg-select">
					<a href="#" class="rsg-select-toggle"><i class="fas fa-gear"></i> &nbsp; <?= strtoupper($_SESSION['name']);?> </a>
					<span class="rsg-dropdown">
						<a href="<?=RSITE;?>member/account.php"><i class="fas fa-user"></i> &nbsp; Account</a>
						<a href="<?=RSITE;?>logout.php"><i class="fas fa-times"></i> &nbsp; Logout</a>
					</span>
				</div>
				
			<?php else:
				echo '<a href="'.RSITE.'member/index.php?do=member_login">Login</a>';
				if( $rsg->site_registration($con)['msg']=='Registration still ongoing.' ){
					echo '<a href="'.RSITE.'member/index.php?do=member_register">Register</a>';
				}
			endif; ?>
		</nav>
		<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
	</div>
</header>
        <?php
          $sql = mysqli_query($con, "SELECT * FROM mainheader");
          $content = mysqli_fetch_assoc($sql);
        ?>

<section id="banner">
	<h1><?=isset($bannertitle) ? $bannertitle : 'TECHNO HOUSE'; ?></h1>
	<p>“<?php echo $content['content'];?>.”</p>
</section>
