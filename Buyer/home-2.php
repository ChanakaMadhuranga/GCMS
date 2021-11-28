<?php

include("connection.php");
$grand_total = 0;




$user_id=$_SESSION['user_id'];
$sql="select * from buyers3 where user_id=$user_id ";
$a=mysqli_query($connection,$sql);

while($row1=mysqli_fetch_array($a)){
  $b11=$row1['b_nic_num'];

}




$sql = "SELECT total_price FROM cart where b_nic_num='$b11' ";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc())
 {

  $grand_total += $row['total_price'];
 }
 ?>













<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>


/* Create four equal columns that floats next to each other */


/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}



.title {
  color: rgb(12, 66, 10);
  font-size: 16px;
}

/*button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: rgb(255, 255, 255);
  background-color: rgb(20, 54, 4);
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 16px;
}*/

a {
  text-decoration: none;
  
  color: rgb(96, 223, 46);
}

button:hover, a:hover {
  opacity: 0.7;
}


  
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(26, 192, 34, 0.2);
}





</style>
</head>
<body>



<div class="row" style="height: 100%;">
  
  <div class="col-12 col-md-4 col-lg-4" style="background-color:rgb(184, 238, 200);">
    
  
        <h1>Ordered Details</h1>
        <p class="title">Now you have to buy <?= number_format($grand_total,2) ?>/- amount of garbage<br></p>
        <p>When you collecting categories you must click here to view details</p>
        <a class="btn btn-success col-12 text-light" href="./booking/display_category.php" >View Ordered List</a>
      </div>
      
      

      <div class="col-12 col-md-8 col-lg-8" style="">
        <center>  <img src="s9.png" class="img-fluid" style="height:60vh; width:100%;">
      </div>
    
</div>

</body>
</html>
