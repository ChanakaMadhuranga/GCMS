<?php
    $dbhost = "localhost";
    $dbuser = "id16384321_root";
    $dbpass = "Password@group04";
    $dbname = "id16384321_gcms_db";
    
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if($conn->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
?>
