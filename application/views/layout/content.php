<div class="wrapper">

    <?php $this->load->view('layout/navbar') ?>
    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <!-- <a class="sidebar-toggle js-sidebar-toggle">
                <i class="hamburger align-self-center"></i>
            </a> -->

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align">
                    <li class="nav-item dropdown">
                        <a class="nav-link d-none d-sm-inline-block" href="#">
                            <img src="<?= base_url($foto) ?>" class="avatar img-fluid rounded me-1" alt="Profile <?= $username; ?>" /> <span class="text-dark"><?= $nama; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="<?= site_url('Admin/Myprofile') ?>"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
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

        <!-- <?php $this->load->view('layout/footer'); ?> -->
    </div>
</div>
</body>

<?php $this->load->view('layout/script') ?>

</html>