<?php
    session_start();
    if (!isset($_SESSION['a_id'])) {
        header('Location: login.php');
        }
?>

<!DOCTYPE html>
<html>
<head>
		 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    
    <script language="JavaScript" type="text/javascript">
    function checkDelete(){
        return confirm('Are you sure you want to delete this record?');
    }
    </script>

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
            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
          <li class="nav-item">
            <a class="nav-link bg-primary rounded text-light" aria-current="page" href="logout.php">Log Out</a>
          </li>
        </ul>

      </div>
    </div>
   </nav>
  </div>

<center><div class="fs-2 fw-bold m-3 shadow p-2 mb-3 card alert-primary">Workers' Details</div></center> 

<?php

// $dbhost = "localhost";
// $dbuser = "root";
// $dbpass = "";
// $dbname = "gcms_db";

// 	//create connection & check connection
// 	if(!$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
// 	{
	
// 		die("failed to connect!");
// 	}
    include("connection.php");

	$sql = "SELECT * FROM worker";
	$result = mysqli_query($connection, $sql);

	if(mysqli_num_rows($result) > 0)
	{
		function Active_acc($a) {

			$row["w_NIC"] = $a;
		}

        echo "<div class='table-responsive'>";
		echo "<table class='table table-striped alert-danger table-bordered'>";
		echo " <tr>
					<th>No</th> <th>First name</th>  <th>Last name</th>  <th>NIC</th>  <th>District</th>  <th>Address number</th> <th>Address street</th>  <th>Address city</th>  <th>Contact no.1</th> <th>Contact no.2</th>  <th>Post</th>  <th>Gender</th>  <th>Joined date</th>  <th>NIC photo</th>  <th>Profile photo</th> <th colspan=2><center>Action</center></th>
				</tr>";

		//print query data on atable
		for ($i=0; $i <mysqli_num_rows($result) ; $i++) { 
			# code...
			$row = mysqli_fetch_assoc($result);

			$blob1 = $row["w_NIC_photo"];
			$blob2 = $row["w_profile_photo"];

			 $w_blob1 = '<img height="60" width="60" src="data:image/jpg;base64,'.base64_encode($blob1).'"/>';
			  $w_blob2 = '<img height="60" width="60" src="data:image/jpg;base64,'.base64_encode($blob2).'"/>';

			  echo '<tr>
						<td>'.$row["id"].'</td> <td>'.$row["w_fname"].'</td>  <td>'.$row["w_lname"].'</td>  <td>'.$row["w_NIC"].'</td>  <td>'.$row["district"].'</td>  <td>'.$row["Address_number"].'</td>  <td>'.$row["Address_street"].'</td>  <td>'.$row["Address_city"].'</td> <td>'.$row["w_contact_no1"].'</td>  <td>'.$row["w_contact_no2"].'</td>  <td>'.$row["w_post"].'</td>  <td>'.$row["w_gender"].'</td>  <td>'.$row["w_joined_date"].'</td>  <td>'.$w_blob1.'</td>  <td>'.$w_blob2.'</td>

							<td>
								<a class="btn btn-info" href="w_update_info.php?w_NIC='.$row["w_NIC"].'">Update</a>
							</td>
							<td>
								<a class="btn btn-danger" href="w_delete.php?w_NIC='.$row["w_NIC"].'" onclick="return checkDelete()">Remove</a>
							</td>
					</tr>';
		}
		echo "</table>";

	}else
		{
			echo "0 results";
		}


		mysqli_close($connection);
		?>

  
</body>
</html>