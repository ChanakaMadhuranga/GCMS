<?php
	session_start();
	include("connection.php");


	$user_id=$_SESSION['user_id'];
	$queryb = mysqli_query($con,"SELECT b_nic_num FROM buyers3 WHERE user_id='$user_id' "); 
  
  while($row_b = mysqli_fetch_assoc($queryb))
    {
  $b11=$row_b['b_nic_num'];
	  
	}





	// Add products into the list
	if (isset($_POST['pname'])) {
	 
	  $pname = $_POST['pname'];
	  $pprice = $_POST['pprice'];
	  $id=$_POST['id'];
	  
	  $pqty = $_POST['pqty'];
	  $u_nic_no=$_POST['u_nic_no'];
	  $b_nic_num=$_POST['b_nic_num'];
	 
	  $route=$_POST['route'];
	  $total_price = $pprice * $pqty;
	  

	 // $stmt = $con->prepare('SELECT g_code FROM cart WHERE g_code=?');
     
	  
	    $query = $con->prepare('INSERT INTO collection(id,g_name,g_price,qty,total_price,u_nic_no,b_nic_num,route) VALUES (?,?,?,?,?,?,?,?)');
	    $query->bind_param('ssssssss', $id,$pname,$pprice,$pqty,$total_price,$u_nic_no,$b_nic_num,$route);
	    $query->execute();
    }
    if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
        $stmt = $con->prepare("SELECT * FROM cart where b_nic_num='$b11'");
        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;
  
        echo $rows;
      }
?>  