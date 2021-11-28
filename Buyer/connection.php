<?php

    $dbhost = "localhost";
    $dbuser = "id16384321_root";
    $dbpass = "Password@group04";
    $dbname = "id16384321_gcms_db";

    if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
    {
    	die("Failed to connect!");
    }

?>

