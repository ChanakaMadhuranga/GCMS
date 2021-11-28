<?php
	session_start();
	if (!isset($_SESSION['a_id'])) {
        header('Location: login.php');
     }

	include("connection.php");

	$w_NIC=$_GET['w_NIC'];

	$query="SELECT * FROM worker WHERE w_NIC='$w_NIC'";
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

 		 
	<div class="container-fluid col-lg-4 col-md-6 col-sm-8 col-xs-12 align-content-center shadow p-3 mb-5 bg-dark rounded" style="opacity: 0.8" >

		<form class="form-container text-light" method="POST" action="w_update.php">

		<div class="fs-2 fw-bold text-center m-3">Edit Profile</div>	

			
				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">First Name</label></div>
 					<div class="col-8"><input class="form-control" type="text" name="w_fname" value="<?php echo $row['w_fname'] ?>" required></div>
 				</div>

 				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Last Name</label></div>
 					<div class="col-8"><input class="form-control"  type="text" name="w_lname" value="<?php echo $row['w_lname'] ?>" required></div>
 				</div>
			
 				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Address</label></div>
 					<div class="col-8"><input class="form-control" type="text"placeholder="Number" name="Address_number" value="<?php echo $row['Address_number'] ?>" required></div>
 					
 					<div class="col-3"><label class="form-label"></label></div>
 					<div class="col-8"><input class="form-control" type="text" placeholder="Street" name="Address_street" value="<?php echo $row['Address_street'] ?>" required></div>
 					
 					<div class="col-3"><label class="form-label"></label></div>
 					<div class="col-8"><input class="form-control" type="text"  placeholder="City" name="Address_city" value="<?php echo $row['Address_city'] ?>" required></div>
 				</div>
				
				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">District</label></div>
 					<div class="col-8"><input class="form-control" type="text" name="district" value="<?php echo $row['district'] ?>" required></div>
 				</div>
 		
 				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Contact No</label></div>
 					<div class="col-8"><input class="form-control" type="text" placeholder="Contact no 1" name="w_contact_no1" value="<?php echo $row['w_contact_no1'] ?>" required></div>
 					
 					<div class="col-3"><label class="form-label"></label></div>
 					<div class="col-8"><input class="form-control" type="text" name="w_contact_no2" placeholder="Contact no 2" value="<?php echo $row['w_contact_no2'] ?>" required></div>
 				</div>
		
				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">NIC</label></div>
 					<div class="col-8"><input class="form-control" type="text" name="w_NIC" value="<?php echo $row['w_NIC'] ?>" required></div>
 				</div>
					
				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Post</label></div>
 					<div class="col-8"><input class="form-control" type="text" name="w_post" value="<?php echo $row['w_post'] ?>" required></div>
 				</div>

 				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Joined Date</label></div>
 					<div class="col-8"><input class="form-control" type="datetime" name="w_joined_date" value="<?php echo $row['w_joined_date'] ?>" required></div>
 				</div>

					<br>
					<div>
	                <button type="submit" class="btn btn-success btn-block" onclick="return updateAlert()">Update</button>
	                <button type="submit" class="btn btn-secondary btn-block" href="info.php">Cancel</button>
	      
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