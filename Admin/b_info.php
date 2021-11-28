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
          <li class="'nav-item">
            <a class="nav-link bg-primary rounded text-light" aria-current="page" href="logout.php">Log Out</a>
          </li>
        </ul>

      </div>
    </div>
   </nav>
  </div>

<center><div class="fs-2 fw-bold m-3 shadow p-2 mb-3 card alert-primary">Buyers' Details</div></center>

<?php



    include("connection.php");

	//receive sql query from database table
	$sql = "SELECT * FROM buyers3";
	$result = mysqli_query($connection, $sql);

	if(mysqli_num_rows($result) > 0) 
  {
        echo "<div class='table-responsive'>";
		echo "<table class='table table-striped alert-danger table-bordered'>";
		echo "	<tr>
					  <th>No</th> <th>NIC</th> <th>First Name</th> <th>Last Name</th> <th>Gender</th> <th>E-mail</th> <th>Address</th> <th>Date of Birth</th> <th>Contact No</th> <th>Company Name</th> <th>Company Address No</th> <th>Street</th> <th>City</th> <th>Company E-mail</th> <th>Company Contact No</th> <th>Garbage Types</th> <th>Profile Photo</th> <th>ID Photo</th> <th>Active Status 01</th> <th>Active Status 02</th> <th colspan=2><center>Action</center></th> <th colspan=4><center>Active/Deactive</center></th>
				</tr>";

		//print query data on a table
		for ($i=0; $i < mysqli_num_rows($result) ; $i++) { 
			# code...
			$row = mysqli_fetch_assoc($result);

					 $blob1 = $row["b_profile_photo"];
					 $blob2 = $row["b_id_photo"];
					
					 $b_blob1 = '<img height="60" width="60" src="data:image/jpg;base64,'.base64_encode($blob1).'"/>';
					 $b_blob2 = '<img height="60" width="60" src="data:image/jpg;base64,'.base64_encode($blob2).'"/>';

           
			echo '<tr> 
					 <td>'.$row["id"].'</td> <td>'.$row["b_nic_num"].'</td> <td>'.$row["b_fname"].'</td> <td>'.$row["b_lname"].'</td> <td>'.$row["b_gender"].'</td> <td>'.$row["b_email"].'</td> <td>'.$row["b_address"].'</td> <td>'.$row["b_dob"].'</td> <td>'.$row["b_contact_num"].'</td> <td>'.$row["b_company_n"].'</td> <td>'.$row["b_caddress_no"].'</td> <td>'.$row["b_street"].'</td> <td>'.$row["b_city"].'</td> <td>'.$row["b_cemail"].'</td> <td>'.$row["b_ccontact_num"].'</td> <td>'.$row["b_garbage"].'</td> <td>'.$b_blob1. '</td> <td>' .$b_blob2.'</td> <td>'.$row["active_status1"].'</td> <td>'.$row["active_status2"].'</td>';
	
			echo '<form method="get">
            <td>
							<a class="btn btn-info" href="b_update_info.php?b_nic_num='.$row["b_nic_num"].'">Update</a>
						</td>
						<td>
							<a class="btn btn-danger" href="b_delete.php?b_nic_num='.$row["b_nic_num"].'" onclick="return checkDelete()">Remove</a>
						</td>
            </form>';

            $b_nic_num = $row['b_nic_num'];

      echo '<form method="post">
            <td><input class="btn btn-success" type="submit" name="Activate" value="Activate"></td>
            <td><input  type="hidden" name="Confirm" value="'.$b_nic_num.'"></td>
            </form>

            <form method="post">            
            <td><input class="btn btn-danger" type="submit" name="Deactivate" value="Deactivate"></td>
            <td><input  type="hidden" name="Block" value="'.$b_nic_num.'"></td>		
            </form>
                        
            </tr>';                	 		
		}
		echo "</table>"; //end of table	
		
	}else{
		echo "0 results";
	}
 
    if (isset($_POST['Activate'])){ 
              $id1 = $_POST['Confirm']; 
              $sql_active1 = "UPDATE buyers3 SET active_status2 = true WHERE b_nic_num='$id1'";
              mysqli_query($connection, $sql_active1);
              echo "<meta http-equiv='refresh' content='0'>
                  <script type=\"text/javascript\">
                  alert(\"Activate Successfully!\");</script>";
          }

     elseif (isset($_POST['Deactivate'])){
              $id2 = $_POST['Block']; 
              $sql_active2 = "UPDATE buyers3 SET active_status2 = false WHERE b_nic_num='$id2'";
              mysqli_query($connection, $sql_active2);
              echo "<meta http-equiv='refresh' content='0'>
                  <script type=\"text/javascript\">
                  alert(\"Deactivate Successfully!\");</script>";
          }
  
	mysqli_close($connection);
	?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>
</html>