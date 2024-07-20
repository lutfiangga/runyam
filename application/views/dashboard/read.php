<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Google Maps</h1>
        <a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html">
            Get more Google Maps examples
        </a>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Default Map</h5>
                    <h6 class="card-subtitle text-muted">Displays the default road map view.</h6>
                </div>
                <div class="card-body">
                    <div class="content" id="map" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Hybrid Map</h5>
                    <h6 class="card-subtitle text-muted">Displays a mixture of normal and satellite views.</h6>
                </div>
                <div class="card-body">
                    <div class="content" id="hybrid_map" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    var Streets = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicmVwYW4yMDEyMjAwNDEiLCJhIjoiY2xvczZ3bTg3MDQ0aDJrbnJqajh4Z2x2MSJ9.zp-NOWWqogtVOsYfax5fhQ', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, ' +
            '<a href="https:almaata.ac.id"><img width="11px" height="11px" src="<?= base_url('assets/img/logo.png') ?>"> Universitas Alma Ata</a>',
        id: 'mapbox/streets-v11'
    });

    var Satellite = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicmVwYW4yMDEyMjAwNDEiLCJhIjoiY2xvczZ3bTg3MDQ0aDJrbnJqajh4Z2x2MSJ9.zp-NOWWqogtVOsYfax5fhQ', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, ' +
            '<a href="https:almaata.ac.id"><img width="11px" height="11px" src="<?= base_url('assets/img/logo.png') ?>"> Universitas Alma Ata</a>',
        id: 'mapbox/satellite-v9'
    });

    var OpenStreetMap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, ' +
            '<a href="https:almaata.ac.id"><img width="11px" height="11px" src="<?= base_url('assets/img/logo.png') ?>"> Universitas Alma Ata</a>',
    });

    var Dark = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicmVwYW4yMDEyMjAwNDEiLCJhIjoiY2xvczZ3bTg3MDQ0aDJrbnJqajh4Z2x2MSJ9.zp-NOWWqogtVOsYfax5fhQ', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, ' +
            '<a href="https:almaata.ac.id"><img width="11px" height="11px" src="<?= base_url('assets/img/logo.png') ?>"> Universitas Alma Ata</a>',
        id: 'mapbox/dark-v10'
    });

    // Add more layers here...

    var Stamen = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicmVwYW4yMDEyMjAwNDEiLCJhIjoiY2xvczZ3bTg3MDQ0aDJrbnJqajh4Z2x2MSJ9.zp-NOWWqogtVOsYfax5fhQ', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, ' +
            '<a href="https:almaata.ac.id"><img width="11px" height="11px" src="<?= base_url('assets/img/logo.png') ?>"> Universitas Alma Ata</a>',
        id: 'mapbox/stamen_watercolor'
    });

    var CartDB = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicmVwYW4yMDEyMjAwNDEiLCJhIjoiY2xvczZ3bTg3MDQ0aDJrbnJqajh4Z2x2MSJ9.zp-NOWWqogtVOsYfax5fhQ', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, ' +
            '<a href="https:almaata.ac.id"><img width="11px" height="11px" src="<?= base_url('assets/img/logo.png') ?>"> Universitas Alma Ata</a>',
        id: 'mapbox/cartdb-v9'
    });


    const map = L.map('map', {
        center: [-7.892299, 110.306511],
        zoom: 16,
        layers: [Streets]
    });

    const baseLayers = {
        'Streets': Streets,
        'Satellite': Satellite,
        'OpenStreetMap ': OpenStreetMap,
        'Dark': Dark,
        // 'Stamen': Stamen,
        // 'CartDB': CartDB,
    };

    const layerControl = L.control.layers(baseLayers, null, {
        collapsed: false
    }).addTo(map);

    // <?php foreach ($rute->result_array() as $key => $value) { ?>
    //     L.marker([<?= $value['latitude'] ?>, <?= $value['longitude'] ?>]).addTo(map)
    //         .bindPopup("<?= $value['lokasi'] ?>")
    //     // .openPopup();
    // <?php } ?>

    // Define the waypoints array
    var waypoints = [
        <?php foreach ($rute->result_array() as $key => $value) { ?>
            L.latLng(<?= $value['latitude'] ?>, <?= $value['longitude'] ?>),
        <?php } ?>
    ];

    // Initialize the routing control
    var control = L.Routing.control({
        waypoints: waypoints,
        createMarker: function(i, waypoint, n) {
            // Create a marker at the waypoint
            <?php foreach ($rute->result_array() as $key => $value) { ?>
                var marker = L.marker(waypoint.latLng).bindPopup('<?= $value['lokasi'] ?>');
                return marker;
            <?php } ?>
        },
    }).addTo(map);

    // Loop through waypoints to add popups
    waypoints.forEach(function(waypoint) {
        // Create and bind a popup to each waypoint
        <?php foreach ($rute->result_array() as $key => $value) { ?>
            L.marker(waypoint).addTo(map).bindPopup('<?= $value['lokasi'] ?>');
        <?php } ?>
    });

    map.addControl(new mapboxgl.FullscreenControl())
    map.addControl(new mapboxgl.NavigationControl())
    map.addControl(new mapboxgl.ScaleControl())
</script>