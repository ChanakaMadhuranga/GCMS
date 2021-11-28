<?php

include("connection.php");

$b_nic_num=$_GET['b_nic_num'];

$query="DELETE FROM buyers3 WHERE b_nic_num='$b_nic_num'";
$result=mysqli_query($connection,$query);

	if ($result) {
		echo "<meta http-equiv='refresh' content='0; b_info.php'>
            <script type=\"text/javascript\">
            alert(\"Successfully Removed!\");</script>";
	
	}
	
	

?>