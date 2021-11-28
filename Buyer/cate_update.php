 <?php
 
 session_start();
 include("connection.php");
 include("functions.php");
 
 
 
 ?>
 
  <!DOCTYPE html>
    <html lang="en" >
    <head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Category Update</title> 

      <script src="js/bootstrap-dropdown.js"></script>

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
   
     <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
      <link rel="stylesheet" href="cate_update.css" > 
    </head>

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
                  <a class="nav-link active" aria-current="page" href="cate_update.php">Update My Categories</a>
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
 $user_id=$_SESSION['user_id'];

 $sql="select * from buyers3 where user_id=$user_id ";
 $a=mysqli_query($con,$sql);
 
 while($row=mysqli_fetch_array($a)):
 
   if(isset($_POST['Submit']))
   {    
   
      $garbage=$_POST['b_garbage'];
   
   if(!empty($_POST['b_garbage']))
         {
             $garbage1=" ";
             foreach($_POST['b_garbage']as $gar)
             {
                     $garbage1 .=$gar.",";
             }
         
   
   
   
   
   
   
   
   
   
   
   $query="update buyers3 set b_garbage='$garbage1' where user_id=$user_id";
	
	
	mysqli_query($con,$query);

    //echo "<h5><b>Successfully Updated!</b></h5>";
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Category Update is successfully!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
   </div>';




}}

 ?>




      <div class="login-wrap">
        <div class="login-html">
          <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
          <label for="tab-1" class="tab">CATEGORY UPDATE </label> 
       
       
 
       <div class="login-form">
 		<form method="post" >
     <?php
     $row1 = $row['b_garbage'];
        $row1 = trim($row1);
          $b= explode(',', $row1);

                ?>
    <?php  endwhile; ?>
                  <h8><br>You Can Change your collection categories in the System.</h8>
              
 <br>
 
                <fieldset class="form-group">
                   
                        <legend class="col-form-label col-sm-5 pt-0"><b>Type of Garbage</b></legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                  <?php          if(in_array('Organic',$b)) 
                            { 

                              ?>
                                <input type="checkbox" name="b_garbage[]" value="Organic" checked> 
                                  <?php }
                                  else {
                                    echo "<input type='checkbox' name='b_garbage[]' value='Organic'>";
                                  } ?>
                    
                                <label class="form-check-label">Organic</label>
                            </div>

                            <div class="form-check">

                            <?php          if(in_array('Polythene',$b)) 
                            { 

                              ?>
                                <input type="checkbox" name="b_garbage[]" value="Polythene" checked> 
                                  <?php }
                                  else {
                                    echo "<input type='checkbox' name='b_garbage[]' value='Polythene'>";
                                  } ?>




                              
                                <label class="form-check-label">Polythene</label><br>
                            </div>

                            <div class="form-check">
                            <?php          if(in_array('Plastic',$b)) 
                            { 

                              ?>
                                <input type="checkbox" name="b_garbage[]" value="Plastic" checked> 
                                  <?php }
                                  else {
                                    echo "<input type='checkbox' name='b_garbage[]' value='Plastic'>";
                                  } ?>



                              
                                <label class="form-check-label">Plastic</label>
                            </div>

                            <div class="form-check">
                            <?php          if(in_array('Metal',$b)) 
                            { 

                              ?>
                                <input type="checkbox" name="b_garbage[]" value="Metal" checked> 
                                  <?php }
                                  else {
                                    echo "<input type='checkbox' name='b_garbage[]' value='Metal'>";
                                  } ?>




                              
                                <label class="form-check-label">Metals</label>
                            </div>
                            <div class="form-check">
                            <?php          if(in_array('Glass',$b)) 
                            { 

                              ?>
                                <input type="checkbox" name="b_garbage[]" value="Glass" checked> 
                                  <?php }
                                  else {
                                    echo "<input type='checkbox' name='b_garbage[]' value='Glass'>";
                                  } ?>



                             
                                <label class="form-check-label">Glass</label>
                            </div>
                           
                            <div class="form-check">
                            <?php          if(in_array('Coconut_shell',$b)) 
                            { 

                              ?>
                                <input type="checkbox" name="b_garbage[]" value="Coconut_shell" checked> 
                                  <?php }
                                  else {
                                    echo "<input type='checkbox' name='b_garbage[]' value='Coconut_shell'>";
                                  } ?>






                              
                                <label class="form-check-label">Coconut Shells</label><br>
                            </div>
                            <div class="form-check">

                            <?php          if(in_array('Fabric',$b)) 
                            { 

                              ?>
                                <input type="checkbox" name="b_garbage[]" value="Fabric" checked> 
                                  <?php }
                                  else {
                                    echo "<input type='checkbox' name='b_garbage[]' value='Fabric'>";
                                  } ?>





                               
                                <label class="form-check-label">Fabric</label>
                            </div>
                            <div class="form-check">

                            <?php          if(in_array('Paper',$b)) 
                            { 

                              ?>
                                <input type="checkbox" name="b_garbage[]" value="Paper" checked> 
                                  <?php }
                                  else {
                                    echo "<input type='checkbox' name='b_garbage[]' value='Paper'>";
                                  } ?>





                                <label class="form-check-label">Paper</label>
                            </div>
                            <div class="form-check">

                            <?php          if(in_array('Ewaste',$b)) 
                            { 

                              ?>
                                <input type="checkbox" name="b_garbage[]" value="Ewaste" checked> 
                                  <?php }
                                  else {
                                    echo "<input type='checkbox' name='b_garbage[]' value='Ewaste'>";
                                  } ?>







                               
                                <label class="form-check-label">E-waste</label>
                            </div>
                        
                        </div>
                    </fieldset>
                    <div class="hr">
              </div> 

                    <div class="group"> 
                    <input type="submit" class="button" name="Submit" value="Submit">
                     </div>
                   
     </form>
     </div></div></div>

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
      
      </body> </html>
     