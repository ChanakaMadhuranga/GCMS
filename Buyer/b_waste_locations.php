<?php


    if(session_status() === PHP_SESSION_NONE)
    {
      session_start();
    }

    if(!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        }

    $user_id = $_SESSION['user_id'];


    include("connection.php");

    $b_result = mysqli_query($con,"SELECT b_garbage FROM buyers3 WHERE id ='$user_id'");

        
        while($row = mysqli_fetch_assoc($b_result)) {
            $row1 = $row['b_garbage'];
            $row1 = trim($row1);

            $category= explode(',', $row1);
        }
        
    $booked_result = mysqli_query($con,"SELECT DISTINCT cart.u_nic_no FROM cart INNER JOIN buyers3 ON cart.b_nic_num = buyers3.b_nic_num WHERE buyers3.user_id = $user_id");

    $u_nic_list = array();
    if (mysqli_num_rows($booked_result)>0) {
        while($row2 = mysqli_fetch_assoc($booked_result)) {
          $row3 = $row2['u_nic_no'];
          array_push($u_nic_list, $row3); 
       }
    }
        
?>


<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Using MySQL and PHP with Google Maps</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script> -->



    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100vh;
      }
      /* Optional: Makes the sample page fill the window. */
      
    </style>

    
  </head>

  <body>

<!--
    <div>

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
              <a class="nav-link" aria-current="page" href="view.php">Profile</a>
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
  -->
    <div class="row">
        <div  class="col col-lg-10 col-md-10 col-sm-12 ">
            <div id="map"></div>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-4">
       <?php

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
                strokeOpacity: 0.65,
                strokeWeight: 5,
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


      var category = <?php echo json_encode($category); ?>;
      console.log(category);
      
      var u_nic_list = [];
      u_nic_list = <?php echo json_encode($u_nic_list); ?>;
      console.log(u_nic_list);

      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

        var map;
        function initMap() {
          map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(6.8018,  79.9227),
          zoom: 15
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('b_xml.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {

              var u_id = markerElem.getAttribute('u_id');
              var u_nic_no = markerElem.getAttribute('u_nic_no');
              var u_first_name = markerElem.getAttribute('u_first_name');
              var u_last_name = markerElem.getAttribute('u_last_name');

              var plastic_not_sell          = markerElem.getAttribute('plastic_not_sell');
              var plastic_sell       = markerElem.getAttribute('plastic_sell');
              var organic_not_sell          = markerElem.getAttribute('organic_not_sell');
              var organic_sell       = markerElem.getAttribute('organic_sell');
              var polythene_not_sell        = markerElem.getAttribute('polythene_not_sell');
              var polythene_sell     = markerElem.getAttribute('polythene_sell');
              var metal_not_sell            = markerElem.getAttribute('metal_not_sell');
              var metal_sell         = markerElem.getAttribute('metal_sell');
              var paper_not_sell            = markerElem.getAttribute('paper_not_sell');
              var paper_sell         = markerElem.getAttribute('paper_sell');
              var coconut_shell_not_sell    = markerElem.getAttribute('coconut_shell_not_sell');
              var coconut_shell_sell = markerElem.getAttribute('coconut_shell_sell');
              var glass_not_sell            = markerElem.getAttribute('glass_not_sell');
              var glass_sell         = markerElem.getAttribute('glass_sell');
              var fabric_not_sell           = markerElem.getAttribute('fabric_not_sell');
              var fabric_sell        = markerElem.getAttribute('fabric_sell');
              var e_waste_not_sell          = markerElem.getAttribute('e_waste_not_sell');
              var e_waste_sell       = markerElem.getAttribute('e_waste_sell');
              
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('u_latitude')),
                  parseFloat(markerElem.getAttribute('u_longitude')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = u_first_name+" "+u_last_name;
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));
              var NIC = document.createElement('p');
              NIC.textContent = u_nic_no;
              infowincontent.appendChild(NIC);
              strong.style.cssText = 'font-weight:bold; color: brown; font-size:15px ';

              var table = document.createElement('table');

              var tr1 =document.createElement('tr')
              infowincontent.appendChild(table);
              table.appendChild(tr1);

              var th1 = document.createElement('th');
               var th2 = document.createElement('th');
              var th3 = document.createElement('th');
              th1.textContent = "Category ";
              th2.textContent = " ";
              th3.textContent =  "Sell";
              tr1.appendChild(th1);
              tr1.appendChild(th2);
              tr1.appendChild(th3);


              if (category.includes("Plastic")&&plastic_sell>0) {
                var tr1 =document.createElement('tr')
                infowincontent.appendChild(table);
                table.appendChild(tr1);

                var td1 = document.createElement('td');
                var td2 = document.createElement('td');
                var td3 = document.createElement('td');
                td1.textContent = "Plastic ";
                td2.textContent = " ";
                td3.textContent =  plastic_sell;
                tr1.appendChild(td1);
                tr1.appendChild(td2);
                tr1.appendChild(td3);
            }

             if (category.includes("Organic")&&organic_sell>0) {
                var tr2 =document.createElement('tr')
                infowincontent.appendChild(table);
                table.appendChild(tr2);

                var td1 = document.createElement('td');
                var td2 = document.createElement('td');
                var td3 = document.createElement('td');
                td1.textContent = "Organic ";
                td2.textContent = " ";
                td3.textContent =  organic_sell;
                tr2.appendChild(td1);
                tr2.appendChild(td2);
                tr2.appendChild(td3);
            }

             if (category.includes("Polythene")&&polythene_sell>0) {
                var tr3 =document.createElement('tr')
                infowincontent.appendChild(table);
                table.appendChild(tr3);

                var td1 = document.createElement('td');
                var td2 = document.createElement('td');
                var td3 = document.createElement('td');
                td1.textContent = "polythene ";
                td2.textContent = " ";
                td3.textContent =  polythene_sell;
                tr3.appendChild(td1);
                tr3.appendChild(td2);
                tr3.appendChild(td3);
            }


              if (category.includes("Metal")&&metal_sell>0) {
                var tr4 =document.createElement('tr')
                infowincontent.appendChild(table);
                table.appendChild(tr4);

                var td1 = document.createElement('td');
                var td2 = document.createElement('td');
                var td3 = document.createElement('td');
                td1.textContent = "Metal ";
                td2.textContent = " ";
                td3.textContent =  metal_sell;
                tr4.appendChild(td1);
                tr4.appendChild(td2);
                tr4.appendChild(td3);
            }


              if (category.includes("Paper")&&paper_sell>0) {
                var tr5 =document.createElement('tr')
                infowincontent.appendChild(table);
                table.appendChild(tr5);

                var td1 = document.createElement('td');
                var td2 = document.createElement('td');
                var td3 = document.createElement('td');
                td1.textContent = "Paper ";
                td2.textContent = " ";
                td3.textContent =  paper_sell;
                tr5.appendChild(td1);
                tr5.appendChild(td2);
                tr5.appendChild(td3);
            }


              if (category.includes("Coconut_shell")&&coconut_shell_sell>0) {
                var tr6 =document.createElement('tr')
                infowincontent.appendChild(table);
                table.appendChild(tr6);

                var td1 = document.createElement('td');
                var td2 = document.createElement('td');
                var td3 = document.createElement('td');
                td1.textContent = "Coconut shell ";
                td2.textContent = " ";
                td3.textContent =  coconut_shell_sell;
                tr6.appendChild(td1);
                tr6.appendChild(td2);
                tr6.appendChild(td3);
            }

              if (category.includes("Glass")&&glass_sell>0) {
                var tr7 =document.createElement('tr')
                infowincontent.appendChild(table);
                table.appendChild(tr7);

                var td1 = document.createElement('td');
                var td2 = document.createElement('td');
                var td3 = document.createElement('td');
                td1.textContent = "Glass ";
                td2.textContent = " ";
                td3.textContent =  glass_sell;
                tr7.appendChild(td1);
                tr7.appendChild(td2);
                tr7.appendChild(td3);
            }

              if (category.includes("Fabric")&&fabric_sell>0) {
                var tr8 =document.createElement('tr')
                infowincontent.appendChild(table);
                table.appendChild(tr8);

                var td1 = document.createElement('td');
                var td2 = document.createElement('td');
                var td3 = document.createElement('td');
                td1.textContent = "Fabric ";
                td2.textContent = " ";
                td3.textContent =  fabric_sell;
                tr8.appendChild(td1);
                tr8.appendChild(td2);
                tr8.appendChild(td3);
            }

            if (category.includes("Ewaste")&&e_waste_sell>0) {
                var tr9 =document.createElement('tr')
                infowincontent.appendChild(table);
                table.appendChild(tr9);

                var td1 = document.createElement('td');
                var td2 = document.createElement('td');
                var td3 = document.createElement('td');
                td1.textContent = "E-waste ";
                td2.textContent = " ";
                td3.textContent =  e_waste_sell;
                tr9.appendChild(td1);
                tr9.appendChild(td2);
                tr9.appendChild(td3);
            }

              //infowincontent.appendChild(document.createElement('br'));         
             
              /* var text4 = document.createElement('text');
              text4.textContent = "Paper: "+paper_q+" "+paper_sell;
              infowincontent.appendChild(text4);
              infowincontent.appendChild(document.createElement('br'));*/

              if (category.includes("Plastic")&&plastic_sell>0 || category.includes("Organic")&&organic_sell>0 || category.includes("Polythene")&&polythene_sell>0 || category.includes("Metal")&&metal_sell>0 || category.includes("Paper")&&paper_sell>0 || category.includes("Coconut_shell")&&coconut_shell_sell>0 || category.includes("Glass")&&glass_sell>0 || category.includes("Fabric")&&fabric_sell>0 || category.includes("E-waste")&&e_waste_sell>0 ) {
                
                if (u_nic_list.includes(u_nic_no)) {
                     var icon = {
                      url: ' https://drive.google.com/thumbnail?id=13wjC-PTc5de1JYUFx-0MFQT4pTgFPd9Z',
                      scaledSize: new google.maps.Size(30, 45), // scaled size
                      origin: new google.maps.Point(0,0), // origin
                      anchor: new google.maps.Point(18, 40),
                      labelOrigin: new google.maps.Point(30, 75) // anchor
                    };
                    var marker = new google.maps.Marker({
                      map: map,
                      position: point,
                      icon: icon
                    });

                  }else{
                    var marker = new google.maps.Marker({
                      map: map,
                      position: point,
                      //icon: icon
                    });
                  }
                
                //   var marker = new google.maps.Marker({
                //     map: map,
                //     position: point,
                //     //label: icon.label
                //   });
                  
                  marker.addListener('click', function() {
                  infoWindow.setContent(infowincontent);
                  infoWindow.open(map, marker);
              });
            }
              
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNky4nu5tOcJKkGHvJI-v89CtSUsc72B8&callback=initMap&libraries=geometry&v=weekly"
      async
    ></script>

  </body>
</html>