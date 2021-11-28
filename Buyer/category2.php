<html>
  <body>
  <?php
   session_start();
include("connection.php");
include("functions.php");

$query = mysqli_query($con,"SELECT b_garbage FROM buyers3 WHERE id = 8");

 		echo '<form method="Post">';
        while($row = mysqli_fetch_assoc($query)) {
        	$row1 = $row['b_garbage'];

            $e = explode(',', $row1);
            foreach($e as $r) {

                echo $r;
                
                echo"<input type='text' name='$r' value='1'>";
              
                echo "<br>";
            }
           
        }


	echo'<input class="form-control" type="date"  name="date" ><br>
		<input class="form-control" type="time"  name="time"> 
		<input type="Submit"> 
		  </form>';


$user_data=check_login($con);

$b_nic_num=$user_data['b_nic_num'];
echo "$b_nic_num";
    
  
	if ($_SERVER['REQUEST_METHOD'] == "POST") 
	{
 		$Plastic=$_POST['Plastic'];
		$Ewaste=$_POST['Ewaste'];
		$Paper=$_POST['Paper'];
		$Organic=$_POST['Organic'];
		$Coconut_shell=$_POST['Coconut_shell'];
		$Glass=$_POST['Glass'];
		$Fabric=$_POST['Fabric'];
		$Polythene=$_POST['Polythene'];
		$Metal=$_POST['Metal'];
		$date=$_POST['date'];
		$time=$_POST['time']; 
 
 $query="insert into category(Plastic,Ewaste,Paper,Organic,Coconut_shell,Glass,Fabric,Polythene,Metal,date,time,b_nic_num) values('$Plastic','$Ewaste','$Paper','$Organic','$Coconut_shell','$Glass','$Fabric','$Polythene','$Metal','$date','$time','$b_nic_num') ";

  mysqli_query($con, $query);

  echo "successfully Entered";
 }

	
 

?>
</body>
</html>

