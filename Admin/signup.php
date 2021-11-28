<?php
session_start();
	if (!isset($_SESSION['a_id'])) {
        header('Location: login.php');
        }

	include("connection.php");

	?>


<!DOCTYPE html>
<html>

<head>
	<title>Signup</title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

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
            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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


<?php

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//SOMETHING WAS POSTED
		$w_fname = $_POST['w_fname'];
		$w_lname = $_POST['w_lname'];
		$district = $_POST['district'];
		$w_NIC = $_POST['w_NIC'];
		$Address_number = $_POST['Address_number'];
		$Address_street = $_POST['Address_street'];
		$Address_city = $_POST['Address_city'];
		$w_contact_no1 = $_POST['w_contact_no1'];
		$w_contact_no2 = $_POST['w_contact_no2'];
		$w_post = $_POST['w_post'];
		//$w_profile_photo = $_POST['w_profile_photo'];
		$w_gender = $_POST['w_gender'];
		$w_joined_date = $_POST['w_joined_date'];
		//$w_NIC_photo = $_POST['w_NIC_photo'];
		//$password = $_POST['password'];


			//checking max length
			$max_len_fields = array('w_fname' => 100,'w_lname' => 100, 'w_NIC' => 12, 'w_contact_no1' => 10, 'w_contact_no2' => 10);

			foreach ($max_len_fields as $field => $max_len) {
				if (strlen(trim($_POST[$field])) > $max_len) {
				$errors[] = $field . 'must be less than' . $max_len . 'characters';
				}
			}


			//checking if  usrname already exists
			$w_NIC = mysqli_real_escape_string($connection, $_POST['w_NIC']);
			$query1 = "SELECT * FROM worker WHERE  = '{$w_NIC}' LIMIT 1";

			$result_set1 = mysqli_query($connection, $query1);

			if ($result_set1) {
				if(mysqli_num_rows($result_set1) == 1){
					$errors[] = 'NIC No already exists'; 

				}
			}

			

		if (!empty($w_fname) && !empty($w_lname) && !empty($district) && !empty($w_NIC) && !empty($w_post) && !empty($w_gender) && !empty($w_joined_date))

		{
			//for 1st image....
			$fileName = basename($_FILES["image"]["name"]); 
        	$fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        	// Allow certain file formats 
	       	 $allowTypes = array('jpg','png','jpeg','gif','jfif'); 
	       	 if(in_array($fileType, $allowTypes))
	       	 { 
	           	 $image = $_FILES['image']['tmp_name']; 
	           	 $imgContent = addslashes(file_get_contents($image)); 


	           	 //for 2nd image........
		        $fileName1 = basename($_FILES["image1"]["name"]); 
	        	$fileType1 = pathinfo($fileName1, PATHINFO_EXTENSION); 
	        	// Allow certain file formats 
		       	 $allowTypes1 = array('jpg','png','jpeg','gif','jfif'); 
		       	 if(in_array($fileType1, $allowTypes1))
		       	 { 
		           	 $image1 = $_FILES['image1']['tmp_name']; 
		           	 $imgContent1 = addslashes(file_get_contents($image1)); 
					//save to database
					//$ = random_num(20);
					$query = "INSERT INTO worker (w_fname, w_lname, district, w_NIC, Address_number, Address_street, Address_city, w_contact_no1, w_contact_no2, w_post,w_gender, w_joined_date, w_NIC_photo, w_profile_photo) VALUES ('$w_fname', '$w_lname', '$district', '$w_NIC', '$Address_number', '$Address_street', '$Address_city', '$w_contact_no1', '$w_contact_no2', '$w_post', '$w_gender', '$w_joined_date','$imgContent','$imgContent1')";

					$result = mysqli_query($connection, $query);

                    if ($result) 
                      {
                        echo '<div class="alert alert-success" role="alert">';
                            echo "Registration Successfully!";
                        echo '</div>';
                        
                      }
                      else
                      {
                        echo '<div class="alert alert-danger" role="alert">';
                             echo "Something went wrong!";
                        echo '</div>'; 
                      }

					
			}
		 }
	  }		
	}
?>



   
	
	<style type="text/css">
		#body
			{
				font-family: Arial;
				background-image: linear-gradient(to right top, pink, purple, skyblue);
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
 		 
	<div class="container-fluid col-lg-4 col-md-6 col-sm-8 col-xs-12 align-content-center shadow mt-3 p-3 mb-5 bg-dark rounded" style="opacity: 0.8;">
		
		<form class="form-container text-light" method="Post" enctype="multipart/form-data" name="workerregistration">

		<div class="fs-2 fw-bold text-center m-3">Worker Registration</div>	

			
				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">First Name</label></div>
 					<div class="col-8"><input class="form-control" type="text" name="w_fname" required></div>
 				</div>

 				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Last Name</label></div>
 					<div class="col-8"><input class="form-control"  type="text" name="w_lname" required></div>
 				</div>
			
 				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Address</label></div>
 					<div class="col-8"><input class="form-control" type="text"placeholder="Number" name="Address_number" required></div>
 					
 					<div class="col-3"><label class="form-label"></label></div>
 					<div class="col-8"><input class="form-control" type="text" placeholder="Street" name="Address_street" required></div>
 					
 					<div class="col-3"><label class="form-label"></label></div>
 					<div class="col-8"><input class="form-control" type="text"  placeholder="City" name="Address_city" required></div>
 				</div>
				
				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">District</label></div>
 					<div class="col-8"><input class="form-control" type="text" name="district" required></div>
 				</div>
 		
 				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Contact No</label></div>
 					<div class="col-8"><input class="form-control" type="text" placeholder="Contact no 1" name="w_contact_no1" required></div>
 					
 					<div class="col-3"><label class="form-label"></label></div>
 					<div class="col-8"><input class="form-control" type="text" name="w_contact_no2" placeholder="Contact no 2" required></div>
 				</div>
		
				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Gender</label></div>
 					<div class="col-4"><input class="form-check-input" type="radio" name="w_gender" value="Male" required>Male
 					<input class="form-check-input" type="radio" name="w_gender" value="Female" required>Female</div>
 				</div>

				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">NIC</label></div>
 					<div class="col-8"><input class="form-control" type="text" name="w_NIC" required></div>
 				</div>
					
				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Post</label></div>
 					<div class="col-8">
 						<select name="w_post" id="post" required>
					 		<option>Driver</option>
					 		<option>Helper</option>
					 	</select>
 					</div>
 				</div>
		
				<div class="row mb-2">
 					<div class="col-3"><label class="form-label">Joined Date</label></div>
 					<div class="col-8"><input class="form-control" type="date" name="w_joined_date" required></div>
 				</div>

                <div class="row mb-2">
 							<div class="col-3"><label class="form-label">NIC/ Driving Licence/ Passport photo</label></div>
 							<div class="col-8"><input class="form-control" type="file" name="image" required></div>
 				</div>

 				<div class="row mb-2">
 							<div class="col-3"><label class="form-label">Profile photo:</label></div>
 							<div class="col-8"><input class="form-control" type="file" name="image1" required></div>
 				</div>

					<br>
					
					<br>
					<div>
	                <button type="submit" class="btn btn-success">Submit</button>
	                <button type="reset" class="btn btn-info">Reset</button>
	                </div>

				</form>

				</div>
				<div class="col-md-4 col-sm-4 col-xs-12"></div>
		

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>
</html>