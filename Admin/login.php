<?php
    ob_start();
    session_start();

	if (isset($_POST['submit'])) {
		$uname = $_POST['uname'];
		$password = $_POST['password'];

		if ($uname == "Admin") {
			if ($password == "Password123") {
				echo 'Welcome Admin!!!';
				//redirect to another page on successful login
				$_SESSION['a_id'] = "dhdghv0ygwqfg90g099wvg";
				header("Location: index.php");
			}
			else{
				echo '<h4>Invalid Password</h4>';

			}
		}
		else{
				echo '<h4>Invalid Username</h4>';
			}
	}
	
	ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title>Admin Login</title>
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

      </style>

    </head>
    
	<body id="body">
    <style type="text/css">
    #body
      {
        font-family: Arial;
      }
  </style>

	<div class="container-fluid col-lg-4 col-md-6 col-sm-8 col-xs-12 p-3 mt-4 align-content-center shadow bg-dark rounded" style="opacity: 0.8">
	
	<center><img src="avatar.jpg" alt="Avatar"></center>
    <form class="form-conatiner text-light" method="post">
      
      <div class="fs-2 fw-bold text-center m-3">Admin Login</div>

            <div class="row mb-3">
               <div class="col-3"><label class="form-label">Username</label></div>
                <div class="col-8"><input type="text" class="form-control bg-dark text-light border-primary" name="uname" id="uname" placeholder="Enter username" required></div>
            </div>

            <div class="row mb-3">
              <div class="col-3"><label class="form-label">Password</label></div>
              <div class="col-8"><input type="password" class="form-control bg-dark text-light border-primary" name="password" id="password" placeholder="Enter password" required></div>
            </div>

            <div class="row  mb-3">
            <div class="align-content-center"><input type="submit" name="submit" class="form-control bg-success text-light mb-2 border-0 p-2" value="Login"></div>
            </div>

	</form>

    </div>    	
	
</body>
</html>
