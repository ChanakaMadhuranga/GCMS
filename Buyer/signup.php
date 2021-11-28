
<!doctype html>
<html lang="en">
  <head>
   

    <title>Register Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
 </head>
 
 	<style type="text/css">
 		#text{
 			height: 25px;
 			border-radius: 5px;
 			padding: 4px;
 			border: solid thin #aaa;
 			width: 100%;
 		}

 		#button{
 			padding: 10px;
 			width: 100px;
 			color: white;
 			background-color: lightblue;
 			border: none;
 		}

 		#box{
 			background-color: grey;
 			margin: auto;
 			width: 500px;
 			padding: 20px;
 			height: 100%;

 		}

 		#body{
 			background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);
 		}

 	</style>

<?php
//session_start();

    include("connection.php");
    include("functions.php");
    include('common_navbar.html');
    
    use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;

    //$errors = array();
    $emailErr=$email="";
    if ($_SERVER['REQUEST_METHOD'] == "POST") 
    {   
        
        $FirstName=$_POST['b_fname'];
        $LastName=$_POST['b_lname'];
        $address=$_POST['b_address'];
        $email=$_POST['b_email'];
        $DOB=$_POST['b_dob'];
        $gender=$_POST['b_gender'];
        $contact_num=$_POST['b_contact_num'];
        $Company_Name=$_POST['b_company_n'];
        $b_caddress_no = $_POST['b_caddress_no'];
        $b_street = $_POST['b_street'];
        $b_city=$_POST['b_city'];
        $Company_Email=$_POST['b_cemail'];
        $Company_contact=$_POST['b_ccontact_num'];
        $b_v_no=$_POST['b_v_no'];
        $garbage=$_POST['b_garbage'];
        $nic_num=$_POST['b_nic_num'];
        $b_password = $_POST['b_password'];
        $hashed_password = sha1($b_password);


              

// Remove all illegal characters from email
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

// Validate email
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '<div class="alert alert-success" role="alert">';
        echo $email." is a valid email address";
    echo '</div>';
   
} else {
    echo $email." is not a valid email address";
}

        $verification_code = sha1($email . time());
        $verification_URL   =   'http://gcms.cf/Buyer/verify.php?code='   .   $verification_code;


        if($_POST['b_password']!==$_POST['b_confirmpassword']) 
        {

          echo "Your passwords did not match";
          exit();
            
        } 

        if(!empty($_POST['b_garbage']))
        {
            $garbage1=" ";
            foreach($_POST['b_garbage']as $gar)
            {
                    $garbage1 .=$gar.",";
            }
        }

        if(!empty($nic_num) && !empty($b_password))
        {
            $user_id = random_num(20);

          //for 1at image ......ID
          $fileName = basename($_FILES["image"]["name"]); 
          $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 

          // Allow certain file formats 
         $allowTypes = array('jpg','png','jpeg','gif'); 
         if(in_array($fileType, $allowTypes))
         { 
             $image = $_FILES['image']['tmp_name']; 
             $imgContent = addslashes(file_get_contents($image));


             //for 2nd image........Profile photo
            $fileName1 = basename($_FILES["image1"]["name"]); 
            $fileType1 = pathinfo($fileName1, PATHINFO_EXTENSION); 
            // Allow certain file formats 
             $allowTypes1 = array('jpg','png','jpeg','gif'); 
             if(in_array($fileType1, $allowTypes1))
             { 
                 $image1 = $_FILES['image1']['tmp_name']; 
                 $imgContent1 = addslashes(file_get_contents($image1));  


                    /*$query = "insert into buyers3(user_id,b_fname,b_lname,b_address,b_email,b_dob,
                      b_gender,b_nic_num,b_contact_num,b_company_n,b_caddress_no,b_street,b_city,b_cemail,
                      b_ccontact_num,b_password,b_garbage,b_id_photo,b_profile_photo,active_status1,active_status2) values('$user_id','$FirstName','$LastName','$address','$email','$DOB','$gender'
                      ,'$nic_num','$contact_num','$Company_Name','$b_caddress_no','$b_street','$b_city','$Company_Email','$Company_contact',
                    '$hashed_password','$garbage1','$imgContent','$imgContent1',false,false)";*/

                $query = "insert into buyers3(user_id,b_fname,b_lname,b_address,b_email,b_dob,
                      b_gender,b_nic_num,b_contact_num,b_company_n,b_caddress_no,b_street,b_city,b_cemail,
                      b_ccontact_num,b_password,b_garbage,b_id_photo,b_profile_photo,verification_code,active_status1,active_status2,b_v_no)values('$user_id','$FirstName','$LastName','$address','$email','$DOB','$gender'
                      ,'$nic_num','$contact_num','$Company_Name','$b_caddress_no','$b_street','$b_city','$Company_Email','$Company_contact',
                '$hashed_password','$garbage1','$imgContent','$imgContent1','$verification_code',false,false,'$b_v_no')";

                     $result=mysqli_query($con, $query);

                     if($result) {
                        echo '<div class="alert alert-success" role="alert">';
                            echo "successfully registered";
                        echo '</div>';
                        
                    }else{
                        echo "<br>";
                        echo "error in registration!";
                        die();
                    }

              }

          } 


        }
        else
        {
            echo "Please enter some valid information!";
            die();
        }

            //mail sending code
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
			    $mail->addAddress($email, $FirstName);     //Add a recipient
			    //$mail->addAddress('ellen@example.com');               //Name is optional
			    $mail->addReplyTo('gcmsalertslk@gmail.com', 'Information');
			    //$mail->addCC('cc@example.com');
			    //$mail->addBCC('bcc@example.com');

			    //Attachments
			    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

			    //Content
			    $mail->isHTML(true);                                  //Set email format to HTML
			    $mail->Subject = 'Verify Email Address';
			    $mail->Body    = '<p>Dear ' . $FirstName . '</p>';
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
  
?>




<body id="body">
 	<div class="container-fluid col-lg-4 col-md-8 col-sm-12 align-content-center shadow p-3 mt-1 mb-5 bg-dark rounded" style="opacity: 0.8" >

 		<form class="form-conatiner text-light" method="post"  enctype="multipart/form-data">
 			<div class="fs-2 fw-bold text-center m-3">Buyer Signup</div>


             <div class="row mb-2">
 			<div class="col-3"><label class="form-label">First Name</label></div>
             <div class="col-8"><input type="text" name="b_fname"  class="form-control" placeholder="Enter your first name" required></div>
                    </div>
                    <div class="row mb-2">
 			<div class="col-3"><label class="form-label">Last Name</label></div>
             <div class="col-8"><input type="text" name="b_lname"  class="form-control" placeholder="Enter your first name" required></div>
                    </div>


                    <div class="row mb-2">
 			<div class="col-3"><label class="form-label">Address</label></div>
             <div class="col-8"><input type="text" name="b_address"  class="form-control" placeholder="Enter your address" required>
              </div>
                    </div>

                    <div class="row mb-2">
 			<div class="col-3"><label class="form-label">Email</label></div>
 			<div class="col-8"><input class="form-control" type="email" name="b_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address" placeholder="Enter your Email" required></div>
              
                     </div>

                     <div class="row mb-2">
 			<div class="col-3"><label class="form-label">Date of Birth</label></div>
 			<div class="col-8"><input class="form-control" type="date"  name="b_dob" required></div>
 		            </div>
                   
                     


         <div class="row mb-2">
 			<div class="col-3"><label class="form-label">Gender</label></div>
 			<div class="col-5"><input class="form-check-input" type="radio" name="b_gender" value="Male">Male
 			<input class="form-check-input" type="radio" name="b_gender" value="Female" required>Female</div>
 		</div>



         <div class="row mb-2">
 			<div class="col-3"><label class="form-label">Contact No</label></div>
 			<div class="col-8"><input class="form-control" type="text" maxlength=12 name="b_contact_num" placeholder="+94....." value="+94" pattern="^(?:\+94)?(?:(11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|91)(0|2|3|4|5|7|9)|7(0|1|2|4|5|6|7|8)\d)\d{6}$" title="Please enter a valid phone number starts with +94" required></div>
 		</div>


<label class="form-label"><b>If you are registered in this system as a company,you must enter company details.</b> </label>
         <div class="row mb-2">
 			<div class="col-3"><label class="form-label">Company Name</label></div>
             <div class="col-8"><input type="text" name="b_company_n"  class="form-control" placeholder="Enter your company Name" ></div>
                    </div>

                    <div class="row mb-2">
 			<div class="col-3"><label class="form-label">Company Address no</label></div>
 			<div class="col-8"><input class="form-control" type="text" name="b_caddress_no" placeholder="Enter your company address number"></div>
 		</div>

 		<div class="row mb-2">
 			<div class="col-3"><label class="form-label">Street</label></div>
 			<div class="col-8"><input class="form-control" type="text" name="b_street" placeholder="Enter your company street" required></div>
 		</div>

 		<div class="row mb-2">
 			<div class="col-3"><label class="form-label">City</label></div>
 			<div class="col-8"><input class="form-control" type="text" name="b_city" placeholder="Enter your company city" required></div>
 		</div>  



         <div class="row mb-2">
 			<div class="col-3"><label class="form-label">Company Email</label></div>
 			<div class="col-8"><input class="form-control" type="email" name="b_cemail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address"  placeholder="Enter Company Email" required></div>
 		            </div>

                     <div class="row mb-2">
 			<div class="col-3"><label class="form-label">Company Contact No</label></div>
 			<div class="col-8"><input class="form-control" type="text" name="b_ccontact_num" placeholder="+94....." value="+94" pattern="^(?:\+94)?(?:(11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|91)(0|2|3|4|5|7|9)|7(0|1|2|4|5|6|7|8)\d)\d{6}$" title="Please enter a valid phone number starts with +94" required></div>
 		</div>

        <div class="row mb-2">
            <div class="col-3"><label class="form-label">Vehicle Redistration No</label></div>
            <div class="col-8"><input class="form-control" type="text" name="b_v_no" placeholder="Example: BAC-7575" required></div>
        </div>

                    
                    


                <fieldset class="form-group">
                   
                        <legend class="col-form-label col-sm-5 pt-0"><b>Type of Garbage</b></legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="Organic">
                                <label class="form-check-label">Organic</label>
                           
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="Polythene">
                                <label class="form-check-label">Polythene</label><br>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="Plastic">
                                <label class="form-check-label">Plastic</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="Metal">
                                <label class="form-check-label">Metals</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="Glass">
                                <label class="form-check-label">Glass</label>
                            </div>
                           
                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="Coconut_shell">
                                <label class="form-check-label">Coconut Shells</label><br>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="Fabric">
                                <label class="form-check-label">Fabric</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="Paper">
                                <label class="form-check-label">Paper</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="E-waste">
                                <label class="form-check-label">E-waste</label>
                            </div>
                        
                        </div>
                    </fieldset>
<p></p>
                  

      <div class="row mb-2">
      <div class="col-3"><label class="form-label">NIC/Passport/Driving License Photo</label></div>
      <div class="col-8"><input class="form-control" type="file" name="image" required></div>
    </div>  

    <div class="row mb-2">
      <div class="col-3"><label class="form-label">Profile photo</label></div>
      <div class="col-8"><input class="form-control" type="file" name="image1"></div>
    </div>           

                 
                    
                    <div class="row mb-2">
 			<div class="col-3"><label class="form-label">NIC Num:</label></div>
 			<div class="col-8"><input class="form-control" id="text" type="text"  maxlength='12' name="b_nic_num" placeholder="Enter your National ID number" pattern="^([0-9]{9}[x|X|v|V]|[0-9]{12})$" title="Please enter a valid NIC number"  required></div>
 		</div>



                    <div class="row mb-2">
 			<div class="col-3"><label class="form-label">Password</label></div>
 			<div class="col-8"><input class="form-control" minlength='8' type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"  name="b_password" required></div>
 		</div>
 			

         <div class="row mb-2">
 			<div class="col-3"><label class="form-label">  <label for="password2">Confirm Password:  </label>
</label></div>
 			<div class="col-8"><input class="form-control" type="password" name="b_confirmpassword" required></div>
 		</div>
 			


  

  <!-- <div class="col-auto">
      <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" id="autoSizingCheck">
        <label class="form-check-label" for="autoSizingCheck">
          Remember me
        </label>
      </div>
      </div> -->

	
      <input class="form-control bg-success text-light mb-2"  type="submit" value="Signup">

<div class="row align-content-center p-2 mx-auto">
    <div class="col-6 "><input class="form-control btn btn-outline-secondary d-md-block" type="reset" name="reset"></div>
    <div class="col-6 "><a href="login.php" class="btn btn-outline-info d-md-block">Click here to Login</a></div>		
</div>




    
  
</form>



</div>

  </body>
</html>


