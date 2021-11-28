<?php

include("connection.php");

$u_nic_no=$_GET['u_nic_no'];

$query="DELETE FROM user WHERE u_nic_no='$u_nic_no'";
$result=mysqli_query($connection,$query);

	if ($result) {
		echo "<meta http-equiv='refresh' content='0; register_info.php'>
              <script type=\"text/javascript\">
              alert(\"Successfully Removed!\");</script>";
	
	}
	
	

?>