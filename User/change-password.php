<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php
$u_nic_no = $_SESSION['u_nic_no']; 
if(isset($_POST['submit'])){

  $c_u_password = $_POST['c_u_password'];
  $c_hashed_password = sha1($c_u_password);

  $n_u_password = $_POST['n_u_password'];
  $n_hashed_password = sha1($n_u_password);

    $confirm_password = $_POST['confirm_password'];
    $con_hashed_password = sha1($confirm_password);


  $query = "SELECT u_password FROM user WHERE u_nic_no = '{$u_nic_no}' AND u_password = '{$c_hashed_password}' LIMIT 1";
  $result = mysqli_query($connection, $query);

  if(mysqli_num_rows($result)==0)
    {
        //echo "You entered an incorrect password";
        echo '<script type="text/javascript">alert("You entered an incorrect password");</script>';
    } 
    elseif(mysqli_num_rows($result)==1 && $n_hashed_password == $con_hashed_password){
       $query2="UPDATE user
                   SET u_password = '{$n_hashed_password}'
                    WHERE u_nic_no = '{$u_nic_no}' ";

                    $result = mysqli_query($connection, $query2);
                    if ($result) {
                      //echo "You have successfully changed your password";
                      echo '<script type="text/javascript">alert("You have successfully changed your password");</script>';
                    }


    }else{
            echo "passwords do not match";
               }    
  


}
 ?>


<!DOCTYPE html>
<html lang="en">
<head>

  <title>Change Password</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


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
    
    
      </style>
      

</head>
<body id="body">


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
            <a class="nav-link" aria-current="page" href="allnotification.php">Notification</a>
          </li>


       <!--  <li class="nav-item">
          <a class="nav-link" aria-current="page" href="modify-user.php">Profile Details</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="change-password.php">Change Password</a>
        </li> -->




        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
  

  <div class="container-fluid col-11 col-lg-4 col-md-6 col-sm-12 p-3 align-content-center shadow bg-dark rounded mt-5" style="opacity: 0.8">
  
    <form class="form-container text-light" action="change-password.php" method="post">
      
      <div class="fs-2 fw-bold text-center m-3">Change Password</div>

     

             <div class="row mb-3">
              <div class="col-5"><label class="form-label">Enter Current Password:</label></div>
              <div class="col-6"><input type="password" class="form-control bg-dark text-light border-primary" name="c_u_password" placeholder="Password"></div>
            </div>

           

            <div class="row mb-3">
               <div class="col-5"><label class="form-label">Enter New Password:</label></div>
               <div class="col-6"><input class="form-control bg-dark text-light border-primary" type="password" name="n_u_password" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Enter Password" required></div>
           </div>

            <div class="row mb-2">
              <div class="col-5"><label for="form-label">Confirm Password:</label></div>
              <div class="col-6"><input type="password" class="form-control bg-dark text-light border-primary" name="confirm_password"id="confirm_password" placeholder="Enter Password" required></div>
            </div> 


            
            
            <!--<div class="checkbox row mb-3">-->
            <!--  <label>-->
            <!--    <input type="checkbox">Remember me-->
            <!--  </label>-->
            <!--</div> -->

            <div class="row  mb-3 mt-2">
            <div class="align-content-center"><input type="submit" name="submit" class="form-control bg-success text-light mb-2 border-0 p-2" value="Submit"></div>
            </div>

            
  </form>

    </div> 

    
  
</body>
</html>
