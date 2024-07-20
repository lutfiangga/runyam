<div class="wrapper">

    <?php $this->load->view('layout/navbar') ?>
    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <a class="sidebar-toggle js-sidebar-toggle">
                <i class="hamburger align-self-center"></i>
            </a>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align">
                    <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                            <img src="<?= base_url($foto) ?>" class="avatar img-fluid rounded me-1" style="max-width: 30px; max-height: 30px;" alt="Profile <?= $username; ?>" />
                        </a>
                        <a class="nav-link d-none d-sm-inline-block" href="#">
                            <img src="<?= base_url($foto) ?>" class="avatar img-fluid rounded me-1" alt="Profile <?= $username; ?>" /> <span class="text-dark"><?= $nama; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="<?= site_url('Myprofile') ?>"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmLogout<?= $id_user; ?>">Log out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="content">
            <?= $contents; ?>
        </main>
        <!-- Modal Logout -->
        <div class="modal fade" id="confirmLogout<?= $id_user; ?>" tabindex="-1" aria-labelledby="confirmLogoutLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="max-width: 30%; border-radius: 10px;">
                    <div class="modal-header  d-flex justify-content-center">
                        <h5 class="modal-title fw-bold fs-3 mb-3" id="confirmLogoutLabel">Konfirmasi Keluar</h5>
                    </div>
                    <div class="modal-body fw-md fs-4 mb-4  d-flex justify-content-center">
                        Yakin Mau Keluar
                    </div>
                    <div class="modal-footer mt-4 d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a class="btn btn-danger" href="<?= site_url('Auth/logout') ?>">Ya, Keluar</a>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view('layout/footer'); ?>
    </div>
</div>
</body>

<?php $this->load->view('layout/script') ?>

</html>