<?php
    session_start();

    include("inc/connection.php");
    include("inc/functions.php");

    if (!isset($_SESSION['user_id'])) {
      header('Location: login.php');
    
    }
    $user_id = $_SESSION['user_id'];

    $query_bin = "SELECT SUM(plastic_sell) AS 'Plastic', SUM(organic_sell) AS 'Organic', SUM(polythene_sell) AS 'Polythene', SUM(metal_sell) AS 'Metal', SUM(paper_sell) AS 'Paper', SUM(coconut_shell_sell) AS 'Coconut_shell', SUM(glass_sell) AS 'Glass', SUM(fabric_sell) AS 'Fabric', SUM(e_waste_sell) AS 'Ewaste' FROM update_bin";
    
    $result_bin = mysqli_query($connection, $query_bin);
    $row_bin = mysqli_fetch_assoc($result_bin);

    $query_category = "SELECT b_garbage FROM buyers3 where user_id= $user_id";
    $result_category = mysqli_query($connection, $query_category);

    while($row_category = mysqli_fetch_assoc($result_category)) {
            $row1 = $row_category['b_garbage'];
            $row1 = trim($row1);

            $category= explode(',', $row1);

        }

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

<div class="p-2 m-3">
    
    <div class="row">

            <div class="col-12 col-lg-6 col-md-10 card shadow">
                <label class="fs-2 fw-bold m-3">Waste To Be Collected</label>
                <canvas id="myChart"></canvas>
            </div>
            <div class="col-12 col-lg-6 col-md-10 card shadow">
                <?php
                    include("home-2.php");
                ?>
            </div>
    </div>
</div>

 <div class="">
    <div class="border border-warning shadow rounded mb-3">
        <?php
            include("b_waste_locations.php");
        ?>
    </div>
</div>


 <script>
    var row_bin = <?php echo json_encode($row_bin); ?>;
    //console.log(row_bin);

    var category = <?php echo json_encode($category); ?>;
    //console.log(category);

    var chart_keys = [];
    var chart_values = [];
    //console.log(Object.keys(row_bin)[3]);
    //console.log(JSON.stringify(Object.keys(row_bin)[3]));

    //console.log(Object.values(row_bin)[3]);

    for (var i =  0; i <9; i++) {

        var key = Object.keys(row_bin)[i];
        var value = Object.values(row_bin)[i];
        
        if (category.includes(key)) {

            chart_keys.push(key);
            chart_values.push(parseFloat(value));
        }
    }
    //console.log(chart_keys);
    console.log(chart_values);


var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: chart_keys,
        datasets: [{
            label: '# of Buckets',
            data: chart_values,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

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
