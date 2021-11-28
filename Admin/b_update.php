<?php
	
	include("connection.php");

		$b_nic_num = $_POST['b_nic_num'];
		$b_fname = $_POST['b_fname'];
		$b_lname = $_POST['b_lname'];
		$b_gender = $_POST['b_gender'];
		$b_email = $_POST['b_email'];
		$b_address = $_POST['b_address'];
		$b_contact_num = $_POST['b_contact_num'];
		$b_company_n = $_POST['b_company_n'];
		$b_caddress_no = $_POST['b_caddress_no'];
		$b_street = $_POST['b_street'];
		$b_city = $_POST['b_city'];
		$b_cemail = $_POST['b_cemail'];
		$b_ccontact_num = $_POST['b_ccontact_num'];
		$b_garbage = $_POST['b_garbage'];

						
		$query="UPDATE buyers3  SET b_nic_num='$b_nic_num',b_fname='$b_fname',b_lname='$b_lname',b_gender='$b_gender',b_email='$b_email',b_address='$b_address',b_contact_num='$b_contact_num',b_company_n='$b_company_n',b_caddress_no='$b_caddress_no',b_street='$b_street',b_city='$b_city',b_cemail='$b_cemail',b_ccontact_num='$b_ccontact_num', b_garbage='$b_garbage' WHERE b_nic_num='$b_nic_num'";

		$result=mysqli_query($connection,$query);

		if ($result) {
			echo "<meta http-equiv='refresh' content='0; b_info.php'>";

		}
?>
