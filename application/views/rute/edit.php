<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Application &gt; <?= $sub; ?></h1>
        <a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html">
            Pilih lokasi pengambilan
        </a>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Lokasi pengambilan</h5>
                    <h6 class="card-subtitle text-muted">klik marker atau drag marker di maps</h6>
                </div>
                <div class="card-body">
                    <div class="content" id="map" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="<?= site_url('Rute/update/') . $edit['id_rute'] ?>" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <label for="lokasi" class="form-label">Lokasi:</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= $edit['lokasi'] ?>" placeholder="Contoh : lapangan" required>
                            </div>
                            <div class="mt-4 col-12 col-sm-6 col-md-6">
                                <label for="hari" class="form-label">Hari:</label>
                                <input type="text" class="form-control" id="hari" name="hari" value="<?= $edit['hari'] ?>" placeholder="Contoh : senin dan jumat" required>
                            </div>
                            <div class="mt-4 col-12 col-sm-6 col-md-6">
                                <label for="waktu" class="form-label">Jam:</label>
                                <input type="time" class="form-control" id="waktu" name="waktu" value="<?= $edit['waktu'] ?>" placeholder="Contoh : 09:00" required>
                            </div>
                            <div class="mt-4 col-12 col-sm-6 col-md-6">
                                <label for="latitude" class="form-label">Latitude:</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" value="<?= $edit['latitude'] ?>" placeholder="Contoh : -7.0023481" required>
                            </div>
                            <div class="mt-4 col-12 col-sm-6 col-md-6">
                                <label for="longitude" class="form-label">Longitude:</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" value="<?= $edit['longitude'] ?>" placeholder="Contoh : 110.843232" required>
                            </div>
                            <div class="mt-4 col-12">
                                <label for="posisi" class="form-label">Posisi:</label>
                                <input type="text" class="form-control" id="posisi" name="posisi" value="<?= $edit['posisi'] ?>" placeholder="Contoh : -7.3421, 110.3214" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-4 mt-4">
                            <a href="<?= site_url('Rute') ?>" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
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
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    var Dark = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicmVwYW4yMDEyMjAwNDEiLCJhIjoiY2xvczZ3bTg3MDQ0aDJrbnJqajh4Z2x2MSJ9.zp-NOWWqogtVOsYfax5fhQ', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, ' +
            '<a href="https:almaata.ac.id"><img width="11px" height="11px" src="<?= base_url('assets/img/logo.png') ?>"> Universitas Alma Ata</a>',
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

    //getcoordinat
    var latInput = document.querySelector("[name=latitude]");
    var lngInput = document.querySelector("[name=longitude]");
    var posisi = document.querySelector("[name=posisi]");
    var curLocation = [-7.892299, 110.306511];
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