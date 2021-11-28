<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Email verification</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>

</body>
</html>

<?php 


	if (isset($_GET['code'])) {
		$verification_code = mysqli_real_escape_string($connection, $_GET['code']);
		$query	=	"SELECT * FROM buyers3 WHERE verification_code	=	'{$verification_code}'";
		$result	=	mysqli_query($connection, $query);
		
		$row = mysqli_fetch_assoc($result);
		
		if (mysqli_num_rows($result) ==1) {
			$query =	"UPDATE buyers3 SET active_status1	=true, verification_code = NULL WHERE verification_code	='{$verification_code}' LIMIT 1";

				$result	=	mysqli_query($connection, $query);
				
			if (mysqli_affected_rows($connection) ==1) {
				// echo'<div class="alert alert-success" role="alert">';
				//  	echo 'Email address verified successfully!. Thanks for signing up with GCMS. Your account will be verified by the admin and activated within 24 hours';
				// echo'</div>';

				echo'<div class="alert alert-primary alert-dismissible fade show" role="alert">';
					echo 'Email address verified successfully!. Thanks for signing up with GCMS. Your account will be verified by the admin and activated within 24 hours';
				echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
				echo'</div>';	
					 
				}else{
					// echo'<div class="alert alert-danger" role="alert">';
				 // 		echo 'Invalid verification code.';
					// echo'</div>';
					echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">';
						echo 'Invalid verification code.';
					echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
					echo'</div>';
				
				}
			}
		}
 ?>