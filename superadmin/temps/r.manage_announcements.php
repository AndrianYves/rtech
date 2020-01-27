<?php

$ret = mysqli_query($con,"select * from announcements");
$arr = array();
$activeCtr = $archivedCtr = 0;
while($row=mysqli_fetch_array($ret)){
	$arr[ $row['id'] ] = array( 'title'=>$row['title'],'descriptions'=>$row['descriptions'],'status'=>$row['status'] );
	if( $row['status'] == 'archived' ){ $archivedCtr++; }else{ $activeCtr++; }
}
// ARCHIVED POSTS
if( isset($_GET['display']) == 'archived' ): ?>

	

	<section id="main-content">
		<section class="wrapper">
			
			<div class="container rsg-padTB20">
				<div class="row">
					<h3><i class="fas fa-arrow-circle-right"></i> Archived Announcements/Posts </h3>
				</div>
				<div class="row text-right">
					<div class="modal-footer">
						<button class="btn btn-danger announcementActions" i="0" t="delAllArchived"><i class = "fa fa-trash"></i> &nbsp;Delete All Archived</i></button>
					</div>
				</div>
				<div class="row"><p>Note: Please be advised that deleting here will delete the post/s permanently.</p></div>
				<?php if ($archivedCtr==0): ?>
					<div class="row">
						<div class="content-panel r-bglightblue">
							<div class="rsg-padTB5 text-center" style="padding-top:30px; padding-bottom:30px;">
								<strong style="font-size:20px;">NO ARCHIVED ANNOUNCEMENTS</strong>
							</div>
						</div>
					</div>	
				<?php else: ?>

					<div class="row">

						<div class="r-tbl">
							<table class="rsg-tbl r-wid100 tablesorter rsg-tblpaged r-marginauto r-announcements" border=1>
								<thead>
									<th style="width:100px;" class="text-center"><span>ID</span></th>
									<th><span>Title</span></th>   
									<th><span>Description</span></th>
									<th style="width:100px;"><span>Action</span></th>
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
									<?php foreach( $arr as $k=>$a ):  if( $a['status'] == 'archived' ):?>

									<tr>
										<td class="rsg-valign-mid text-center"> 
											<div class="rsg-padTB5">
												&emsp;<input type="checkbox" name="ActionCheckBox[]" class="custom-control-input ActionCheckBox" value="<?=$k;?>">&emsp;
												<?=$k;?>
											</div> 	
										</td>
										<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$a['title'];?></div> </td>
										<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$a['descriptions'];?></div> </td>
										<td class="rsg-valign-mid text-center">
											<div class="rsg-padTB5">
												<button type="button" class="btn btn-danger btn-sm announcementActions" i="<?=$k;?>" t="delArchived"> <i class = "fa fa-trash"></i> &nbsp;Delete</button>
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
				<h3><i class="fas fa-arrow-circle-right"></i> Announcements </h3>
			</div>
			<div class="row text-right">
				<div class="modal-footer">
					<a href="<?=RSITE.RTYPE;?>/create-post.php" class="btn btn-success createPost"><i class = "fa fa-tasks"></i> &nbsp;Create Post</a>
					<button class="btn btn-danger announcementActions" i="0" t="delAll"><i class = "fa fa-trash"></i> &nbsp;Archive All</i></button>
					<button class="btn btn-info announcementActions" i="0" t="hideAll">Hide All</i></button>
					<button class="btn btn-info announcementActions" i="0" t="showAll">Show All</i></button>
				</div>
			</div>
			<div class="row"><p>Note: Posts with hidden status will not be displayed at the <a href="<?=RSITE;?>announcement.php" target='_blank'><strong>announcements page</strong></a>. Archiving a post will not delete the post. To delete posts permanently, please go to <a href="?display=archived"><strong>Archived Announcements</strong></a>.</p></div>
			<?php if ($activeCtr==0): ?>
				<div class="row">
					<div class="content-panel r-bglightblue">
						<div class="rsg-padTB5 text-center" style="padding-top:30px; padding-bottom:30px;">
							<strong style="font-size:20px;">NO ANNOUNCEMENTS POSTED</strong>
						</div>
					</div>
				</div>	
			<?php else: ?>
				<div class="row">

					<div class="r-tbl">
						<table class="rsg-tbl r-wid100 tablesorter rsg-tblpaged r-marginauto r-announcements" border=1>
							<thead>
								<th style="width:100px;" class="text-center"><span>ID</span></th>
								<th><span>Title</span></th>   
								<th><span>Description</span></th>
								<th><span>Status</span></th>
								<th><span>Action</span></th>
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
								<?php foreach( $arr as $k=>$a ):  if( $a['status'] != 'archived' ):?>
								<tr>
									<td class="rsg-valign-mid text-left"> 
										<div class="rsg-padTB5">
											&emsp;<input type="checkbox" name="ActionCheckBox[]" class="custom-control-input ActionCheckBox" value="<?=$k;?>">&emsp;
											<?=$k;?>
										</div> 
									</td>
									<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$a['title'];?></div> </td>
									<td class="rsg-valign-mid"> <div class="rsg-padTB5"><?=$a['descriptions'];?></div> </td>
									<td class="rsg-valign-mid"> <div class="rsg-padTB5 <?=$a['status']=='inactive'?'r-colred':'';?>"><strong><?=$a['status']=='inactive'?'Hidden':'Displayed';?></strong></div> </td>
									<td class="rsg-valign-mid text-center">
										<div class="rsg-padTB5">
											<button type="button" class="btn btn-danger btn-sm announcementActions" i="<?=$k;?>" t="del"> <i class = "fa fa-trash"></i> &nbsp;Archive</button>
											<button type="button" class="btn btn-primary btn-sm announcementActions" i="<?=$k;?>" t="<?=($a['status']=='inactive')?'sho':'hid';?>"><?=($a['status']=='inactive')?'Show':'Hide';?></button>'
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

