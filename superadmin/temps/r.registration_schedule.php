<?php

$r = mysqli_query( $con,"SELECT * FROM reg_scheds");
if( $r->num_rows > 0 ){
	$estes 	= mysqli_fetch_array($r);
	$msg 	= $estes['inactive_message'];
	$sdate 	= $estes['start_date'];
	$edate 	= $estes['end_date'];
	$edate1 = new DateTime($edate);
	$ids 	= $estes['id'];
}else{
	$msg 	= 'Sorry, registration period has ended. Please wait for it to be opened or inquire to any of the administrators. Thank You.';
	$sdate 	= $edate = $ids ='';
}
$dt = new DateTime();
?>
<?php
if(isset($_POST['update_reg_sched'])){ 
  $s_date = $_POST["s_date"];
  $e_date = $_POST["e_date"];

  $sql = "UPDATE reg_scheds SET start_date = '$s_date', end_date = '$e_date' where id = '1'"; 
  mysqli_query($con, $sql);
}
?>
<section id="main-content">
    <section class="wrapper">
        <div class="container rsg-padTB20">
            <div class="row">
                <h3><i class="fas fa-arrow-circle-right"></i> Registration Schedule</h3>
			</div>
            <div class="row">
				<div class="col-lg-12">
					<div class="content-panel r-bglightblue">	
						<h4>Registration Schedule ( <?php echo date('M d,Y', strtotime($sdate) ) .' to '. date('M d,Y', strtotime($edate) ); ?> )</h4>
						<hr>
						<form class="card-content rsg-pad5 text-center" name="reg_sched" method="post" action="" enctype="multipart/form-data">
							<strong class="r-f20">
								<div class="form-group text-left r-colblack col-md-12">
									<label><strong>Note: <?=( $dt > $edate1 )?'Registration has ended.':'Registration still ongoing';?></strong></label>
								</div>
								<div class="form-group text-left r-colblack col-md-12">
									<label for="s_date">Set New Start Date</label>
									<input type="date" class="form-control" id="s_date" aria-describedby="s_dateHelp" name="s_date" required>
									<small id="s_dateHelp" class="form-text r-opac8"></small>
								</div>

								<div class="form-group text-left r-colblack col-md-12">
									<label for="e_date">Set New End Date</label>
									<input type="date" class="form-control" id="e_date" aria-describedby="e_dateHelp" name="e_date" required>
									<small id="e_dateHelp" class="form-text r-opac8"></small>
								</div>
							</strong>
							<div class="modal-footer">
								<?php if ($ids!=''){ echo '<input type="hidden" value="'.$ids.'" name="ids">';   }  ?>
								<input type="hidden" value="<?=$_SESSION['name'];?>" name="creatorID">
								<input type="submit" class="btn btn-primary" name="update_reg_sched" value="Update Schedule">
							</div>
						</form>
						
					</div>
				</div>
				<div class="col-lg-12">
					<hr>
				</div>
				<div class="col-lg-12">
					<div class="content-panel r-bglpurple">	
						<h4>Message if registration has ended</h4>
						<hr>
						<form class="card-content rsg-pad5 text-center" name="reg_sched_msg" method="post" action="" enctype="multipart/form-data">
							
							<strong class="r-f20">
								<div class="form-group text-left r-colblack col-md-12">
									<label><strong>Current Message: <?=$msg;?></strong></label>
								</div>
								<div class="form-group text-left r-colblack col-md-12">
									<label for="reg_sched_msg">Set new message:</label>
									<input type="text" class="form-control" id="reg_sched_msg" aria-describedby="reg_sched_msgHelp" name="reg_sched_msg" required >
									<small id="reg_sched_msgHelp" class="form-text r-opac8"></small>
								</div>
							</strong>
							<div class="modal-footer">
								<?php if ($ids!=''){ echo '<input type="hidden" value="'.$ids.'" name="ids">';   }  ?>
								<input type="hidden" value="<?=$_SESSION['name'];?>" name="creatorID">
								<input type="submit" class="btn btn-primary" name="update_reg_sched_msg" value="Update Message">
							</div>
						</form>
					</div>
				</div>
				
			</div>

        </div>
    </section>
</section>

