<!-- Make sure you put this AFTER Leaflet's CSS -->
 	<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>

  <!-- Load Esri Leaflet from CDN -->
  <script src="https://unpkg.com/esri-leaflet@2.3.3/dist/esri-leaflet.js"
  integrity="sha512-cMQ5e58BDuu1pr9BQ/eGRn6HaR6Olh0ofcHFWe5XesdCITVuSBiBZZbhCijBe5ya238f/zMMRYIMIIg1jxv4sQ=="
  crossorigin=""></script>


  <!-- Load Esri Leaflet Geocoder from CDN -->
  <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.2/dist/esri-leaflet-geocoder.css"
    integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
    crossorigin="">
  <script src="https://unpkg.com/esri-leaflet-geocoder@2.3.2/dist/esri-leaflet-geocoder.js"
    integrity="sha512-8twnXcrOGP3WfMvjB0jS5pNigFuIWj4ALwWEgxhZ+mxvjF5/FBPVd5uAxqT8dd2kUmTVK9+yQJ4CmTmSg/sXAQ=="
    crossorigin=""></script>


   <script type="text/javascript">
   	var latInput=document.querySelector("[name=lat]");
   	var lngInput=document.querySelector("[name=lng]");
   	var lokasiInput=document.querySelector("[name=lokasi]");
   	var idKecamatanInput=document.querySelector("[name=id_kecamatan]");
   	var geocodeService = L.esri.Geocoding.geocodeService();
   	var marker;
   	var map = L.map('map').setView([-3.824181, 114.8191513], 12);

   	var Layer=L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
	    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	    maxZoom: 18,
	    id: 'mapbox.streets',
	    accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
	});
	map.addLayer(Layer);


	map.on("click",function(e){
		var lat=e.latlng.lat;
		var lng=e.latlng.lng;
		if(!marker){
			marker = L.marker(e.latlng).addTo(map)
		}
		else{
			marker.setLatLng(e.latlng);
		}


		latInput.value=lat;
		lngInput.value=lng;

		$.ajax({
			url:"https://nominatim.openstreetmap.org/reverse",
			data:"lat="+lat+
				"&lon="+lng+
				"&format=json",
			dataType:"JSON",
			success:function(data){
				console.log(data);
			    lokasiInput.value=data.display_name;
			}
		})



	  	geocodeService.reverse().latlng(e.latlng).run(function (error, result) {
	      if (error) {
	        return;
	      }
	      console.log(result);
	      var district=result.address.District;
		  idKecamatanInput.selectedIndex=0;
	      for(i=0;i<idKecamatanInput.options.length;i++){
	      	if(idKecamatanInput.options[i].text==district){
	      		idKecamatanInput.selectedIndex=i;
	      		break;
	      	}
	      }
	    });
	})
   </script>