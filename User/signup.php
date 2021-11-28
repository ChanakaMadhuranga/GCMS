<?php session_start(); ?>
<?php require_once('inc/connection.php'); 
 require_once('inc/functions.php'); 
 include('common_navbar.html');
 
 	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;
 ?>

<!DOCTYPE html>
 <html>
 <head>
 	<title>Signup</title>
 	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
 </head>

<?php 
	$errors = array();

	$u_first_name = '';
	$u_last_name = '';
	$u_email = '';
	$u_password = '';
	$u_address_no = '';
	$u_street = '';
	$u_city = '';

	if (isset($_POST['submit'])) {


		$u_first_name = $_POST['u_first_name'];
		$u_last_name = $_POST['u_last_name'];
		$u_email = $_POST['u_email'];
		$u_password = $_POST['u_password'];
		$u_address_no = $_POST['u_address_no'];
		$u_street = $_POST['u_street'];
		$u_city = $_POST['u_city'];


			//checking max length
			$max_len_fields = array('u_first_name' => 100,'u_last_name' => 100,'u_email' =>100,'u_password' => 40,'u_nic_no' => 12);

			foreach ($max_len_fields as $field => $max_len) {
				if (strlen(trim($_POST[$field])) > $max_len) {
				$errors[] = $field . 'must be less than' . $max_len . 'characters';
				}
			}

			//checking email address
			if(!is_email($_POST['u_email'])){
				$errors[] = 'Email address is invalid.';
			}

			//checking if email address already exists
			$u_email = mysqli_real_escape_string($connection, $_POST['u_email']);
			$query = "SELECT * FROM user WHERE u_email = '{$u_email}' LIMIT 1";

			$result_set	= mysqli_query($connection, $query);

			if ($result_set) {
				if(mysqli_num_rows($result_set) == 1){
					$errors[] = 'Email address already exists'; 
				}
			}


			//checking if  usrname already exists
			$u_nic_no = mysqli_real_escape_string($connection, $_POST['u_nic_no']);
			$query1 = "SELECT * FROM user WHERE u_nic_no = '{$u_nic_no}' LIMIT 1";

			$result_set1	= mysqli_query($connection, $query1);

			if ($result_set1) {
				if(mysqli_num_rows($result_set1) == 1){
					$errors[] = 'NIC No already exists'; 
				}
			}


			if (empty($errors)) {
				// no errors found..adding new record
				$u_first_name = mysqli_real_escape_string($connection, $_POST['u_first_name']);
				$u_last_name = mysqli_real_escape_string($connection, $_POST['u_last_name']);
				$u_nic_no = mysqli_real_escape_string($connection, $_POST['u_nic_no']);
				$u_password = mysqli_real_escape_string($connection, $_POST['u_password']);

				//email address is already sanitized
				$hashed_password = sha1($u_password);
				$u_gender = mysqli_real_escape_string($connection, $_POST['u_gender']);
				$u_division = mysqli_real_escape_string($connection, $_POST['u_division']);
				$u_address_no = mysqli_real_escape_string($connection, $_POST['u_address_no']);
				$u_street = mysqli_real_escape_string($connection, $_POST['u_street']);
				$u_city = mysqli_real_escape_string($connection, $_POST['u_city']);
				$u_contact_no1 = mysqli_real_escape_string($connection, $_POST['u_contact_no1']);
				$u_contact_no2 = mysqli_real_escape_string($connection, $_POST['u_contact_no2']);
				
				


				$verification_code = sha1($u_email . time());
				$verification_URL	=	'http://gcms.cf/User/verify.php?code='	.	$verification_code;

				$u_latitude = $_POST['newLatId1'];
				$u_longitude = $_POST['newLngId1'];


				
				// Get file info 
        	$fileName = basename($_FILES["image"]["name"]); 
        	$fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        		// Get file info 
        	$fileName1 = basename($_FILES["image1"]["name"]); 
        	$fileType1 = pathinfo($fileName1, PATHINFO_EXTENSION);




        	// Allow certain file formats 
       	 $allowTypes = array('jpg','png','jpeg','gif'); 
       	 if(in_array($fileType, $allowTypes)){ 
           	 $image = $_FILES['image']['tmp_name']; 
           	 $imgContent = addslashes(file_get_contents($image));

           	  $allowTypes1 = array('jpg','png','jpeg','gif'); 
       		 if(in_array($fileType1, $allowTypes1)){ 
           	 $image1 = $_FILES['image1']['tmp_name']; 
           	 $imgContent1 = addslashes(file_get_contents($image1)); 
			
				$query = "INSERT INTO user (u_first_name,u_last_name,u_email,u_nic_no,u_password,u_gender,u_division,u_address_no,u_street,u_city,u_contact_no1,u_contact_no2,verification_code,active_status1,active_status2,u_latitude,u_longitude,u_profile_photo,u_nic_passport_driving_licence_photo) VALUES ('{$u_first_name}','{$u_last_name}','{$u_email}','{$u_nic_no}','{$hashed_password}','{$u_gender}','{$u_division}','{$u_address_no}','{$u_street}','{$u_city}','{$u_contact_no1}','{$u_contact_no2}','{$verification_code}',false,false,'{$u_latitude}','{$u_longitude}','{$imgContent}','{$imgContent1}')";
				$result = mysqli_query($connection, $query);
				
				$query2 = "INSERT INTO update_bin (u_nic_no,dispose_status,plastic_not_sell,plastic_sell,organic_not_sell,organic_sell,polythene_not_sell,polythene_sell,metal_not_sell,metal_sell,paper_not_sell,paper_sell,coconut_shell_not_sell,coconut_shell_sell,glass_not_sell,glass_sell,fabric_not_sell,fabric_sell,e_waste_not_sell,e_waste_sell) VALUES ('{$u_nic_no}','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0')";
				$result2 = mysqli_query($connection, $query2);
				$query3 = "INSERT INTO points (u_nic_no,points,rating) VALUES ('{$u_nic_no}','0','0')";
				$result3 = mysqli_query($connection, $query3);

					if ($result) {
					//query successful..redirecting to users page
						// echo'<div class="alert alert-success" role="alert">';
						//  	 echo 'records added successfully!';
						// echo'</div>';
						echo'<div class="alert alert-primary alert-dismissible fade show" role="alert">';
								  echo 'records added successfully!';
							echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
							echo'</div>';
					
				
					}else{
							$errors[] = 'Failed to add the new record.';
							die;
						}


				//$query2 = "INSERT INTO update_bin (u_nic_no) VALUES (`{$u_nic_no}`)"


					if ($result2) {
					//query successful..redirecting to users page
						// echo'<div class="alert alert-success" role="alert">';
						//  	 echo 'Personal bin created successfully!';
						// echo'</div>';
						echo'<div class="alert alert-primary alert-dismissible fade show" role="alert">';
								  echo 'Personal bin created successfully!';
							echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
							echo'</div>';
					 
				
					}else{
							$errors[] = 'Failed to add the new record for bin.';
							die;
						}

	
						
						if ($result3) {
					//query successful..redirecting to users page
							
							echo'<div class="alert alert-primary alert-dismissible fade show" role="alert">';
								  echo 'Points record created successfully!';
							echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
							echo'</div>';	
					 
				
					}else{
							$errors[] = 'Failed to add points record for bin.';
							die;
						}






					}}


					


		

			require '../PHPMailer/PHPMailer/src/Exception.php';
			require '../PHPMailer/PHPMailer/src/PHPMailer.php';
			require '../PHPMailer/PHPMailer/src/SMTP.php';

			//Load Composer's autoloader
			//require 'vendor/autoload.php';

			//Create an instance; passing `true` enables exceptions
			$mail = new PHPMailer(true);

			try {
			    //Server settings
			    $mail->SMTPDebug = 0;   //SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			    $mail->isSMTP();                                            //Send using SMTP
			    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
			    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			    $mail->Username   = 'gcmsalertslk@gmail.com';                     //SMTP username
			    $mail->Password   = 'gcms04@alerts';                               //SMTP password
			    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
			    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			    //Recipients
			    $mail->setFrom('gcmsalertslk@gmail.com', 'GCMS');
			    $mail->addAddress($u_email,$u_first_name);     //Add a recipient
			    //$mail->addAddress('ellen@example.com');               //Name is optional
			    $mail->addReplyTo('gcmsalertslk@gmail.com', 'Information');
			    $mail->addBCC('lkchanakamadhuranga@gmail.com');
			    $mail->addBCC('akilasadaru@gmail.com');
			    //$mail->addCC('bcc@example.com');

			    //Attachments
			    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

			    //Content
			    $mail->isHTML(true);                                  //Set email format to HTML
			    $mail->Subject = 'Verify Email Address';
			    $mail->Body    = '<p>Dear ' . $u_first_name . '</p>';
			    $mail->Body   .= '<p>Thank you for signing up.There is one more step.Click below link to verify your email address in order to activate your account.</p>';
			    $mail->Body   .= '<p>' . $verification_URL . '</p>';
			    $mail->Body   .= '<p>Thank You, <br></p>';

			    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			    $mail->send();
			    echo'<div class="alert alert-primary alert-dismissible fade show" role="alert">';
					   echo 'please check your email.';
				echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
				echo'</div>';	
			} catch (Exception $e) {
				echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">';
			    	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			    echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
				echo'</div>';
			}
							
							
			die;


						}	
			}
 ?>
 
 <body id= "body">
 		<style type="text/css">
 			#body{
 			background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);
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
 		

 	<div class="container-fluid col-11 col-lg-4 col-md-6 col-sm-8 col-xs-12 align-content-center shadow p-3 mt-1 mb-5 bg-dark rounded" style="opacity: 0.8" >
 	

 		<form class="form-conatiner text-light" method="post" enctype="multipart/form-data">
 			<div class="fs-2 fw-bold text-center m-3">User Signup</div>

 			<div class="row mb-3 col-12">
      				<a class=" btn btn-primary p-2" href="map4.html">Tap here to mark your location on google maps</a>
    		</div>

    		<div class="row mb-2">
      			<div class="col-3"><label class="form-label m-1" for="newLatId1">Latitude:</label></div>
     			 <div class="col-8"><input class="form-control bg-dark text-light border-primary" type="text" id="newLatId1" name="newLatId1" placeholder="Enter Latitude" required></div>
    		</div>

    		<div class="row mb-2">
      				<div class="col-3"><label class="form-label m-1" for="newLngId1">Longitude:</label></div>
     				<div class="col-8"><input class="form-control bg-dark text-light border-primary" type="text" id="newLngId1" name="newLngId1" placeholder="Enter Longitude" required></div>
   			 </div>


    
    	<div class="row mb-2">
 			<div class="col-3"><label class="form-label">First Name</label></div>
 			<div class="col-8"><input class="form-control bg-dark text-light border-primary" type="text" name="u_first_name" placeholder="Enter First Name" required <?php echo 'value="' .$u_first_name.'"';?> ></div>
 		</div>

 		<div class="row mb-2">
 			<div class="col-3"><label class="form-label">Last Name</label></div>
 			<div class="col-8"><input class="form-control bg-dark text-light border-primary"  type="text" name="u_last_name" placeholder="Enter Last Name" required <?php echo 'value="' .$u_last_name.'"';?> ></div>
 		</div>

 		

 		<div class="row mb-2">
 			<div class="col-3"><label class="form-label">Email</label></div>
 			<div class="col-8"><input class="form-control bg-dark text-light border-primary" type="text" name="u_email" placeholder="Enter Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address" required <?php echo 'value="' .$u_email.'"';?> ></div>
 		</div>

 		<div class="row mb-2">
 			<div class="col-3"><label class="form-label">Gender</label></div>
 			<div class="col-4"><input class="form-check-input bg-dark text-light border-primary" type="radio" name="u_gender" value="Male" required>Male
 			<input class="form-check-input bg-dark text-light border-primary" type="radio" name="u_gender" value="Female" required>Female</div>
 		</div>

 		<div class="row mb-2">
 			<div class="col-3"><label class="form-label">Grama Niladhari Division</label></div>
 			<div class="col-8"><select class="form-select bg-dark text-light border-primary" name="u_division" required></div>
 				<option>division1</option>
 				<option>division2</option>
 				<option>division3</option>
 				<option>division4</option>
 				<option>division5</option>
 			</select>
 			<br>
 		</div>

 		<div class="row mb-2">
 			<div class="col-3"><label class="form-label">Address No</label></div>
 			<div class="col-8"><input class="form-control bg-dark text-light border-primary" type="text" name="u_address_no" placeholder="Enter Address NO" required <?php echo 'value="' .$u_address_no.'"';?> ></div>
 		</div>

 		<div class="row mb-2">
 			<div class="col-3"><label class="form-label">Street</label></div>
 			<div class="col-8"><input class="form-control bg-dark text-light border-primary" type="text" name="u_street" placeholder="Enter Street" required <?php echo 'value="' .$u_street.'"';?> ></div>
 		</div>

 		<div class="row mb-2">
 			<div class="col-3"><label class="form-label">City</label></div>
 			<div class="col-8"><input class="form-control bg-dark text-light border-primary" type="text" name="u_city" placeholder="Enter City" required <?php echo 'value="' .$u_city.'"';?> ></div>
 		</div>

 		<div class="row mb-2">
 			<div class="col-3"><label class="form-label">Contact (Primary)</label></div>
 			<div class="col-8"><input class="form-control bg-dark text-light border-primary" type="text" name="u_contact_no1" placeholder="+94.........." value="+94" pattern="^(?:\+94)?(?:(11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|91)(0|2|3|4|5|7|9)|7(0|1|2|4|5|6|7|8)\d)\d{6}$" title="Please enter a valid phone number starts with +94" required></div>
 		</div>

 		<div class="row mb-2">
 			<div class="col-3"><label class="form-label">Contact (Optional)</label></div>
 			<div class="col-8"><input class="form-control bg-dark text-light border-primary" type="text" name="u_contact_no2" placeholder="+94........" value="+94"></div>
 		</div>

 		<div class="row mb-2">
 			<div class="col-4"><label class="form-label">Profile Photo</label></div>
 			<div class="col-7"><input class="form-control bg-dark text-light border-primary" type="file" name="image"></div>
 		</div>

 		<div class="row mb-2">
 			<div class="col-4"><label class="form-label">NIC/Passport/ Driving licence Photo</label></div>
 			<div class="col-7"><input class="form-control bg-dark text-light border-primary" type="file" name="image1" required></div>
 		</div>



 		<div class="row mb-2">
 			<div class="col-3"><label class="form-label">NIC No</label></div>
 			<div class="col-8"><input class="form-control bg-dark text-light border-primary" id="text" type="text" name="u_nic_no" placeholder="Enter NIC No" pattern="^([0-9]{9}[x|X|v|V]|[0-9]{12})$" required></div>
 		</div>

 		<div class="row mb-2">
 			<div class="col-3"><label class="form-label">Password</label></div>
 			<div class="col-8"><input class="form-control bg-dark text-light border-primary" type="password" name="u_password" id="pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Enter Password" required></div>
 		</div>

 		<div class="row mb-2">
              <div class="col-3"><label for="form-label">Confirm Password</label></div>
              <div class="col-8"><input type="password" class="form-control bg-dark text-light border-primary" id="confirm_password" placeholder="Enter Password" required></div>
          </div>

 		<input class="form-control bg-success text-light mb-2 border-0 p-2"  type="submit"  name="submit" value="Signup">

 		<div class="row align-content-center p-2 mx-auto">
 			<div class="col-6 "><input class="form-control btn btn-outline-secondary d-md-block" type="reset" name="reset"></div>
 			<div class="col-6"><a href="login.php" class="btn btn-outline-info d-md-block">Click here to Login</a></div>		
 		</div>
 		</form>

 	</div>



 	<script type="text/javascript">
    //get items from local storage
    let Lat1 = localStorage.getItem("latitude1");
    let Lng1 = localStorage.getItem("longitude1");
    //assign items for Id
    document.getElementById("newLatId1").value= Lat1;
    document.getElementById("newLngId1").value= Lng1;

    console.log(Lat1);
    console.log(Lng1);
    
 	 </script>


	<script>
     var pwd = document.getElementById("pwd")
      , confirm_password = document.getElementById("confirm_password");

      function validatePassword(){
        if(pwd.value != confirm_password.value) {
           confirm_password.setCustomValidity("Passwords Don't Match");
          } else {
          confirm_password.setCustomValidity('');
                }
        }

      pwd.onchange = validatePassword;
      confirm_password.onkeyup = validatePassword;
    </script>
 	
 </body>
 </html>
<?php mysqli_close($connection); ?>