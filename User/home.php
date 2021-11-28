<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php 

//checking if a user is logged in
	if (!isset($_SESSION['u_id'])) {
			header('Location: login.php');
		
	}




  $u_nic_no = $_SESSION['u_nic_no'];
  $query = "SELECT * FROM points WHERE u_nic_no = '{$u_nic_no}'";
  $result_set = mysqli_query($connection, $query);

  $result = mysqli_fetch_assoc($result_set);

  $marks = $result['points'];
  $rating = $result['rating'];










  if($marks >2200)
          {
              $marks == 100;
              $mark = $marks;
          }
          elseif($marks > 1750 && $marks < 2200)
          {
            $mark = (($marks - 1750) / 450) * 100;
          }
          elseif($marks > 1350 && $marks < 1750)
          {
             $mark = (($marks - 1350) / 400) * 100;
          }
          elseif($marks > 1000 && $marks < 1350)
          {
             $mark = (($marks - 1000) / 350) * 100;
          }
          elseif($marks > 700 && $marks < 1000)
          {
             $mark = (($marks - 700) / 300) * 100;
          }
          elseif($marks > 450 && $marks < 700)
          {
             $mark = (($marks - 450) / 250) * 100;
          }
          elseif($marks > 250 && $marks < 450)
          {
             $mark = (($marks - 250) / 200) * 100;
          }
          elseif($marks > 100 && $marks < 150)
          {
             $mark = (($marks - 100) / 150) * 100;
          }
          else
          {
             $mark = (($marks - 0) / 100) * 100;
          }

          //echo $mark;
          


 ?>


<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

 		 <style type="text/css">
 			

 html {
  height: 100%;
  margin: 0;
}

#body {
  /* The image used */
   background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);

    height: 100%;
    margin: 0;
    background-repeat: no-repeat;
    background-attachment: fixed;


  /* Full height */


}

      .card {
        z-index: 1;
        
        background-color: rgba(0, 0, 0, 0.5);
        border: 2px solid brown;
      }
      .navbar {
        z-index: 1;
        position: relative;
      }

 		</style>
 	
</head>

<body  id="body">






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
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
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
            <a class="nav-link" aria-current="page" href="allnotification.php">Notification</a>
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

<div class="container-fluid p-0">
<div class="row no-gutters">
  <div class="col-sm-12 col-lg-3 mt-1">
    <div class="card " style="">
        <div class="card border">
        <div class="card-body">
           <h5 class="card-title text-light">GCMS <?php echo $rating;  ?></h5>
        <div class="row no-gutters">
         <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> 


          <?php
           if ($rating == "GOLD III") {
                   echo '<img src="images/01.png" />';
            
          }elseif ($rating == "GOLD II") {
             echo '<img src="images/02.png" />';
          }
          elseif ($rating == "GOLD I") {
             echo '<img src="images/03.png" />';
          }
           elseif ($rating == "SILVER III") {
             echo '<img src="images/04.png" />';
          }
          elseif ($rating == "SILVER II") {
             echo '<img src="images/05.png" />';
          }
          elseif ($rating == "SILVER I") {
             echo '<img src="images/06.png" />';
          }
          elseif ($rating == "BRONZ III") {
             echo '<img src="images/07.png" />';
          }
          elseif ($rating == "BRONZ II") {
             echo '<img src="images/08.png" />';
          }
          elseif ($rating == "BRONZ I") {
             echo '<img src="images/09.png" />';
          }
          

          ?>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 mt-3"> 
          
           <div class="progress">
            <div class="progress-bar bg-success " role="progressbar" style="width:<?php echo $mark; ?>%" aria-valuenow="<?php echo $marks; ?>" aria-valuemin="0" aria-valuemax="100"></div>
         </div>


     </div>  
     </div>
          
          <h6 ><div class="text-danger">Congratulations...!</div><div class="text-info">currently you have <?php echo $marks;  ?> points </div></h6>
       </div>
    </div>
  </div>
          <div class="mt-1 ">

                <?php 
                    include('disposenotification.php');
                  ?>
                <?php 
                    include('notification.php');
                  ?>
          </div>

  </div>

    <div class="col-lg-9 col-md-9 col-sm-12 mt-1">
      <?php 
        include('user_map1.php');
       ?>


    </div>
</div>
</div>

</body>
</html>
<?php mysqli_close($connection); ?>