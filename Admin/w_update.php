<?php
	
	include("connection.php");

		$w_fname = $_POST['w_fname'];
		$w_lname = $_POST['w_lname'];
		$district = $_POST['district'];
		$w_NIC = $_POST['w_NIC'];
		$Address_number = $_POST['Address_number'];
		$Address_street = $_POST['Address_street'];
		$Address_city = $_POST['Address_city'];
		$w_contact_no1 = $_POST['w_contact_no1'];
		$w_contact_no2 = $_POST['w_contact_no2'];
		$w_post = $_POST['w_post'];
		$w_joined_date = $_POST['w_joined_date'];
		$w_profile_photo = $_FILES['w_profile_photo'];
		$w_NIC_photo = $_FILES['w_NIC_photo'];

		$query="UPDATE worker  SET w_fname='$w_fname',w_lname='$w_lname',district='$district',w_NIC='$w_NIC',Address_number='$Address_number',Address_street='$Address_street', Address_city='$Address_city',w_contact_no1='$w_contact_no1',w_contact_no2='$w_contact_no2',w_post='$w_post',w_joined_date='$w_joined_date',w_profile_photo='$w_profile_photo', w_NIC_photo='$w_NIC_photo' WHERE w_NIC='$w_NIC'";
		$result=mysqli_query($connection,$query);
		
		if ($result) {
			echo "<meta http-equiv='refresh' content='0; info.php'>";
		}
?>