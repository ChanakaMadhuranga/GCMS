<?php
  session_start();
  require 'config.php';
  $user_id=$_SESSION['user_id'];
  $queryb = mysqli_query($conn,"SELECT b_nic_num FROM buyers3 WHERE user_id='$user_id' "); 

while($row_b = mysqli_fetch_assoc($queryb))
			{
         


$b11=$row_b['b_nic_num'];
    
      }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Category Selection Page</title>
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
                           

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                   Change Details
                  </a>
                     <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="../Change_pass.php">Change Password</a></li>
                          <li><a class="dropdown-item" href="../update.php">Change profile Details</a></li>
                     </ul>
                </li>

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
                  <a class="nav-link active" href="cart.php"><i class="fas fa-truck"></i> <span id="cart-item" class="badge badge-danger"></span></a>
                </li>

              <li class="'nav-item">
                <a class="nav-link btn btn-outline-secondary" aria-current="page" href="../logout.php"> Logout</a>
              </li>
             </ul> 


            </div>
          </div>

        </nav>
    </div>

 <!--  <nav class="navbar navbar-expand-md bg-dark navbar-dark">

    <a class="navbar-brand" href="index.php"><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;Buyers' Store</a>
   
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php"><i class="fas fa-th-list mr-2"></i>Categories</a>
        </li>
       
       
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-truck"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
      </ul>
    </div>
  </nav> -->

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div style="display:<?php if (isset($_SESSION['showAlert'])) {
  echo $_SESSION['showAlert'];
} else {
  echo 'none';
} unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><?php if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
} unset($_SESSION['showAlert']); ?></strong>
        </div>
        <div class="table-responsive mt-2">

          <table class="table table-striped text-center">
          
            <thead>
              <tr>
                <td colspan="8">
                  <h4 class="text-center text-info m-0">Items in your List!</h4>
                </td>
              </tr>
              <tr>
                <th>Seller NIC NUM</th>
                
                <th>Category</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Date</th>
              <!--   <th>Time</th> -->
                <th>
                  <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your List?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear List    </a>
                </th>
              </tr>

            </thead>

            <tbody>

              <?php
                require 'config.php';
                $stmt = $conn->prepare("SELECT * FROM cart where b_nic_num='$b11'");
                $stmt->execute();
                $result = $stmt->get_result();
                $grand_total = 0;
                while ($row = $result->fetch_assoc()):
              ?>
              <tr>
                <td><?= $row['u_nic_no'] ?></td>

                      <input type="hidden" class="pcode" value="<?= $row['g_code'] ?>">
                
                <td><?= $row['g_name'] ?></td>

                <td>
                <b>Rs. </b>&nbsp;&nbsp;<?= number_format($row['g_price'],2); ?>
                </td>





                    <input type="hidden" class="pprice" value="<?= $row['g_price'] ?>">
                   
                <td>
                  <input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>" style="width:75px;">
                </td>

                <td><b>Rs. </b>&nbsp;&nbsp;<?= number_format($row['total_price'],2); ?></td>


<td>
<?=$row['date']?>
</td>
<!-- <td><?=$row['time']?></td>
 -->

                <td>
                  <a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
                </td>

              </tr>

              <?php $grand_total += $row['total_price']; ?>

              <?php endwhile; ?>

              <tr>
               
                <td colspan="3">
                  <a href="index.php" class="btn btn-success"><i class="fas fa-truck"></i>&nbsp;&nbsp;Continue
                    Adding items</a>
                </td>

                <td colspan="3"><b>Grand Total</b></td>

                <td><b>Rs. &nbsp;&nbsp;<?= number_format($grand_total,2); ?></b></td>
                
                

              </tr>

            </tbody>

          </table>

        </div>
      </div>
    </div>
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
        url: 'action.php',
        method: 'post',
        cache: false,
        data: {
          qty: qty,
          pcode:pcode,
          pprice: pprice
        },
        success: function(response) {
          console.log(response));
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