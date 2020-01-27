<?php
$r 			= mysqli_query( $con,"SELECT * FROM users WHERE status = 'active'");
$StudCnt 	= $r->num_rows>0 ? $r->num_rows : '0';

$r 		= mysqli_query( $con,"SELECT * FROM users WHERE status = 'pending'; ");
$PenCnt = $r->num_rows>0 ? $r->num_rows : '0';

$r 		 = mysqli_query( $con,"SELECT * FROM users WHERE status = 'inactive'; ");
$InacCnt = $r->num_rows>0 ? $r->num_rows : '0';

$r 		 	= mysqli_query( $con,"SELECT * FROM admin WHERE stat = 'active' AND type='admin'");
$admins 	= $r->num_rows>0 ? $r->num_rows : '0';

$r 		= mysqli_query( $con,"SELECT * FROM reg_scheds");
$estes 	= mysqli_fetch_array($r);
$dt = new DateTime();
$dt1 = $dt->format('M d,Y');
if( $r->num_rows > 0 ){
	$sdate 	= $estes['start_date'];
	$edate 	= $estes['end_date'];
	$edate1 = new DateTime($edate);
	$dates 	= date('M d,Y', strtotime($sdate) ) .' - '. date('M d,Y', strtotime($edate) );
	$dmsg 	= ( $dt > $edate1 )?'Registration has ended.':'Registration still ongoing';
}else{
	$dates = 'Schedule not set.'; $dmsg = '';
}

?>
<section id="main-content">
    <section class="wrapper">
        <div class="container rsg-padTB20">
            <div class="row">
                <h3><i class="fas fa-arrow-circle-right"></i> Dashboard</h3>
			</div>
			
            <div class="row">
				<div class="col-lg-4">
					<div class="content-panel r-bglightblue">	
						<h4><a href="<?=RSITE.RTYPE?>/manage-users.php?manage=students" class="r-colblack hovred">Active Users</a></h4>
						<hr>
						<div class="card-content rsg-pad5 text-center">
							<strong class="r-f25"><?=$StudCnt;?></strong>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="content-panel r-bglpurple">	
						<h4><a href="<?=RSITE.RTYPE?>/manage-users.php?manage=requests" class="r-colblack hovred">Pending Users</a></h4>
						<hr>
						<div class="card-content rsg-pad5 text-center">
							<strong class="r-f25"><?=$PenCnt;?></strong>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="content-panel r-bglightblue">	
						<h4><a href="<?=RSITE.RTYPE?>/manage-users.php?manage=students" class="r-colblack hovred">Inactive Users</a></h4>
						<hr>
						<div class="card-content rsg-pad5 text-center">
							<strong class="r-f25"><?= $InacCnt;?></strong>
						</div>
					</div>
				</div>
			</div>
			<div class="row"> <hr> </div>
			<div class="row">
				<div class="col-lg-6">
					<div class="content-panel r-bglpurple">	
						<h4><a href="<?=RSITE.RTYPE?>/registration-schedule.php" class="r-colblack hovred">Registration Status</a></h4>
						<hr>
						<div class="card-content rsg-pad5 text-center">
							<strong class="r-f25"><?=$dates;?></strong>
							<br>
							<?=$dmsg;?>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="content-panel r-bglightblue">	
						<h4> <?php echo (RTYPE=='superadmin') ? '<a href="'.RSITE.RTYPE.'/manage-users.php?manage=admins" class="r-colblack hovred">Administrators</a>':'Administrators'; ?> </h4>
						<hr>
						<div class="card-content rsg-pad5 text-center">
							<strong class="r-f25"><?=$admins;?></strong>
							<br><br>
						</div>
					</div>
				</div>
				
            </div>
			<?php 
			// MISSION
			$r 		= mysqli_query( $con,"SELECT * FROM options WHERE name = 'mission'");
			$selena = mysqli_fetch_array($r);
			$missionmsg = ( $r->num_rows > 0 ) ? $selena['descriptions'] : '';
			?>
			<div class="row"> <hr> </div>
			<div class="row">
				<div class="col-lg-12">
					<div class="content-panel r-bglpurple">	
						<h4> <i class="fas fa-arrow-circle-right"></i> &nbsp;Mission</h4>
						<hr>
						<form class="card-content rsg-pad5" name="update_mission_msg" method="post" action="" enctype="multipart/form-data">
							<strong class="r-f20">
								<div class="form-group text-left r-colblack col-md-12">
									<label><strong><?=$missionmsg;?></strong></label>
								</div>
								<div class="form-group text-left r-colblack col-md-12">
									<label for="mission_msg">Set new mission:</label>
									<textarea class="form-control" id="mission_msg" aria-describedby="mission_msgHelp" name="mission_msg" required style="height:100px;"></textarea>
									<small id="mission_msgHelp" class="form-text r-opac8"></small>
								</div>
							</strong>
							<div class="modal-footer">
								<input type="submit" class="btn btn-primary" name="update_mission_submit" value="Update Mission">
							</div>
						</form>
					</div>
				</div>
            </div>

			<?php 
			// VISION
			$r 		= mysqli_query( $con,"SELECT * FROM options WHERE name = 'vision'");
			$selena = mysqli_fetch_array($r);
			$visionmsg = ( $r->num_rows > 0 ) ? $selena['descriptions'] : '';
			?>
			<div class="row"> <hr> </div>
			<div class="row">
				<div class="col-lg-12">
					<div class="content-panel r-bglpurple">	
						<h4> <i class="fas fa-arrow-circle-right"></i> &nbsp;Vision</h4>
						<hr>
						<form class="card-content rsg-pad5" name="update_vision_msg" method="post" action="" enctype="multipart/form-data">
							<strong class="r-f20">
								<div class="form-group text-left r-colblack col-md-12">
									<label><strong><?=$visionmsg;?></strong></label>
								</div>
								<div class="form-group text-left r-colblack col-md-12">
									<label for="vision_msg">Set new vision:</label>
									<textarea class="form-control" id="vision_msg" aria-describedby="vision_msgHelp" name="vision_msg" required style="height:100px;"></textarea>
									<small id="vision_msgHelp" class="form-text r-opac8"></small>
								</div>
							</strong>
							<div class="modal-footer">
								<input type="submit" class="btn btn-primary" name="update_vision_submit" value="Update Vision">
							</div>
						</form>
					</div>
				</div>
            </div>

			<?php 
			// GOALS
			$r 		= mysqli_query( $con,"SELECT * FROM options WHERE name = 'goals'");
			$selena = mysqli_fetch_array($r);
			$goalsmsg = ( $r->num_rows > 0 ) ? $selena['descriptions'] : '';
			?>
			<div class="row"> <hr> </div>
			<div class="row">
				<div class="col-lg-12">
					<div class="content-panel r-bglpurple">	
						<h4> <i class="fas fa-arrow-circle-right"></i> &nbsp;Goals</h4>
						<hr>
						<form class="card-content rsg-pad5" name="update_goals_msg" method="post" action="" enctype="multipart/form-data">
							<strong class="r-f20">
								<div class="form-group text-left r-colblack col-md-12">
									<label><strong><?=$goalsmsg;?></strong></label>
								</div>
								<div class="form-group text-left r-colblack col-md-12">
									<label for="goals_msg">Set new goals:</label>
									<textarea class="form-control" id="goals_msg" aria-describedby="goals_msgHelp" name="goals_msg" required style="height:100px;"></textarea>
									<small id="goals_msgHelp" class="form-text r-opac8"></small>
								</div>
							</strong>
							<div class="modal-footer">
								<input type="submit" class="btn btn-primary" name="update_goals_submit" value="Update Goals">
							</div>
						</form>
					</div>
				</div>
            </div>


        </div>
    </section>
</section>

