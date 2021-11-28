<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php
$u_nic_no = $_SESSION['u_nic_no'];
$query = "SELECT * FROM user WHERE u_nic_no = '{$u_nic_no}'";
$result_set = mysqli_query($connection, $query);


$result = mysqli_fetch_assoc($result_set);

 

 

	



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
                    background-color: rgba(0, 0, 0, 0.6);
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
	

        <div class="container-fluid">
		<div class=" row">
		<div class="card col-11 col-sm-12 col-lg-4 rounded mt-5 mb-5" style="" >
  			<div class="card-header bg-transparent border-success text-light"><h5>Profile Details</h5></div>
 			 <div class="card-body text-success table-responsive">
   				 <h5 class="card-title"></h5>
   					 
   					 	<table class="card-text">
   					 		<tr>
   					 			<td><div class="text-light">First Name:</div></td>
   					 			<td><div class="text-light"><?php echo $result['u_first_name']; ?></div></td>
   					 		</tr>
   					 		<tr>
   					 			<td><div class="text-light">Last Name:</div></td>
   					 			<td><div class="text-light"><?php echo $result['u_last_name']; ?></div></td>
   					 		</tr>
   					 		<tr>
   					 			<td><div class="text-light">NIC No:</div></td>
   					 			<td><div class="text-light"><?php echo $result['u_nic_no']; ?></div></td>
   					 		</tr>
   					 		<tr>
   					 			<td><div class="text-light">Email:</div></td>
   					 			<td><div class="text-light"><?php echo $result['u_email']; ?></div></td>
   					 		</tr>
   					 		<tr>
   					 			<td><div class="text-light">Gender:</div></td>
   					 			<td><div class="text-light"><?php echo $result['u_gender']; ?></div></td>
   					 		</tr>
   					 		<tr>
   					 			<td><div class="text-light">Division:</div></td>
   					 			<td><div class="text-light"><?php echo $result['u_division']; ?></div></td>
   					 		</tr>
   					 		<tr>
   					 			<td><div class="text-light">Address No:</div></td>
   					 			<td><div class="text-light"><?php echo $result['u_address_no']; ?></div></td>
   					 		</tr>
   					 		<tr>
   					 			<td><div class="text-light">Street:</div></td>
   					 			<td><div class="text-light"><?php echo $result['u_street']; ?></div></td>
   					 		</tr>
   					 		<tr>
   					 			<td><div class="text-light">City:</div></td>
   					 			<td><div class="text-light"><?php echo $result['u_city']; ?></div></td>
   					 		</tr>
   					 		<tr>
   					 			<td><div class="text-light">Contact(Primary):</div></td>
   					 			<td><div class="text-light"><?php echo $result['u_contact_no1']; ?></div></td>
   					 		</tr>
   					 		<tr>
   					 			<td><div class="text-light">Contact(Optional):</div></td>
   					 			<td><div class="text-light"><?php echo $result['u_contact_no2']; ?></div></td>
   					 		</tr>

   					 	</table>
   					 	
					
			
					
   					
  			</div>
  			<center>
  			<div class="card-footer bg-transparent border-success">
  				<a href="update.php" class="btn btn-primary">Edit</a></div></center>
			</div>


	
</div>
</div>
</body>
</html>
