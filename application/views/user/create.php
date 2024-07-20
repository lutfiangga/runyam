<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Application &gt; <?= $sub; ?></h1>
        <a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html">
            Tambah pengguna
        </a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tambah Pengguna</h5>
                    <h6 class="card-subtitle text-muted">tambah orang yang akan kelola webnya</h6>
                </div>
                <div class="card-body">
                    <?php if ($this->session->flashdata('register_error')) : ?>
                        <div class="col-12 mb-4">
                            <div class="alert alert-danger alert-dismissible fade show bg-danger rounded-md pt-3 px-4 text-white" role="alert">
                                <div class="d-flex justify-content-between items-content-center">
                                    <p class="justify-content-center">
                                       Username sudah digunakan
                                    </p>
                                    <button type="button" class="btn-close justify-content-end bg-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?= site_url('User/save') ?>" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-12">
                                <label for="nama" class="form-label">Nama:</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh : budi" required>
                            </div>
                            <div class="mt-4 col-12 col-sm-6 col-md-6">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Contoh : admin" required>
                            </div>
                            <div class="mt-4 col-12 col-sm-6 col-md-6">
                                <label for="password" class="form-label">Password:</label>
                                <input type="text" class="form-control" id="password" name="password" placeholder="Contoh : Admin#1234" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-4 mt-4">
                            <a href="<?= site_url('User') ?>" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>