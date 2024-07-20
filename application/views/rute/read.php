<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Application &gt; <?= $sub; ?></h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h5 class="card-title mb-0">Empty card</h5> -->
                    <a href="<?= site_url('Rute/create') ?>" class="btn btn-primary">Tambah Rute</a>
                </div>
                <div class="card-body">
                    <table id="rute" class="table table-data table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Lokasi</th>
                                <th>Posisi</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            //$read yang diambil dari control function index
                            foreach ($read->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row['lokasi'] ?></td>
                                    <td><?= $row['posisi'] ?></td>
                                    <td><?= $row['hari'] ?></td>
                                    <td><?= $row['waktu'] ?></td>
                                    <td>
                                        <div class="gap-1 d-flex">
                                            <a class="btn btn-secondary" href="<?= site_url('Rute/detail/' . $row['id_rute']) ?>">
                                                <i data-feather="eye"></i>
                                            </a>
                                            <a class="btn btn-warning" href="<?= site_url('Rute/edit/' . $row['id_rute']) ?>">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete<?= $row['id_rute']; ?>">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal Hapus List -->
                                <div class="modal fade" id="confirmDelete<?php echo $row['id_rute']; ?>" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="max-width: 30%; border-radius: 10px;">
                                            <div class="modal-header  d-flex justify-content-center">
                                                <h5 class="modal-title fw-bold fs-3 mb-3" id="confirmDeleteLabel">Konfirmasi Penghapusan</h5>
                                            </div>
                                            <div class="modal-body fw-md fs-4 mb-4  d-flex justify-content-center">
                                                Yakin mau menghapus <b>'<?php echo $row['lokasi']; ?>'?</b>
                                            </div>
                                            <div class="modal-footer mt-4 d-flex justify-content-center gap-4">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <a class="btn btn-danger" href="<?php echo site_url('Rute/delete/' . $row['id_rute']) ?>">Ya, Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

</div>