<?php
    session_start();
    if (!isset($_SESSION['a_id'])) {
        header('Location: login.php');
        }
        include("connection.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Encoding Methods</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style type="text/css">
     

      

     

      #right-panel i {
        font-size: 12px;
      }
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      #map {
        height: 100vh;
        width: 100%;
        float: left;
      }

      #encoded-polyline {
        height: 100px;
        width: 100%;
      }
    </style>
    <script>

    	var map, polyline, markers = new Array();

		function initMap() {

		    var mapOptions = {
		        zoom: 13,
		        center: new google.maps.LatLng(6.8018,79.9227),
		        mapTypeId: google.maps.MapTypeId.TERRAIN
		    };

		    map = new google.maps.Map(document.getElementById('map'),
		    mapOptions);

		    polyline = new google.maps.Polyline({
		        strokeColor: 'red',
		        strokeWeight: 1,
		        map: map
		    });

		    google.maps.event.addListener(map, 'click', function (event) {

		        addPoint(event.latLng);
		    });
		}

		function removePoint(marker) {

		    for (var i = 0; i < markers.length; i++) {

		        if (markers[i] === marker) {

		            markers[i].setMap(null);
		            markers.splice(i, 1);

		            polyline.getPath().removeAt(i);
		            //done = alert(google.maps.geometry.encoding.encodePath(polyline.getPath()));
		            var encodedString = google.maps.geometry.encoding.encodePath(polyline.getPath());
		            document.getElementById("encoded-polyline").value = encodedString;

		        }
		    }
		}

		function addPoint(latlng) {

		    var marker = new google.maps.Marker({
		        position: latlng,
		        map: map
		    });

		    markers.push(marker);

		    polyline.getPath().setAt(markers.length - 1, latlng);

		    var encodedString = google.maps.geometry.encoding.encodePath(polyline.getPath());
		    document.getElementById("encoded-polyline").value = encodedString;

		    google.maps.event.addListener(marker, 'click', function (event) {

		        removePoint(marker);

		    });
		}

		
			//done = alert(google.maps.geometry.encoding.encodePath(polyline.getPath()));
    </script>
  </head>
  <body>
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
                    <a class="nav-link active" href="route.php">Add Route</a>
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


  <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") 
      {
        
        $encoded_polyline= $_POST['encoded_polyline'];
        $route_name= $_POST['route_name'];

          $sql = "SELECT route_name FROM routes";
          $sql_result = mysqli_query($connection,$sql);

          while($sql_row = mysqli_fetch_assoc($sql_result)){
              if ($route_name == $sql_row['route_name']) {
                 echo '<div class="alert alert-danger" role="alert">';
                    echo "Route name already exists! Please use a different name";
                 echo '</div>'; 
                 die();
              }
          }

          $query = "INSERT INTO routes (route_name, encoded_polyline) VALUES ('{$route_name}', '{$encoded_polyline}') ";

          $result = mysqli_query($connection, $query);

          if ($result) {
            echo '<div class="alert alert-success" role="alert">';
                echo "Route Added Successfully!";
            echo '</div>';
            
          }
          else
          {
            echo '<div class="alert alert-danger" role="alert">';
                 echo "Error...!";
            echo '</div>'; 
          }
      }

    ?>
    <div>
      <div class="row">
    
         <div class="col-12 col-md-9 col-lg-9 shadow">
           <div id="map"></div>
         </div>
         
         <div class="col-12 col-md-3 col-lg-3 mt-4  shadow fw-bold d-flex justify-content-center">
            <form method="POST" class="form-container">
              <div>
                <div><label class="form-label">Encoding:</label></div>
                <textarea class="form-control" id="encoded-polyline" name="encoded_polyline" required></textarea>
              </div>
              <div>
                <div><label class="form-label">Route Name:</label></div>
                <input class="form-control" type="text" name="route_name" required>
              </div>
              <div class="btn-group p-4">
                <input class="form-control m-1 btn-primary" type="submit" name="Submit"> 
                 <input class="form-control m-1 btn-outline-secondary" onclick="initMap();" type="reset" value="Reset Path" />
              </div>
            </form>
        </div>
         

      </div>
    </div>


    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNky4nu5tOcJKkGHvJI-v89CtSUsc72B8&callback=initMap&libraries=geometry&v=weekly"
      async
    ></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>