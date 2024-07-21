<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Application &gt; <?= $sub; ?></h1>
        <a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html">
            Edit Data Sampah
        </a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit Sampah</h5>
                    <h6 class="card-subtitle text-muted">edit data sampah yang dikelola</h6>
                </div>
                <div class="card-body">

                    <form method="POST" action="<?= site_url('Sampah/update/') . $edit['id_sampah'] ?>" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <label for="tanggal" class="form-label">Tanggal:</label>
                                <input type="date" class="form-control" id="tanggal" value="<?= $edit['tanggal'] ?>" name="tanggal" placeholder="Contoh : budi" required>
                            </div>
                            <div class="mt-4 col-12 col-sm-6 col-md-6">
                                <label for="kategori" class="form-label">Kategori:</label>
                                <input type="text" class="form-control" id="kategori" value="<?= $edit['kategori'] ?>" name="kategori" placeholder="Contoh : admin" required>
                            </div>
                            <div class="mt-4 col-12 col-sm-6 col-md-6">
                                <label for="jumlah" class="form-label">Jumlah:</label>
                                <div class="input-group">
                                    <input type="text" id="jumlah" placeholder="1132" name="jumlah" value="<?= $edit['jumlah'] ?>" class="form-control" aria-label="jumlah" required>
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-4 mt-4">
                            <a href="<?= site_url('Sampah') ?>" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>