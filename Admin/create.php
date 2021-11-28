<?php
    session_start();

  include("connection.php");
  include("functions.php");
?>


<!DOCTYPE html>
<html>
<head>
	<title>Schedule</title>
	    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</head>



<body id="body">

		<style type="text/css">
		#body
			{
				font-family: Arial;
				background-image: linear-gradient(to right top, pink, purple, skyblue);
	</style>
      
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
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
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
            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
    <?php
    
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
    
            //something was posted
          $date = $_POST['date'];
          $driver = $_POST['driver'];
          $worker1 = $_POST['worker1'];
          $worker2 = $_POST['worker2'];
          $worker3 = $_POST['worker3'];
          $worker4 = $_POST['worker4']; 
          $v_no = $_POST['v_no'];
          $route_name = $_POST['route_name'];
          //$garbage=$_POST['b_garbage'];
    
          $garbage_list=" ";
          if (!empty($driver) && !empty($v_no)) 
          {
    
            if(!empty($_POST['b_garbage']))
            { 
                foreach($_POST['b_garbage']as $gar)
                {
                        $garbage_list .=$gar.",";
                }
                //save to database
                  $query = "insert into schedule (date, driver, worker1, worker2, worker3, worker4, v_no, route_name, garbage) values('$date', '$driver', '$worker1', '$worker2', '$worker3', '$worker4', '$v_no', '$route_name','$garbage_list')";
    
                  $result = mysqli_query($connection, $query);
    
                  if ($result) 
                  {
                    echo '<div class="alert alert-success" role="alert">';
                        echo "Schedule Added Successfully!";
                    echo '</div>';
                    
                  }
                  else
                  {
                    echo '<div class="alert alert-danger" role="alert">';
                         echo "Something went wrong!";
                    echo '</div>'; 
                  }
    
            }else{
                echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    echo 'Please select atleast one garbage type!';
                echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo'</div>';         
            }
              //}
          }
        }  
    ?>
    
    
    
    
        <div class="container-fluid col-lg-4 col-md-6 col-sm-8 col-xs-12 align-content-center shadow mt-3 p-3 mb-5 bg-dark rounded" style="opacity: 0.8;">
    
        <form class="form-container text-light" method="Post" enctype="multipart/form-data" name="Schedule">
    
        	    <div class="fs-2 fw-bold text-center m-3">Create Schedule</div>
    
       <div class="row">
        <div class="col-3"><label class="form-label">Date</label></div>
        <div class="col-8"><input class="form-control" type="date" name="date" required></div>
            </div>
    
        <br>
    
        <div class="row">
                  <div class="col-3"><label class="form-label">Driver</label></div>
          <div class="col-8">
                <select name="driver" class="form-select" required>
                <option disabled selected></option>
                <?php
                    include "connection.php";  // Using database connection file here
                    $records = mysqli_query($connection, "SELECT w_fname,w_lname From worker where w_post = 'Driver'");  // Use select query here 
    
                    while($data = mysqli_fetch_array($records))
                    {
                       echo "<option value='". $data['w_fname']." ".$data['w_lname'] ."'>" .$data['w_fname']. " " .$data['w_lname'] ."</option>";  // displaying data in option menu
                    }	
                ?>  
                </select>
            </div>
        </div>
        <br>
    
    
    
        <div class="row">
                  <div class="col-3"><label class="form-label">Worker1</label></div>
          <div class="col-8">
              <select name="worker1" class="form-select" required>
                <option disabled selected></option>
                <option value="-">-</option>
                <?php
                    include "connection.php";  // Using database connection file here
                    $records = mysqli_query($connection, "SELECT w_fname,w_lname From worker where w_post = 'Helper'");  // Use select query here 
    
                    while($data = mysqli_fetch_array($records))
                    {
                        echo "<option value='". $data['w_fname']." ".$data['w_lname'] ."'>" .$data['w_fname']. " " .$data['w_lname'] ."</option>";  // displaying data in option menu
                    } 
                ?>  
              </select>
          </div>
        </div>
    
        <br>
        <div class="row">
                  <div class="col-3"><label class="form-label">Worker2</label></div>
          <div class="col-8">
              <select name="worker2" class="form-select" required>
                <option disabled selected></option>
                <option value="-">-</option>
                <?php
                    include "connection.php";  // Using database connection file here
                    $records = mysqli_query($connection, "SELECT w_fname,w_lname From worker where w_post = 'Helper'");  // Use select query here 
    
                    while($data = mysqli_fetch_array($records))
                    {
                        echo "<option value='". $data['w_fname']." ".$data['w_lname'] ."'>" .$data['w_fname'] ." " .$data['w_lname'] ."</option>";  // displaying data in option menu
                    } 
                ?>  
              </select>
          </div>
        </div>
        <br>
    
    
        <div class="row">
                  <div class="col-3"><label class="form-label">Worker3</label></div>
          <div class="col-8">
              <select name="worker3" class="form-select" required>
                <option disabled selected></option>
                <option value="-">-</option>
                <?php
                    include "connection.php";  // Using database connection file here
                    $records = mysqli_query($connection, "SELECT w_fname,w_lname From worker where w_post = 'Helper'");  // Use select query here 
    
                    while($data = mysqli_fetch_array($records))
                    {
                        echo "<option value='". $data['w_fname']." ".$data['w_lname'] ."'>" .$data['w_fname'] ." " .$data['w_lname'] ."</option>";  // displaying data in option menu
                    } 
                ?>  
              </select>
          </div>
        </div>
        <br>
    
    
        <div class="row">
                  <div class="col-3"><label class="form-label">Worker4</label></div>
          <div class="col-8">
              <select name="worker4" class="form-select" required>
                <option disabled selected></option>
                <option value="-">-</option>
                <?php
                    include "connection.php";  // Using database connection file here
                    $records = mysqli_query($connection, "SELECT w_fname,w_lname From worker where w_post = 'Helper'");  // Use select query here 
    
                    while($data = mysqli_fetch_array($records))
                    {
                        echo "<option value='". $data['w_fname']." ".$data['w_lname'] ."'>" .$data['w_fname'] ." " .$data['w_lname'] ."</option>";  // displaying data in option menu
                    } 
                ?>  
              </select>
          </div>
        </div>
        <br>
    
    
        <div class="row">
                  <div class="col-3"><label class="form-label">Vehicle no</label></div>
          <div class="col-8">
              <select name="v_no" class="form-select" required>
                <option disabled selected></option>
                <?php
                    include "connection.php";  // Using database connection file here
                    $records = mysqli_query($connection, "SELECT v_no From vehicle");  // Use select query here 
    
                    while($data = mysqli_fetch_array($records))
                    {
                        echo "<option value='". $data['v_no'] ."'>" .$data['v_no']."</option>";  // displaying data in option menu
                    } 
                ?>  
              </select>
          </div>
        </div>
        <br>
    
        <div class="row">
                  <div class="col-3"><label class="form-label">Route</label></div>
          <div class="col-8">
              <select name="route_name" class="form-select" required>
                <option disabled selected></option>
                <?php
                    include "connection.php";  // Using database connection file here
                    $records = mysqli_query($connection, "SELECT route_name From routes");  // Use select query here 
    
                    while($data = mysqli_fetch_array($records))
                    {
                        echo "<option value='". $data['route_name'] ."'>" .$data['route_name']."</option>";  // displaying data in option menu
                    } 
                ?>  
              </select>
          </div>
        </div>
        <br>
    
                        <fieldset class="form-group">
                           
                           <legend class="col-form-label col-sm-5 pt-0"><b>Type of Garbage</b></legend>
                                <div class="col-sm-10">
                                  <div class="row">
                                      <div class="form-check col-4">
                                          <input type="checkbox" name="b_garbage[]" value="Organic">
                                          <label class="form-check-label">Organic</label>
                                      </div>
    
                                      <div class="form-check col-4">
                                          <input type="checkbox" name="b_garbage[]" value="Polythene">
                                          <label class="form-check-label">Polythene</label><br>
                                      </div>
    
                                      <div class="form-check col-4">
                                          <input type="checkbox" name="b_garbage[]" value="Plastic">
                                          <label class="form-check-label">Plastic</label>
                                      </div>
                                  </div>
    
                                  <div class="row">
                                    <div class="form-check col-4">
                                        <input type="checkbox" name="b_garbage[]" value="Metal">
                                        <label class="form-check-label">Metals</label>
                                    </div>
                                    <div class="form-check col-4">
                                        <input type="checkbox" name="b_garbage[]" value="Glass">
                                        <label class="form-check-label">Glass</label>
                                    </div>
                                   
                                    <div class="form-check col-4">
                                        <input type="checkbox" name="b_garbage[]" value="Coconut_shell">
                                        <label class="form-check-label">Coconut</label><br>
                                    </div>
                                  </div>
    
                                  <div class="row">
                                    <div class="form-check col-4">
                                        <input type="checkbox" name="b_garbage[]" value="Fabric">
                                        <label class="form-check-label">Fabric</label>
                                    </div>
                                    <div class="form-check col-4">
                                        <input type="checkbox" name="b_garbage[]" value="Paper">
                                        <label class="form-check-label">Paper</label>
                                    </div>
                                    <div class="form-check col-4">
                                        <input type="checkbox" name="b_garbage[]" value="E-waste">
                                        <label class="form-check-label">E-waste</label>
                                    </div>
                                  </div>
                                
                                </div>
                            </fieldset>
    
    
                
                  <div>
                  	<center>
                          <button type="submit" class="btn btn-success p-2 m-2">Submit</button>
                           <button type="reset" class="btn btn-secondary p-2 m-2">Reset</button>
                    </center>
                  </div>
    
    <?php mysqli_close($connection);  // close connection ?>

    </form>
    </div>
    
</div>

</body>
</html>