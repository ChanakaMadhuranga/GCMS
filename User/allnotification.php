<?php session_start();
// if(session_status() === PHP_SESSION_NONE)
// {
//   session_start();
// }


 ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>



<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Notification</title>
   

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
        border: 1px solid brown;
        margin: 0 auto;
        float: none;
        margin-top:0px;
        }
    
    
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


        <div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <div class="container-fluid">
    <a class="navbar-brand" href="#"> Welcome <?php echo $_SESSION['u_first_name']; ?>!</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="home.php">Home</a>
        </li>


        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="chart.php">Personal Bin</a>
        </li>

        <!-- <li class="nav-item">
          <a class="nav-link" aria-current="page" href="chart.php">View Bin</a>
        </li>
 -->

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="user_complain.php">Complain</a>
        </li>

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="allnotification.php">Notification</a>
          </li>


       <!--  <li class="nav-item">
          <a class="nav-link" aria-current="page" href="modify-user.php">Profile Details</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="change-password.php">Change Password</a>
        </li> -->




         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Profile
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="modify-user.php">profile Details</a></li>
                  <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>
            
            </ul>
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
</div>


<div class="container-fluid mt-3">

<?php
$u_nic_no = $_SESSION['u_nic_no'];
$query = "SELECT * FROM `cart` INNER JOIN buyers3 ON cart.b_nic_num =buyers3.b_nic_num WHERE cart.u_nic_no='{$u_nic_no}' ORDER BY cart.id DESC";
// -- SELECT * FROM `b_collected` WHERE `u_nic_no`= '{$u_nic_no}' AND 'view_notification' is false ORDER BY `id`DESC";
$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($result)) { ?>

<div class=" row">
<div class="card col-11 col-sm-12 col-lg-4 mt-2" style="text-align: center;">
  <div class="card-body text-light">
    <h5 class="card-title text-light"></h5>
   <!--  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->





  <?php 
  
  $message = $row['b_fname']." "."has booked"."<br>" ;
  $items_good ="";
   $g_name = $row['g_name'];
   $qty = $row['qty'];
  
  
    $items_good .= $qty." ".$g_name." "."buckets"."<br>"."and will be collected on "."<br>".$row['date'];

  echo "<br>".$message.$items_good  ."<br>";
// 




// echo "string";
 






   echo '
  
</div>
</div></div>';

}

 
 ?> 

<!--  <form>
    <input type="button" name="Comanda" value="Comanda" id="Comanda" data-clicked="unclicked" />
    
</form>
 -->


    
 </div> 
</body>
</html>
