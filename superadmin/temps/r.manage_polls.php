<?php

$arr = $rsg->site_polls($con);

$activeCtr = $archivedCtr = 0;
foreach( $arr as $as ){
	if( $as['pollstats']=='active' ){ $activeCtr++; }else{ $archivedCtr++; }
}

if( isset($_GET['display']) == 'archived' ): ?>

<section id="main-content">
	<section class="wrapper">
		
		<div class="container rsg-padTB20">
			<div class="row">
				<h3><i class="fas fa-arrow-circle-right"></i> Archived Polls </h3>
			</div>
			<div class="row text-right">
				<div class="modal-footer">
					<button class="btn btn-danger pollsActions" t="delAllArchived" i="0"><i class = "fa fa-trash"></i> &nbsp;Delete All</i></button>
				</div>
			</div>
			<?php if ($archivedCtr==0): ?>
				<div class="row">
					<div class="content-panel r-bglightblue">
						<div class="rsg-padTB5 text-center" style="padding-top:30px; padding-bottom:30px;">
							<strong style="font-size:20px;">NO ARCHIVED POLLS</strong>
						</div>
					</div>
				</div>	
			<?php else: ?>
				<div class="row">

					<div class="r-tbl">
						<table class="rsg-tbl r-wid100 tablesorter rsg-tblpaged r-marginauto r-pollsActions" border=1>
							<thead>
								<!-- <th style="width:30px;"><span>ID</span></th> -->
								<th style="width:100px;"><span>ID</span></th>
								<th><span>Title</span></th>   
								<th><span>Description</span></th>
								<th><span>Answers</span></th>
								<th><span>Actions</span></th>
							</thead>
							<tfoot>
								<th colspan="5">
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
								<?php foreach($arr as $k=> $a): if( $a['pollstats']=='archived' ): ?>
								<tr>
									<td class="rsg-valign-mid"> 
										<div class="rsg-padTB5">
											&emsp;<input type="checkbox" name="ActionCheckBox[]" class="custom-control-input ActionCheckBox" value="<?=$k;?>">&emsp;
											<?=$k;?>
										</div> 
									</td>
									<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$a['polltitle'];?></div> </td>
									<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$a['polldesc'];?></div> </td>
									<td class="rsg-valign-mid"> 
										<div class="rsg-padTB5">
											<table class="r-wid100">
												<thead>
													<th><div class="rsg-pad5">Title</div></th>
													<th class="text-center"><div class="rsg-pad5">Votes</div></th>
												</thead>
												<tbody>
													<?php foreach( $a['pollanswers'] as $ak=> $aa ): ?>
														<tr>
															<td class="rsg-valign-mid">
																<?=$aa['ansTitle'];?>
															</td>
															<td class="rsg-valign-mid text-center" style="width:20%;"> 
																<?=$aa['ansVotes'];?>
															</td>
														</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										</div> 
									</td>
									<td class="rsg-valign-mid text-center">
										<div class="rsg-padTB5">
											<button type="button" class="btn btn-danger btn-sm pollsActions" i="<?=$k;?>" t="delArchived"> <i class = "fa fa-trash"></i> &nbsp;Delete</button>
										</div>
									</td>
								</tr>
								<?php endif; endforeach; ?>


							</tbody>
						</table>
					</div>

				
				</div>
			<?php endif; ?>
		</div>
	</section>
</section>

<?php else: ?>	

<section id="main-content">
	<section class="wrapper">
		
		<div class="container rsg-padTB20">
			<div class="row">
				<h3><i class="fas fa-arrow-circle-right"></i> Polls </h3>
			</div>
			<div class="row text-right">
				<div class="modal-footer">
					<a class="btn btn-success createPost" href="<?=RSITE.RTYPE;?>/create-poll.php"><i class = "fa fa-tasks"></i> &nbsp;Create Poll</i></a>
					<button class="btn btn-danger announcementActions" i="0" t="pollsArchive"><i class = "fa fa-trash"></i> &nbsp;Archive All</i></button>
				</div>
			</div>
			<?php if ($activeCtr==0): ?>
				<div class="row">
					<div class="content-panel r-bglightblue">
						<div class="rsg-padTB5 text-center" style="padding-top:30px; padding-bottom:30px;">
							<strong style="font-size:20px;">NO POLLS POSTED</strong>
						</div>
					</div>
				</div>	
			<?php else: ?>
				<div class="row">
					<div class="r-tbl">
						<table class="rsg-tbl r-wid100 tablesorter rsg-tblpaged r-marginauto r-announcements" border=1>
							<thead>
								<!-- <th style="width:30px;"><span>ID</span></th> -->
								<th style="width:100px;"><span>ID</span></th>
								<th><span>Title</span></th>   
								<th><span>Description</span></th>
								<th><span>Answers</span></th>
								<th><span>Actions</span></th>
							</thead>
							<tfoot>
								<th colspan="5">
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
								<?php foreach($arr as $k=> $a): if( $a['pollstats']=='active' ): ?>
								<tr>
									<td class="rsg-valign-mid"> 
										<div class="rsg-padTB5">
											&emsp;<input type="checkbox" name="ActionCheckBox[]" class="custom-control-input ActionCheckBox" value="<?=$k;?>">&emsp;
											<?=$k;?>
										</div> 
									</td>
									<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$a['polltitle'];?></div> </td>
									<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$a['polldesc'];?></div> </td>
									<td class="rsg-valign-mid"> 
										<div class="rsg-padTB5">
											<table class="r-wid100">
												<thead>
													<th><div class="rsg-pad5">Title</div></th>
													<th class="text-center"><div class="rsg-pad5">Votes</div></th>
												</thead>
												<tbody>
													<?php foreach( $a['pollanswers'] as $ak=> $aa ): ?>
														<tr>
															<td class="rsg-valign-mid">
																<?=$aa['ansTitle'];?>
															</td>
															<td class="rsg-valign-mid text-center" style="width:20%;"> 
																<?=$aa['ansVotes'];?>
															</td>
														</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										</div> 
									</td>
									<td class="rsg-valign-mid text-center">
										<div class="rsg-padTB5">
											<button type="button" class="btn btn-danger btn-sm pollsActions" i="<?=$k;?>" t="arch"> <i class = "fa fa-trash"></i> &nbsp;Archive</button>
										</div>
									</td>
								</tr>
								<?php endif; endforeach; ?>


							</tbody>
						</table>
					</div>

				
				</div>
			<?php endif; ?>
		</div>
	</section>
</section>

<?php endif; ?>