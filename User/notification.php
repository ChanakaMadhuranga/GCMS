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
     $bc_id = intval(base64_decode($_GET['id']));

   
  $query = "UPDATE `cart` SET `view_notification` = '1' WHERE `id` = '{$bc_id}'";
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


        .card {
        z-index: 1;
        position: relative;
        background-color: rgba(0, 0, 0, 0.6);
        border: 2px solid brown;}
    
    
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
$query = "SELECT buyers3.b_fname, cart.g_name, cart.qty, cart.id,cart.date FROM `cart` INNER JOIN buyers3 ON cart.b_nic_num =buyers3.b_nic_num WHERE cart.view_notification is false AND cart.u_nic_no='{$u_nic_no}' ORDER BY cart.id DESC";
// -- SELECT * FROM `b_collected` WHERE `u_nic_no`= '{$u_nic_no}' AND 'view_notification' is false ORDER BY `id`DESC";
$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($result)) { ?>

 
<div class="card col-sm-12 col-lg-12" style="">
  <div class="card-body text-light">
    <div class="row">
      
   
   <!--  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->

  <?php 
  $message ="<b>".$row['b_fname']."</b>"." "."has booked " ;
  $items_good ="";
  $g_name = $row['g_name'];
  $qty = $row['qty'];
  
    
     $items_good .= "<b>".$qty." ".$g_name."</b>"." "."buckets "."and will be collected on ".$row['date'];
  
      echo '<div class="col-10">'.$message.$items_good.'</div>';  

      echo '<div class="col-2" style="text-align: right;
      position: relative;"><a href="http://gcms.cf/User/home.php?notification=remove&id='.base64_encode($row['id']).'"><i class="bi bi-x-squarefill">

       <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="grey" class="bi bi-x-square-fill" viewBox="0 0 16 16">
        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
      </svg>
        
    </i>

        </a><br> </div>';

       
    // 



// echo "string";
 






   echo '
    </div>
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
