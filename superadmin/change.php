<?php

require('dbconnection.php');
$query = mysqli_query($con, "Update users set status='".$_POST['val']."' where id = '".$_POST['id']."' ");
	
if($query)
{
	$q = mysqli_query($con, "Select * from users where id = '".$_POST ['id']."' ");
	$data = mysqli_fetch_assoc($query);
	echo $data['$status'];
}
?>