<!DOCTYPE html>
<html>
<head>
		 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

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
            <a class="nav-link active" href="complains_display.php">Complains</a>
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
  
<center><div class="fs-2 fw-bold m-3 shadow p-2 mb-3 card alert-primary">Complains</div></center>
  
    <?php
    
    include("connection.php");
    
    	//create connection & check connection
    	if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
    	{
    	
    		die("failed to connect!");
    	}
    
    	$sql = "SELECT * FROM complain";
    	$result = mysqli_query($con, $sql);
    
    	if(mysqli_num_rows($result) > 0)
    	{
    		function Active_acc($a) {
    
    			$row["NIC"] = $a;
    		}
    		
		    echo "<div class='table-responsive'>";
		    echo "<table class='table table-striped alert-danger table-bordered'>";
    		echo " <tr class='text-center'>
    					<th>Complain No</th>  <th>NIC No</th> <th>User</th>   <th>Date</th>  <th>Complaint</th>  <th>Photo</th>
    				</tr>";
    
    	//print query data on a table
    		for ($i=0; $i <mysqli_num_rows($result) ; $i++) { 
    			# code...
    			$row = mysqli_fetch_assoc($result);
    
    			$blob1 = $row["photo"];
          if(empty($blob1)){
              $c_blob1 = "Not available";
          }else{
              $c_blob1 = '<img height="60" width="60" src="data:image/jpg;base64,'.base64_encode($blob1).'"/>';
          }
    
    		
    
    						  echo '<tr>
    							  		<td class="text-center">'.$row["c_no"].'</td>
    									<td>'.$row["nic_num"].'</td>
    									<td>'.$row["user"].'</td>    
    									<td>'.$row["date"].'</td>  
    									<td>'.$row["complain"].'</td>  
    									<td class="text-center">'.$c_blob1.'</td>
    								</tr>';
    		}
    		echo "</table>";
    		
    
    	}else
    		{
    			echo '<div class="alert alert-success d-flex align-items-center" role="alert">
                          No complains to show!
                      </div>';
    		}
    
    
    		mysqli_close($con);
    		?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>
</html>