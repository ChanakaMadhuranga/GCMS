<?php require_once('connection.php'); 

    session_start();
    if (!isset($_SESSION['a_id'])) {
        header('Location: login.php');
        }


    $myNames = ['Plastic','Organic','Ploythene','Metal','Paper','Coconut shell','Glass','Fabric','E-waste'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Home</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <style>
      #td {
        text-align: center;
        border: 0;
      }
      
  </style>

  </head>
	<body id="body">
    <style type="text/css">
    #body
      {
        font-family: Arial;
      }
  </style>

<div>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand">Welcome Admin!</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">          
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin_chartN.php">History</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              People
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item">User</a>
                  <ul>
                      <li><a class="dropdown-item" href="register_info.php">Users' Details</a></li>
                  </ul>
              </li>
                  
              <li><a class="dropdown-item">Worker</a>
                  <ul>
                      <li><a class="dropdown-item" href="signup.php">A new worker</a></li>
                      <li><a class="dropdown-item" href="info.php">Workers' Details</a></li>
                  </ul>
              </li>
              <li><a class="dropdown-item">Buyer</a>
                <ul>
                    <li><a class="dropdown-item" href="b_info.php">Buyers' Details</a></li>
                </ul>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="complains_display.php">Complains</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="route.php">Add Route</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Job-Schedules
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="create.php">Create a Schedule</a></li>
              <li><a class="dropdown-item" href="schedule-display.php">Schedule Details</a></li>
            </ul>
          </li>
        </ul>

        <ul class="navbar-nav m-2">      
          <li class="'nav-item">
            <a class="nav-link bg-primary rounded text-light" aria-current="page" href="logout.php">Log Out</a>
          </li>
        </ul>

      </div>
    </div>
   </nav>
  </div>
               
  <div class="row">
    <!-- Statestics Start -->
    <div class="col-md-6 col-xl-3">
      <div class="card alert-warning mb-3">
        <table>
          <tr>
            <td id="td">
              <i class="fas fa-users fa-4x"></i>
            </td>
            <td id="td">
              <center>
              <h5>End-Users</h5>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  <?php
                    $query = "SELECT COUNT(u_nic_no) as users FROM user WHERE active_status2 = false";
                    $result = mysqli_query($connection, $query);
                            
                    echo $result->fetch_array()['users'];             
                  ?>
                </span>              
              <h5>
                <?php
                  $query = "SELECT COUNT(u_nic_no) as users FROM user WHERE active_status2 = true";
                  $result = mysqli_query($connection, $query);
                          
                  echo $result->fetch_array()['users'];             
                ?>
              </h5>
              <div class="text-muted">
                <h7>Members</h7>
              </div>
              </center>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <!-- card1 end -->
    <!-- card2 start -->
    <div class="col-md-6 col-xl-3">
      <div class="card alert-info mb-3">
        <table>
          <tr>
            <td id="td">
              <i class="fas fa-database fa-4x"></i>
            </td>
            <td id="td">
              <center>
              <h5>Buyers</h5>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  <?php
                    $query = "SELECT COUNT(b_nic_num ) as buyers FROM buyers3 WHERE active_status2 = false";
                  $result = mysqli_query($connection, $query);
                          
                  echo $result->fetch_array()['buyers'];             
                  ?>
                </span>
              <h5>
                <?php
                  $query = "SELECT COUNT(b_nic_num ) as buyers FROM buyers3 WHERE active_status2 = true";
                  $result = mysqli_query($connection, $query);
                          
                  echo $result->fetch_array()['buyers'];           
                ?>
              </h5>
              <div class="text-muted">
                <h7>Members</h7>
              </div>
              </center>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <!-- card2 end -->
    <!-- card3 start -->
    <div class="col-md-6 col-xl-3">
      <div class="card alert-success mb-3">
        <table>
          <tr>
            <td id="td">
              <i class="fas fa-trash fa-4x"></i>
            </td>
            <td id="td">
              <center>
              <h5>Workers</h5>
              <h5>
                <?php
                  $query = "SELECT COUNT(w_NIC) as wokers FROM worker";
              $result = mysqli_query($connection, $query);
                      
              echo $result->fetch_array()['wokers'];             
                ?>
              </h5>
              <div class="text-muted">
                <h7>Members</h7>
              </div>
              </center>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <!-- card3 end -->
    <!-- card4 start -->
    <div class="col-md-6 col-xl-3">
      <div class="card alert-danger mb-3">
        <table>
          <tr>
            <td id="td">
              <i class="fas fa-truck fa-4x"></i>
            </td>
            <td id="td">
              <center>
              <h5>Vehicles</h5>
              <h5>
                <?php
                  $query = "SELECT COUNT(v_no) as vehicles FROM vehicle";
                  $result = mysqli_query($connection, $query);
                          
                  echo $result->fetch_array()['vehicles'];           
                ?>
              </h5>
              <div class="text-muted">
                <h7>Trucks</h7>
              </div>
              </center>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <!-- card4 end -->
  </div>
    
  <div class="row">
    <!-- Statestics Start -->
    <div class="col-md-12 col-xl-8">
      <div class="card">
        <div class="card-header">
          <center><h3 class="shadow p-2 mb-3 card alert-primary" align="center"><B>Garbage quantities to collect</B></h3></center>

          <h5 class="text alert-warning bg-body rounded shadow p-2 mb-3">
            Select a Route : <select name="route" id="route" class="btn btn-secondary dropdown-toggle" onchange="chartRouteDbUpdate()">
            <option value="all" selected>All</option>
            <?php
                include("connection.php");

                $sql_route = "SELECT route_name FROM routes";
                $result_route = mysqli_query($connection,$sql_route);

                while($row_route = mysqli_fetch_assoc($result_route)){
                    $route_name = $row_route['route_name'];
                    echo '  <option value="'.$route_name.'">'.$route_name.'</option>';
                }
            ?>
      			</select>
          </h5>
        </div>
														       
        <div class="chart-container shadow p-2 mb-3">
            <canvas id="my_Chart" height="150"></canvas>
        </div>

        <script>
          //calls only at page load to generate chart 
          chartRouteDbUpdate();
          
    			// Data define for bar chart
  				var myData;
  				function data(array){
  				 myData = {
  					labels: [<?php foreach ($myNames as $value) { echo "'".$value."',"; } ?>],
  					datasets: [{
  						label: "Bags",
  						fill: false,
  						backgroundColor: ['lightblue','grey','lightblue','grey','lightblue','grey','lightblue','grey','lightblue'],
  						borderColor: 'black',
  						data: array,
  					}]
  				 };
  			  }

          var ctx = document.getElementById('my_Chart').getContext('2d');
          ctx.canvas.height = 170;
          var myChart = new Chart(ctx, {
            type: 'bar',      // Define chart type
            //data: myData      // Chart data
          });


           function chartRouteDbUpdate() {

              var route_name = document.getElementById("route").value;
              console.log(route_name);
             
              $.ajax({
                      url:"./chartRouteDbUpdate.php",
                      method:"post",
                      data: 
                        {route_name: route_name
                        },
                      success: function(result) {
                          console.log(result);
                          var array = result;
                              array = JSON.parse(array);
                              data(array);
                          
                             myChart.destroy();

                             myChart = new Chart(ctx, {
                                type: 'bar',  // Select chart type from dropdown
                                data: myData
                              });

                      }
                  });

          }
    	    	
      		</script>
      </div>
    </div>


    <div class="col-md-12 col-xl-4">
      <table class="container-fluid">
        <tr>
          <h4 align="center" class="shadow p-2 mb-3 card alert-primary"><b>Total garbage quantities to collect according to categories</b></h4>
        </tr>
        
        <tr>
          <td id="td">
            <div class="card alert-info mb-3">
              <div class="card-header text-white bg-info">
                <h5>Plastic <i class="fas fa-shopping-bag"></i></h5>
              </div>

              <div class="card-block">
                <div class="row">
                    <div class="col-6 b-r-default">
                      <h4>                                                             
                        <?php
                          $query = "SELECT SUM(plastic_sell) as plastic_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                          $result = mysqli_query($connection, $query);
                        
                        echo $result->fetch_array()['plastic_sell'];                 
                        ?>
                      </h4>                                                            
                    </div>

                    <div class="col-6">
                        <h4>
                          <?php
                          $query = "SELECT SUM(plastic_not_sell) as plastic_not_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                          $result = mysqli_query($connection, $query);
                        
                          echo $result->fetch_array()['plastic_not_sell'];
                          ?>                                                          
                        </h4>                                                  
                    </div>
                    
                    <div class="col-6 b-r-default">
                      <h6>Sell</h6>
                    </div>

                    <div class="col-6">
                      <h6>Dispose</h6>
                    </div>

                </div>
              </div>
            </div>
          </td>

          <td id="td">
            <div class="card alert-dark mb-3">
              <div class="card-header bg-dark text-white">
                <h5>Organic <i class="fas fa-shopping-bag"></i></h5>
              </div>

              <div class="card-block">
                <div class="row">
                  <div class="col-6 b-r-default">
                      <h4>
                        <?php
                        $query = "SELECT SUM(organic_sell) as organic_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['organic_sell'];             
                        ?>
                      </h4>     
                  </div>

                  <div class="col-6">
                      <h4>
                        <?php
                        $query = "SELECT SUM(organic_not_sell) as organic_not_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['organic_not_sell'];
                        ?>
                        </h4>                                                                
                  </div>

                  <div class="col-6 b-r-default">
                    <h6>Sell</h6>
                  </div>

                  <div class="col-6">
                    <h6>Dispose</h6>
                  </div>

                </div>
              </div>
            </div>
          </td>
        </tr>

        <tr>
          <td id="td">
            <div class="card alert-dark mb-3">
              <div class="card-header bg-dark text-white">
                <h5>Polythene <i class="fas fa-shopping-bag"></i></h5>
              </div>

              <div class="card-block">
                <div class="row">
                  <div class="col-6 b-r-default">
                    <h4>
                      <?php
                        $query = "SELECT SUM(polythene_sell) as polythene_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['polythene_sell'];             
                      ?>
                    </h4>     
                  </div>

                  <div class="col-6">
                    <h4>
                      <?php
                        $query = "SELECT SUM(polythene_not_sell) as polythene_not_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['polythene_not_sell'];
                      ?>
                      </h4>                                                                
                  </div>

                  <div class="col-6 b-r-default">
                    <h6>Sell</h6>
                  </div>

                  <div class="col-6">
                    <h6>Dispose</h6>
                  </div>

                </div>
              </div>
            </div>
          </td>

          <td id="td">
            <div class="card alert-info mb-3">
              <div class="card-header bg-info text-white">
                <h5>Metal <i class="fas fa-shopping-bag"></i></h5>                        
              </div>

              <div class="card-block">
                <div class="row">
                  <div class="col-6 b-r-default">
                    <h4>
                      <?php
                        $query = "SELECT SUM(metal_sell) as metal_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['metal_sell'];             
                      ?>
                    </h4>     
                  </div>

                  <div class="col-6">
                    <h4>
                      <?php
                        $query = "SELECT SUM(metal_not_sell) as metal_not_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['metal_not_sell'];
                      ?>
                    </h4>                                                                
                  </div>

                  <div class="col-6 b-r-default">
                    <h6>Sell</h6>
                  </div>

                  <div class="col-6">
                    <h6>Dispose</h6>
                  </div>

                </div>
              </div>
            </div>
          </td>
        </tr>

        <tr>
          <td id="td">
            <div class="card alert-info mb-3">
              <div class="card-header bg-info text-white">
                <h5>Paper <i class="fas fa-shopping-bag"></i></h5>
              </div>

              <div class="card-block">
                <div class="row">
                  <div class="col-6 b-r-default">
                    <h4>
                      <?php
                        $query = "SELECT SUM(paper_sell) as paper_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['paper_sell'];             
                      ?>
                    </h4>     
                  </div>

                  <div class="col-6">
                    <h4>
                      <?php
                        $query = "SELECT SUM(paper_not_sell) as paper_not_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['paper_not_sell'];
                      ?>
                      </h4>                                                                
                  </div>

                  <div class="col-6 b-r-default">
                    <h6>Sell</h6>
                  </div>

                  <div class="col-6">
                    <h6>Dispose</h6>
                  </div>

                </div>
              </div>
            </div>
          </td>

          <td id="td">
            <div class="card alert-dark mb-3">
              <div class="card-header bg-dark text-white">
                <h5>Coconut-shell <i class="fas fa-shopping-bag"></i></h5>
              </div>

              <div class="card-block">
                <div class="row">
                  <div class="col-6 b-r-default">
                    <h4>
                      <?php
                        $query = "SELECT SUM(coconut_shell_sell) as coconut_shell_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['coconut_shell_sell'];             
                      ?>
                    </h4>     
                  </div>

                  <div class="col-6">
                    <h4>
                      <?php
                        $query = "SELECT SUM(coconut_shell_not_sell) as coconut_shell_not_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['coconut_shell_not_sell'];
                      ?>
                    </h4>                                                                
                  </div>

                  <div class="col-6 b-r-default">
                    <h6>Sell</h6>
                  </div>

                  <div class="col-6">
                    <h6>Dispose</h6>
                  </div>

                </div>
              </div>
            </div>
          </td>
        </tr>

        <tr>
          <td id="td">
            <div class="card alert-dark mb-3">
              <div class="card-header text-white bg-dark">
                <h5>Glass <i class="fas fa-shopping-bag"></i></h5>
              </div>
              <div class="card-block">
                <div class="row">
                  <div class="col-6 b-r-default">
                    <h4>
                      <?php
                        $query = "SELECT SUM(glass_sell) as glass_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['glass_sell'];             
                      ?>
                    </h4>     
                  </div>

                  <div class="col-6">
                    <h4>
                      <?php
                        $query = "SELECT SUM(glass_not_sell) as glass_not_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['glass_not_sell'];
                      ?>
                      </h4>                                                                
                  </div>

                  <div class="col-6 b-r-default">
                    <h6>Sell</h6>
                  </div>

                  <div class="col-6">
                    <h6>Dispose</h6>
                  </div>

                </div>
              </div>
            </div>
          </td>

          <td id="td">
            <div class="card alert-info mb-3">
              <div class="card-header bg-info text-white">
                <h5>Fabric <i class="fas fa-shopping-bag"></i></h5>
              </div>

              <div class="card-block">
                <div class="row">
                  <div class="col-6 b-r-default">
                    <h4>
                      <?php
                        $query = "SELECT SUM(fabric_sell) as fabric_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['fabric_sell'];             
                      ?>
                    </h4>     
                  </div>

                  <div class="col-6">
                    <h4>
                      <?php
                        $query = "SELECT SUM(fabric_not_sell) as fabric_not_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['fabric_not_sell'];
                      ?>
                    </h4>                                                                
                  </div>

                  <div class="col-6 b-r-default">
                    <h6>Sell</h6>
                  </div>

                  <div class="col-6">
                    <h6>Dispose</h6>
                  </div>

                </div>
              </div>
            </div>
          </td>
        </tr>

        <tr>
          <td id="td">
            <div class="card alert-info mb-3">
              <div class="card-header bg-info text-white">
                <h5>E-waste <i class="fas fa-shopping-bag"></i></h5>
              </div>

              <div class="card-block">
                <div class="row">
                  <div class="col-6 b-r-default">
                    <h4>
                      <?php
                        $query = "SELECT SUM(e_waste_sell) as e_waste_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['e_waste_sell'];             
                      ?>
                    </h4>     
                  </div>

                  <div class="col-6">
                    <h4>
                      <?php
                        $query = "SELECT SUM(e_waste_not_sell) as e_waste_not_sell FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['e_waste_not_sell'];
                      ?>
                      </h4>                                                                
                  </div>

                  <div class="col-6 b-r-default">
                    <h6>Sell</h6>
                  </div>

                  <div class="col-6">
                    <h6>Dispose</h6>
                  </div>

                </div>
              </div>
            </div>
          </td>

          <td id="td">
            <div class="card alert-danger mb-3">
              <div class="card-header bg-danger text-white">
                <h5>Total <i class="fas fa-plus-circle"></i></h5>
              </div>

              <div class="card-block">
                <div class="row">
                  <div class="col-6 b-r-default">
                    <h4>
                      <?php
                        $query = "SELECT SUM(plastic_sell+organic_sell+polythene_sell+metal_sell+paper_sell+coconut_shell_sell+glass_sell+fabric_sell+e_waste_sell) as sell_total FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['sell_total'];             
                      ?>
                    </h4>
                  </div>

                  <div class="col-6">
                    <h4>
                      <?php
                        $query = "SELECT SUM(plastic_not_sell+organic_not_sell+polythene_not_sell+metal_not_sell+paper_not_sell+coconut_shell_not_sell+glass_not_sell+fabric_not_sell+e_waste_not_sell) as not_sell_total FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no";
                        $result = mysqli_query($connection, $query);
                      
                        echo $result->fetch_array()['not_sell_total'];             
                      ?>
                    </h4>
                  </div>

                  <div class="col-6 b-r-default">
                    <h6>Sell</h6>
                  </div>

                  <div class="col-6">
                    <h6>Dispose</h6>
                  </div>

                </div>
              </div>
            </div>
          </td>
        </tr>
      </table>
    </div>
  </div>
  
  <div class="">
    <div class="border border-warning shadow rounded mb-3">
        <?php
            include("combined_map.php");
        ?>
    </div>

    <!--<div class="row">-->
    <!--    <h3 align="center" class="shadow p-2 mb-3 card alert-primary"><B>GCMS Map</B></h3>-->
    
    <!--    <?php-->
    <!--      include 'combined_map.php';-->
    <!--    ?>-->
    <!--</div>-->
  
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

	</body>
</html>
