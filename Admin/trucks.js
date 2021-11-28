function trucks(){

			  var icon = {
			    url: 'https://drive.google.com/thumbnail?id=1WhheHUt1VYmw5vHZhivEhAVehIVo1eYy',
			    scaledSize: new google.maps.Size(40, 53), // scaled size
			    origin: new google.maps.Point(0,0), // origin
			    anchor: new google.maps.Point(50, 50) // anchor
				};

				  var uId = [];
				  var marker = [];
				  var i = 0;
				  var lastId = "";
				  var loopCount = 0;
				  var loopCurrent = "";

				firebase.database().ref('User/uId').once('value', function (snapshot) {
					var obj = snapshot.val();
					var uId = Object.values(obj);
					loop(uId);	
				});
				
		      	function loop(uId){
					i = 0;
					loopCount = uId.length;
					lastId = "";
					loopInUserList();
					
				function loopInUserList(){
					if(i<loopCount){
						var  j = uId[i];
						mapWork(j);
					}
				}

				function mapWork(j){
				
					if(lastId != j){
						lastId = j;
						workWithUsers(j);
						i += 1;
						loopInUserList();
					}
					
					function workWithUsers(j){
						firebase.database().ref('Location/'+j+'/latitude').on('child_added', (snapshot) => {
							console.log('user was added !!');
							console.log(j);
							
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
									marker[j] = new google.maps.Marker({
										//position: uluru,
										map: map,
										icon: icon,
										animation: google.maps.Animation.DROP,
										<!-- animation: google.maps.Animation.DROP -->
									});
									marker[j].setTitle("Latitude:"+lat1+" | Longitude:"+lng1);
									marker[j].setPosition(latlng);
								}
			
							});
						});
					}
				}
			} 
		} // function truck end