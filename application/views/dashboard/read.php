<div class="container-fluid p-0">

    <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

    <div class="row">
        <div class="col-xl-6 col-xxl-5 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Pegguna</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="users"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"><?= $user; ?></h1>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Rute</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="compass"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"><?= $jumlah_rute; ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Aduan</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="message-circle"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"><?= $total_aduan; ?></h1>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Sampah</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="trash-2"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"><?= $total_sampah; ?> Kg</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-xxl-7">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Grafik pengambilan Sampah</h5>
                </div>
                <div class="card-body py-3">
                    <div class="chart chart-sm">
                        <canvas id="grafik-pengambilan-sampah"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 col-xxl-6 d-flex order-2 order-xxl-3">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Kategori Sampah</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="py-3">
                            <div class="chart chart-xs">
                                <canvas id="chartjs-dashboard-pie"></canvas>
                            </div>
                        </div>

                        <table class="table mb-0">
                            <tbody>
                                <?php
                                $no = 1;
                                //$read yang diambil dari control function index
                                foreach ($kategori_sampah as $sampah) {
                                ?>
                                    <tr>
                                        <td><?= $no;?></td>
                                        <td><?= $sampah->kategori;?></td>
                                        <td class="text-end"><?= $sampah->total_jumlah;?></td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Rute Pengambilan Sampah</h5>
                </div>
                <div class="card-body px-4">
                    <div id="map" style="height:350px;"></div>
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