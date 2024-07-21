    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Application &gt; <?= $sub; ?></h1>

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <!-- <h5 class="card-title mb-0">Empty card</h5> -->
                        <a href="<?= site_url('Sampah/create') ?>" class="btn btn-primary">Tambah Sampah</a>
                    </div>
                    <div class="card-body">
                        <table id="sampah" class="table table-data" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kategori</th>
                                    <th>Jumlah</th>
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
                                        <td><?= tanggal($row['tanggal']) ?></td>
                                        <td><?= $row['kategori'] ?></td>
                                        <td><?= $row['jumlah'] ?></td>
                                        <td>
                                            <div class="gap-1 d-flex">
                                                <a class="btn btn-warning" href="<?= site_url('Sampah/edit/' . $row['id_sampah']) ?>">
                                                    <i data-feather="edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete<?= $row['id_sampah']; ?>">
                                                    <i data-feather="trash-2"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal Hapus List -->
                                    <div class="modal fade" id="confirmDelete<?php echo $row['id_sampah']; ?>" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="max-width: 30%; border-radius: 10px;">
                                                <div class="modal-header  d-flex justify-content-center">
                                                    <h5 class="modal-title fw-bold fs-3 mb-3" id="confirmDeleteLabel">Konfirmasi Penghapusan</h5>
                                                </div>
                                                <div class="modal-body fw-md fs-4 mb-4  d-flex justify-content-center">
                                                    Yakin mau menghapus <b>'<?php echo $row['kategori']; ?> <?php echo $row['jumlah']; ?>Kg'?</b>
                                                </div>
                                                <div class="modal-footer mt-4 d-flex justify-content-center gap-4">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <a class="btn btn-danger" href="<?php echo site_url('Sampah/delete/' . $row['id_sampah']) ?>">Ya, Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $no++;
                                }
                                ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th colspan="2">Jumlah</th>
                                    <th class="border-l-8"><?= $total_sampah; ?> Kg</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card">
                    <form method="post" class="mt-2 px-2 px-lg-4" action="<?php echo site_url('sampah/index'); ?>">
                        <label for="period">Pilih Periode:</label>
                        <select name="period" class="form-control" id="period" onchange="toggleCustomDate()">
                            <option value="all">Semua</option>
                            <option value="last_week">1 Minggu Terakhir</option>
                            <option value="second_week">2 Minggu Terakhir</option>
                            <option value="last_month">1 Bulan Terakhir</option>
                            <option value="second_month">2 Bulan Terakhir</option>
                            <option value="third_month">3 Bulan Terakhir</option>
                            <option value="past_month">6 Bulan Terakhir</option>
                            <option value="last_year">1 Tahun Terakhir</option>
                            <option value="custom">Custom</option>
                        </select>

                        <div id="custom_date" class="form-control" style="display: none;">
                            <label for="start_date">Tanggal Mulai:</label>
                            <input type="date" class="form-control datetimepicker" name="start_date" id="start_date"> <br>
                            <label for="end_date">Tanggal Akhir:</label>
                            <input type="date" class="form-control datetimepicker" name="end_date" id="end_date">
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">Tampilkan</button>
                    </form>
                    <div class="card-body">
                        <table id="sampah" class="table table-data table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                //$read yang diambil dari control function index
                                foreach ($sampah_by_kategori as $sampah) {
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $sampah->kategori ?></td>
                                        <td><?= $sampah->total_jumlah ?></td>
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

    <script>
        function toggleCustomDate() {
            var period = document.getElementById('period').value;
            var customDate = document.getElementById('custom_date');
            if (period === 'custom') {
                customDate.style.display = 'block';
            } else {
                customDate.style.display = 'none';
            }
        }
    </script>