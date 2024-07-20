<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Application &gt; <?= $sub; ?></h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- <div class="card-header">
                    <a href="<?= site_url('Aduan/create') ?>" class="btn btn-primary">Tambah Aduan</a>
                </div> -->
                <div class="card-body">
                    <table id="rute" class="table table-data table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pengirim</th>
                                <th>Subjek</th>
                                <th>Waktu</th>
                                <th>Status</th>
                                <th>Proses Aduan</th>
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
                                    <td><?= $row['pengirim'] ?></td>
                                    <td><?= $row['subjek'] ?></td>
                                    <td><?= $row['waktu_aduan'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                    <td><?php if ($row['status'] == 'pending') : ?>
                                            <a class="sm:flex items-center sm:mr-4 mt-2 xl:mt-4 btn btn-success w-24 mr-1 mb-2" href="<?php echo site_url('Aduan/accept/' . $row['id_aduan']); ?>">
                                                <i data-feather="rotate-cw"></i>
                                                Proses
                                            </a>

                                            <a class="sm:flex items-center sm:mr-4 mt-2 xl:mt-4 btn btn-danger w-24 mr-1 mb-2" href="<?php echo site_url('Aduan/decline/' . $row['id_aduan']); ?>">
                                                <i data-feather="x-circle"></i>
                                                Tolak
                                            </a>

                                        <?php elseif ($row['status'] == 'diproses') : ?>
                                            <a class="flex items-center btn btn-success text-white font-bold" href="<?php echo site_url('Aduan/finish/' . $row['id_aduan']) ?>">
                                                <i data-feather="check-circle" class="w-4 h-4 mr-1"></i> Selesai
                                            </a>
                                        <?php elseif ($row['status'] == 'ditolak') : ?>
                                            Aduan ditolak
                                        <?php elseif ($row['status'] == 'selesai') : ?>
                                            Aduan sudah ditanggapi
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="gap-1 d-flex">
                                            <a class="btn btn-secondary" href="<?= site_url('Aduan/detail/' . $row['id_aduan']) ?>">
                                                <i data-feather="eye"></i>
                                            </a>
                                            <!-- <a class="btn btn-warning" href="<?= site_url('Aduan/edit/' . $row['id_aduan']) ?>">
                                                <i data-feather="edit"></i>
                                            </a> -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete<?= $row['id_aduan']; ?>">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal Hapus List -->
                                <div class="modal fade" id="confirmDelete<?php echo $row['id_aduan']; ?>" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="max-width: 30%; border-radius: 10px;">
                                            <div class="modal-header  d-flex justify-content-center">
                                                <h5 class="modal-title fw-bold fs-3 mb-3" id="confirmDeleteLabel">Konfirmasi Penghapusan</h5>
                                            </div>
                                            <div class="modal-body fw-md fs-4 mb-4  d-flex justify-content-center">
                                                Yakin mau menghapus <b>'<?php echo $row['subjek']; ?>'?</b>
                                            </div>
                                            <div class="modal-footer mt-4 d-flex justify-content-center gap-4">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <a class="btn btn-danger" href="<?php echo site_url('Aduan/delete/' . $row['id_aduan']) ?>">Ya, Hapus</a>
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