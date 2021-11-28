<?php
	include("connection.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		//print_r($_POST);
		$route_name	= $_POST['route_name'];
		//echo $route_name;
		if ($route_name == 'all') {
			$query1 = "SELECT SUM(plastic_not_sell) as plastic_not_sell,SUM(organic_not_sell) as organic_not_sell,SUM(polythene_not_sell) as polythene_not_sell,SUM(metal_not_sell) as metal_not_sell,SUM(paper_not_sell) as paper_not_sell,SUM(coconut_shell_not_sell) as coconut_shell_not_sell,SUM(glass_not_sell) as glass_not_sell,SUM(fabric_not_sell) as fabric_not_sell,SUM(e_waste_not_sell) as e_waste_not_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
		}else{
			$query1 = "SELECT SUM(plastic_not_sell) as plastic_not_sell,SUM(organic_not_sell) as organic_not_sell,SUM(polythene_not_sell) as polythene_not_sell,SUM(metal_not_sell) as metal_not_sell,SUM(paper_not_sell) as paper_not_sell,SUM(coconut_shell_not_sell) as coconut_shell_not_sell,SUM(glass_not_sell) as glass_not_sell,SUM(fabric_not_sell) as fabric_not_sell,SUM(e_waste_not_sell) as e_waste_not_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no where route = '$route_name'";
		}
		

			$result1 = mysqli_query($connection, $query1);

			$quantites1 = array();
			while($row1 = mysqli_fetch_array($result1))
			{
			  array_push($quantites1, doubleval($row1['plastic_not_sell']));

			  array_push($quantites1, doubleval($row1['organic_not_sell']));

			  array_push($quantites1, doubleval($row1['polythene_not_sell']));

			  array_push($quantites1, doubleval($row1['metal_not_sell']));

			  array_push($quantites1, doubleval($row1['paper_not_sell']));

			  array_push($quantites1, doubleval($row1['coconut_shell_not_sell']));

			  array_push($quantites1, doubleval($row1['glass_not_sell']));

			  array_push($quantites1, doubleval($row1['fabric_not_sell']));

			  array_push($quantites1, doubleval($row1['e_waste_not_sell']));  


			}
			echo json_encode($quantites1);
		
		}
		else{
			echo json_encode("No data");
		}				
		
?>