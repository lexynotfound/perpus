<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Open Hero Section  -->
<div class="section g-3 position-relative ">
    <div class="container col-xxl-4 px-6 py-5 ">
        <div class="ml-2 mr-1 md:ml-2 rounded-3">
            <div class="p-4 rounded-5 shadow">
                <div class="pb-1 text-left">
                    <h2 class="mb-2 text-lg text-center font-medium text-gray-900 dark:text-white rounded-6">
                        Riwayat Peminjaman
                    </h2>
                    <form action="<?= base_url('home/searchRiwayat'); ?>" method="GET">
                        <div class="mt-3 overflow-hidden bg-white border-none rounded-6 ">
                            <input class="w-100 px-3 p-5 py-2 mb-3 placeholder-gray-400 rounded-3 focus:outline-none" type="text" name="s" placeholder="Cek Riwayat Peminjaman...">
                        </div>
                        <button type="submit" class="w-100 p-5 py-2 mt-3 text-sm font-lg tracking-widest text-white uppercase bg-gray-900 rounded-lg btn btn-info">
                            Cek Riwayat
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Closed Hero Section -->
    <!-- Open Content -->

    <?php if (isset($riwayatPinjam) || isset($riwayatPengembalian)) : ?>
        <?php if (!empty($riwayatPinjam) || !empty($riwayatPengembalian)) : ?>
            <div class="card">
                <div class="card-body">
                    <div class="container mb-5 mt-3">
                        <?php if (!empty($riwayatPinjam)) : ?>
                            <?php foreach ($riwayatPinjam as $pinjam) : ?>
                                <div class="row d-flex align-items-baseline">
                                    <div class="col-xl-9">
                                        <p style="color: #7e8d9f;font-size: 20px;">Invoice &gt;&gt; <strong>ID: <?= $pinjam->id_pinjam ?></strong></p>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <!-- <i class="far fa-building fa-4x ms-0" style="color:#8f8061 ;"></i> -->
                                            <img src="<?= base_url('img/logo.png') ?>" class="rounded-image mx-auto d-block" alt="Logo" style="max-width: 100%; height: auto;" />
                                            <p class="pt-2">Mangsel</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-8">
                                            <ul class="list-unstyled">
                                                <li class="text-muted">Peminjam: <span style="color:#8f8061 ;"><?= $pinjam->nama; ?></span></li>
                                                <li class="text-muted"><?= $pinjam->alamat; ?></li>
                                                <li class="text-muted"><?= $pinjam->tempat_lahir; ?></li>
                                                <li class="text-muted"><i class="fas fa-phone fa-sm me-2"></i><?= $pinjam->telepon; ?></li>
                                            </ul>
                                        </div>
                                        <div class="col-xl-4">
                                            <p class="text-muted">Invoice</p>
                                            <ul class="list-unstyled">
                                                <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span class="fw-bold">ID:</span><?= $pinjam->id_pinjam; ?></li>
                                                <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span class="fw-bold">Creation Date: </span><?= $pinjam->tgl_pinjam; ?></li>
                                                <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span class="fw-bold">Due Date: </span><?= $pinjam->lama_pinjam; ?> Hari</li>
                                                <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061;"></i> <span class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold"><?= $pinjam->status; ?></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row my-2 mx-1 justify-content-center">
                                        <div class="col-md-2 mb-4 mb-md-0">
                                            <div class=" bg-image ripple rounded-5 mb-4 overflow-hidden d-block " data-ripple-color="light">
                                                <img src="<?= base_url('writable/uploads/' . $pinjam->sampul) ?>" class="rounded-image"  alt="Sampul" />
                                                <a href="#!">
                                                    <div class="hover-overlay">
                                                        <div class="mask" style="background-color: hsla(0, 0%, 98.4%, 0.2)"></div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-7 mb-4 mb-md-0">
                                            <p class="fw-bold"><?= $pinjam->title; ?></p>
                                            <p class="mb-1">
                                                <span class="text-muted me-2">Jumlah:</span><span><?= $pinjam->jml_pinjam; ?> Buku</span>
                                            </p>
                                            <p>
                                                <span class="text-muted me-2">Kode:</span><span><?= $pinjam->id_buku; ?></span>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-xl-8">
                                            <p class="ms-3">Add additional notes and payment information</p>
                                        </div>
                                        <div class="col-xl-3">
                                            <ul class="list-unstyled">
                                                <li class="text-muted ms-3"><span class="text-black me-4">Denda</span><?= $pinjam->denda; ?></li>
                                            </ul>
                                            <p class="text-black float-start"><span class="text-black me-3"> Total Denda</span><span style="font-size: 25px;"><?= $pinjam->denda; ?></span></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="container mb-5 mt-3">
                        <?php if (!empty($riwayatPengembalian)) : ?>
                            <?php foreach ($riwayatPengembalian as $pengembalian) : ?>
                                <div class="row d-flex align-items-baseline">
                                    <div class="col-xl-9">
                                        <p style="color: #7e8d9f;font-size: 20px;">Invoice &gt;&gt; <strong>ID: <?= $pengembalian->id_pengembalian ?></strong></p>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <!-- <i class="far fa-building fa-4x ms-0" style="color:#8f8061 ;"></i> -->
                                            <img src="<?= base_url('img/logo.png') ?>" class="rounded-image mx-auto d-block" alt="Logo" style="max-width: 100%; height: auto;" />
                                            <p class="pt-2">Mangsel</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-8">
                                            <ul class="list-unstyled">
                                                <li class="text-muted">Peminjam: <span style="color:#8f8061 ;"><?= $pengembalian->nama; ?></span></li>
                                                <li class="text-muted"><?= $pengembalian->alamat; ?></li>
                                                <li class="text-muted"><?= $pengembalian->tempat_lahir; ?></li>
                                                <li><i class="fas fa-phone fa-sm me-2"></i> <?= $pengembalian->telepon; ?></li>
                                            </ul>
                                        </div>
                                        <div class="col-xl-4">
                                            <p class="text-muted">Invoice</p>
                                            <ul class="list-unstyled">
                                                <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span class="fw-bold">ID:</span><?= $pengembalian->id_pengembalian; ?></li>
                                                <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span class="fw-bold">Creation Date: </span><?= $pengembalian->tgl_pinjam; ?></li>
                                                <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span class="fw-bold">Updated Date: </span><?= $pengembalian->tgl_balik; ?></li>
                                                <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span class="fw-bold">Due Date: </span><?= $pengembalian->lama_pinjam; ?></li>
                                                <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061;"></i> <span class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                                                        <?= $pengembalian->status; ?></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row my-2 mx-1 justify-content-center">
                                        <div class="col-md-2 mb-4 mb-md-0">
                                            <div class=" bg-image ripple rounded-5 mb-4 overflow-hidden d-block " data-ripple-color="light">
                                                <img src="<?= base_url('writable/uploads/' . $pengembalian->sampul) ?>" class="rounded-image" alt="Sampul" />
                                                <a href="#!">
                                                    <div class="hover-overlay">
                                                        <div class="mask" style="background-color: hsla(0, 0%, 98.4%, 0.2)"></div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-7 mb-4 mb-md-0">
                                            <p class="fw-bold"><?= $pengembalian->title; ?></p>
                                            <p class="mb-1">
                                                <span class="text-muted me-2">Jumlah:</span><span><?= $pengembalian->jml_pinjam; ?> Buku</span>
                                            </p>
                                            <p>
                                                <span class="text-muted me-2">Kode:</span><span><?= $pengembalian->id_buku; ?></span>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-xl-8">
                                            <p class="ms-3">Add additional notes and payment information</p>
                                        </div>
                                        <div class="col-xl-3">
                                            <ul class="list-unstyled">
                                                <li class="text-muted ms-3"><span class="text-black me-4">Denda</span><?= $pengembalian->denda; ?></li>
                                            </ul>
                                            <p class="text-black float-start"><span class="text-black me-3"> Total Denda</span><span style="font-size: 25px;"><?= $pengembalian->denda; ?></span></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else : ?>
                <div class="container text-center mt-4 g-5">
                    <h4 style="font-size: 30px;">Belum Ada Riwayat Peminjaman dan Pengembalian</h4>
                </div>
            <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="container text-left mt-5 mb-5">
            <div class="row">
                <div class="col-xxl-4 px-6 py-5 ml-auto">
                    <div class="ml-2 mr-1 md:ml-2 rounded-3">
                        <div class="p-4 rounded-5 shadow">
                            <div class="pb-1 text-left">
                                <h2 class="mb-2 text-lg text-center font-medium text-gray-900 dark:text-white rounded-6">
                                    Cari Buku
                                </h2>
                                <form action="<?= base_url('home/searchBuku'); ?>" method="GET">
                                    <div class="mt-3 overflow-hidden bg-white border-none rounded-6 ">
                                        <input class="w-100 px-3 p-5 py-2 mb-3 placeholder-gray-400 rounded-3 focus:outline-none" type="text" name="s" placeholder="Cari Buku...">
                                    </div>
                                    <button type="submit" class="w-100 p-5 py-2 mt-3 text-sm font-lg tracking-widest text-white uppercase bg-gray-900 rounded-lg btn btn-info">
                                        Search
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script type="text/javascript">
            $(document).on('click', 'button', function() {
                $(this).addClass('active').siblings().removeClass('active');
            })
        </script>

        <?php if (isset($buku) && !empty($buku)) : ?>
            <section style="background-color: #FEFFFD;">
                <div class="container py-5">
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-12 col-xl-10">
                            <?php foreach ($buku as $item) : ?>
                                <div class="card shadow-0 border rounded-3 mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                                <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                                    <img src="<?= base_url('writable/uploads/' . $item->sampul) ?>" class="w-100" />
                                                    <a href="#!">
                                                        <div class="hover-overlay">
                                                            <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <h5><?= $item->title; ?></h5>
                                                <div class="d-flex flex-row">
                                                    <div class="text-info mb-1 me-2">
                                                        <i class="fa fa-solid fa-at"></i>
                                                    </div>
                                                    <span><?= $item->pengarang; ?></span>
                                                </div>
                                                <div class="mt-1 mb-0 text-muted small">
                                                    <span><?= $item->nama_rak; ?></span>
                                                    <span class="text-primary"> • </span>
                                                </div>
                                                <div class="mb-2 text-muted small">
                                                    <span><?= $item->nama_kategori; ?></span>
                                                    <span class="text-primary"> • </span>
                                                </div>
                                                <p class="text-truncate mb-4 mb-md-0">
                                                    There are many variations of passages of Lorem Ipsum available, but the
                                                    majority have suffered alteration in some form, by injected humour, or
                                                    randomised words which don't look even slightly believable.
                                                </p>
                                            </div>
                                            <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                                <div class="d-flex flex-row align-items-center mb-1">
                                                    <span class="mb-1 me-1">stok</span>
                                                    <h4 class="mb-1 me-1"><?= $item->jml; ?></h4>
                                                </div>
                                                <!-- <h6 class="text-success">Free shipping</h6> -->
                                                <div class="d-flex flex-column mt-4">
                                                    <!-- <button class="btn btn-outline-primary btn-sm" type="button">Details</button> -->
                                                    <div class="d-flex flex-column mt-4">
                                                        <a href="<?= base_url('home/detail/' . $item->bukuid) ?>" class="btn btn-outline-primary text-uppercase mr-2 px-4">Detail</a>
                                                    </div>
                                                    <!-- <button class="btn btn-outline-primary btn-sm mt-2" type="button">Add to wishlist</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>


        <!-- End Of Section -->
        <?= $this->endSection(); ?>