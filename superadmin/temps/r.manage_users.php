<?php

$ret = mysqli_query($con,"select * from users where status<>'pending'");
$req = mysqli_query($con,"select * from users where status='pending'");
$adm = mysqli_query($con,"select * from admin where type = 'admin'");
$sArr = $aArr = $rArr = array();
$sCtr = $aCtr = $rCtr = 0;
while($row=mysqli_fetch_array($ret)){
	$sArr[$row['id']] = array('id_number'=>$row['id_number'],'fname'=>$row['fname'], 'lname'=>$row['lname'], 'course'=>$row['course'],'date'=>date('M d,Y', strtotime($row['posting_date']) ),'status'=>$row['status'] );
	$sCtr++;
}

while($row=mysqli_fetch_array($adm)){
	$aArr[$row['id']] = array('username'=>$row['username'],'reg_date'=>date('M d,Y h:i', strtotime($row['reg_date']) ), 'stat'=>$row['stat'] );
	$aCtr++;
}

while($row=mysqli_fetch_array($req)){
	$rArr[$row['id']] = array('id_number'=>$row['id_number'],'fname'=>$row['fname'], 'lname'=>$row['lname'], 'course'=>$row['course'],'date'=>date('M d,Y', strtotime($row['posting_date']) ),'status'=>$row['status'] );
	$rCtr++;
}

$pa = 'Manage Users';
if( isset($_GET['manage']) ){
	if( $_GET['manage']=='admins' ){
		$pa = 'Manage Administrators';
	}elseif($_GET['manage']=='students' ){
		$pa = 'Manage Students';
	}elseif($_GET['manage']=='requests' ){
		$pa = 'Manage Requests';
	}else{
		$pa = 'Manage Users';
	}
}else{
	header("Location: ".RSITE.RTYPE.'/manage-users.php?manage=all');
	exit;
}
?>

<section id="main-content">
	<section class="wrapper">
		
		<div class="container rsg-padTB20">

			<!-- ADMINISTRaTORS -->
			<?php if( ($rtype == 'superadmin' || RTYPE=='superadmin') && ( $pa=='Manage Administrators' || $pa=='Manage Users' ) ): ?>
			<div class="row">
				<h3><i class="fas fa-arrow-circle-right"></i> Manage Administrators</h3>
			</div>
			<div class="row text-right">
				<div class="modal-footer">
					<button class="btn btn-success AllStatBtnNoModal" t="acti_all" g="admi">Activate All</i></button>
					<button class="btn btn-danger AllStatBtnNoModal" t="deac_all" g="admi">Deactivate All</i></button>
				</div>
			</div>
			<div class="row">

				<div class="r-tbl">
					<table class="rsg-tbl r-wid100 tablesorter rsg-tblpaged r-marginauto r-adminusers" border=1>
						<thead>
							<th><span>Username</span></th>   
							<th><span>Registered Date</span></th>
							<th><span>Status</span></th>
							<th><span>Action</span></th>
						</thead>
						<tfoot>
							<th colspan="4">
								<div class="pager rsg-tblpager rsg-font12">
									<nav class="right r-col r-col100">
										<div class="txtCenter rsg-wid100">
											<button class="prev rsg-btn c-pink rsg-font12">
												<i class="fas fa-backward"></i> Prev&nbsp;
											</button>
											&emsp;<strong class="cssPageDisplay"></strong> &emsp;
											<button class="next rsg-btn c-pink rsg-font12">Next
												<i class="fas fa-forward next"></i>
											</button>
										</div>
									</nav>
								</div>
							</th>
						</tfoot>
						<tbody>
							<?php if ($aCtr==0): ?>
								<tr>
									<td colspan="7">
										<div class="rsg-padTB5 text-center" style="padding-top:30px; padding-bottom:30px;">
											<strong style="font-size:20px;">NO RECORDS</strong>
										</div>
									</td>
								</tr>	
							<?php endif; ?>
							<?php foreach($aArr as $k=> $a): ?>
							<tr>
								<td class="rsg-valign-mid"> 
									<div class="rsg-padTB5">
										&emsp;<input type="checkbox" name="ActionCheckBox[]" class="custom-control-input ActionCheckBox" value="<?=$k;?>">&emsp;
										<?=$a['username'];?>
									</div> 
								</td>
								<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$a['reg_date'];?></div> </td>
								<td class="rsg-valign-mid"> <div class="rsg-padTB5 adminStat" i="<?=$k;?>"><?=$a['stat'];?></div> </td>
								<td class="rsg-valign-mid">
									<div class="rsg-padTB5">
										<?php 
										if( $a['stat']  == 'active') {
											echo '<button class="btn btn-danger btn-xs adminStatBtn" i="'.$k.'" t="deac">Deactivate</i></button>';
										}else{
											echo '<button class="btn btn-success btn-xs adminStatBtn" i="'.$k.'" t="acti">Activate</i></button>';
										}
										?>
									</div>
								</td>
							</tr>
							<?php endforeach; ?>


						</tbody>
					</table>
				</div>

			
			</div>
			<?php endif; ?>
			

			<!-- ACTIVE / INACTIVE sTUDENTS -->
			<?php if( $pa=='Manage Students' || $pa=='Manage Users' ): ?>
			<div class="row"><hr></div>
			<div class="row">
				<h3><i class="fas fa-arrow-circle-right"></i> Manage Students</h3>
			</div>
			<div class="row text-right">
				<div class="modal-footer">
					<button class="btn btn-success AllStatBtnNoModal" t="acti_all" g="stud">Activate All</i></button>
					<button class="btn btn-danger AllStatBtnNoModal" t="deac_all" g="stud">Deactivate All</i></button>
				</div>
			</div>
			<div class="row">

				<div class="r-tbl">
					<table class="rsg-tbl r-wid100 tablesorter rsg-tblpaged r-marginauto r-studusers" border=1>
						<thead>
							<th><span>ID No.</span></th>   
							<th><span>First Name</span></th>
							<th><span>Last Name</span></th>   
							<th><span>Course-Year</span></th>   
							<th><span>Reg Date</span></th>
							<th><span>Status</span></th>
							<th><span>Action</span></th>
						</thead>
						<tfoot>
							<th colspan="7">
								<div class="pager rsg-tblpager rsg-font12">
									<nav class="right r-col r-col100">
										<div class="txtCenter rsg-wid100">
											<button class="prev rsg-btn c-pink rsg-font12">
												<i class="fas fa-backward"></i> Prev&nbsp;
											</button>
											&emsp;<strong class="cssPageDisplay"></strong> &emsp;
											<button class="next rsg-btn c-pink rsg-font12">Next
												<i class="fas fa-forward next"></i>
											</button>
										</div>
									</nav>
								</div>
							</th>
						</tfoot>
						<tbody>
							<?php if ($sCtr==0): ?>
								<tr>
									<td colspan="7">
										<div class="rsg-padTB5 text-center" style="padding-top:30px; padding-bottom:30px;">
											<strong style="font-size:20px;">NO RECORDS</strong>
										</div>
									</td>
								</tr>	
							<?php endif; ?>
							<?php $cnt=1; foreach( $sArr as $k=>$s ): ?>
							<tr>
								<td class="rsg-valign-mid"> 
									<div class="rsg-padTB5">
										&emsp;<input type="checkbox" name="ActionCheckBox[]" class="custom-control-input ActionCheckBox" value="<?=$k;?>">&emsp;
										<?=$s['id_number'];?>
									</div> 
								</td>
								<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$s['fname'];?></div> </td>
								<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$s['lname'];?></div> </td>
								<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$s['course'];?></div> </td>
								<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$s['date'];?></div> </td>
								<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$s['status'];?></div> </td>
								<td class="rsg-valign-mid">
									<div class="rsg-padTB5">
										<?php 
										if( $s['status']  == 'active') {
											echo '<button class="btn btn-danger btn-xs studentStatBtn" i="'.$k.'" t="deac">Deactivate</i></button>';
										}else{
											echo '<button class="btn btn-success btn-xs studentStatBtn" i="'.$k.'" t="acti">Activate</i></button>';
										}
										?>
										<a href="update-profile.php?uid=<?= $k;?>"> <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
										<a href="manage-users.php?id=<?= $k;?>"> <button class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete');"><i class="fa fa-trash-o "></i></button></a>
									</div>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

			
			</div>
			<?php endif; ?>

			<!-- PENDING REQUESTS -->
			<?php if( $pa=='Manage Requests' || $pa=='Manage Users' ): ?>
			<div class="row"><hr></div>
			<div class="row">
				<h3><i class="fas fa-arrow-circle-right"></i> Manage Requests</h3>
			</div>
			<div class="row text-right">
				<div class="modal-footer">
					<button class="btn btn-success AllStatBtnNoModal" t="acti_all" g="pending">Accept All</i></button>
				</div>
			</div>
			<div class="row">

				<div class="r-tbl">
					<table class="rsg-tbl r-wid100 tablesorter rsg-tblpaged r-marginauto r-pendingusers" border=1>
						<thead>
							<th><span>ID No.</span></th>   
							<th><span>First Name</span></th>
							<th><span>Last Name</span></th>   
							<th><span>Course-Year</span></th>   
							<th><span>Reg Date</span></th>
							<th><span>Status</span></th>
							<th><span>Action</span></th>
						</thead>
						<tfoot>
							<th colspan="7">
								<div class="pager rsg-tblpager rsg-font12">
									<nav class="right r-col r-col100">
										<div class="txtCenter rsg-wid100">
											<button class="prev rsg-btn c-pink rsg-font12">
												<i class="fas fa-backward"></i> Prev&nbsp;
											</button>
											&emsp;<strong class="cssPageDisplay"></strong> &emsp;
											<button class="next rsg-btn c-pink rsg-font12">Next
												<i class="fas fa-forward next"></i>
											</button>
										</div>
									</nav>
								</div>
							</th>
						</tfoot>
						<tbody>
							<?php if ($rCtr==0): ?>
								<tr>
									<td colspan="7">
										<div class="rsg-padTB5 text-center" style="padding-top:30px; padding-bottom:30px;">
											<strong style="font-size:20px;">NO RECORDS</strong>
										</div>
									</td>
								</tr>	
							<?php endif; ?>
							<?php foreach( $rArr as $k=>$s ): ?>
							<tr>
								<td class="rsg-valign-mid"> 
									<div class="rsg-padTB5">
										&emsp;<input type="checkbox" name="ActionCheckBox[]" class="custom-control-input ActionCheckBox" value="<?=$k;?>">&emsp;
										<?=$s['id_number'];?>
									</div> 
								</td>
								<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$s['fname'];?></div> </td>
								<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$s['lname'];?></div> </td>
								<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$s['course'];?></div> </td>
								<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$s['date'];?></div> </td>
								<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$s['status'];?></div> </td>
								<td class="rsg-valign-mid">
									<div class="rsg-padTB5">
										<?php echo '<button class="btn btn-success btn-xs studentStatBtn" i="'.$k.'" t="acti">Accept</i></button>'; ?>
										<a href="manage-users.php?id=<?= $k;?>"> <button class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete');"><i class="fa fa-trash-o "></i></button></a>
									</div>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

			
			</div>
			<?php endif; ?>

		</div>

	</section>
</section>


<div class="rsg_popup allstatuschange">
	<div class="rsg_BlackBG5"></div>
	<div class="customContainer rsgPopupContainer">
		<div class="col- col-100 flex-wrap">
			<h1><b>Update all status</b></h1>
		</div>
		<div class="rsgBlock">
			<label> Please select which status to change. </label>
		</div>
		<div class="rsgBlock">
			<hr>
			
			<button class="rsgBtn dark-blue" type="button" g="stud"> Students </button>
			<button class="rsgBtn dark-blue" type="button" g="admi"> Administrators </button>
			<button class="rsgBtn dark-blue" type="button" g="alls"> All Users </button>

			<button class="rsgBtn pink rsg_closePopup" type="button"> Cancel </button>
		</div>
	</div>
</div>