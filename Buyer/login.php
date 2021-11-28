<?php
    ob_start();
    session_start();

	include("connection.php");
	include("functions.php");
	include('common_navbar.html');

	if ($_SERVER['REQUEST_METHOD'] == "POST") 
	{
		
		$b_nic_num= $_POST['b_nic_num'];
		$b_password = $_POST['b_password'];
        $hashed_password = sha1($b_password);
		if (!empty($b_nic_num) && !empty($b_password))
		{
			
			$query = "select * from buyers3 where b_nic_num = '$b_nic_num' and b_password = '$hashed_password' limit 1";

			$result = mysqli_query($con, $query);

			if ($result) 
			{
				if ($result && mysqli_num_rows($result) > 0) 
				{
					$user_data = mysqli_fetch_assoc($result);

					$active_status1 = $user_data['active_status1'];
					$active_status2 = $user_data['active_status2'];

					if ($user_data['b_password'] == $hashed_password)
					{
							if ($active_status1 == 0) {
								echo'<div class="alert alert-danger" role="alert">';
							 	 		echo "Please verify your Email";
								echo'</div>';	
						
							}elseif($active_status2 == 0){
								echo'<div class="alert alert-primary" role="alert">';
							 			echo "Your account activation is pending. Please try again later";
								echo'</div>';	
						
							}else{
								$_SESSION['user_id'] = $user_data['user_id'];
								header("Location: home.php");
								die;
						}

						
					}
				}else
				{
					echo "Wrong username or password!";
				}
				
			}

		}else
		{
			//echo "Wrong username or password!";
		}
	}
    
    ob_end_flush();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <meta charset="UTF-8">
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
 		
 		
      </style>
      
      




</head>
<body id="body">
<div class="container-fluid col-lg-4 col-md-6 col-sm-8 col-xs-12 p-3 mt-5 align-content-center shadow bg-dark rounded" style="opacity: 0.8">
<form class="form-container text-light" method="post">
      
      <div class="fs-2 fw-bold text-center m-3">Buyer Login Form</div>

	  <div class="row mb-3">
               <div class="col-3"><label class="form-label">User Name</label></div>
                <div class="col-8"><input type="text" class="form-control bg-dark text-light border-primary" name="b_nic_num" placeholder="NIC No" required></div>
            </div>

            <div class="row mb-3">
              <div class="col-3"><label class="form-label">Password</label></div>
              <div class="col-8"><input type="password" class="form-control bg-dark text-light border-primary" name="b_password" placeholder="Password" required></div>
            </div>
            
            <!--<div class="checkbox row mb-3">-->
            <!--  <label>-->
            <!--    <input type="checkbox">Remember me-->
            <!--  </label>-->
            <!--</div>-->

            <div class="row  mb-3">
            <div class="align-content-center"><input type="submit" name="submit" class="form-control bg-success text-light mb-2 border-0 p-2" value="Login"></div>
            </div>

            <div class="row mb-2">
            <div class="d-flex align-items-end flex-column"><a href="signup.php" class="btn btn-secondary">Click to Signup</a></div>
            </div>
	</form>

    </div>    	
	
</body>
</html>
