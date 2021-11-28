<?php
	include("..\inc\connection.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		//print_r($_POST);
		// $bId 	= $_POST['bId'];
		// $bLPlate = $_POST['bLPlate']; 

		//$bIdLength = count($bId);
		$array1=array();
		$bShedule=array();

		// for ($i=0; $i<$bIdLength; $i++) {
		// 	$bIdIndex 	= $bId[$i];
		// 	$bLPlateIndex = $bLPlate[$i];
			
		// 	$sql = "INSERT IGNORE INTO `buyer_vehicle`(b_v_id, b_v_no) VALUES ('$bIdIndex','$bLPlateIndex')";
		// 	$result = mysqli_query($connection,$sql);
		// 	//echo "Successfully";
		// }
		
		$sql1 = "SELECT buyer_vehicle.b_v_id, buyers3.b_nic_num
				FROM buyer_vehicle
				INNER JOIN buyers3 ON buyer_vehicle.b_v_no=buyers3.b_v_no";

		$result1 = mysqli_query($connection,$sql1);
		
		if ($result1 && mysqli_num_rows($result1)>0) {
			while ($row1 = mysqli_fetch_assoc($result1)) {
		    	array_push($array1, $row1["b_v_id"],$row1["b_nic_num"]);
			//echo '<br>';
			}
			
		}
		else{
			echo "No data";
		}

		
		$today = date("Y-m-d");
		//echo $today;
		$sql2 = "SELECT DISTINCT buyers3.b_v_no, cart.b_nic_num, cart.u_nic_no, cart.date
				FROM buyers3
				INNER JOIN cart ON buyers3.b_nic_num=cart.b_nic_num
				WHERE cart.date='$today'";

		$result2 = mysqli_query($connection,$sql2);
		
		if ($result2 && mysqli_num_rows($result2)>0) {
			while ($row2 = mysqli_fetch_assoc($result2)) {   
		   
		    if (in_array($row2["b_nic_num"], $array1))
			{
			  //echo "Match found";
			  $index_b_nic_num = array_search($row2["b_nic_num"], $array1);
			  $index_b_v_id = $index_b_nic_num - 1;
			  $b_v_id =  $array1[$index_b_v_id];
			  array_push($bShedule, $b_v_id, $row2["b_nic_num"], $row2["b_v_no"], $row2["u_nic_no"], $row2["date"]);
			}
		    
			}
		echo json_encode($bShedule);
		exit();	
		}
		else{
			echo json_encode("No Buyers");
		}
				
	
	}