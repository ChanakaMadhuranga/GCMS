<?php

session_start();
require 'config.php';

$user_id=$_SESSION['user_id'];
/*$query="select 'paper_sell' as 'Paper','plastic_sell' as 'Plastic',u_nic_no from  update_bin "; */
 //$query="select * from update_bin";
$query = "SELECT * FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no ";
$result = mysqli_query($conn, $query);

$queryA="select * from g_prices";
$resultA=mysqli_query($conn,$queryA);








$queryb = mysqli_query($conn,"SELECT b_garbage,b_nic_num FROM buyers3 WHERE user_id='$user_id' "); 

while($row_b = mysqli_fetch_assoc($queryb))
      {
         


$b11=$row_b['b_nic_num'];
        $row1 = $row_b['b_garbage'];
        $row1 = trim($row1);
          $b= explode(',', $row1);
      }
      ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Shopping Cart System</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
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
                  <a class="nav-link" aria-current="page" href="../home.php">Home</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="../view.php">Profile</a>
                </li>
                           

                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Change Details                </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                          <li><a class="dropdown-item" href="../Change_pass.php">Change Password</a></li>
                          <li><a class="dropdown-item" href="../update.php">Change profile Details</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>

                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../cate_update.php">Update My Categories</a>
                  </li>

                    <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="../buyer_complain.php">Complain</a>
                   </li>

              </ul>

            
             <ul class="navbar-nav m-2">
                <li class="nav-item me-3">
                  <a class="nav-link btn btn-primary text-light" aria-current="page" href="index.php">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-bag-check mb-1" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                      <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                    </svg> Booking
                    </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="cart.php"><i class="fas fa-truck"></i> <span id="cart-item" class="badge badge-danger"></span></a>
                </li>

              <li class="'nav-item">
                <a class="nav-link btn btn-outline-secondary" aria-current="page" href="../logout.php"> Logout</a>
              </li>
             </ul> 


            </div>
          </div>

        </nav>
    </div>
<!-- <nav class="navbar navbar-expand-md bg-dark navbar-dark">
   
    <a class="navbar-brand" href="login.php"><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;Buyers' Store</a>
 
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
      <li class="'nav-item">
        <a class="nav-link" aria-current="page" href="cate_update.php">Category Update</a>
      </li>

        <li class="nav-item">
          <a class="nav-link active" href="index.php"><i class="fas fa-th-list mr-2"></i>Categories</a>
        </li>
       
       
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-truck"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>

        <li class="'nav-item">
        <a class="nav-link" aria-current="page" href="login.php"> Sign In</a>
      </li>
      </ul>
    </div>
  </nav> -->


  <!-- Displaying Products Start -->
  <div class="container">
    <div id="message"></div>
    

 <br>
 <b>
 <div class="row">
                       <div class="col">Seller NIC NUM.</div>

                        <div class="col">Category</div>
                        <div class="col">Quantity</div>
                        <div class="col">Route</div>
                        <div class="col">Set Date</div>
                       <!--  <div class="col">Set Time</div> -->
                        <div class="col">  Action</div>
                        </div></b>
<hr>
 
                            <?php
                            /*
                            echo '<table>';
                            echo "<tr>";
                            echo "<th>"."NIC No"."</th>";
                            echo "<th>"."Garbage"."</th>";
                            echo "<th>"."Quantity"."</th>";
                            echo "<th>"."Action"."</th>";
                            echo "</tr>";
                            echo "<tr>";*/
         

                        
                            
                            while($rowA=mysqli_fetch_assoc($resultA)):
                              while($u_garbage=mysqli_fetch_assoc($result))
                                                    
                            {
                              ?>
                             <?php
                            echo '<form action="" class="form-submit">';
            $date=date("Y-m-d");
                           if(isset($u_garbage['plastic_sell']) && in_array('Plastic',$b))
                            {      
                              if($u_garbage['plastic_sell']!== '0')   { 
                            ?>


                        <div class="row">
                        <div class="col"> <?= $u_garbage['u_nic_no']?></div>
                        <div class="col">  Plastic</div>
                        <div class="col"> <input type="number" class="form-control pqty" value="<?= $u_garbage['plastic_sell'] ?>"></div>
                        <div class="col"> <input type="text" class="form-control route" value="<?php echo $u_garbage['route'];?>" readonly></div>
                        <div class="col"> <input type="date" class="form-control date" required value="<?php  echo date('Y-m-d',strtotime($date.' + 3 days'));?>"></div>
                         <input type="hidden" class="form-control time">
                        <div class="col">  <button class="btn btn-info btn-block text-light addItemBtn"><i class="fas fa-truck"></i>&nbsp;&nbsp;Add to
                                            List</button></div></div>


                            <input type="hidden" class="u_nic_no" value="<?=$u_garbage['u_nic_no']?>">
                            <input type="hidden" class="pname" value="Plastic">
                            <input type="hidden" class="pprice" value="<?=$rowA['Plastic']?>">
                     
                            <input type="hidden" class="pcode" value="<?= $u_garbage['u_nic_no']."Plastic".$u_garbage['plastic_sell'] ?>">
                           
                            <input type="hidden" class="b_nic_num" value='<?php echo $b11?>'>
                            <?php }  }?>


















                          
                                         <?php  /*     $x=array("Paper"=>40,"Plastic"=>60);
                                                 foreach($x as $key=>$value)
                                                  {
                                                    if(isset($u_garbage[$key]) && in_array($key,$b))
                                                    {              
                                                    ?>
                        
                        
                                                    <?= $u_garbage['u_nic_no']?>
                                                    <?= $key?>
                                                    <input type="number" class="form-control pqty" value="<?= $u_garbage[$key]?>">
                                                   
                 
                        
                                                    <input type="hidden" class="u_nic_no" value="<?=$u_garbage['u_nic_no']?>">
                                                    <input type="hidden" class="pname" value="<?=$key?>">
                                                    <input type="hidden" class="pprice" value="<?=$value?>">
                                                   
                                                    <input type="hidden" class="pcode" value="<?= $u_garbage['u_nic_no'].$key ?>">
                                                  
                                                    <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-truck"></i>&nbsp;&nbsp;Add to
                                                                    List</button>
                                       
                                                    <?php } } */?>









                                                    

                                                    <?php echo "</form>"?>
                                                   
                                                     <?php }
                                                     endwhile;
                                                
                                                     ?>
  </div>
  <!-- Displaying Products End -->
  <?php include('index1.php');?>
  <?php include('index2.php');?>
  <?php include('index3.php');?>
 <?php include('index4.php');?>
 <?php include('index5.php');?>
 <?php include('index6.php');?>
 <?php include('index7.php');?>
 <?php include('index8.php');?>




  
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
       var route = $form.find(".route").val();
       var b_nic_num = $form.find(".b_nic_num").val();

      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {
        
          pname: pname,
          pprice: pprice,
          pqty: pqty,
          u_nic_no: u_nic_no,
          pcode: pcode,
          date:date,
          time:time,
          route:route,
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
        url: 'action.php',
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