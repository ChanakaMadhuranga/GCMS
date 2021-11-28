<?php 

	$dbhost = "localhost";
    $dbuser = "id16384321_root";
    $dbpass = "Password@group04";
    $dbname = "id16384321_gcms_db";

	$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

	// Checking the connection
	if (mysqli_connect_errno()) {
		die('Database connection failed ' . mysqli_connect_error());
	
	}

?>