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
            <?php foreach ($rute->result_array() as $key => $value) { ?>
                if (i === <?= $key ?>) {
                    var marker = L.marker(waypoint.latLng).bindPopup('<?= $value['lokasi'] ?><br/> Setiap hari <?= $value['hari'] ?> <br/> pukul <?= $value['waktu'] ?>', {
                        autoClose: true,
                        closeOnClick: false,
                        autoPan: false
                    });
                    marker.on('click', function(e) {
                        this.openPopup();
                    });
                    return marker;
                }
            <?php } ?>
            return L.marker(waypoint.latLng);
        },
        routeWhileDragging: true,
        geocoder: false, // Disable geocoder
        collapsible: true, // Make the control collapsible
        autoRoute: true // Disable auto routing
    }).addTo(map);

    // Hide the control by default
    control.hide();

    // Loop through waypoints to add popups
    waypoints.forEach(function(waypoint, i) {
        <?php foreach ($rute->result_array() as $key => $value) { ?>
            if (i === <?= $key ?>) {
                var marker = L.marker(waypoint).addTo(map).bindPopup('<?= $value['lokasi'] ?><br/> Setiap hari <?= $value['hari'] ?> <br/> pukul <?= $value['waktu'] ?>', {
                    autoPan: false
                });
                marker.on('click', function(e) {
                    this.openPopup();
                });
            }
        <?php } ?>
    });

    map.addControl(new mapboxgl.FullscreenControl())
    map.addControl(new mapboxgl.NavigationControl())
    map.addControl(new mapboxgl.ScaleControl())
</script>