

 
<?php
 session_start();
 include("connection.php");
 include("functions.php");
 if(!isset($_SESSION['user_id']))
 {
   header('location:login.php');
 }
$user_id=$_SESSION['user_id'];
$queryb = mysqli_query($con,"SELECT b_garbage,b_nic_num FROM buyers3 WHERE user_id='$user_id' "); 

while($row_b = mysqli_fetch_assoc($queryb))
{
$b11=$row_b['b_nic_num'];
}
$sql="select * from buyers3 where user_id=$user_id ";
$a=mysqli_query($con,$sql);



?>
<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>

<body class="">

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
                  <a class="nav-link btn btn-primary text-light" aria-current="page" href="./Booking/index.php">
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
  <!-- Navbar end -->
<?php


/*$query="select 'paper_sell' as 'Paper','plastic_sell' as 'Plastic',u_nic_no from  update_bin "; */
 $query="SELECT * FROM cart where b_nic_num='$b11' and route='route2' ";
$result = mysqli_query($con, $query);



?>

<br>
<a href="display_category.php" class="btn btn-danger" role="button" aria-presse="true">Route1</a>
<a href="display_category1.php" class="btn btn-danger" role="button" aria-presse="true">Route2</a>
<a href="display_category2.php" class="btn btn-danger" role="button" aria-presse="true">Route3</a>


<br>
<p></p>
 <div class="row">
                        <div class="col">Seller NIC Number</div>
                        <div class="col">Category</div>
                        <div class="col">price</div>
                        <div class="col">Quantity</div>
                        <div class="col">Quality</div>
                        <div class="col">Route</div>
                        <div class="col-2">Action</div>
</div>

<hr>
<?php
                        while($garbage=mysqli_fetch_assoc($result))
                                                    
                         {
                           
                            echo '<form action="" class="form-submit">';
            ?>
             <div class="row">
                        <div class="col"><?= $garbage['u_nic_no']?></div>
                        <div class="col"><?= $garbage['g_name']?></div>
                        <div class="col"><?= $garbage['g_price']?></div>
                        <div class="col"><input type="number" class="form-control pqty" value="<?= $garbage['qty'] ?>"></div>

                        <div class="col"><select name="Grade" class="Grade">
                        <option selected>Quality</option>
                        <option value="Grade-A">Grade-A</option>
                        <option value="Grade-B">Grade-B</option>
                        <option value="Grade-C">Grade-C</option>
                        <option value="Grade-D">Grade-D</option></select>
                        </div>

                        <div class="col"><?= $garbage['route']?></div>
                        <div class="col-2"><button class="btn btn-info btn-block addItemBtn1"><i class="fas fa-truck"></i>&nbsp;&nbsp;
                                  Buy Category          </button></div>

                            <input type="hidden" class="u_nic_no" value="<?=$garbage['u_nic_no']?>">
                            <input type="hidden" class="pname" value="<?= $garbage['g_name']?>">
                            <input type="hidden" class="pprice" value="<?= $garbage['g_price']?>">
                            <input type="hidden" class="route" value="<?= $garbage['route']?>">
                            <input type="hidden" class="b_nic_num" value="<?= $b11?>">
                            <input type="hidden" class="id" value="<?= $garbage['id']?>">
                            </div>
<?php echo "</form>" ?>

<?php } ?>



<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">

 
  $(document).ready(function() {

    // Send product details in the server
    $(".addItemBtn1").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
    
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();
      var pqty = $form.find(".pqty").val();
      var u_nic_no=$form.find(".u_nic_no").val();
      var b_nic_num= $form.find(".b_nic_num").val();
      var route= $form.find(".route").val();
      var id=$form.find(".id").val();
      var Grade=$form.find(".Grade").val();
      $.ajax({
        url: 'action_g.php',
        method: 'post',
        data: {
        
          pname: pname,
          pprice: pprice,
          pqty: pqty,
          u_nic_no: u_nic_no,
          b_nic_num:b_nic_num,
          route:route,
          id:id,
          Grade:Grade,
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
        url: 'action_g.php',
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