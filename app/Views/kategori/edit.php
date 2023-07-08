<?= $this->extend('layout/dashboard/index'); ?>
<?= $this->section('content'); ?>

<ol class="breadcrumb nav nav-tabs">
    <li class="nav-item nav-link"><a class="nav-link" href="<?= base_url('admin') ?>"><i class="fas fa-fw fa-tachometer-alt"></i>&nbsp; Dashboard</a></li>
    <li class="nav-item nav-link"><a class="nav-link" href="<?= base_url('kategori'); ?>"><i class="fas fa-regular fa-list"></i>&nbsp; Kategori Buku</a></li>
    <li class="nav-item nav-link active"><a class="nav-link" href="<?= base_url('kategori/edit') ?>"><i class="fas fa-solid fa-book-medical"></i>&nbsp; Edit Kategori</a></li>
</ol>

<section class="vh-95 bg-image mt-4">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <?php if (isset($validation)) : ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php foreach ($validation->getErrors() as $error) : ?>
                                            <li><?= $error ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <h2 class="text-uppercase text-center mb-5">Edit Data Kategori Buku</h2>
                            <form action="<?= isset($kategori['kategoriid']) ? base_url('kategori/update/' . $kategori['kategoriid']) : '' ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="form-outline mb-4">
                                    <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="nama_kategori" value="<?= old('nama_kategori', isset($kategori['nama_kategori']) ? $kategori['nama_kategori'] : '') ?>" required />
                                    <label class="form-label" for="form3Example1cg">Nama Kategori</label>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-info btn-lg">Update Data</button>
                                    <a href="<?= base_url('kategori'); ?>" class="btn btn-outline-info btn-lg">Cancel</a>
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