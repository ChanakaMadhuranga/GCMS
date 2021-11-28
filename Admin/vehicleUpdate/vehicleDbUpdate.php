<?php
	include("../connection.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		//print_r($_POST);
		$uId 	= $_POST['uId'];
		$lPlate = $_POST['lPlate']; 

		$uIdLength = count($uId);
		$vidRoute=array();

		for ($i=0; $i<$uIdLength; $i++) {
			$uIdIndex 	= $uId[$i];
			$lPlateIndex = $lPlate[$i];
			
			$sql = "INSERT IGNORE INTO vehicle (v_id,v_no) VALUES ('$uIdIndex','$lPlateIndex')";
			$result = mysqli_query($connection,$sql);
		}
		$today = date("Y-m-d");
		$sql1 = "SELECT vehicle.v_id, schedule.route_name, schedule.garbage
				FROM vehicle
				INNER JOIN schedule ON vehicle.v_no=schedule.v_no
				WHERE schedule.date='$today'";

		$result1 = mysqli_query($connection,$sql1);
		
		if ($result1 && mysqli_num_rows($result1)>0) {
			while ($row = mysqli_fetch_assoc($result1)) {
		    //echo $row["v_id"];
		    //echo $row["route_name"];
		    array_push($vidRoute, $row["v_id"],$row["route_name"], $row["garbage"]);
			
			}
			echo json_encode($vidRoute);
			exit();
		}
		else{
			echo json_encode("No data");
		}

					
		
	
	}
?>