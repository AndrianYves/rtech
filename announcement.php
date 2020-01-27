<?php

$rtitle = 'Announcements | Technohouse'; //  set page title
$rtype = '';
include 'r.header.php';

$ret = mysqli_query($con,"select * from announcements"); 
$arr = array();
$activeCtr = 0;
while($row=mysqli_fetch_array($ret)){
	$arr[ $row['id'] ] = array( 'title'=>$row['title'],'descriptions'=>$row['descriptions'],'status'=>$row['status'],'image'=>$row['image'] );
	if( $row['status'] == 'active' ){ $activeCtr++; }
}

?>
<link href = "<?=RSITE;?>css/postmember.css" rel = "stylesheet" type = "text/css">
<link href = "<?=RSITE;?>assets/css/main.css" rel = "stylesheet" >

<section id="container" >

	<?php $bannertitle="Announcements";  include 'r.header.client.php'; ?>
	
	<div class = "content home">
		<?php if ($activeCtr==0): ?>
			<div class="row">
				<div class="content-panel r-bglightblue r-wid100">
					<div class="rsg-padTB5 text-center" style="padding-top:30px; padding-bottom:30px;">
						<strong style="font-size:20px;">NO ANNOUNCEMENTS POSTED</strong>
					</div>
				</div>
			</div>	
		<?php else: ?>
			<h2 style="font-weight:500;"> ANNOUNCEMENTS </h2>

			<table class="rsg-tbl r-wid100 tablesorter rsg-tblpaged r-marginauto" border=1>
				<thead>
					<!-- <th class="rsg-pad5" style="width:30px;"><div class="rsg-pad5">ID</div></th> -->
					<th class="rsg-pad5"><div class="rsg-pad5">Title</div></th>
					<th class="rsg-pad5"><div class="rsg-pad5">Description</div></th>
					<th class="rsg-pad5"><div class="rsg-pad5">Image</div></th>
				</thead>
				<tfoot>
					<th colspan="2">
						<div class="pager rsg-tblpager rsg-font12">
							<nav class="right r-col r-col100">
								<div class="txtCenter rsg-wid100">
									<button class="prev rsg-btn c-pink rsg-font12">
										<i class="fas fa-backward"></i> Prev&nbsp;
									</button>
									&emsp;<strong class="cssPageDisplay r-colwhite"></strong> &emsp;
									<button class="next rsg-btn c-pink rsg-font12">Next
										<i class="fas fa-forward next"></i>
									</button>
								</div>
							</nav>
						</div>
					</th>
				</tfoot>
				<tbody>
					<?php foreach( $arr as $k=>$a ):  if( $a['status'] == 'active' ):?>
					<tr>
						<td class="rsg-valign-mid"> <div class="rsg-padTB5 r-colblack"><?=$a['title'];?></div> </td>
						<td class="rsg-valign-mid"> <div class="rsg-padTB5 r-colblack"><?=$a['descriptions'];?></div> </td>
						<td class="rsg-valign-mid"><div class="rsg-padTB5 r-colblack"><img src="<?=RSITE;?>assets/postimage/<?=$a['image'];?>" class="img-circle" width="100"></a></div></td>
					</tr>
					<?php endif; endforeach; ?>

				</tbody>
			</table>
		<?php endif; ?>
	</div>

</section>

<?php include 'r.footer.php';