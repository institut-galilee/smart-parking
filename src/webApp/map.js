var map;
var geocoder;
var markerpos;
var result;

function loadMap() {
	var pune = {lat: 18.5204, lng: 73.8567};
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: pune
    });

    markerpos = new google.maps.Marker({
      position: pune,
      animation: google.maps.Animation.DROP,
      map: map
		});
		markerpos.setMap(map);
		map.panTo(markerpos.position);

    /*var cdata = JSON.parse(document.getElementById('data').innerHTML);
    geocoder = new google.maps.Geocoder();  
    codeAddress(cdata);*/

		geocoder = new google.maps.Geocoder();  

		var address = "tikiouine ,agadir , maroc";
		
		/*geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == 'OK') {
				//map.setCenter(results[0].geometry.location);
				var points = {};
				points.id = data.id;
				points.lat = map.getCenter().lat();
				points.lng = map.getCenter().lng();
				console.log(points);
			} else {
				alert('Geocode was not successful for the following reason: ' + status);
			}
		});*/


			
        //var allData = JSON.parse(document.getElementById('allData').innerHTML);
       var data = {latitude:48.956591,longitude:2.343185,raduis:5};
       data = JSON.stringify(data);
       
       
      // nearByCollege(data);
       
        
		
		//updateCollegeWithLatLng(pune);
        
}

function showAllColleges(allData) {
    var infoWind = new google.maps.InfoWindow;
    
    /*$.each(allData, function(index, value) {
       console.log(value);
      });*/
	Array.prototype.forEach.call(allData, function(data){
		/*var content = document.createElement('div');
		var strong = document.createElement('strong');
		
		strong.textContent = data.name;
		content.appendChild(strong);

		var img = document.createElement('img');
		img.src = 'img/Leopard.jpg';
		img.style.width = '100px';
		content.appendChild(img);*/


		/*this.setAvailability = function() {
			if (data.Avail <= 5) {
					this._availabilityState = availabilityStateEnum.noAvail;
			} else if (data.Avail < 10) {
					this._availabilityState = availabilityStateEnum.someAvail;
			} else if (data.Avail >= 10) {
					this._availabilityState = availabilityStateEnum.highAvail;
			}
			if (ParkItPage.ZoomLevel > ParkItPage.defaultRegionZoom && ParkItPage.ZoomLevel < ParkItPage.defaultDetailsZoom) {
					image = ParkItPage.icons["noStatusPt"];
			} else if (ParkItPage.ZoomLevel >= ParkItPage.defaultDetailsZoom) {
					image = ParkItPage.icons[this._availabilityState.code];
			}
			this.setIcon(image);
	};*/

console.log(data);


		var marker = new google.maps.Marker({
				position: new google.maps.LatLng(data.latitude, data.longitude),
				icon: 'noStatus.png',
				  map: map,
				  id: data.id
	    });
		
		
	   /* marker.addListener('mouseover', function(){
	    	infoWind.setContent(content);
	    	infoWind.open(map, marker);
		})*/
		
		
		data = JSON.stringify(data);
		marker.addListener('click',function() {
			$(".inactive").show();
			
			var data = {id_parkinglot:this.get('id')};
			data = JSON.stringify(data);
			getParkinglot(data);
			getParkingSpots(data);
			
		  });
	})
}

function myFunction() {
	console.log('rachid');
	
	var address =document.getElementById("pac-input").value;
	var points = {};
	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == 'OK') {
			//map.setCenter(results[0].geometry.location);
			
			
			points.lat = map.getCenter().lat();
			points.lng = map.getCenter().lng();
			console.log(points);
		} else {
			alert('Geocode was not successful for the following reason: ' + status);
		}
	});

	/*var marker = new google.maps.Marker({
		position: new google.maps.LatLng(points.lat, points.lng),
		map: map
	});*/
    changeMarkerPos(points.lat, points.lng);
    


}


function codeAddress(cdata) {
   Array.prototype.forEach.call(cdata, function(data){
    	var address = data.name + ' ' + data.address;
	    geocoder.geocode( { 'address': address}, function(results, status) {
	      if (status == 'OK') {
	        /*map.setCenter(results[0].geometry.location);*/
	        var points = {};
	        points.id = data.id;
	        points.lat = map.getCenter().lat();
	        points.lng = map.getCenter().lng();
	        updateCollegeWithLatLng(points);
	      } else {
	        alert('Geocode was not successful for the following reason: ' + status);
	      }
	    });
	});
}

function updateCollegeWithLatLng(points) {
	$.ajax({
		url:"action.php",
		method:"post",
		data: points,
		success: function(res) {
			console.log(res)
		}
	})
	
}
function nearByCollege(data) {
    
	$.ajax({
		url:"api/parking/nearby.php",
		method:"post",
        data: data,
        ContentType:"application/json",
		success: function(res) {
            console.log(res[0].latitude);
            showAllColleges(res);
        }
        ,
        
        error : function(resultat, statut, erreur){
         console.log('rachid');
               }

    })
  
	
}




function bookingParkingSpots(data) {
console.log(data);
	$.ajax({
		url:"api/booking/create.php",
		method:"post",
        data: data,
        ContentType:"application/json",
		success: function(res) {

			/*Array.prototype.forEach.call(res, function(data){
				if(data.etat ==0 ){

				$(".location2").append('<div _ngcontent-kwy-44=""  data-id="'+data.id_parkingspot+'" >'+data.parkingspotname+'</div>');
				console.log(data);
				}else{
					$(".location2").append('<div _ngcontent-kwy-44=""  data-id="'+data.id_parkingspot+'"class="alreadyReserved" >'+data.parkingspotname+'</div>');
				}
			});*/

			console.log(res);
			$("#myModal").modal("toggle");
			$(".alert").show();
			window.setTimeout(function() {
				$(".alert").fadeTo(500, 0).slideUp(500, function(){
					
					$(this).hide();
					$(this).css('opacity', '1'); 
				});
			}, 4000);
			
           
        }
        ,
        
        error : function(resultat, statut, erreur){
         console.log(resultat);
               }

    })
  
	
}


function getParkinglot(data){
	console.log(data);
	$.ajax({
		url:"api/parking/getParking.php",
		method:"post",
        data: data,
        ContentType:"application/json",
		success: function(res) {
			
			console.log(res);
			$('#lName').html(res.name);
			$('#address').html(res.addresse);
			$('#tSpace').html(res.capacity);
			$('#aSpace').html(res.available);
        }
        ,
        
        error : function(resultat, statut, erreur){
         console.log(resultat);
               }

    })
  
	
}



function getParkingSpots(data){
	$.ajax({
		url:"api/slot/spotsOfParking.php",
		method:"post",
        data: data,
        ContentType:"application/json",
		success: function(res) {
			
			var template="";
			

			Array.prototype.forEach.call(res, function(donne){
				if(donne.etat ==0 ){

				template= template + '<div _ngcontent-kwy-44=""  data-id="'+donne.id_parkingspot+'" class="free" ></div>';
				console.log(donne);
				}else{
					
						template= template + '<div _ngcontent-kwy-44=""  data-id="'+donne.id_parkingspot+'"class="alreadyReserved" ></div>';
				}

				
			});
			$(".location2").html(template);
           
        }
        ,
        
        error : function(resultat, statut, erreur){
         console.log(resultat);
               }

    })
  
	
}

$("#myModal").on("hidden.bs.modal", function(){
    $('.location2 div').removeClass('changeBg');
});

$("#link1").click(function(){
    changeMarkerPos(3.165759, 101.611416);
});
$(".single").click(function(){
    $("#myModal").modal("toggle");
});
$("#link2").click(function(){
    changeMarkerPos(18.5204, 73.8567);
});
function changeMarkerPos(lat, lon){
    myLatLng = new google.maps.LatLng(lat, lon)
    markerpos.setPosition(myLatLng);
    map.panTo(myLatLng);
}

$("#search").click(function(){
    console.log('rachid');
	
	var address =document.getElementById("pac-input").value;
	var points = {};
	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == 'OK') {
			map.setCenter(results[0].geometry.location);
			
			
			points.lat = map.getCenter().lat();
			points.lng = map.getCenter().lng();
            changeMarkerPos(points.lat, points.lng);
            
            var data = {latitude:points.lat,longitude:points.lng,raduis:5};
            data = JSON.stringify(data);
            
            
            nearByCollege(data);
		} else {
			alert('Geocode was not successful for the following reason: ' + status);
		}
	});

	/*var marker = new google.maps.Marker({
		position: new google.maps.LatLng(points.lat, points.lng),
		map: map
	});*/
    
});


google.maps.event.addDomListener(window, 'load', loadMap);




$("#bookingform").submit(function(e){

	var hour =  $("#duration").val();
	var vhecileno = $("#vhecileno").val();
	var id = $(".changeBg").data("id");

	var data =  {'vehicleno': vhecileno , 'id_parkingspot' : id , 'hour' : hour   };

	data = JSON.stringify(data);


	console.log(id);
	console.log(vhecileno);

	e.preventDefault();
	console.log('rachid');
	bookingParkingSpots(data);
	


	return false;
});





jQuery(document).ready(function() {
    jQuery('.location2 div').on( "click", function() {
		
	});
	
	$(document).on('click','.location2 div',function(){
		
		$('.location2 div').removeClass('changeBg');
		$(this).toggleClass('changeBg');
		
		});
});


