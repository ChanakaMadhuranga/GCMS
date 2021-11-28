<?php

include("connection.php");

$w_NIC=$_GET['w_NIC'];

$query="DELETE FROM worker WHERE w_NIC='$w_NIC'";
$result=mysqli_query($connection,$query);

	if ($result) {
		echo "<meta http-equiv='refresh' content='0; info.php'>
            <script type=\"text/javascript\">
            alert(\"Successfully Removed!\");</script>";
	
	}
	
	

?>