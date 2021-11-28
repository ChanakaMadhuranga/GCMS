<?php
  //include("New.html");
?>
<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Using MySQL and PHP with Google Maps</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
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




 <!--  <div>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Admin Home Page</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="waste_locations.php">Map</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="chart.php">Quantities</a>
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
              <li><a class="dropdown-item" href="">Buyer</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Messages
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="">Complains of Users</a></li>
              <li><a class="dropdown-item" href="">Complains of Workers</a></li>
              <li><a class="dropdown-item" href="">Notices</a></li>
            </ul>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Routes
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="route.php">New Route</a></li>
              <li><a class="dropdown-item" href="display_route.php">My Routes</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Job-Schedules
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="schedule.php">Create a Schedule</a></li>
              <li><a class="dropdown-item" href="sdisplay.php">Schedule Details</a></li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
   </nav>
    </div>

 -->
  <div class="row h-100">
    <div class="col-12">
      <div id="map" ></div>
    </div>

    
   


  <script>
  
//var u_contact_no1 = '+94788021733';
      var map;        
      function initMap() {
          map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(6.817741208903762, 79.9675433727993),
            zoom: 12
          });
      
      
      var radius = 600;

      var icon = {
          url: 'https://drive.google.com/thumbnail?id=1a9Z7ylEQxFYEcPMIox1v_2gPKeflZFGO',
              scaledSize: new google.maps.Size(60, 80), // scaled size
              origin: new google.maps.Point(0,0), // origin
              anchor: new google.maps.Point(30, 80), // anchor
              labelOrigin: new google.maps.Point(30, 85)
        };


      var bShedule

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

      firebase.database().ref('Buyer/bId').once('value', function (snapshot) {
          var obj = snapshot.val();
          var bId = Object.values(obj);
          console.log(bId);

              firebase.database().ref('Buyer/bLPlate').once('value', function (snapshot) {
              var obj = snapshot.val();
              var bLPlate = Object.values(obj);
              console.log(bLPlate);

              // loop(uId,lPlate);
              vehicleDbUpdate(bId,bLPlate);

              //setTimeout(houseStatus, 1000);
            });

        });
       function vehicleDbUpdate(bId,bLPlate) {
            //console.log(uId);
            //console.log(lPlate);
            $.ajax({
                    url:"./vehicleUpdate/vehicleDbUpdate.php",
                    method:"post",
                    data: 
                      {bId: bId,
                       bLPlate: bLPlate
                      },
                    success: function(result) {
                        console.log(result);
                        bShedule = result;
                        bShedule = JSON.parse(bShedule);
                        //console.log(bShedule);
                        loop(bId,bLPlate);

                    }
                });

        }
          

       //console.log(vidRoute);
      function loop(bId,bLPlate){
          i = 0;
          loopCount = bId.length;
          lastId = "";
          loopInUserList();
        
        function loopInUserList(){
            if(i<loopCount){
              j = bId[i];
              n = bLPlate[i];
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
            firebase.database().ref('BuyerLocation/'+j+'/latitude').on('child_added', (snapshot) => {
             console.log('user was added !!'); 
             //console.log(j); 
              firebase.database().ref('BuyerLocation/'+j).on('value',function(snapshot){
              
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
                    strokeColor: "#0000FF",
                    strokeOpacity: 0.4,
                    strokeWeight: 2,
                    fillColor: "#0000FF",
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

                  //setTimeout(markerBounce,3000);
                  function markerBounce(){
                      marker[j].setAnimation(google.maps.Animation.BOUNCE);
                    }

                  marker[j].setTitle("Latitude:"+lat1+"Longitude:"+lng1);
                  marker[j].setPosition(latlng);
                  circle1.bindTo('center',marker[j], 'position');
                  

                  console.log(bShedule);
                 
                  var userNic = [];

                  function getAllIndexes(arr, val) {
                      var indexes = [], a = -1;
                      while ((a = arr.indexOf(val, a+1)) != -1) {
                          indexes.push(a);
                          userNic.push(arr[a+3]);
                      }
                      return indexes;
                  }

                  var indexes = getAllIndexes(bShedule, j);
                  console.log(indexes);
                  console.log(userNic);

                  marker[j].UserNic = userNic;
                  
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

            var iconHouse = {
              url: 'https://drive.google.com/thumbnail?id=1Kp5ZOrBsy538jMLtrkQYyjwUp9M-Gm4Q',
              scaledSize: new google.maps.Size(60, 80), // scaled size
              origin: new google.maps.Point(0,0), // origin
              anchor: new google.maps.Point(30, 80), // anchor
              labelOrigin: new google.maps.Point(30, 85)
             };

            // var icon = customLabel[type] || {};
            var marker = new google.maps.Marker({
              map: map,
              position: point,
              icon: iconHouse
              //label: icon.label
            });
              
            marker.addListener('click', function() {
              infoWindow.setContent(infowincontent);
              infoWindow.open(map, marker);
            });
            
            var triggered = [];
            var confirm = [];
            //console.log(markerListArray);


            setTimeout(houseStatus, 10000);


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

                    var BuyerUserNic = markerData.UserNic;
                    if(BuyerUserNic.includes(u_nic_no)){
                       // console.log(markerData); 
                        var location = markerData.getPosition();
                        var house =marker.getPosition();
                        //console.log(markerData.route);
                        
                        var distance = google.maps.geometry.spherical.computeDistanceBetween(location, house);
                        console.log(distance);
                          
                        if (distance<radius&&triggered[k]==false) {
                            console.log("Msg: Truck is arriving!!");
                            console.log(u_contact_no1);

                            // twilio truck arriving msg
                            $.ajax({
                              url:"./twilio/twilio_arrive.php",
                              method:"post",
                              data: 
                                {u_contact_no1: JSON.stringify(u_contact_no1),
                                 u_first_name: JSON.stringify(u_first_name)
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
                            // $.ajax({
                            //     url: "activate_dispose.php",
                            //     method: "post",
                            //     data: {u_nic_no: JSON.stringify(u_nic_no)},
                            //     success: function(result) {
                            //       console.log(result);
                            //     }
                            // });

                            // twilio please confirm msg
                            // $.ajax({
                            //   url:"./twilio/twilio_dispose.php",
                            //   method:"post",
                            //   data: 
                            //     {u_contact_no1: JSON.stringify(u_contact_no1),
                            //      u_first_name: JSON.stringify(u_first_name)
                            //     },
                            //   success: function(result) {
                            //     console.log(result);
                            //   }
                            //   });
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