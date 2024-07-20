<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Application &gt; <?= $sub;?></h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h5 class="card-title mb-0">Empty card</h5> -->
                    <a href="<?= site_url('Rute/create')?>" class="btn btn-primary">Tambah Rute</a>
                </div>
                <div class="card-body">
                    <table id="rute" class="table table-data table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Lokasi</th>
                                <th>Posisi</th>
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
                                    <td>
                                        <div class="gap-1 d-flex">
                                            <a class="btn btn-secondary" href="<?= site_url('Rute/detail/' . $row['id_rute']) ?>">
                                                <i data-feather="eye"></i>
                                            </a>
                                            <a class="btn btn-warning" href="<?= site_url('Rute/edit/' . $row['id_rute']) ?>">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteRute<?= $row['id_rute']; ?>">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </div>
                                    </td>
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

</div>