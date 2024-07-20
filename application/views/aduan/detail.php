<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Application &gt; <?= $sub; ?></h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-start">
                        <a href="<?= site_url('Aduan') ?>" class="btn btn-danger me-2">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="GET" action="<?= site_url('Aduan/update/') . $detail['id_aduan'] ?>" enctype="multipart/form-data">
                        <div class="row">
                            <div class="mt-4 col-12 col-sm-6 col-md-3">
                                <label for="status" class="form-label">Status:</label>
                                <p class="badge bg-dark text-white ms-2 px-4 py-2" href="upgrade-to-pro.html">
                                    <?= $detail['status'] ?>
                                </p>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <label for="waktu_aduan" class="form-label">Waktu Aduan:</label>
                                <p class="badge bg-secondary text-white ms-2 px-4 py-2" href="upgrade-to-pro.html">
                                    <?= $detail['waktu_aduan'] ?>
                                </p>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <label for="subjek" class="form-label">Subjek:</label>
                                <input type="text" class="form-control" id="subjek" name="subjek" value="<?= $detail['subjek'] ?>" readonly>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <label for="pengirim" class="form-label">Pengirim:</label>
                                <input type="text" class="form-control" id="pengirim" name="pengirim" value="<?= $detail['pengirim'] ?>" readonly>
                            </div>

                            <div class="mt-4 col-12">
                                <label for="pesan" class="form-label">Pesan:</label>
                                <textarea type="text" rows="6" class="form-control" id="pesan" name="pesan" readonly><?= $detail['pesan'] ?></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>