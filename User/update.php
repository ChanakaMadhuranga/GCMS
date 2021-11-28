<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php
$u_nic_no = $_SESSION['u_nic_no'];
$query = "SELECT * FROM user WHERE u_nic_no = '{$u_nic_no}'";
$result_set = mysqli_query($connection, $query);

$result = mysqli_fetch_assoc($result_set);

if(isset($_POST['submit'])){
    
    $u_contact_no1 =$_POST['u_contact_no1'];
    $u_contact_no2 =$_POST['u_contact_no2'];

  
    $query1="UPDATE user
                   SET u_contact_no1 = '{$u_contact_no1}',u_contact_no2 = '{$u_contact_no2}' 
                    WHERE u_nic_no = '{$u_nic_no}' ";

                    $result1 = mysqli_query($connection, $query1);
                     echo "<meta http-equiv='refresh' content='0'>";
                    if($result1){
                      //echo "You have successfully changed your contact Number";
                       echo '<script type="text/javascript">alert("You have successfully changed your contact Number");</script>';
                      //header('Location: modify-user.php');
                    }else{
                      //echo "passwords do not match";
                    }    






}

 

 

  



?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


    <style type="text/css">
      #body{
      background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);
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
        background-color: rgba(0, 0, 0, 0.8);
        border: 1px solid brown;
        margin: 0 auto;
        float: none;
        margin-top:0px; 
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
       
  

    <div class="container-fluid">
    <div class=" row">
    <div class="card col-11 col-md-5 col-lg-3 bg-dark rounded mt-5" style="text-align: center;">
        <div class="card-header bg-transparent border-success text-light"><h5>Change Contact Number</h5></div>
       <div class="card-body text-success">
           <h5 class="card-title"></h5>
             <form action="update.php" method="post">
              <table class="card-text">
                
                <tr>
                 <td><div class=" text-light">Contact(Primary):</div></td>
                  <td><input class="bg-dark text-light border-primary rounded" type="text" name="u_contact_no1" value="<?php echo $result['u_contact_no1']; ?>" placeholder="Enter Contact No" size="12"></td>
                  
                </tr>
                <tr>
                  <td><div class=" text-light">Contact(Optional):</div></td>
                  <td><input class="bg-dark text-light border-primary rounded" type="text" name="u_contact_no2" value="<?php echo $result['u_contact_no2']; ?>" placeholder="Enter Contact No" size="12"></td>
                </tr>

              </table>
             
          
      
          
            
            <div class="d-inline-flex">
            <input type="submit" name="submit" class="form-control bg-success text-light mt-2 mb-2 border-0 p-2" value="Submit"></div>
            <div class="d-inline-flex"><input class="form-control bg-success text-light mb-2 border-0 p-2" type="reset" name="reset">
            </div>
      </form>

  
  
</div>
</div>
</div>
</div>
</body>
</html>
