<?= $this->extend('layout/dashboard/index'); ?>
<?= $this->section('content'); ?>

<ol class="breadcrumb nav nav-tabs">
    <li class="nav-item nav-link"><a class="nav-link" href="<?= base_url('admin') ?>"><i class="fas fa-fw fa-tachometer-alt"></i></i>&nbsp; Dashboard</a></li>
    <li class="nav-item nav-link "><a class="nav-link" href="<?= base_url('rak'); ?>"><i class="fas fa-lights fa-bookmark"></i></i>&nbsp; Rak Buku</a></li>
    <li class="nav-item nav-link active"><a class="nav-link" href="<?= base_url('rak/create') ?>"><i class="fas fa-solid fa-book-medical"></i></i>&nbsp; Tambah Rak Buku</a></li>
</ol>

<section class="vh-95 bg-image mt-4">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <!-- Tampilkan pesan error jika terdapat kesalahan validasi -->
                            <?php if (isset($validation)) : ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php foreach ($validation->getErrors() as $error) : ?>
                                            <li><?= $error ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <h2 class="text-uppercase text-center mb-5">Penambahan Data Rak Buku</h2>
                            <form action="/rak/addrk" method="post">
                                <?= csrf_field() ?>
                                <div class="form-outline mb-4">
                                    <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="nama_rak" required />
                                    <label class="form-label" for="form3Example1cg">Nama Rak</label>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-info btn-block btn-lg gradient-custom-4 text-body">Tambah Data</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>