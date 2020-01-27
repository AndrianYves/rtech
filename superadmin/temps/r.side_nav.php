<?php
?>
<aside>
	<div id="sidebar"  class="nav-collapse ">
		<ul class="sidebar-menu" id="nav-accordion">
		
			<p class="centered"><a href="#"><img src="<?=RSITE;?>assets/logo.jpg" class="img-circle" width="100"></a></p>
			<h5 class="centered"><?php echo $_SESSION['name'];?></h5>

			<li class="mt"> <a href="dashboard.php"> <i class="fa fa-cubes"></i> <span>Dashboard</span> </a> </li>

			<li class="sub-menu"> <a href="change-password.php"> <i class="fa fa-lock"></i> <span>Change Password</span> </a> </li>

			<li class="sub-menu"> <a href="change-content.php"> <i class="fa fa-file"></i> <span>Main Content</span> </a> </li>

			<li class="sub-menu">
				<a href="manage-users.php" >
					<i class="fa fa-users"></i>
					<span>Manage Users</span>
				</a>
				<ul style="padding-left: 20px;">
					<li> <a href="manage-users.php?manage=all" > <span>Users</span> </a> </li>
					<?php if( RTYPE=='superadmin' ): ?>
						<li> <a href="manage-users.php?manage=admins" > <span>Admin</span> </a> </li>
					<?php endif; ?>
					<li> <a href="manage-users.php?manage=students" > <span>Students</span> </a> </li>
					<li> <a href="manage-users.php?manage=requests" > <span>Requests</span> </a> </li>
				</ul>
			</li>

			<li class="sub-menu">
				<a href="manage-announcements.php" > <i class="fa fa-tasks"></i> <span>Announcements</span> </a>
				<ul style="padding-left: 20px;">
					<li> <a href="manage-announcements.php" > <span>Announcements</span> </a> </li>
					<li> <a href="<?=RSITE.RTYPE;?>/create-post.php" > <span>Create</span> </a> </li>
					<li> <a href="manage-announcements.php?display=archived" > <span>Archived</span> </a> </li>
				</ul>
			</li>

			<li class="sub-menu">
				<a href="manage-polls.php" > <i class="fa fa-tasks"></i> <span>Polls</span> </a>
				<ul style="padding-left: 20px;">
					<li> <a href="manage-polls.php" > <span>Polls</span> </a> </li>
					<li> <a href="<?=RSITE.RTYPE;?>/create-poll.php" > <span>Create</span> </a> </li>
					<li> <a href="manage-polls.php?display=archived" > <span>Archived</span> </a> </li>
				</ul>
			</li>

			<li class="sub-menu">
				<a href="registration-schedule.php" >
					<i class="fa fa-calendar"></i>
					<span>Reg Schedule</span>
				</a>
			</li>
		</ul>
	</div>
</aside>
