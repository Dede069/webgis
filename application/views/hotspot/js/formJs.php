<!-- Make sure you put this AFTER Leaflet's CSS -->
 	<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>

	<script src="<?=base_url('assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js')?>"></script>
	<script src="<?=base_url('assets/js/leaflet.ajax.js')?>"></script>

   <script type="text/javascript">
   	var latInput=document.querySelector("[name=lat]");
   	var lngInput=document.querySelector("[name=lng]");
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
	})
   </script>