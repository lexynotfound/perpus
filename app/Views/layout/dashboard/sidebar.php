        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon ">
                    <i class="fas fa-solid fa-users"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?= user()->nama; ?>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->

            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url('admin') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <?php if (in_groups('petugas')) : ?>

                <div class="sidebar-heading">
                    Data
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-user"></i>
                        <span>User</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Data Anggota:</h6>
                            <a class="collapse-item" href="<?= base_url('admin/data') ?>">Daftar Anggota</a>
                            <a class="collapse-item" href="<?= base_url('admin/tambahUserView') ?>">Tambah Anggota</a>
                        </div>
                    </div>
                </li>


                <!-- Nav Item -Buku -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-regular fa-book"></i>
                        <span>Buku</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Data Buku:</h6>
                            <a class="collapse-item" href="<?= base_url('buku') ?>">Buku</a>
                            <a class="collapse-item" href="<?= base_url('kategori') ?>">Katagori</a>
                            <a class="collapse-item" href="<?= base_url("rak") ?>">Rak</a>
                        </div>
                    </div>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Transaksi
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> -->

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-regular fa-file-invoice"></i>
                        <span>Transaksi</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Transaksi:</h6>
                            <a class="collapse-item" href="<?= base_url('pinjam') ?>">Peminjaman</a>
                            <a class="collapse-item" href="<?= base_url('pengembalian') ?>">Pengembalian</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Denda -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('denda') ?>">
                        <i class="fas fa-solid fa-money-bill"></i>
                        <span>Denda</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <div class="sidebar-heading">
                    Laporan
                </div>

                <!-- Nav Item - Denda -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="true" aria-controls="collapseLaporan">
                        <i class="fas fa-regular fa-file-invoice"></i>
                        <span>Laporan</span>
                    </a>
                    <div id="collapseLaporan" class="collapse" aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Laporan:</h6>
                            <a class="collapse-item" href="<?= base_url('laporanbuku') ?>">Laporan Buku</a>
                            <a class="collapse-item" href="<?= base_url('laporan') ?>">Laporan Peminjaman</a>
                            <a class="collapse-item" href="<?= base_url('laporanpengembalian') ?>">Laporan Pengembalian</a>
                            <a class="collapse-item" href="<?= base_url('laporandenda') ?>">Laporan Denda</a>
                        </div>
                    </div>
                </li>


            <?php else : ?>
                <!-- Nav Item - Denda -->
                <li class="nav-item">
                    <a class="nav-link" href="charts.html">
                        <i class="fas fa-solid fa-money-bill"></i>
                        <span>Denda</span></a>
                </li>
            <?php endif ?>
            <!-- Heading -->




            <!-- Nav Item - Tables -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->