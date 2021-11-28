<?php
	include("connection.php");

	if( isset($_POST['u_nic_no']) )
		{
			print_r($_POST);
		     $u_nic_no = $_POST['u_nic_no'];
		     $u_nic_no = trim($u_nic_no,'"');
		     
		     $query = "UPDATE update_bin SET dispose_status = true WHERE u_nic_no = '$u_nic_no'";
		     mysqli_query($connection,$query);
		}
?>