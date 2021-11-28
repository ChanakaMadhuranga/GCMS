<?php require_once('connection.php'); 

    session_start();
    if (!isset($_SESSION['a_id'])) {
        header('Location: login.php');
        }

$myNames = ['Plastic','Organic','Ploythene','Metal','Paper','Coconut shell','Glass','Fabric','E-waste'];

$query = "SELECT SUM(plastic_not_sell) as Total FROM `collected_bin` WHERE YEAR(update_date) = YEAR(CURDATE()) GROUP BY MONTH(update_date)";
$result = mysqli_query($connection, $query);

$quantites11 = array();
while($row = mysqli_fetch_array($result))
{
  array_push($quantites11, doubleval($row['Total']));
}

$query = "SELECT SUM(organic_not_sell) as Total FROM `collected_bin` WHERE YEAR(update_date) = YEAR(CURDATE()) GROUP BY MONTH(update_date)";
$result = mysqli_query($connection, $query);

$quantites12 = array();
while($row = mysqli_fetch_array($result))
{
  array_push($quantites12, doubleval($row['Total']));
}

$query = "SELECT SUM(polythene_not_sell) as Total FROM `collected_bin` WHERE YEAR(update_date) = YEAR(CURDATE()) GROUP BY MONTH(update_date)";
$result = mysqli_query($connection, $query);

$quantites13 = array();
while($row = mysqli_fetch_array($result))
{
  array_push($quantites13, doubleval($row['Total']));
}

$query = "SELECT SUM(metal_not_sell) as Total FROM `collected_bin` WHERE YEAR(update_date) = YEAR(CURDATE()) GROUP BY MONTH(update_date)";
$result = mysqli_query($connection, $query);

$quantites14 = array();
while($row = mysqli_fetch_array($result))
{
  array_push($quantites14, doubleval($row['Total']));
}

$query = "SELECT SUM(paper_not_sell) as Total FROM `collected_bin` WHERE YEAR(update_date) = YEAR(CURDATE()) GROUP BY MONTH(update_date)";
$result = mysqli_query($connection, $query);

$quantites15 = array();
while($row = mysqli_fetch_array($result))
{
  array_push($quantites15, doubleval($row['Total']));
}

$query = "SELECT SUM(coconut_shell_not_sell) as Total FROM `collected_bin` WHERE YEAR(update_date) = YEAR(CURDATE()) GROUP BY MONTH(update_date)";
$result = mysqli_query($connection, $query);

$quantites16 = array();
while($row = mysqli_fetch_array($result))
{
  array_push($quantites16, doubleval($row['Total']));
}

$query = "SELECT SUM(glass_not_sell) as Total FROM `collected_bin` WHERE YEAR(update_date) = YEAR(CURDATE()) GROUP BY MONTH(update_date)";
$result = mysqli_query($connection, $query);

$quantites17 = array();
while($row = mysqli_fetch_array($result))
{
  array_push($quantites17, doubleval($row['Total']));
}

$query = "SELECT SUM(fabric_not_sell) as Total FROM `collected_bin` WHERE YEAR(update_date) = YEAR(CURDATE()) GROUP BY MONTH(update_date)";
$result = mysqli_query($connection, $query);

$quantites18 = array();
while($row = mysqli_fetch_array($result))
{
  array_push($quantites18, doubleval($row['Total']));
}

$query = "SELECT SUM(e_waste_not_sell) as Total FROM `collected_bin` WHERE YEAR(update_date) = YEAR(CURDATE()) GROUP BY MONTH(update_date)";
$result = mysqli_query($connection, $query);

$quantites19 = array();
while($row = mysqli_fetch_array($result))
{
  array_push($quantites19, doubleval($row['Total']));
}


$myNames1 = ['January','February','March','April','May','June','July','August','September','October','November','December'];


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bar Chart</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  </head>
	<body id="body">
    <style type="text/css">
    #body
      {
        font-family: Arial;
      }
  </style>

  <link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>

   <!-- Script -->
   <script src='jquery-3.3.1.js' type='text/javascript'></script>
   <script src='jquery-ui.min.js' type='text/javascript'></script>
   <script type='text/javascript'>
   $(document).ready(function(){
     $('.dateFilter').datepicker({
        dateFormat: "yy-mm-dd"
     });
   });
   </script>

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
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="admin_chartN.php">History</a>
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

  <div class="container-fluid"> 
  <div class="row">                                                 
    <!-- Statestics Start -->
    <div class="col-md-12 col-xl-6">
      <div class="card">
        <div class="card-header">
          <h3 class="shadow p-2 mb-3 card alert-primary" align="center"><B>Total amount of garbage collected</B></h3>

          <h5 class="text alert-warning bg-body rounded shadow p-2 mb-3">
              Select a Route : <select name="route" id="route" class="btn btn-secondary dropdown-toggle" onchange="chartRouteDbUpdate1()"></h5>
            <h5><option value="all" selected>All</option>
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

        <div class="card-body">
    		  <form method='post' action=''>
            <table border="0" style="width:100%">
              <tr>
                <td>
                 From Date <input type='date' id="dateFilter" class='form-control border-danger' name='fromDate' value='<?php if(isset($_POST['fromDate'])) echo $_POST['fromDate']; ?>'>
                </td>
                <td>                             
                 To Date <input type='date' id="dateFilter" class='form-control border-danger' name='endDate' value='<?php if(isset($_POST['endDate'])) echo $_POST['endDate']; ?>'>
                </td>
                <td>
                  <input type='submit' name='but_search' class="btn btn-info mt-4" value='Search'>
                  <input type="button" class="btn btn-danger mt-4" onclick="location.href='admin_chartN.php';" value="Reset" />
                </td>
              </tr>
            </table>
          </form>
  	       
          
          <div class="chart-container shadow p-2 mb-3">
              <canvas id="my_Chart" height="150"></canvas>
          </div>
        </div>
      </div>

      <script>
        //calls only at page load to generate chart 
        chartRouteDbUpdate1();

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
  			var myChart = new Chart(ctx, {
  				type: 'bar',    	// Define chart type
  				data: myData    	// Chart data
  			});
  				
  				function chartRouteDbUpdate1() {

              var route_name = document.getElementById("route").value;
              console.log(route_name);
             
              $.ajax({
                      url:"./chartRouteDbUpdate1.php",
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
                                    
    <div class="col-md-12 col-xl-6">
      <div class="card">
        <div class="card-header">

          <h3 class="shadow p-2 mb-3 card alert-primary" align="center"><B>Monthly garbage collection chart</B></h3>
          
          <h5 class="text alert-warning bg-body rounded shadow p-2 mb-3">
            Select a Garbage-Type : <select name="type" id="type" class="btn btn-secondary dropdown-toggle" onchange="updateType()">
            <option value="type1" selected>Plastic</option>
            <option value="type2">Organic</option>
            <option value="type3">Ploythene</option>
            <option value="type4">Metal</option>
            <option value="type5">Paper</option>
            <option value="type6">Coconut shell</option>
            <option value="type7">Glass</option>
            <option value="type8">Fabric</option>
            <option value="type9">E-waste</option>
          </select> 

        </div>
             
        <div class="card-body">
          <h3 class="shadow p-2 mb-3 card alert-danger" align="center"><B>Year - <?php echo date("Y"); ?></B></h3>
        
          <div class="chart-container1 shadow p-2 mb-3">
              <canvas id="my_Chart1" height="150"></canvas>
              
          </div>
        </div>
      </div>
        
      <script>
      
        var array=[];
        //var data2=[];
        function test1() {  
                
          if (document.getElementById("type").value=="type1") {
            array = [<?php echo json_encode($quantites11); ?>];
            array = Object.values(array)[0];
            console.log(array);
            data1(array);
          }
          if (document.getElementById("type").value=="type2") {
            array = [<?php echo json_encode($quantites12); ?>];
            array = Object.values(array)[0];  
            console.log(array);
            data1(array);
          }
          if (document.getElementById("type").value=="type3") {
            array = [<?php echo json_encode($quantites13); ?>];
            array = Object.values(array)[0];  
            console.log(array);
            data1(array);
          }
          if (document.getElementById("type").value=="type4") {
            array = [<?php echo json_encode($quantites14); ?>];
            array = Object.values(array)[0];  
            console.log(array);
            data1(array);
          }
          if (document.getElementById("type").value=="type5") {
            array = [<?php echo json_encode($quantites15); ?>];
            array = Object.values(array)[0];  
            console.log(array);
            data1(array);
          }
          if (document.getElementById("type").value=="type6") {
            array = [<?php echo json_encode($quantites16); ?>];
            array = Object.values(array)[0];  
            console.log(array);
            data1(array);
          }
          if (document.getElementById("type").value=="type7") {
            array = [<?php echo json_encode($quantites17); ?>];
            array = Object.values(array)[0];  
            console.log(array);
            data1(array);
          }
          if (document.getElementById("type").value=="type8") {
            array = [<?php echo json_encode($quantites18); ?>];
            array = Object.values(array)[0];  
            console.log(array);
            data1(array);
          }
          if (document.getElementById("type").value=="type9") {
            array = [<?php echo json_encode($quantites19); ?>];
            array = Object.values(array)[0];  
            console.log(array);
            data1(array);
          }
        }

        // Data define for line chart
        var myData1;
        function data1(array){
         myData1 = {
          labels: [<?php foreach ($myNames1 as $value1) { echo "'".$value1."',"; } ?>],
          datasets: [{
            label: 'Bags',
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            data: array
          }]
         };
        }

        function updateType() {
          test1();
                  // Destroy the previous chart
          myChart1.destroy();
                  // Draw a new chart on the basic of dropdown
          myChart1 = new Chart(ctx2, {
            type: 'line',  // Select chart type from dropdown
            data: myData1
          });
        };
        
        // Code to drow Chart
        // Default chart defined with type: 'line'
        var ctx2 = document.getElementById('my_Chart1').getContext('2d');
        var myChart1 = new Chart(ctx2, {
          type: 'line',      // Define chart type
          data: myData1     // Chart data
        });
          
          // Function runs on chart type select update
                  
      </script>
    </div>
  </div>

  <br/>
  <div class="row">
    <div class="col-md-4">
      <!-- USERS LIST -->
       <div class="card-header" style="color: brown; background-color:lightsalmon;">
        <h3 class="card-title">Best End-Users</h3>
        <h7>(Selected with maximum points of End-Users)</h7>
        <h5 style="color: white;">Top 10</h5 style="color: white;">
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class ="table">
          <thead>
            <tr>
              <th>NIC</th>
              <th>Name</th> 
            </tr>
          </thead>
          <tbody>
          <?php
            $query = "SELECT * FROM points INNER JOIN user ON points.u_nic_no = user.u_nic_no ORDER BY points DESC LIMIT 0,2";
            $result = mysqli_query($connection, $query);

            if(mysqli_num_rows($result) > 0) {

              //print query data on a table
              for ($i=0; $i < mysqli_num_rows($result) ; $i++) { 
                # code...
                $row = mysqli_fetch_assoc($result);
                echo '<tr> 
                  <td>'.$row["u_nic_no"].'</td> <td>'.$row["u_first_name"].''." ".''.$row["u_last_name"].'</td> </tr>';
              }
            }
          ?>                   
          </tbody>
        </table>
        <!-- /.users-list -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer text-center" style="color: darkblue; background-color:lightsalmon;">
        <a href="register_info.php">View All End-Users</a>
      </div>
      <!-- /.card-footer -->
     </div>
    <!-- /.col -->

    <div class="col-md-4">
      <!-- USERS LIST -->
       <div class="card-header" style="color: #342D7E; background-color:#38ACEC;">
        <h3 class="card-title">Best Buyers</h3>
        <h7>(Selected based on the maximum amount of waste collected)</h7>
        <h5 style="color: white;">Top 10</h5>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
      <table class ="table">
          <thead>
            <tr>
              <th>NIC</th>
              <th>Name</th> 
            </tr>
          </thead>
          <tbody>
<!--           <?php
            $query = "SELECT SUM(plastic_sell+organic_sell+polythene_sell+metal_sell+paper_sell+coconut_shell_sell+glass_sell+fabric_sell+e_waste_sell) AS total,b_nic_num,b_fname,b_lname FROM `buyers3` INNER JOIN collected_bin ON buyers3.b_nic_num = collected_bin.b_nic_num ORDER BY total DESC LIMIT 2";

            $result = mysqli_query($connection, $query);

            if(mysqli_num_rows($result) > 0) {

              //print query data on a table
              for ($i=0; $i < mysqli_num_rows($result) ; $i++) { 
                # code...
                $row = mysqli_fetch_assoc($result);
                echo '<tr> 
                  <td>'.$row["b_nic_num"].'</td> <td>'.$row["b_fname"].''." ".''.$row["b_lname"].'</td> </tr>';
              }
            }else{
              echo "0 results";
            }
          ?>             -->       
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer text-center" style="color: darkblue; background-color:#38ACEC;">
        <a href="b_info.php">View All Buyers</a>
      </div>
      <!-- /.card-footer -->
     </div>
    <!-- /.col -->

    <div class="col-md-4">
      <!-- USERS LIST -->
       <div class="card-header" style="color: black; background-color:#838996;">
        <h3 class="card-title">Best Routes</h3>
        <h7>(Selected with minimum disposed quantity of plastic,polythene)</h7>
        <h5 style="color: white;">Top 10</h5>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class ="table">
          <thead>
            <tr>
              <th>Route</th>
              <th>It's Division</th> 
            </tr>
          </thead>
          <tbody>
          <?php
            $query = "SELECT SUM(plastic_not_sell+polythene_not_sell) AS total,route,u_division FROM `user` INNER JOIN collected_bin ON user.u_nic_no = collected_bin.u_nic_no GROUP BY route ORDER BY total ASC LIMIT 2";
            $result = mysqli_query($connection, $query);

            if(mysqli_num_rows($result) > 0) {

              //print query data on a table
              for ($i=0; $i < mysqli_num_rows($result) ; $i++) { 
                # code...
                $row = mysqli_fetch_assoc($result);
                echo '<tr> 
                  <td>'.$row["route"].'</td> <td>'.$row["u_division"].'</td> </tr>';
              }
            }else{
              echo "0 results";
            }
          ?>                   
          </tbody>
        </table>        
      </div>
      <!-- /.card-body -->
      <div class="card-footer text-center" style="color: darkblue; background-color:#838996;">
        <a href="combined_map.php">View All Routes</a>
      </div>
      <!-- /.card-footer -->
     </div>
    <!-- /.col -->
   </div>
  </div>

	</body>
</html>
