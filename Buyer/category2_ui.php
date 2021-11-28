<!doctype html>
<html lang="en">
  <head>
   

    <title>Register Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
 </head>
 
 	<style type="text/css">
 		#text{
 			height: 25px;
 			border-radius: 5px;
 			padding: 4px;
 			border: solid thin #aaa;
 			width: 100%;
 		}

 		#button{
 			padding: 10px;
 			width: 100px;
 			color: white;
 			background-color: lightblue;
 			border: none;
 		}

 		#box{
 			background-color: grey;
 			margin: auto;
 			width: 500px;
 			padding: 20px;
 			height: 100%;

 		}

 		body{
 			background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);
            height: 900px;
 		}

 	</style>
<body>
<div class="container-fluid col-lg-4 col-md-8 col-sm-12 align-content-center shadow p-3 mb-5 bg-dark rounded" style="opacity: 0.8" >

  <?php
   session_start();
include("connection.php");
include("functions.php");
$user_data=check_login($con);

$b_nic_num=$user_data['b_nic_num'];
$query = mysqli_query($con,"SELECT b_garbage FROM buyers3 WHERE id ='$id'");





 		echo '<form class="form-conatiner text-light" method="post"  enctype="multipart/form-data">';
         echo'<div class="fs-2 fw-bold text-center m-3">';
         echo "Price for waste Category ";
         echo'</div>';
         
        while($row = mysqli_fetch_assoc($query)) {
        	$row1 = $row['b_garbage'];

            $e = explode(',', $row1);
            foreach($e as $r) {


               echo' <div class="row mb-2">
                <div class="col-3"><label class="form-label">';
                echo $r;'</label></div>';
                




                echo'<div class="col-8">';
                     echo'<input class="form-control" type="text" name="$r" value=0>';
                echo'</div></div>';
                echo "<br>";
            }
           
        }
    echo '<div class="row mb-2">
        <div class="col-3"><label class="form-label">Date</label></div>
        <div class="col-8"><input class="form-control" type="date"  name="date"   required></div>
                </div>';
              
        echo '<div class="row mb-2">
        <div class="col-3"><label class="form-label">Time</label></div>
        <div class="col-8"><input class="form-control" type="time"  name="time"   required></div>
                </div>		  </form></div>';
               


	/*echo'<input class="form-control" type="date"  name="date" ><br>
		<input class="form-control" type="time"  name="time"> 
        <input class="form-control bg-success text-light mb-2"  type="submit" value="submit">

';*/



//echo "$b_nic_num";
    
  
	if ($_SERVER['REQUEST_METHOD'] == "post") 
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

