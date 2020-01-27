<?php
session_start();
include'dbconnection.php';

//result
// $result = mysqli_query($conn, "select * from users");
// checking session is valid for not 
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{

// for deleting user
if(isset($_GET['id']))
{
$adminid=$_GET['id'];
$msg=mysqli_query($con,"delete from users where id='$adminid'");
if($msg)
{
echo "<script>alert('Data deleted');</script>";
}
}
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link href = "postadmin/css/styles.css" rel = "stylesheet" type = "text/css">

    <title>Super Admin | Manage Users</title>
    <link rel = "stylesheet" type = "text/css" href = "https://fonts.googleapis.com/css?family=Raleway">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
 <style>
  .rightbox{
  text-align:right;
}
 </style>

  </head>

  <body>

  <section id="container" >
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <a href="#" class="logo"><b>Super Admin Dashboard</b></a>
            <div class="nav notify-row" id="top_menu">
               
                         
                   
                </ul>
            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="logout.php">Logout</a></li>
            	</ul>
            </div>
        </header>
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="#"><img src="assets/img/logo.jpg" class="img-circle" width="100"></a></p>
              	  <h5 class="centered"><?php echo $_SESSION['login'];?></h5>
              	  	
                  <li class="mt">
                      <a href="change-password.php">
                          <i class="fa fa-file"></i>
                          <span>Change Password</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="#" >
                          <i class="fa fa-users"></i>
                          <span>Status</span>
                      </a>
                   
                  </li>

                  <li class="sub-menu">
                      <a href="./request/home.php" >
                          <i class="fa fa-users"></i>
                          <span>Membership</span>
                      </a>
                   
                  </li>

                  <li class="sub-menu">
                      <a href="manage-users.php" >
                          <i class="fa fa-users"></i>
                          <span>Manage Users</span>
                      </a>
                   
                  </li>

                  <li class="sub-menu">
                      <a href="manage-admins.php" >
                          <i class="fa fa-users"></i>
                          <span>Manage Admin</span>
                      </a>
                   
                  </li>

                  <li class="sub-menu">
                      <a href="./postadmin/index.php" >
                          <i class="fa fa-users"></i>
                          <span>Announcement</span>
                      </a>
                   
                  </li>

                   <li class="sub-menu">
                      <a href="./poll/index.php" >
                          <i class="fa fa-users"></i>
                          <span>Polls</span>
                      </a>
                   
                  </li>
              
                 
              </ul>
          </div>
      </aside>
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Manage Users</h3>

<div class="rightbox">
<form action="result.php" method="get">
<input type="text" name="search" id="search">
<button type="submit">Search</button>
</form>
<br>
</div>

				<div class="row">
				
                  
	                  
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
	                  	  	  <h4><i class="fa fa-angle-right"></i> All User Details </h4>
	                  	  	  <hr>
                              <thead>
                              <tr>
                                  <th>id</th>
                                  <th> Email Id</th>
                                  <th>Expiration date</th>
                                  <th>Registered Date</th>
                                  <th> Current Status </th>
                                  <th>Update</th>

                              </tr>
                              </thead>
                              <tbody>
                              <?php 


                              $search = $_GET['search'];
                              $ret=mysqli_query($con,"SELECT * FROM users where email LIKE '%$search%' || expiry_date LIKE '%$search%' || posting_date LIKE '%$search%' || status LIKE '$search%'");
							  $cnt=1;
							  while($row=mysqli_fetch_array($ret))
							  {?>
                              <tr>
                              <td><?php echo $cnt;?></td>
                                  <td><?php echo $row['email'];?></td>
                                  <td><?php echo $date2 = $row['expiry_date'];?></td> 
                                  <td><?php echo $date1 = $row['posting_date'];?></td>
                                <!--  <td><?php if(strtotime(date("Y/m/d")) < strtotime($date2)) echo "Active"; else { echo "deactive";} ?></td> -->
                                   <td> 
                                    <?php
                                  if($row['status']=='active')
                                  {
                                    echo "<p id=str ".$row['id'].">active </p>";
                                  } else {
                                    echo "<p id=str ".$row['id'].">inactive</p>";
                                  }
                                  ?> 
                                  </td>
                                  <td>
                                     <select onchange="active_deactive_user(this.value,<?php echo $row['id'];?>)">
                                      <option value = "active">Active </option>
                                      <option value = "inactive">Inactive </option>
                                    </select>
                                  </td>
                              </tr>
                              <?php $cnt=$cnt+1; }?>
                             
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
		</section>
      </section
  ></section>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/common-scripts.js"></script>
  <script>
      $(function(){
          $('select.styled').customSelect();
      });

  </script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
<script type = "text/javascript">
  function active_deactive_user(val, id) {
    $.ajax ({
      type:'post',
      url:'change.php',
      data: {val:val,id:id},
      success: function(ret) {
        if(ret=='active') {
          $('#str'+id).html('active');
        } else {
          $('#str'+id).html('inactive');
        }
      }
    });
  }
</script>
  </body>
</html>
<?php } ?>

