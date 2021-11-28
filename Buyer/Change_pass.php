<?php
    session_start();
    include("connection.php");
    include("functions.php");

    $user_data=check_login($con);
?>



<!DOCTYPE html>
<HTML>
<head>
    <title>Change Password</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

 </head>
 <body id= "body">
 		<style type="text/css">
 			
      #body{ 
          margin:0; color:#0ae215;
          background: #E8CBC0;  /* fallback for old browsers */
          background: -webkit-linear-gradient(to left, #636FA4, #E8CBC0);  /* Chrome 10-25, Safari 5.1-6 */
          background: linear-gradient(to left, #636FA4, #E8CBC0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        } 
 			
 			
 			
 			html{
  				height: 100%;
				}
			body{
  				min-height: 100%;
				}
 			

 		</style> 

    <div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <div class="container-fluid">
    <a class="navbar-brand" href="#">GCMS Buyer</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="home.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="view.php">Profile</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Change Details
          </a>
             <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="Change_pass.php">Change Password</a></li>
                  <li><a class="dropdown-item" href="update.php">Change profile Details</a></li>
             </ul>
        </li>

          <li class="nav-item">
          <a class="nav-link" aria-current="page" href="cate_update.php">Update My Categories</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="buyer_complain.php">Complain</a>
         </li>
         
         </ul>
              <ul class="navbar-nav m-2">
                <li class="nav-item me-3">
                  <a class="nav-link btn btn-primary text-light" aria-current="page" href="./booking/index.php">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-bag-check mb-1" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                      <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                    </svg> Booking
                    </a>
                </li>


                 <li class="nav-item">
                  <a class="nav-link" href="./booking/cart.php"><i class="fas fa-truck"></i> <span id="cart-item" class="badge bg-danger"></span></a>
                </li>

                <li class="'nav-item">
                  <a class="nav-link btn btn-outline-secondary" aria-current="page" href="logout.php"> Logout</a>
                </li>
             </ul> 

    </div>
  </div>

</nav>
</div>


<?php

$id=$user_data['id'];
if($_SERVER['REQUEST_METHOD'] == "POST")
	{
//$b_nic_num=$_POST['b_nic_num'];
$b_password = $_POST['b_password'];
$hashed_password = sha1($b_password);

$newpassword = $_POST['newpassword'];
$hashed_password_new = sha1($newpassword);
$confirmpassword = $_POST['confirmpassword'];

$result=mysqli_query($con,"select b_password from buyers3 where id='$id'and b_password = '$hashed_password' limit 1 ");

    if(mysqli_num_rows($result)==0)
    {
       // echo "You entered an incorrect password";

       echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>You entered an incorrect password!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
   </div>';

    }  
    elseif(mysqli_num_rows($result)==1 && $newpassword == $confirmpassword)
    {
        $sql=mysqli_query($con,"update buyers3 set b_password='$hashed_password_new'where id='$id'  ");

      if($sql)
      {
         // echo "You have successfully changed your password";
         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>You have successfully changed your password!</strong>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        </div>';


      }
      
    }
    else
      {
          //echo "passwords do not match";

          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>passwords do not match!</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
         </div>';
      }   
}
?>





    
  <div class="container-fluid col-lg-4 col-md-6 col-sm-8 col-xs-12 align-content-center shadow p-3 mb-5 bg-dark rounded" style="opacity: 0.8" >
 	

 		<form class="form-conatiner text-light" method="post" enctype="multipart/form-data">
 			<div class="fs-2 fw-bold text-center m-3">Change Password</div>

<!-- <div class="row mb-2">
 			<div class="col-4"><label class="form-label">Enter  NIC Number: </label></div>
 			<div class="col-7"><input class="form-control"size="10" value="<?php echo $user_data['b_nic_num']; ?>" type="text"name="b_nic_num" required></div>
 		</div> -->


<div class="row mb-2">
 			<div class="col-4"><label class="form-label">Enter  Current Password:</label></div>
 			<div class="col-7"><input class="form-control" type="password"name="b_password" required></div>
 		</div>

<div class="row mb-2">
 			<div class="col-4"><label class="form-label">Enter New  Password: </label></div>
 			<div class="col-7"><input class="form-control"type="password"name="newpassword" required></div>
 		</div>

<div class="row mb-2">
 			<div class="col-4"><label class="form-label">Confirm New Password:</label></div>
 			<div class="col-7"><input class="form-control" type="password"name="confirmpassword" required></div>
 		</div>



     
      
        <div class="col-auto">
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" id="autoSizingCheck">
              <label class="form-check-label" for="autoSizingCheck">
                Remember me
              </label>
            </div>
            </div>
          <div class="col-auto">
            <button type="submit" name="update" class="btn btn-success passe w-100">Update Password</button>
          </div>
        </div>
      </form>
        </div>
        
</div>

 <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
 
  $(document).ready(function() {

    // Send product details in the server
    $(".addItemBtn").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
    
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();

      var pcode = $form.find(".pcode").val();

      var pqty = $form.find(".pqty").val();
      var u_nic_no=$form.find(".u_nic_no").val();
      var date = $form.find(".date").val();
      var b_nic_num= $form.find(".b_nic_num").val();
       var time = $form.find(".time").val();
       
       var b_nic_num = $form.find(".b_nic_num").val();

      $.ajax({
        url: './booking/action.php',
        method: 'post',
        data: {
        
          pname: pname,
          pprice: pprice,
          pqty: pqty,
          u_nic_no: u_nic_no,
          pcode: pcode,
          date:date,
          time:time,
          b_nic_num:b_nic_num
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);


        }
      });
    });




    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: './booking/action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });

  
  </script>

</body>
</HTML>
