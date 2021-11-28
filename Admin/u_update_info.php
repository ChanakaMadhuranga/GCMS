<?php
	session_start();
	if (!isset($_SESSION['a_id'])) {
        header('Location: login.php');
        }

	include("connection.php");

	$u_nic_no=$_GET['u_nic_no'];

	$query="SELECT * FROM user WHERE u_nic_no='$u_nic_no'";
	$result=mysqli_query($connection,$query);

	$row=mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html>

<head>
	<title>Edit Profile</title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    
    <script language="JavaScript" type="text/javascript">
    function updateAlert(){
        return confirm('Update Successfully!!!');
    }
    </script>

</head>
<body id="body">
	<style type="text/css">
		#body{
			font-family: Arial;
 			background-image: linear-gradient(to right top, pink, purple, skyblue);
 		}
	</style>

		<?php 
 			if (!empty($errors)) {
 				echo "<script type='text/javascript'>alert('There were error(s) on your form.');</script>";
 				 

 				foreach($errors as $error){
 				
 					echo "<script type='text/javascript'>alert('$error.');</script>";
 				}
 				echo '</div>';
 			}
 		 ?>

 	<div>
	  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
	  <div class="container-fluid">
	    <a class="navbar-brand">Welcome Admin!</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
	      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	        <li class="nav-item">
	          <a class="nav-link" aria-current="page" href="index.php">Home</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="admin_chartN.php">History</a>
	        </li>
	        <li class="nav-item dropdown">
	          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
	            People
	          </a>
	          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
	            <li><a class="dropdown-item">User</a>
                  <ul>
                      <li><a class="dropdown-item" href="register_info.php">Users' Details</a></li>
                  </ul>
              </li>
                  
	            <li><a class="dropdown-item">Worker</a>
                  <ul>
                      <li><a class="dropdown-item" href="signup.php">A new worker</a></li>
                      <li><a class="dropdown-item" href="info.php">Workers' Details</a></li>
                  </ul>
              </li>
              <li><a class="dropdown-item">Buyer</a>
                <ul>
                    <li><a class="dropdown-item" href="b_info.php">Buyers' Details</a></li>
                </ul>
              </li>
	          </ul>
	        </li>
	        
	        <li class="nav-item">
            	<a class="nav-link" href="complains_display.php">Complains</a>
          	</li>
	       
          	<li class="nav-item">
            	<a class="nav-link" href="route.php">Add Route</a>
          	</li>

          	<li class="nav-item dropdown">
            	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Job-Schedules
            	</a>
            	<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              		<li><a class="dropdown-item" href="create.php">Create a Schedule</a></li>
              		<li><a class="dropdown-item" href="schedule-display.php">Schedule Details</a></li>
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
 		 
	<div class="container-fluid col-lg-4 col-md-6 col-sm-8 col-xs-12 align-content-center shadow p-3 mb-5 bg-dark rounded" style="opacity: 0.8" >

		<form class="form-container text-light" method="POST" action="u_update.php">

		<div class="fs-2 fw-bold text-center m-3">Edit Profile</div>	

			
				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">NIC No</label></div>
 					<div class="col-8"><input class="form-control" type="text" name="u_nic_no" value="<?php echo $row['u_nic_no'] ?>" required></div>
 				</div>

				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">First Name</label></div>
 					<div class="col-8"><input class="form-control" type="text" name="u_first_name" value="<?php echo $row['u_first_name'] ?>" required></div>
 				</div>

 				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Last Name</label></div>
 					<div class="col-8"><input class="form-control"  type="text" name="u_last_name" value="<?php echo $row['u_last_name'] ?>" required></div>
 				</div>

 				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Gender</label></div>
 					<div class="col-8"><input class="form-control"  type="text" name="u_gender" value="<?php echo $row['u_gender'] ?>" required></div>
 				</div>

 				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">E-mail</label></div>
 					<div class="col-8"><input class="form-control"  type="text" name="u_email" value="<?php echo $row['u_email'] ?>" required></div>
 				</div>

 				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Division</label></div>
 					<div class="col-8"><input class="form-control"  type="text" name="u_division" value="<?php echo $row['u_division'] ?>" required></div>
 				</div>
			
 				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Address</label></div>
 					<div class="col-8"><input class="form-control" type="text" name="u_address_no" value="<?php echo $row['u_address_no'] ?>" required></div>
 					
 					<div class="col-3"><label class="form-label"></label></div>
 					<div class="col-8"><input class="form-control" type="text" name="u_street" value="<?php echo $row['u_street'] ?>" required></div>
 					
 					<div class="col-3"><label class="form-label"></label></div>
 					<div class="col-8"><input class="form-control" type="text" name="u_city" value="<?php echo $row['u_city'] ?>" required></div>
 				</div>
				
 				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Contact No</label></div>
 					<div class="col-8"><input class="form-control" type="text" name="u_contact_no1" value="<?php echo $row['u_contact_no1'] ?>" required></div>
 					
 					<div class="col-3"><label class="form-label"></label></div>
 					<div class="col-8"><input class="form-control" type="text" name="u_contact_no2" value="<?php echo $row['u_contact_no2'] ?>" required></div>
 				</div>

 				<?php
 				/*
 				<div class="row mb-2">
 							<div class="col-3"><label class="form-label">NIC/ Driving Licence/ Passport photo</label></div>
 							<div class="col-8"><input class="form-control" type="file" name="u_nic_passport_driving_licence_photo" value="<?php echo $row['u_nic_passport_driving_licence_photo'] ?>" required></div>
 				</div>

 				<div class="row mb-2">
 							<div class="col-3"><label class="form-label">Profile photo:</label></div>
 							<div class="col-8"><input class="form-control" type="file" name="u_profile_photo" value="<?php echo $row['u_profile_photo'] ?>" required></div>
 				</div>

 				*/
 				?>

 				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Longitude</label></div>
 					<div class="col-8"><input class="form-control" type="text" name="u_longitude" value="<?php echo $row['u_longitude'] ?>" required></div>
 				</div>
 		
							
				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Latitude</label></div>
 					<div class="col-8"><input class="form-control" type="text" name="u_latitude" value="<?php echo $row['u_latitude'] ?>" required></div>
 				</div>

 				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Joined Date</label></div>
 					<div class="col-8"><input class="form-control" type="datetime" name="u_joined_date" value="<?php echo $row['u_joined_date'] ?>" required></div>
 				</div> 				
 				

 					<br>
					<br>
					
					<br>
					<div>
	                <button type="submit" class="btn btn-success btn-block" onclick="return updateAlert()">Update</button>
	                <button type="submit" class="btn btn-secondary btn-block" href="register_info.php">Cancel</button>
	      
	             </div>

				</form>

				</div>
				<div class="col-md-4 col-sm-4 col-xs-12"></div>
			</div>
		</div>
	</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>
</html>