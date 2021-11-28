<?php

		if(session_status() === PHP_SESSION_NONE)
		{
		  session_start();
		}
  	include("./inc/connection.php");
  	 
  	$u_nic_no = $_SESSION['u_nic_no'];

  	$sql = "SELECT * FROM user WHERE u_nic_no = '$u_nic_no'";
  	$result = mysqli_query($connection,$sql);

  	if($result && mysqli_num_rows($result)==1){
		  	while($data = mysqli_fetch_assoc($result)) {

		  	$route = $data['route'];
		  	$u_latitude = $data['u_latitude'];
		  	$u_longitude = $data['u_longitude'];

		  	// echo $route;
		  	// echo $u_latitude;
		   //  echo $u_longitude;
		  }
	}else{
		  	echo "Error: No User data found";
		  }

		  $sql_route = "SELECT encoded_polyline FROM routes WHERE route_name = '$route'";
		  $result_route = mysqli_query($connection,$sql_route);
		  if ($result_route && mysqli_num_rows($result_route)==1) {
		  		while($route_data = mysqli_fetch_assoc($result_route)){
		  				$encoded_polyline = $route_data['encoded_polyline'];
		  		}
		  }else{
		  		echo "No Route details found!";
		  }
  ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
      /* Set the size of the div element that contains the map */
      #map {
			  height: 100vh;
			 
			  top:0; 
			  bottom: -200px; 
			  left: 0; 
			  right: 0; 
			  z-index: 0;
			}
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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

	 <div id="map" class="border border-warning shadow rounded"></div>
	 <br>

	<!-- Latitude: <input type="text" name="" id="latitudeBox"> <br><br>
	Longitude: <input type="text" name="" id="longitudeBox"> <br><br> 	<br>
	<button id="select">Select</button>   -->


	<script type="text/javascript">
		 var u_nic_no = <?php echo json_encode($u_nic_no); ?> 
		 var u_route = <?php echo json_encode($route); ?>;
     var u_latitude =  <?php echo json_encode($u_latitude); ?>;
     var u_longitude =  <?php echo json_encode($u_longitude); ?>;
     var encoded_polyline = <?php echo json_encode($encoded_polyline); ?>;

     		var polyline;
				function initialize(encoded_polyline) {
          console.log(encoded_polyline);
		      var decodedPath = google.maps.geometry.encoding.decodePath(encoded_polyline); 
		      var decodedLevels = decodeLevels("BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB");
		    
		            if (polyline==null) {
		              polyline = new google.maps.Polyline({
		                path: decodedPath,
		                levels: decodedLevels,
		                strokeColor: "#EE0000",
		                strokeOpacity: 0.7,
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
     

			u_latitude = parseFloat(u_latitude);
			u_longitude = parseFloat(u_longitude);
				// Initialize and add the map
			var map;
			function initMap() {
			
			  // The location of Uluru
			  const uluru = { lat: 6.832, lng: 79.89 };
			  const homeLoation = {lat: u_latitude, lng: u_longitude};
			  // The map, centered at homeLocation
			  	map = new google.maps.Map(document.getElementById("map"), {
			    zoom: 14,
			    center: homeLoation,
			  });

			  	initialize(encoded_polyline);

			  var iconHome = {
					    url: 'https://drive.google.com/thumbnail?id=1gLyZlV6M3o8biCupkw177VFhELUcSmGO',
					    scaledSize: new google.maps.Size(80, 80), // scaled size
					    origin: new google.maps.Point(0,0), // origin
					    anchor: new google.maps.Point(50, 50), // anchor
					    labelOrigin: new google.maps.Point(30, 85)
					};

			  var markerHome = new google.maps.Marker({
				    position: {lat: u_latitude, lng: u_longitude},
				    map: map,
						icon: iconHome,
						//label:{text:"Home", fontWeight: "bold",fontSize:'20px' }
	      	  });

			  
			  
				var marker;
				var vidRoute;
				var vid;
				var vNo;
				vehicleDbUpdate();
				function vehicleDbUpdate() {
		           
	            $.ajax({
	                    url:"./vehicleUpdate/vehicleDbUpdate.php",
	                    method:"post",
	                    success: function(result) {
	                        //console.log(result);
	                        vidRoute = result;
	                        vidRoute = JSON.parse(vidRoute);
	                        console.log(vidRoute);
	                        filterTruck(vidRoute);

	                    }
	                });

	        }

	     function filterTruck(vidRoute) {
	     		if (vidRoute.includes(u_route)) {
	     			 var routeIndex = vidRoute.indexOf(u_route);
	     			 var vidIndex = routeIndex - 1;
	     			 vid = vidRoute[vidIndex];
	     			 var vNoIndex = routeIndex + 1;
	     			 vNo = vidRoute[vNoIndex];
	     			 console.log(vid);
	     			 console.log(vNo);
	     			 truckLocation(vid)
	     		}
	     }

			  function truckLocation(vid){
			  	console.log(vid);
				 	console.log(vNo);

				 	var icon = {
					    url: 'https://drive.google.com/thumbnail?id=1WhheHUt1VYmw5vHZhivEhAVehIVo1eYy',
					    scaledSize: new google.maps.Size(60, 80), // scaled size
					    origin: new google.maps.Point(0,0), // origin
					    anchor: new google.maps.Point(30, 80), // anchor
					    labelOrigin: new google.maps.Point(30, 85)
					};
				 	// The marker, positioned at Uluru
			  		marker = new google.maps.Marker({
				    position: uluru,
				    map: map,
						icon: icon,
						label:{text:vNo, fontWeight: "bold",fontSize:'20px' },
						draggable:true
	      	  });


					  firebase.database().ref('Location/'+vid+'/latitude').on('child_added', (snapshot) => {
					  		console.log('user was added !!');

					  		 if (marker && marker.setMap) {
									    marker.setPosition(null);
									}

					  		firebase.database().ref('Location/'+vid).on('value',function(snapshot){

								var obj = snapshot.val();
								var myJSON = JSON.stringify(obj);
								var javaObj = JSON.parse(myJSON);

								var undoneJSONlat = javaObj['latitude'];
								var undoneJSONlng = javaObj['longitude'];

								var lat = Object.keys(undoneJSONlat)[Object.keys(undoneJSONlat).length-1];	
								var lat1 = undoneJSONlat[lat];
								var lng = Object.keys(undoneJSONlng)[Object.keys(undoneJSONlng).length-1];	
								var lng1 = undoneJSONlng[lng];

								var newLocation = { lat: parseFloat(lat1), lng: parseFloat(lng1) };

								//document.getElementById('latitudeBox').value=lat1;
								//document.getElementById('longitudeBox').value=lng1;	
								
								var latPre = Object.keys(undoneJSONlat)[Object.keys(undoneJSONlat).length-2];
								var latPre1 = undoneJSONlat[latPre];
								var lngPre = Object.keys(undoneJSONlng)[Object.keys(undoneJSONlng).length-2];
								var lngPre1 = undoneJSONlng[lngPre];					

								//const locationPre = { lat: parseFloat(latPre1), lng: parseFloat(lngPre1) };
								//console.log(locationPre);

								var locationLat = parseFloat(lat1);
								var locationLng = parseFloat(lng1);
								var locationPreLat = parseFloat(latPre1);
								var locationPreLng = parseFloat(lngPre1);
								

								var numDeltas = 100;
								var delay = 10; //milliseconds
								var i = 0;
								var deltaLat;
								var deltaLng;

								    deltaLat = (locationLat - locationPreLat)/numDeltas;
								    deltaLng = (locationLng - locationPreLng)/numDeltas;
									
								    moveMarker();

								function moveMarker(){
								    locationPreLat += deltaLat;
									locationPreLng += deltaLng;
									
								    var latlng = new google.maps.LatLng(locationPreLat, locationPreLng);
								    marker.setTitle("Latitude:"+locationPreLat+" | Longitude:"+locationPreLng);
								    marker.setPosition(latlng);
								    
								    if(i!=numDeltas){
								        i++;
								        setTimeout(moveMarker, delay);
								    }
								    //map.panTo(latlng);
								    //map.setZoom(17);
								}
								function pan(){
								 	map.panTo(newLocation);
								    map.setZoom(15);
								}
								//setTimeout(pan,500)
								  
						});

					});

				}

				var bShedule;
				var bId;
				var markerBuyer = [];

				buyerVehicle();

				function buyerVehicle() {    
	            $.ajax({
	                    url:"./vehicleUpdate/buyerVehicle.php",
	                    method:"post",
	                    success: function(result) {
	                        //console.log(result);
	                        bShedule = result;
	                        bShedule = JSON.parse(bShedule);
	                        console.log(bShedule);
	                        getAllIndexes(bShedule, u_nic_no);

	                    }
	                });

	        }

	        function getAllIndexes(arr, val) {
                      var indexes = [], a = -1;
                      while ((a = arr.indexOf(val, a+1)) != -1) {
                          indexes.push(a);
                          console.log(a);
                          bId = arr[a-3];
                          bVNo = arr[a-1];

                          buyerLocation(bId, bVNo);
                          //bId.push(arr[a+3]);
                      }
                      return indexes;
                  }

	        function buyerLocation(bId, bVNo){
				 	var icon = {
					    url: 'https://drive.google.com/thumbnail?id=1a9Z7ylEQxFYEcPMIox1v_2gPKeflZFGO',
					    scaledSize: new google.maps.Size(60, 80), // scaled size
					    origin: new google.maps.Point(0,0), // origin
					    anchor: new google.maps.Point(30, 80), // anchor
					    labelOrigin: new google.maps.Point(30, 85)
					};
				 	// The marker, positioned at Uluru
			  		markerBuyer[bId] = new google.maps.Marker({
				    position: uluru,
				    map: map,
						icon: icon,
						label:{text:bVNo, fontWeight: "bold",fontSize:'20px' },
						draggable: true
	      	  });


					  firebase.database().ref('BuyerLocation/'+bId+'/latitude').on('child_added', (snapshot) => {
					  		console.log('user was added !!');

					  		 if (markerBuyer[bId] && markerBuyer[bId].setMap) {
									    markerBuyer[bId].setPosition(null);
									}

					  		firebase.database().ref('BuyerLocation/'+bId).on('value',function(snapshot){

								var obj = snapshot.val();
								var myJSON = JSON.stringify(obj);
								var javaObj = JSON.parse(myJSON);

								var undoneJSONlat = javaObj['latitude'];
								var undoneJSONlng = javaObj['longitude'];

								var lat = Object.keys(undoneJSONlat)[Object.keys(undoneJSONlat).length-1];	
								var lat1 = undoneJSONlat[lat];
								var lng = Object.keys(undoneJSONlng)[Object.keys(undoneJSONlng).length-1];	
								var lng1 = undoneJSONlng[lng];

								var newLocation = { lat: parseFloat(lat1), lng: parseFloat(lng1) };

								//document.getElementById('latitudeBox').value=lat1;
								//document.getElementById('longitudeBox').value=lng1;	
								
								var latPre = Object.keys(undoneJSONlat)[Object.keys(undoneJSONlat).length-2];
								var latPre1 = undoneJSONlat[latPre];
								var lngPre = Object.keys(undoneJSONlng)[Object.keys(undoneJSONlng).length-2];
								var lngPre1 = undoneJSONlng[lngPre];					

								//const locationPre = { lat: parseFloat(latPre1), lng: parseFloat(lngPre1) };
								//console.log(locationPre);

								var locationLat = parseFloat(lat1);
								var locationLng = parseFloat(lng1);
								var locationPreLat = parseFloat(latPre1);
								var locationPreLng = parseFloat(lngPre1);
								

								var numDeltas = 50;
								var delay = 20; //milliseconds
								var i = 0;
								var deltaLat;
								var deltaLng;

								    deltaLat = (locationLat - locationPreLat)/numDeltas;
								    deltaLng = (locationLng - locationPreLng)/numDeltas;
									
								    moveMarker();

								function moveMarker(){
								    locationPreLat += deltaLat;
									locationPreLng += deltaLng;
									
								    var latlng = new google.maps.LatLng(locationPreLat, locationPreLng);
								    markerBuyer[bId].setTitle("Latitude:"+locationPreLat+" | Longitude:"+locationPreLng);
								    markerBuyer[bId].setPosition(latlng);
								    
								    if(i!=numDeltas){
								        i++;
								        setTimeout(moveMarker, delay);
								    }
								    //map.panTo(latlng);
								    //map.setZoom(17);
								}
								function pan(){
								 	map.panTo(newLocation);
								  map.setZoom(15);
								}
								//setTimeout(pan,500)
								  
						});

					});

				}

			 
			}

	</script>
	

  <!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->

  <!-- Add Firebase products that you want to use -->
  <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-firestore.js"></script>

  <!-- <script type="text/javascript">
			vehicleDbUpdate();
	</script> -->
  <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
   <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNky4nu5tOcJKkGHvJI-v89CtSUsc72B8&callback=initMap&libraries=geometry&v=weekly"
      async
    ></script>

</body>
</html>