<?php
$rtitle = 'Homepage | Technohouse'; //  set page title
$rtype = '';
include 'r.header.php';
?>

<link href = "<?=RSITE;?>css/postmember.css" rel = "stylesheet" type = "text/css">
<link href = "<?=RSITE;?>assets/css/main.css" rel = "stylesheet" >
<link rel = "stylesheet" type = "text/css" href = "https://fonts.googleapis.com/css?family=Raleway">
<!-- <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet" />
<section id="container" >

		<?php include 'r.header.client.php'; ?>

		<!-- One -->
			<section id="one" class="wrapper">
				<div class="inner">
					<div class="flex flex-3">
						<article>
							<header> <h3>Mission</h3> </header>
							<p><?=$rsg->site_options($con,'mission'); ?></p>
						</article>
						<article>
							<header> <h3>Vision</h3> </header>
							<p><?=$rsg->site_options($con,'vision'); ?></p>
						</article>
						<article>
							<header> <h3>Goals</h3> </header>
							<p><?=$rsg->site_options($con,'goals'); ?></p>
						</article>
					</div>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style1 special">
				<div class="inner">
					<header>
						<h2>Organization</h2>
					</header>
					<div class="flex flex-4">
						<div class="box person">
							<div class="image round">
								<img src="images/pic03.jpg" alt="Person 1" />
							</div>
							<h3>Mark Abuzo</h3>
							<p>President</p>
						</div>
						<div class="box person">
							<div class="image round">
								<img src="images/pic04.jpg" alt="Person 2" />
							</div>
							<h3>Josh Siababa</h3>
							<p>Vice-President</p>
						</div>
						<div class="box person">
							<div class="image round">
								<img src="images/pic05.jpg" alt="Person 3" />
							</div>
							<h3>Laurence Bernardo</h3>
							<p>Secretary</p>
						</div>
						<div class="box person">
							<div class="image round">
								<img src="images/pic06.jpg" alt="Person 4" />
							</div>
							<h3>Frank Torio</h3>
							<p>Treasurer</p>
						</div>
					</div>
				</div>
			</section>

		<!-- Three -->
			<section id="three" class="wrapper special">
				<div class="inner">
					<header class="align-center">
						<h2>EVENTS</h2>
					</header>
					<div class="flex flex-2">
						<article>
							<div class="image fit">
								<img src="images/pic01.jpg" alt="Pic 01" height="300px" />
							</div>
							<header>
								<h3>Sport festival 2019</h3>
							</header>
							<p>Last year sport fest was held at navybase baguio city.</p>
						</article>
						<article>
							<div class="image fit">
								<img src="images/pic02.jpg" alt="Pic 02" height="300px" />
							</div>
							<header>
								<h3>Techno House in lanter parade</h3>
							</header>
							<p>First time in history the organization joins SLU lantern parade 2019.</p>
						</article>
					</div>
				</div>
			</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<div class="flex">
						<ul class="icons">
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						</ul>
					</div>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

</section>

<?php include 'r.footer.php';