<?php
session_start();
    $nic_num = $_SESSION['u_nic_no'];
    //$nic_num = "960331478v";
    

    include('inc/connection.php');
    include('inc/functions.php');

    ?>
    
    
<!DOCTYPE html>
 <html>
     <head>
          <!-- Required meta tags -->
           <meta charset="utf-8">
           <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>Complain Section</title>

         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

     </head>

     <body id="body">
        <style type="text/css">
        #body
          {
            background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);
            min-height: 100vh;
          }
      </style>


       <div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <div class="container-fluid">
    <a class="navbar-brand" href="#"> Welcome <?php echo $_SESSION['u_first_name']; ?>!</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="home.php">Home</a>
        </li>


        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="chart.php">Personal Bin</a>
        </li>

        <!-- <li class="nav-item">
          <a class="nav-link" aria-current="page" href="chart.php">View Bin</a>
        </li>
 -->

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="user_complain.php">Complain</a>
        </li>

          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="allnotification.php">Notification</a>
          </li>


       <!--  <li class="nav-item">
          <a class="nav-link" aria-current="page" href="modify-user.php">Profile Details</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="change-password.php">Change Password</a>
        </li> -->



        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Profile
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="modify-user.php">profile Details</a></li>
                  <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>
            
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


<?php
    
      if($_SERVER['REQUEST_METHOD'] == "POST")
      {
          
          $complain = $_POST['complain'];
      }

        if (!empty($complain) )

             {

      $fileName = basename($_FILES["image"]["name"]); 
          $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
          // Allow certain file formats 
           $allowTypes = array('jpg','png','jpeg','gif'); 
           if(in_array($fileType, $allowTypes))
           { 
               $image = $_FILES['image']['tmp_name']; 
               $imgContent = addslashes(file_get_contents($image)); 
           }
            if (isset($imgContent)) {
                $query = "insert into complain (nic_num, complain, photo, user) values('$nic_num', '$complain', '$imgContent', 'End-User')";
            }else{
                 $query = "insert into complain (nic_num, complain, photo, user) values('$nic_num', '$complain', '', 'End-User')";
            }
             
              $result = mysqli_query($connection, $query);

              if ($result) 
              {
                //query successful..
                 //echo 'Successful!'; 
                 echo '<div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                            <div>
                                Complain sent successfully!
                            </div>
                        </div>';

              }else
              {
                echo '<div class="alert alert-primary d-flex align-items-center" role="alert">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                          </svg>
                          <div>
                            Error ocurred!
                          </div>
                        </div>';
                die;
              }
       } 
    ?>



        <div class="container col-11 col-lg-4 col-md-6 col-sm-12 col-xs-12 align-content-center shadow p-3 mt-5 bg-dark rounded" style="opacity: 0.8">
                         
                <form enctype="multipart/form-data" method="post">
                    <div class="fs-2 fw-bold text-center text-light m-3">Complain</div>

                       <div>
                            <textarea class="form-control mt-3" rows="4" placeholder="Add complain here. . ." name="complain" required></textarea>
                       
                            <input class="form-control mt-3" type="file" name="image">
                       
                            <button type="reset" class="btn btn-secondary mt-3" style="width: 100%;"><i style="padding-right: 5px;"></i> Reset</button>
                        
                            <button type="submit" class="btn btn-danger mt-3" style="width: 100%;"><i class="fa fa-envelope-o" style="padding-right: 5px;"></i> Send</button>
                        </div>  

                </form>                     
            
        </div>

    </body>
 </html>  




