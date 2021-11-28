
  <?php

  if(session_status() === PHP_SESSION_NONE)
    {
      session_start();
    }
    include("connection.php");
    include("functions.php");
    
     $user_data=check_login($con);
     $row = $user_data;
     
  
    ?>
    <!DOCTYPE html>
    <html lang="en" >
    <head>
     <meta charset="UTF-8">
      <title>PHP Learning</title>


        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />


          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

           <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
   
     <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
      <link rel="stylesheet" href="view.css" > </head> 

      <body> 

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
          <a class="nav-link active" aria-current="page" href="view.php">Profile</a>
        </li>

       

       
       

        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
Change Details                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                  <li><a class="dropdown-item" href="Change_pass.php">Change Password</a></li>
                  <li><a class="dropdown-item" href="update.php">Change profile Details</a></li>
                </ul>
              </li>
            </ul>
          </div>

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



      <div class="login-wrap">
       <div class="login-html">
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
       <label for="tab-1" class="tab">PROFILE DETAILS</label> 
       
       
      <form >


<P></P>

<br>
      <div class="row mb-2">
                <div class="col-4"><label class="form-label">First Name</label></div>
                <div class="col-8"><label class="form-label"><?php echo $row['b_fname']; ?></label></div>
        </div>  
        
        

        <div class="row mb-2">
                <div class="col-4"><label class="form-label">Last Name</label></div>
                <div class="col-8"><label class="form-label"><?php echo $row['b_lname']; ?></label></div>
        </div>  
        
        

        <div class="row mb-2">
                <div class="col-4"><label class="form-label">Company Address</label></div>
                <div class="col-8"><label class="form-label"><?php echo $row['b_caddress_no']; ?></label></div>
        </div>  
        

        <div class="row mb-2">
                <div class="col-4"><label class="form-label">street</label></div>
                <div class="col-8"><label class="form-label"><?php echo $row['b_street']; ?></label></div>
        </div>  
        

        <div class="row mb-2">
                <div class="col-4"><label class="form-label">city</label></div>
                <div class="col-8"><label class="form-label"><?php echo $row['b_city']; ?></label></div>
        </div>  
        



        <div class="row mb-2">
                <div class="col-4"><label class="form-label">E-mail</label></div>
                <div class="col-8"><label class="form-label"><?php echo $row['b_email']; ?></label></div>
        </div>  
        

        <div class="row mb-2">
                <div class="col-4"><label class="form-label">DOB</label></div>
                <div class="col-8"><label class="form-label"><?php echo $row['b_dob']; ?></label></div>
        </div>  
        

        <div class="row mb-2">
                <div class="col-4"><label class="form-label">Gender</label></div>
                <div class="col-8"><label class="form-label"><?php echo $row['b_gender']; ?></label></div>
        </div>  
        

        <div class="row mb-2">
                <div class="col-4"><label class="form-label">NIC No</label></div>
                <div class="col-8"><label class="form-label"><?php echo $row['b_nic_num']; ?></label></div>
        </div>  
        
        <div class="row mb-2">
                <div class="col-4"><label class="form-label">Contact No</label></div>
                <div class="col-8"><label class="form-label"><?php echo $row['b_contact_num']; ?></label></div>
        </div>  
        <div class="row mb-2">
                <div class="col-4"><label class="form-label">Company Name</label></div>
                <div class="col-8"><label class="form-label"><?php echo $row['b_company_n']; ?></label></div>
        </div>  
        <div class="row mb-2">
                <div class="col-4"><label class="form-label">Company Contact No</label></div>
                <div class="col-8"><label class="form-label"><?php echo $row['b_ccontact_num']; ?></label></div>
        </div>  
        
           
          
         
              <a href="update.php" class="btn btn-primary col-12"><center>Edit your Profile</center></a>

             </form>
             </div></div>

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

 </html>
 
 <?php
    // session_destroy();
 ?>