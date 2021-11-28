
  <?php
   session_start();
include("connection.php");
include("functions.php");

$user_data=check_login($con);
    ?>
  

  
<!DOCTYPE html>
<html>
<head>
    <title>your profile </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    
</head>
<body style="background-color:grey;background-repeat:no-repeat;">

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
          <a class="nav-link" aria-current="page" href="n9.php">Profile</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="h8.php">Customers' details</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="b_waste_locations.php">See Map</a>
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
         
      </ul>
    
     <ul class="navbar-nav m-2">
      <li class="'nav-item">
        <a class="nav-link" aria-current="page" href="logout.php"> Logout</a>
      </li>
     </ul> 


    </div>
  </div>

</nav>
</div>


     <div class="container">
       <div class="row">
         <section class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 my-5">
           <div class="card shadow p-5">
             <img src="a1.png" style="width:150px;" class="img-fluid mb-5">
             <h3 class="mb-3"style="align:center;">MY Profile</h3>
             <p class="text-justify">You are logging in Buyers website of GCMS.You can update your profile from below link</p>

             <form>
              <?php
              //$result = mysqli_query($con,"SELECT * FROM buyers3 WHERE");
      
          echo "<table>";
         // echo "<tr><th colspan='2'>           My Profile</th>
         // </tr>";

          $row = $user_data;
          
          echo "<tr>
          <td>First Name</td>
          <td>".$row['b_fname']."</td>
          </tr>";
          echo "<tr>";
          echo "<td>" ."Last Name". "</td>";
          echo "<td>" .$row['b_lname']. "</td>";
          echo "</tr>";
      
          echo "<tr>";
          echo "<td>" ."Address". "</td>";
          echo "<td>" .$row['b_caddress_no']. "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>" ."street". "</td>";
          echo "<td>" .$row['b_street']. "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>" ."city". "</td>";
          echo "<td>" .$row['b_city']. "</td>";
          echo "</tr>";
          
          echo "<tr>";
          echo "<td>" ."E-mail". "</td>";
          echo "<td>" .$row['b_email']. "</td>";
          echo "</tr>";
          
          echo "<tr>";
          echo "<td>" ."DOB". "</td>";
          echo "<td>" .$row['b_dob']. "</td>";
          echo "</tr>";
          
          echo "<tr>";
          echo "<td>" ."Gender". "</td>";
          echo "<td>" .$row['b_gender']. "</td>";
          echo "</tr>";
          
          echo "<tr>";
          echo "<td>" ."NIC No". "</td>";
          echo "<td>" .$row['b_nic_num']. "</td>";
          echo "</tr>";
          
          echo "<tr>";
          echo "<td>" ."Contact No". "</td>";
          echo "<td>" .$row['b_contact_num']. "</td>";
          echo "</tr>";
      
            
          echo "<tr>";
          echo "<td>" ."Company Name ". "</td>";
          echo "<td>" .$row['b_company_n']. "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>" ."Company Contact No ". "</td>";
          echo "<td>" .$row['b_ccontact_num']. "</td>";
          echo "</tr>";
       

          echo "</table>";
          
          mysqli_close($con);
          ?>
              <a href="update.php"><center>Edit your Profile</center></a>

             </form>
           </div>
         </section>
       </div>
     </div>
        </body>
</html>

