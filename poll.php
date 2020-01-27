<?php
$rtitle = 'Polls | Technohouse'; //  set page title
$rtype = '';
include 'r.header.php';

$arr = $rsg->site_polls($con); 
$activeCtr = 0;
foreach( $arr as $as ){
	if( $as['pollstats']=='active' ){ $activeCtr++; }
}

?>
<link href = "<?=RSITE;?>css/postmember.css" rel = "stylesheet" type = "text/css">
<link href = "<?=RSITE;?>assets/css/main.css" rel = "stylesheet" >

<section id="container" >

	<?php $bannertitle="Polls";  include 'r.header.client.php'; ?>
	
	<div class = "content home">
		<?php if ($activeCtr==0): ?>
				<div class="row">
					<div class="content-panel r-bglightblue r-wid100">
						<div class="rsg-padTB5 text-center" style="padding-top:30px; padding-bottom:30px;">
							<strong style="font-size:20px;">NO POLLS POSTED</strong>
						</div>
					</div>
				</div>	
		<?php else: ?>
			<h2 style="font-weight:500;"> CHOOSE AMONG THE GIVEN CHOICES: </h2>

			<table class="rsg-tbl r-wid100 tablesorter rsg-tblpaged r-marginauto" border=1>
				<thead>
					<th class="rsg-pad5" style="width:100px;"><div class="rsg-pad5">#</div></th>
					<th class="rsg-pad5"><div class="rsg-pad5">Title</div></th>
					<th class="rsg-pad5"><div class="rsg-pad5">Question</div></th>
					<th class="rsg-pad5" style="width:100px;"><div class="rsg-pad5">Vote</div></th>
				</thead>
				<tfoot>
					<th colspan="4">
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

					<?php foreach($arr as $k=> $a): if( $a['pollstats']=='active' ):?>
					<tr>
						<td class="rsg-valign-mid" style="width:50px;"> <div class="rsg-padTB5 r-colblack text-center"><?=$k;?></div> </td>
						<td class="rsg-valign-mid"> <div class="rsg-padTB5 r-colblack"><?=$a['polltitle'];?></div> </td>
						<td class="rsg-valign-mid"> <div class="rsg-padTB5 r-colblack"><?=$a['polldesc'];?></div> </td>
						<td class="rsg-valign-mid actions"> 
							<div class="rsg-padTB5 r-colblack text-center">
								<a href = "pollmember/vote.php?id=<?=$k;?>" class = "view" title = "Vote">
									<i class = "fa fa-thumbs-up"></i>
								</a>
							</div> 
						</td>
					</tr>
					<?php endif; endforeach; ?>

				</tbody>
			</table>
		<?php endif; ?>
	</div>

</section>

<?php include 'r.footer.php';