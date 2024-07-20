<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Runyam</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">Pages</li>

            <li class="sidebar-item <?= ($active_menu == 'dashboard') ? 'active' : ''; ?>">
                <a class="sidebar-link" href="<?= site_url('Dashboard'); ?>">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item <?= ($active_menu == 'myprofle') ? 'active' : ''; ?>">
                <a class="sidebar-link" href="<?= site_url('Myprofile'); ?>">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">My Profile</span>
                </a>
            </li>


            <li class="sidebar-header">Manajemen Sampah</li>

            <li class="sidebar-item <?= ($active_menu == 'user') ? 'active' : ''; ?>">
                <a class="sidebar-link" href="<?= site_url('User'); ?>">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">User</span>
                </a>
            </li>
            <li class="sidebar-item <?= ($active_menu == 'rute') ? 'active' : ''; ?>">
                <a class="sidebar-link" href="<?= site_url('Rute'); ?>">
                    <i class="align-middle" data-feather="map"></i> <span class="align-middle">Rute</span>
                </a>
            </li>

            <li class="sidebar-header">Logout</li>

            <li class="sidebar-item <?= ($active_menu == 'logout') ? 'active' : ''; ?>">
                <a class="sidebar-link" data-bs-toggle="modal" data-bs-target="#confirmLogout<?= $id_user; ?>"> <i class="align-middle" data-feather="power"></i> <span class="align-middle">Logout</span></a>
            </li>

        </ul>

    </div>
</nav>