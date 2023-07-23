<!--Open Navbar  -->
<!-- Topbar -->
<header>
    <div class="container mt-4">
        <nav class="navbar navbar-expand-lg bg-white ms-auto ">
            <div class="container ">
                <a class="navbar-brand" href="<?= base_url('home') ?>">
                    <img src="<?= base_url() ?>/assets/img/mgsl.svg" alt="logomangselperpus" srcset="" width="100" height="" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse dropdown" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <?php if (logged_in()) : ?>
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-4 d-none d-lg-inline text-gray-600 small me-1"><?= user()->username; ?></span>
                                    <img class="img-profile rounded-circle ms-auto" src="<?= base_url(); ?>/img/<?= user()->foto; ?>" alt="Foto Profile" style="width: 40px; height: 40px;">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="<?= base_url('admin'); ?>">
                                        <i class="fas fa-fw fa-tachometer-alt mr-2 text-gray-400"></i>
                                        Dashboard
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= base_url('logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="d-flex btn-container gap-3 ml-2">
                                    <a href="<?= base_url('login'); ?>" class="text-decoration-none">
                                        <button class="btn btn-info text-white " type="submit">
                                            Login
                                        </button>
                                    </a>
                                    <a href="<?= base_url('register'); ?> " class="text-decoration-none">
                                        <button class="btn btn-info text-white" type="submit">
                                            Register
                                        </button>
                                    </a>
                                </div>
                            <?php endif ?>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>