<?php
	session_start();
	require 'config.php';


	$user_id=$_SESSION['user_id'];
	$queryb = mysqli_query($conn,"SELECT b_nic_num FROM buyers3 WHERE user_id='$user_id' "); 
  
  while($row_b = mysqli_fetch_assoc($queryb))
			  {
		   
  
  
  $b11=$row_b['b_nic_num'];
 // echo $b11;
	  
		}





	// Add products into the cart table
	if (isset($_POST['pname'])) {
	 
	  $pname = $_POST['pname'];
	  $pprice = $_POST['pprice'];
	  $route=$_POST['route'];
	  $pcode = $_POST['pcode'];
	  $pqty = $_POST['pqty'];
	  $u_nic_no=$_POST['u_nic_no'];
	  $b_nic_num=$_POST['b_nic_num'];
	 $date= $_POST['date'];
	 $time= null;                       //$_POST['time'];
	  $total_price = $pprice * $pqty;



	  $stmt = $conn->prepare('SELECT g_code FROM cart WHERE g_code=?');
	  $stmt->bind_param('s',$pcode);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $code = $r['g_code'] ?? '';

	  if (!$code) {
	    $query = $conn->prepare('INSERT INTO cart(g_name,g_price,qty,total_price,g_code,u_nic_no,b_nic_num,date,time,route) VALUES (?,?,?,?,?,?,?,?,?,?)');
	    $query->bind_param('ssssssssss',$pname,$pprice,$pqty,$total_price,$pcode,$u_nic_no,$b_nic_num,$date,$time,$route);
	    $query->execute();


	    if ($pname == 'Plastic') {
		$query = "UPDATE update_bin SET plastic_sell = plastic_sell - '$pqty' WHERE u_nic_no = '$u_nic_no'";
		}elseif ($pname == 'Paper') {
			$query = "UPDATE update_bin SET paper_sell = paper_sell - '$pqty' WHERE u_nic_no = '$u_nic_no'";
		}elseif ($pname == 'Ewaste') {
			$query = "UPDATE update_bin SET e_waste_sell = e_waste_sell - '$pqty' WHERE u_nic_no = '$u_nic_no'";
		}elseif ($pname == 'Fabric') {
			$query = "UPDATE update_bin SET fabric_sell = fabric_sell - '$pqty' WHERE u_nic_no = '$u_nic_no'";
		}elseif ($pname == 'Coconut_shell') {
			$query = "UPDATE update_bin SET coconut_shell_sell = coconut_shell_sell - '$pqty' WHERE u_nic_no = '$u_nic_no'";
		}elseif ($pname == 'Metal') {
			$query = "UPDATE update_bin SET metal_sell = metal_sell - '$pqty' WHERE u_nic_no = '$u_nic_no'";
		}elseif ($pname == 'Polythene') {
			$query = "UPDATE update_bin SET polythene_sell = polythene_sell - '$pqty' WHERE u_nic_no = '$u_nic_no'";
		}elseif ($pname == 'Glass') {
			$query = "UPDATE update_bin SET glass_sell = glass_sell - '$pqty' WHERE u_nic_no = '$u_nic_no'";
		}elseif ($pname == 'Organic') {
			$query = "UPDATE update_bin SET organic_sell = organic_sell - '$pqty' WHERE u_nic_no = '$u_nic_no'";
		}
		echo '<meta http-equiv="refresh" content="0">';
		// $stmt = $conn->prepare($query);
		// $stmt->execute();
		$result = mysqli_query($conn,$query);
		if ($result) {
			//echo "success";
		}else{
			//echo "error";
		}


	    

	    echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your List!</strong>
				</div>';
	  } else {
	    echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your List!</strong>
				</div>';
	  }
	}






	
	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	  $stmt = $conn->prepare("SELECT * FROM cart where b_nic_num='$b11'");
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}

	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  $query = "SELECT * FROM cart WHERE id = '$id'";
	  $result = mysqli_query($conn,$query);
	  $row = mysqli_fetch_assoc($result);

	  $g_name = $row['g_name'];
	  $qty = $row['qty'];
	  $u_nic_no = $row['u_nic_no'];

	  echo $g_name;
	  echo $qty;
	  echo $u_nic_no;

			if ($g_name == 'Plastic') {
				$query = "UPDATE update_bin SET plastic_sell = plastic_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
			}elseif ($g_name == 'Paper') {
				$query = "UPDATE update_bin SET paper_sell = paper_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
			}elseif ($g_name == 'Ewaste') {
				$query = "UPDATE update_bin SET e_waste_sell = e_waste_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
			}elseif ($g_name == 'Fabric') {
				$query = "UPDATE update_bin SET fabric_sell = fabric_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
			}elseif ($g_name == 'Coconut_shell') {
				$query = "UPDATE update_bin SET coconut_shell_sell = coconut_shell_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
			}elseif ($g_name == 'Metal') {
				$query = "UPDATE update_bin SET metal_sell = metal_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
			}elseif ($g_name == 'Polythene') {
				$query = "UPDATE update_bin SET polythene_sell = polythene_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
			}elseif ($g_name == 'Glass') {
				$query = "UPDATE update_bin SET glass_sell = glass_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
			}elseif ($g_name == 'Organic') {
				$query = "UPDATE update_bin SET organic_sell = organic_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
			}

			$result = mysqli_query($conn,$query);
			if ($result) {
				echo "success";

				  $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
				  $stmt->bind_param('i',$id);

				  $stmt->execute();

				  $_SESSION['showAlert'] = 'block';
				  $_SESSION['message'] = 'Item removed from the List!';
				  header('location:cart.php');
			}else{
				echo "error";
			}


	  $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	  $stmt->bind_param('i',$id);

	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the List!';
	  header('location:cart.php');
	}

	// Remove all items at once from cart
	if (isset($_GET['clear'])) {

	  $query = "SELECT * FROM cart WHERE b_nic_num = '$b11'";
	  $result = mysqli_query($conn,$query);
	  if(mysqli_num_rows($result) > 0){
		  while($row = mysqli_fetch_assoc($result)) {
		  	 $g_name = $row['g_name'];
		  	 $qty = $row['qty'];
		  	 $u_nic_no = $row['u_nic_no'];

		  	 	if ($g_name == 'Plastic') {
					$query = "UPDATE update_bin SET plastic_sell = plastic_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
				}elseif ($g_name == 'Paper') {
					$query = "UPDATE update_bin SET paper_sell = paper_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
				}elseif ($g_name == 'Ewaste') {
					$query = "UPDATE update_bin SET e_waste_sell = e_waste_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
				}elseif ($g_name == 'Fabric') {
					$query = "UPDATE update_bin SET fabric_sell = fabric_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
				}elseif ($g_name == 'Coconut_shell') {
					$query = "UPDATE update_bin SET coconut_shell_sell = coconut_shell_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
				}elseif ($g_name == 'Metal') {
					$query = "UPDATE update_bin SET metal_sell = metal_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
				}elseif ($g_name == 'Polythene') {
					$query = "UPDATE update_bin SET polythene_sell = polythene_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
				}elseif ($g_name == 'Glass') {
					$query = "UPDATE update_bin SET glass_sell = glass_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
				}elseif ($g_name == 'Organic') {
					$query = "UPDATE update_bin SET organic_sell = organic_sell + '$qty' WHERE u_nic_no = '$u_nic_no'";
				}
				$result_updated = mysqli_query($conn,$query);
				if($result_updated){
					//echo "done";
				}else{
					//echo "nope";
				}
		  }
	 }


	  $stmt = $conn->prepare("DELETE FROM cart where b_nic_num='$b11'");
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the List!';
	  header('location:cart.php');
	}

	// Set total price of the product in the cart table
	if (isset($_POST['qty'])) {
	  $qty = $_POST['qty'];
	  $id = $_POST['id'];
	  $pprice = $_POST['pprice'];

	  $tprice = $qty * $pprice;

	  $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
	  $stmt->bind_param('isi',$qty,$tprice,$id);
	  $stmt->execute();
	}


?>