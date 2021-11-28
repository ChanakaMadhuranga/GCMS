
<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Admin Main Map</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100vh;
        width:100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript" src="trucks.js"></script>

  </head>

  <body>

    <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
  <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-app.js"></script>
  <!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
  <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-analytics.js"></script>

  <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-database.js"></script>

  <script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
      apiKey: "AIzaSyDXAyeW3xNhUnU3zJotvZrUL34DjyaSwnQ",
      authDomain: "gcmslocation.firebaseapp.com",
      databaseURL: "https://gcmslocation-default-rtdb.firebaseio.com",
      projectId: "gcmslocation",
      storageBucket: "gcmslocation.appspot.com",
      messagingSenderId: "626179172017",
      appId: "1:626179172017:web:a4bf93606daeb617ca2490",
      measurementId: "G-KS2GD53HF3"
    };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();

  //const db = firebase.database();
  </script>

  <div class="row">
        <div  class="col col-lg-10 col-md-10 col-sm-12 ">
            <div id="map"></div>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-4">
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


  <script>
    var customLabel = {
      restaurant: {
        label: 'R'
      },
      bar: {
        label: 'B'
      }
    };

    var polyline;     //Route Display code
    function initialize(encoded_polyline) {
          
      var decodedPath = google.maps.geometry.encoding.decodePath(encoded_polyline); 
      var decodedLevels = decodeLevels("BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB");
          
            if (polyline==null) {
        polyline = new google.maps.Polyline({
          path: decodedPath,
          levels: decodedLevels,
          strokeColor: "#0000ee",
          strokeOpacity: 0.65,
          strokeWeight: 5,
          map: map            
        });             
            }
            else{
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




      var map;        
      function initMap() {
          map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(6.801767, 79.922679),
            zoom: 13
          });


        
      
      var radius = 500;

      var icon = {
          url: 'https://drive.google.com/thumbnail?id=1WhheHUt1VYmw5vHZhivEhAVehIVo1eYy',
          scaledSize: new google.maps.Size(50, 65), // scaled size
          origin: new google.maps.Point(0,0), // origin
          anchor: new google.maps.Point(30, 60),
          labelOrigin: new google.maps.Point(30, 75) // anchor
        };

      var vidRoute;
      var uId = [];
      var lPlate = [];
      var marker = [];
      var markerListArray = [];
      var uIdListArray = [];
      var lPlateListArray = [];
      var i = 0;
      var j = 0;
      var n = 0;
      var lastId = "";
      var loopCount = 0;
      var loopCurrent = "";

      firebase.database().ref('User/uId').once('value', function (snapshot) {
          var obj = snapshot.val();
          var uId = Object.values(obj);

              firebase.database().ref('User/lPlate').once('value', function (snapshot) {
              var obj = snapshot.val();
              var lPlate = Object.values(obj);
              //console.log(lPlate);

              // loop(uId,lPlate);
              vehicleDbUpdate(uId,lPlate);

              //setTimeout(houseStatus, 1000);
            });

        });
       function vehicleDbUpdate(uId,lPlate) {
            //console.log(uId);
            //console.log(lPlate);
            $.ajax({
                    url:"./vehicleUpdate/vehicleDbUpdate.php",
                    method:"post",
                    data: 
                      {uId: uId,
                       lPlate: lPlate
                      },
                    success: function(result) {
                        //console.log(result);
                        vidRoute = result;
                        vidRoute = JSON.parse(vidRoute);
                        //console.log(vidRoute);
                        loop(uId,lPlate);

                    }
                });

        }
          

       //console.log(vidRoute);
      function loop(uId,lPlate){
          i = 0;
          loopCount = uId.length;
          lastId = "";
          loopInUserList();
        
        function loopInUserList(){
            if(i<loopCount){
              j = uId[i];
              n = lPlate[i];
              mapWork(j,n);
              //console.log(n);
            }
          }

        function mapWork(j,n){
        
            if(lastId != j){
              lastId = j;
              workWithUsers(j,n);
              i += 1;
              loopInUserList();
            }
       
          
          function workWithUsers(j,n){
            //console.log(n);
            firebase.database().ref('Location/'+j+'/latitude').on('child_added', (snapshot) => {
             //console.log('user was added !!'); 
             //console.log(j); 
              firebase.database().ref('Location/'+j).on('value',function(snapshot){
              
                var obj = snapshot.val();
                var javaObj = JSON.parse(JSON.stringify(obj));
                
                var undoneJSONlat = javaObj['latitude'];
                var undoneJSONlng = javaObj['longitude'];
                
                var lat = Object.keys(undoneJSONlat)[Object.keys(undoneJSONlat).length-1];  
                var lat1 = undoneJSONlat[lat];
                var lng = Object.keys(undoneJSONlng)[Object.keys(undoneJSONlng).length-1];  
                var lng1 = undoneJSONlng[lng];
                
                var latlng = new google.maps.LatLng(lat1,lng1);
                
                if(marker[j]){
                  marker[j].setTitle("Latitude:"+lat1+" | Longitude:"+lng1);
                  marker[j].setPosition(latlng);
                }
                else{
                  const circle1 = new google.maps.Circle({
                    strokeColor: "#FF0000",
                    strokeOpacity: 0.4,
                    strokeWeight: 2,
                    fillColor: "#FF0000",
                    fillOpacity: 0.25,
                    map,
                    radius: radius,
                    //center: latLngCircleCenter,
                    //radius: Math.sqrt(84) * 100,
                    
                  });
                  marker[j] = new google.maps.Marker({
                    //position: uluru,
                    map: map,
                    icon: icon,
                    animation: google.maps.Animation.DROP,
                    label: {text:n, fontWeight: "bold",fontSize:'15px' },
                    draggable:true
                  });
                  marker[j].setTitle("Latitude:"+lat1+"Longitude:"+lng1);
                  marker[j].setPosition(latlng);
                  circle1.bindTo('center',marker[j], 'position');
                  

                  console.log(vidRoute);
                  var route;
                  var garbage;
                  if(vidRoute.includes(j)){
                    console.log(j);
                    var vidIndex=vidRoute.indexOf(j);
                    //console.log(vidIndex);
                    var routeIndex = vidIndex + 1;
                    route = vidRoute[routeIndex];

                    var garbageIndex = vidIndex + 2;
                    garbage = vidRoute[garbageIndex];

                  }
                  console.log(route);
                  marker[j].Route = route;
                  marker[j].Garbage = garbage;
                  
                  if(markerListArray.indexOf(marker[j]) < 0){
                    markerListArray.push(marker[j]);

                    
                  }
                }
              
              });
            });
          }
        }
      } 
      
      var infoWindow = new google.maps.InfoWindow;

      //Bin Locations Code
      downloadUrl('xml.php', function(data) {
      
        var xml = data.responseXML;
        if(xml){
          var markers = xml.documentElement.getElementsByTagName('marker');
          var NumberOfMarkers = markers.length;
          
          Array.prototype.forEach.call(markers, function(markerElem) {

            var u_id = markerElem.getAttribute('u_id');
            var u_nic_no = markerElem.getAttribute('u_nic_no');
            var u_first_name = markerElem.getAttribute('u_first_name');
            var u_last_name = markerElem.getAttribute('u_last_name');
            var u_contact_no1 = markerElem.getAttribute('u_contact_no1');
            var u_route = markerElem.getAttribute('route');

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
              parseFloat(markerElem.getAttribute('u_longitude'))
            );

            var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');
            strong.textContent = u_first_name+" "+u_last_name;
            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));
            strong.style.cssText = 'font-weight:bold; color: brown; font-size:15px ';

            var NIC = document.createElement('p');
            NIC.textContent = u_nic_no +"----"+ u_route;
            infowincontent.appendChild(NIC);

            var table = document.createElement('table');

            var tr1 =document.createElement('tr')
            infowincontent.appendChild(table);
            table.appendChild(tr1);

            var th1 = document.createElement('th');
            var th2 = document.createElement('th');
            var th3 = document.createElement('th');
            th1.textContent = "Category ";
            th2.textContent =  "Not Sell";
            th3.textContent =  "Sell";
            tr1.appendChild(th1);
            tr1.appendChild(th2);
            tr1.appendChild(th3);
            th2.style.cssText = 'padding-right: 10px; padding-left: 10px; ';

            var tr1 =document.createElement('tr')
            infowincontent.appendChild(table);
            table.appendChild(tr1);

            var td1 = document.createElement('td');
            var td2 = document.createElement('td');
            var td3 = document.createElement('td');
            td1.textContent = "Plastic ";
            td2.textContent =  plastic_not_sell;
            td3.textContent =  plastic_sell;
            tr1.appendChild(td1);
            tr1.appendChild(td2);
            tr1.appendChild(td3);
            td2.style.cssText = 'padding-left: 15px; ';
            td3.style.cssText = 'padding-left: 5px; ';

            var tr2 =document.createElement('tr')
            infowincontent.appendChild(table);
            table.appendChild(tr2);

            var td1 = document.createElement('td');
            var td2 = document.createElement('td');
            var td3 = document.createElement('td');
            td1.textContent = "Organic ";
            td2.textContent =  organic_not_sell;
            td3.textContent =  organic_sell;
            tr2.appendChild(td1);
            tr2.appendChild(td2);
            tr2.appendChild(td3);
            td2.style.cssText = 'padding-left: 15px; ';
            td3.style.cssText = 'padding-left: 5px; ';

            var tr3 =document.createElement('tr')
            infowincontent.appendChild(table);
            table.appendChild(tr3);

            var td1 = document.createElement('td');
            var td2 = document.createElement('td');
            var td3 = document.createElement('td');
            td1.textContent = "polythene ";
            td2.textContent =  polythene_not_sell;
            td3.textContent =  polythene_sell;
            tr3.appendChild(td1);
            tr3.appendChild(td2);
            tr3.appendChild(td3);
            td2.style.cssText = 'padding-left: 15px; ';
            td3.style.cssText = 'padding-left: 5px; ';

            var tr4 =document.createElement('tr')
            infowincontent.appendChild(table);
            table.appendChild(tr4);

            var td1 = document.createElement('td');
            var td2 = document.createElement('td');
            var td3 = document.createElement('td');
            td1.textContent = "Metal ";
            td2.textContent =  metal_not_sell;
            td3.textContent =  metal_sell;
            tr4.appendChild(td1);
            tr4.appendChild(td2);
            tr4.appendChild(td3);
            td2.style.cssText = 'padding-left: 15px; ';
            td3.style.cssText = 'padding-left: 5px; ';

            var tr5 =document.createElement('tr')
            infowincontent.appendChild(table);
            table.appendChild(tr5);

            var td1 = document.createElement('td');
            var td2 = document.createElement('td');
            var td3 = document.createElement('td');
            td1.textContent = "Paper ";
            td2.textContent =  paper_not_sell;
            td3.textContent =  paper_sell;
            tr5.appendChild(td1);
            tr5.appendChild(td2);
            tr5.appendChild(td3);
            td2.style.cssText = 'padding-left: 15px; ';
            td3.style.cssText = 'padding-left: 5px; ';

            var tr6 =document.createElement('tr')
            infowincontent.appendChild(table);
            table.appendChild(tr6);

            var td1 = document.createElement('td');
            var td2 = document.createElement('td');
            var td3 = document.createElement('td');
            td1.textContent = "Coconut shell ";
            td2.textContent =  coconut_shell_not_sell;
            td3.textContent =  coconut_shell_sell;
            tr6.appendChild(td1);
            tr6.appendChild(td2);
            tr6.appendChild(td3);
            td2.style.cssText = 'padding-left: 15px; ';
            td3.style.cssText = 'padding-left: 5px; ';
            
            var tr7 =document.createElement('tr')
            infowincontent.appendChild(table);
            table.appendChild(tr7);

            var td1 = document.createElement('td');
            var td2 = document.createElement('td');
            var td3 = document.createElement('td');
            td1.textContent = "Glass ";
            td2.textContent =  glass_not_sell;
            td3.textContent =  glass_sell;
            tr7.appendChild(td1);
            tr7.appendChild(td2);
            tr7.appendChild(td3);
            td2.style.cssText = 'padding-left: 15px; ';
            td3.style.cssText = 'padding-left: 5px; ';

            var tr8 =document.createElement('tr')
            infowincontent.appendChild(table);
            table.appendChild(tr8);

            var td1 = document.createElement('td');
            var td2 = document.createElement('td');
            var td3 = document.createElement('td');
            td1.textContent = "Fabric ";
            td2.textContent =  fabric_not_sell;
            td3.textContent =  fabric_sell;
            tr8.appendChild(td1);
            tr8.appendChild(td2);
            tr8.appendChild(td3);
            td2.style.cssText = 'padding-left: 15px; ';
            td3.style.cssText = 'padding-left: 5px; ';

            var tr9 =document.createElement('tr')
            infowincontent.appendChild(table);
            table.appendChild(tr9);

            var td1 = document.createElement('td');
            var td2 = document.createElement('td');
            var td3 = document.createElement('td');
            td1.textContent = "E-waste ";
            td2.textContent =  e_waste_not_sell;
            td3.textContent =  e_waste_sell;
            tr9.appendChild(td1);
            tr9.appendChild(td2);
            tr9.appendChild(td3);
            td2.style.cssText = 'padding-left: 15px; ';
            td3.style.cssText = 'padding-left: 5px; ';

            // var icon = customLabel[type] || {};
            var iconHouse = {
              url: 'https://drive.google.com/thumbnail?id=1Kp5ZOrBsy538jMLtrkQYyjwUp9M-Gm4Q',
              scaledSize: new google.maps.Size(55, 80), // scaled size
              origin: new google.maps.Point(0,0), // origin
              anchor: new google.maps.Point(30, 80), // anchor
              labelOrigin: new google.maps.Point(30, 85)
             };

            var marker = new google.maps.Marker({
              map: map,
              position: point,
              icon: iconHouse
            });
              
            marker.addListener('click', function() {
              infoWindow.setContent(infowincontent);
              infoWindow.open(map, marker);
            });
            
            var triggered = [];
            var confirm = [];
            //console.log(markerListArray);


            setTimeout(houseStatus, 8000);


            //document.addEventListener('DOMContentLoaded', houseStatus());
            function houseStatus() {
                for (k=0;k<markerListArray.length;k++){
                    triggered.push(false);
                    confirm.push(false);
                }
                console.log(triggered);
                console.log(confirm);
          }
            

            setInterval(geofence, 4000);
            
            function geofence() {
                  for (k=0;k<markerListArray.length;k++){
                    //console.log(markerListArray); 
                    var markerData = markerListArray[k];

                    var truckRoute = markerData.Route;
                    var truckGarbage = markerData.Garbage;
                    if(truckRoute == u_route){
                       // console.log(markerData); 
                        var location = markerData.getPosition();
                        var house =marker.getPosition();
                        //console.log(markerData.route);
                        
                        var distance = google.maps.geometry.spherical.computeDistanceBetween(location, house);
                        console.log(distance);
                          
                        if (distance<radius&&triggered[k]==false) {
                            console.log("Msg: Truck is arriving!!");
                            console.log(u_contact_no1);
                            console.log(truckGarbage);

                            // twilio truck arriving msg
                            $.ajax({
                              url:"./twilio/twilio_arrive.php",
                              method:"post",
                              data: 
                                {u_contact_no1: JSON.stringify(u_contact_no1),
                                 u_first_name: JSON.stringify(u_first_name),
                                 truckGarbage: JSON.stringify(truckGarbage)
                                },
                              success: function(result) {
                                console.log(result);
                              }
                              });
                              
                            triggered[k] = true;
                        }
                        else if (distance<radius&&triggered[k]==true) {
                            console.log("Message already sent");
                        }
                        else if (distance>radius&&triggered[k]==true&&confirm[k]==false) {
                            console.log("Msg: Please Confirm!!");
                          
                            //activate user dispose
                            $.ajax({
                                url: "activate_dispose.php",
                                method: "post",
                                data: {u_nic_no: JSON.stringify(u_nic_no)},
                                success: function(result) {
                                  console.log(result);
                                }
                            });

                            // twilio please confirm msg
                            $.ajax({
                              url:"./twilio/twilio_dispose.php",
                              method:"post",
                              data: 
                                {u_contact_no1: JSON.stringify(u_contact_no1),
                                 u_first_name: JSON.stringify(u_first_name)
                                },
                              success: function(result) {
                                console.log(result);
                              }
                              });
                            confirm[k] = true;
                        }
                        else{
                            console.log("No truck in range");
                        }
                    }

                  }
                    
                
              }

          });
        }
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
  
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNky4nu5tOcJKkGHvJI-v89CtSUsc72B8&callback=initMap&libraries=geometry&v=weekly"
      async
    ></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>