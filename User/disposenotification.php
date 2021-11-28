<?php //session_start();
if(session_status() === PHP_SESSION_NONE)
{
  session_start();
}


 ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>

<?php 

  if(isset($_GET['notification']) && $_GET['notification']=='remove' ){
     $bc_id = intval($_GET['id']);

   
  $query = "UPDATE `b_collected` SET `view_notification` = '1' WHERE `id` = '{$bc_id}'";
  $result = mysqli_query($connection, $query);

  if($result){
      //echo " THE remove Not ".$bc_id;
      }else{
        echo "NOT Remove";
      }    
  }

  ?>


<!DOCTYPE html>
<html lang="en">
<head>

  <title>Notification</title>
   <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

      <style type="text/css">
        #body{
      background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);
      background-size: 100% 100%;
    }

      
      html{
          height: 100%;
        }
      body{
          min-height: 100%;
        }


        #dispose {
        z-index: 1;
        position: relative;
        background-color: rgba(255,0 , 0, 0.8);
        border: 2px solid white;}
    
    
      </style>


     <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script>
      $(document).ready(function(){
        $("#Comanda").click(function(){
          $(this).hide();
        });
      });
      </script>
 -->
      

</head>
<body id="body">

  <script
  type="text/javascript"
  src="js/bootstrap.bundle.min.js"
></script>


         <!-- <div>
           <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

                    <div class="container-fluid">
                      <a class="navbar-brand" href="#"> Welcome <?php //echo $_SESSION['u_first_name']; ?>!</a>

                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>

                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                          <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="Home.php">Home</a>
                          </li>


                          <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="personalbin.php">Personal Bin</a>
                          </li>

                          <li class="nav-item">
                             <a class="nav-link" aria-current="page" href="chart.php">View Bin</a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Complain</a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="notification.php">Notification</a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="modify-user.php">Profile Details</a>
                          </li>

                          <li class="nav-item">
                             <a class="nav-link" aria-current="page" href="change-password.php">Change Password</a>
                          </li>


                        </ul>
                        
                      
                      <ul class="navbar-nav m-2">
                        
                        <li class="'nav-item">
                          <a class="nav-link bg-primary rounded text-light" aria-current="page" href="logout.php">Log Out</a>
                        </li>
                      </ul> 


              </div>
            </div>
          </nav>
        </div> -->




<?php
$u_nic_no = $_SESSION['u_nic_no'];
$query = "SELECT * FROM `update_bin` WHERE `dispose_status` is true AND `u_nic_no`='{$u_nic_no}'";
// -- SELECT * FROM `b_collected` WHERE `u_nic_no`= '{$u_nic_no}' AND 'view_notification' is false ORDER BY `id`DESC";
$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($result)) { ?>

 
<div class="card col-sm-12 col-lg-12" id="dispose" style="">
  <div class="card-body text-light">
    <h5 class="card-title text-light">Did you just disposed?<br>Click <a class="link-warning" href="chart.php#employee_table">here</a> to submit</h5>
   <!--  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->





  <?php 
  // $message = "Some items has been purchases by ". $row['b_first_name']."<br>" ;
  // $items_good ="";
  // $plastic_sell = $row['plastic_sell'];
  // if($plastic_sell!=0){
  //   $items_good .= " Plastic buckets".$plastic_sell.","."<br>";
  // }
  // $organic_sell = $row['organic_sell'];
  // if($organic_sell!=0){
  //   $items_good .= " Organic buckets ".$organic_sell.","."<br>";
  // }
  // $polythene_sell = $row['polythene_sell'];
  // if($polythene_sell!=0){
  //   $items_good .= " Polythene buckets ".$polythene_sell.","."<br>";
  // }
  // $metal_sell = $row['metal_sell'];
  //  if($metal_sell!=0){
  //   $items_good .= " Metal buckets ".$metal_sell.","."<br>";
  // }
  // $paper_sell = $row['paper_sell'];
  //  if($paper_sell!=0){
  //   $items_good .= " Paper buckets ".$paper_sell.","."<br>";
  // }
  // $coconut_shell_sell = $row['coconut_shell_sell'];
  //  if($coconut_shell_sell!=0){
  //   $items_good .= " Coconut shell amount ".$coconut_shell_sell.","."<br>";
  // }
  // $glass_sell = $row['glass_sell'];
  //  if($glass_sell!=0){
  //   $items_good .= " Glass buckets ".$glass_sell.","."<br>";
  // }
  // $fabric_sell = $row['fabric_sell'];
  //  if($fabric_sell!=0){
  //   $items_good .= " Fabric buckets ".$fabric_sell.","."<br>";
  // }
  // $e_waste_sell = $row['e_waste_sell'];
  //  if($e_waste_sell!=0){
  //   $items_good .= " E waste buckets ".$e_waste_sell.","."<br>";
  // }

  // echo " ".$message.$items_good  . " ".'<a href="http://localhost/project/home.php?notification=remove&id='.$row['id'].'"><button class="btn btn-primary">Close</button></a>' ."<br>";
// 

//echo "Please submit the amounts of waste you disposed";
// echo "string";
 






   echo '
  
</div>
</div>';

}

 
 ?> 

<!--  <form>
    <input type="button" name="Comanda" value="Comanda" id="Comanda" data-clicked="unclicked" />
    
</form>
 -->


    
  
</body>
</html>
