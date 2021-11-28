<?php
	
	include("connection.php");

		$u_nic_no = $_POST['u_nic_no'];
		$u_first_name = $_POST['u_first_name'];
		$u_last_name = $_POST['u_last_name'];
		$u_gender = $_POST['u_gender'];
		$u_email = $_POST['u_email'];
		$u_division = $_POST['u_division'];
		$u_address_no = $_POST['u_address_no'];
		$u_street = $_POST['u_street'];
		$u_city = $_POST['u_city'];
		$u_contact_no1 = $_POST['u_contact_no1'];
		$u_contact_no2 = $_POST['u_contact_no2'];
		$u_longitude = $_POST['u_longitude'];
		$u_latitude = $_POST['u_latitude'];
		$u_joined_date = $_POST['u_joined_date'];
		
		$query="UPDATE user  SET u_nic_no='$u_nic_no',u_first_name='$u_first_name',u_last_name='$u_last_name',u_gender='$u_gender',u_email='$u_email',u_division='$u_division', u_address_no='$u_address_no',u_street='$u_street',u_city='$u_city',u_contact_no1='$u_contact_no1', u_contact_no2='$u_contact_no2', u_longitude='$u_longitude', u_latitude='$u_latitude', u_joined_date='$u_joined_date' WHERE u_nic_no='$u_nic_no'";

		$result=mysqli_query($connection,$query);

		if ($result) {
			echo "<meta http-equiv='refresh' content='0; register_info.php'>";
		}
?>