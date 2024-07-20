<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">
		body {
			margin: 0;
			padding: 0;
		}

		#map {
			position: absolute;
			top: 1;
			bottom: 1;
			width: 60%;
			height: 40%;
		}

		::selection {
			background-color: #E13300;
			color: white;
		}

		::-moz-selection {
			background-color: #E13300;
			color: white;
		}

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
			text-decoration: none;
		}

		a:hover {
			color: #97310e;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body {
			margin: 0 15px 0 15px;
			min-height: 96px;
		}

		p {
			margin: 0 0 10px;
			padding: 0;
		}

		p.footer {
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}

		#container {
			margin: 10px;
			border: 1px solid #D0D0D0;
			box-shadow: 0 0 8px #D0D0D0;
		}
	</style>
	<!-- <link href="<?= base_url('sb-admin/') ?>css/styles.css" rel="stylesheet" /> -->
	<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<!-- <script src="<?= base_url('sb-admin/') ?>js/scripts.js"></script> -->

	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
	<!-- Rute -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
	<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet" />
	<script src="https://cdn.tailwindcss.com/"></script>
</head>

<body>

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label>Latitude</label>
				<input class="form-control" name="latitude" id="Latitude">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label>Longitude</label>
				<input class="form-control" name="longitude" , id="Longitude">
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>Posisi</label>
					<input class="form-control" name="posisi" , id="Posisi">
				</div>
			</div>

			<div class="col-sm-12">
				<br>
				<div id="map" style="width: 100%; height: 100vh;"></div>
			</div>
		</div>





		<script>
			var Streets = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicmVwYW4yMDEyMjAwNDEiLCJhIjoiY2xvczZ3bTg3MDQ0aDJrbnJqajh4Z2x2MSJ9.zp-NOWWqogtVOsYfax5fhQ', {
				attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
					'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
					'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
				id: 'mapbox/streets-v11'
			});

			var Satellite = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicmVwYW4yMDEyMjAwNDEiLCJhIjoiY2xvczZ3bTg3MDQ0aDJrbnJqajh4Z2x2MSJ9.zp-NOWWqogtVOsYfax5fhQ', {
				attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
					'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
					'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
				id: 'mapbox/satellite-v9'
			});

			var OpenStreetMap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
			});

			var Dark = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicmVwYW4yMDEyMjAwNDEiLCJhIjoiY2xvczZ3bTg3MDQ0aDJrbnJqajh4Z2x2MSJ9.zp-NOWWqogtVOsYfax5fhQ', {
				attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
					'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
					'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
				id: 'mapbox/dark-v10'
			});

			// Add more layers here...

			var Stamen = L.tileLayer('YOUR_TILE_URL_HERE', {
				attribution: 'Your attribution here'
			});

			var CartDB = L.tileLayer('ANOTHER_TILE_URL_HERE', {
				attribution: 'Another attribution here'
			});


			const map = L.map('map', {
				center: [-0.023378509107682747, 109.32605263182627],
				zoom: 16,
				layers: [Satellite]
			});

			const baseLayers = {
				'Streets': Streets,
				'Satellite': Satellite,
				'OpenStreetMap ': OpenStreetMap,
				'Dark': Dark,
				'Stamen': Stamen,
				'CartDB': CartDB,
			};

			const layerControl = L.control.layers(baseLayers, null, {
				collapsed: false
			}).addTo(map);

			//getcoordinat
			var latInput = document.querySelector("[name=latitude]");
			var lngInput = document.querySelector("[name=longitude]");
			var posisi = document.querySelector("[name=posisi]");
			var curLocation = [-0.023378509107682747, 109.32605263182627];
			map.attributionControl.setPrefix(false);

			var marker = new L.marker(curLocation, {
				draggable: true,
			});

			//mengambil coordinat saat marker d pindah/geser 
			marker.on('dragend', function(e) {
				var position = marker.getLatLng();
				marker.setLatLng(position, {
					curLocation,
				}).bindPopup(position).update();
				$("#Latitude").val(position.lat);
				$("#Longitude").val(position.lng);
				$("#Posisi").val(position.lat + ',' + position.lng);
			});

			//mengambil coordinat saat map diclik
			map.on('click', function(e) {
				var lat = e.latlng.lat;
				var lng = e.latlng.lng;
				if (!marker) {
					marker = L.marker(e.latlng).addTo(map);
				} else {
					marker.setLatLng(e.latlng);
				}
				latInput.value = lat;
				lngInput.value = lng;
				posisi.value = lat + ',' + lng;
			});

			map.addLayer(marker);

			map.addControl(new mapboxgl.FullscreenControl())
			map.addControl(new mapboxgl.NavigationControl())
			map.addControl(new mapboxgl.ScaleControl())
		</script>

</body>

</html>