<?php
    session_start();
    if (!isset($_SESSION['a_id'])) {
        header('Location: login.php');
        }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>End-User Location Map</title>

     <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <style type="text/css">
      /* Set the size of the div element that contains the map */
      #map {
        height: 80vh;
        /* The height is 400 pixels */
      }
      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
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
    <center><h3><b>User Residence<b></h3></center>
    <!--The div element for the map -->
    <div class="container-fluid">
    <div class="row">
      <div class="col-11 shadow rounded">
        <div id="map"></div>
      </div>

       <div class="col-1">
       <?php

        include("connection.php");

        $encoded_polyline="";
       
        $sql = "SELECT * FROM routes";
        $result = mysqli_query($connection, $sql);

        if(mysqli_num_rows($result) > 0)
        {
            echo "<table class = 'table table-borderless table-hover'>";
            echo " <tr>
                         <th>Route</th>
                    </tr>";

            //print query data on atable
            for ($i=0; $i <mysqli_num_rows($result) ; $i++) { 
                # code...
                $row = mysqli_fetch_assoc($result);

                $encoded_polyline = $row['encoded_polyline'];

                  echo "<tr>
                            <td> <button type='botton' class='btn btn-warning' onClick=initialize('$encoded_polyline')>".$row['route_name']."</button> </td> 
                        </tr>";
            }
            echo "</table>";

        }else
            {
                echo "0 results";
            }

            mysqli_close($connection);
            ?>
        </div>

    </div>

  </div>

   <div>
      <a class="col-md-2 col-sm-6 btn btn-outline-success m-2" href="register_info.php">Back to Page</a>
    </div>

     <script>
      var polyline;     //Route Display code
      function initialize(encoded_polyline) {
          
      var decodedPath = google.maps.geometry.encoding.decodePath(encoded_polyline); 
      var decodedLevels = decodeLevels("BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB");
    
            if (polyline==null) {
              polyline = new google.maps.Polyline({
                path: decodedPath,
                levels: decodedLevels,
                strokeColor: "#0000CC",
                strokeOpacity: 1.0,
                strokeWeight: 4,
                map: map            
              });             
              }else{
                  polyline.setPath(decodedPath);
                }                       
              }

    function decodeLevels(encodedLevelsString) {
      var decodedLevels = [];
      var abc = encodedLevelsString;

      for (var i = 0; i < abc.length; ++i) {
        var level = abc.charCodeAt(i) - 63;
        decodedLevels.push(level);
      }
      return decodedLevels;
    }



      // get submitted data to local variables
       let Lat = "<?php echo $_GET['latitude']; ?>";
       let Lng = "<?php echo $_GET['longitude']; ?>";

      console.log(Lat);
      console.log(Lng);
      // Initialize and add the map
      var map;
      function initMap() { 
        // The location of Uluru
        //const uluru = { lat: -25.344, lng: 131.036 };
        const uluru = {lat: parseFloat(Lat), lng: parseFloat(Lng)};
        console.log(uluru);
        // The map, centered at Uluru
          map = new google.maps.Map(document.getElementById("map"), {
          zoom: 15,
          center: uluru,
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
          position: uluru,
          map: map,
        });
      }
    </script>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNky4nu5tOcJKkGHvJI-v89CtSUsc72B8&callback=initMap&libraries=geometry&v=weekly"
      async
    ></script>
  </body>
</html>