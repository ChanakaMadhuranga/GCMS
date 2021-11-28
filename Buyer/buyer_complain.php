<?php
    session_start();
    include("connection.php");
    include("functions.php");

?>
   
<!DOCTYPE html>
 <html>
     <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <title>Complain Section</title>

         <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />

         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

         <style type="text/css">
             #body{ 
                   
                    background: -webkit-linear-gradient(to left, #636FA4, #E8CBC0);  /* Chrome 10-25, Safari 5.1-6 */
                    background: linear-gradient(to left, #636FA4, #E8CBC0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                  }
         </style>

     </head>

     <body id="body">

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
                  <a class="nav-link active" aria-current="page" href="home.php">Home</a>
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
                    <a class="nav-link active" aria-current="page" href="buyer_complain.php">Complain</a>
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
    
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT b_nic_num FROM buyers3 WHERE user_id = '$user_id'";
    $resultSql = mysqli_query($con,$sql);
    while($rowSql=mysqli_fetch_assoc($resultSql)){
        $nic_num  = $rowSql['b_nic_num'];
    }
    //$nic_num = "960331478v";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        
        $complain = $_POST['complain'];
}

        if (!empty($complain) )

             {

      $fileName = basename($_FILES["image"]["name"]); 
          $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
          // Allow certain file formats 
           $allowTypes = array('jpg','png','jpeg','gif'); 
           if(in_array($fileType, $allowTypes))
           { 
               $image = $_FILES['image']['tmp_name']; 
               $imgContent = addslashes(file_get_contents($image)); 
           }
            if (isset($imgContent)) {
                $query = "insert into complain (nic_num, complain, photo, user) values('$nic_num', '$complain', '$imgContent', 'Buyer')";
            }else{
                 $query = "insert into complain (nic_num, complain, photo, user) values('$nic_num', '$complain', '', 'Buyer')";
            }
             
              $result = mysqli_query($con, $query);
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Your Complain Has Been Received!</strong><br>
              We will check on that...
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
             </div>';
              if ($result) 
              {
                //query successful..
                 //echo 'Successful!'; 
                /* echo '<div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                            <div>
                                Complain sent successfully!
                            </div>
                        </div>';*/

              }
              else
              {
                echo '<div class="alert alert-primary d-flex align-items-center" role="alert">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                          </svg>
                          <div>
                            Error ocurred!
                          </div>
                        </div>';
                die;
              }
       } 
    ?>


        <div class="container container-fluid col-lg-4 col-md-6 col-sm-8 col-xs-12 align-content-center shadow p-3 mt-5 bg-dark rounded" style="opacity: 0.8">
                         
                <form enctype="multipart/form-data" method="post">
                    <div class="fs-2 fw-bold text-center text-light m-3">Complain</div>

                       <div>
                            <textarea class="form-control m-2" rows="4" placeholder="Add complain here. . ." name="complain" required></textarea>
                       
                            <input class="form-control m-2" type="file" name="image">
                       
                            <button type="reset" class="btn btn-secondary m-2" style="width: 100%;"><i style="padding-right: 5px;"></i> Reset</button>
                        
                            <button type="submit" class="btn btn-danger m-2 " style="width: 100%;"><i class="fa fa-envelope-o" style="padding-right: 5px;"></i> Send</button>
                        </div>  

                </form>                     
            
        </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Change the item quantity
    $(".itemQty").on('change', function() {
      var $el = $(this).closest('tr');

      var pcode = $el.find(".pcode").val();
      var pprice = $el.find(".pprice").val();
      var qty = $el.find(".itemQty").val();
      location.reload(true);
      $.ajax({
        url: './booking/action.php',
        method: 'post',
        cache: false,
        data: {
          qty: qty,
          pcode:pcode,
          pprice: pprice
        },
        success: function(response) {
          console.log(response);
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




