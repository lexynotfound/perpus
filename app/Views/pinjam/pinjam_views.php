<?= $this->extend('layout/dashboard/index'); ?>
<?= $this->section('content'); ?>
<ol class="breadcrumb nav nav-tabs">
    <li class="nav-item nav-link"><a class="nav-link" href="<?= base_url('admin') ?>"><i class="fas fa-fw fa-tachometer-alt"></i>&nbsp; Dashboard</a></li>
    <li class="nav-item nav-link"><a class="nav-link" href="<?= base_url('pinjam'); ?>"><i class="fas fa-solid fa-book"></i>&nbsp; Daftar Data Peminjaman</a></li>
    <li class="nav-item nav-link active"><a class="nav-link" href="<?= base_url('pinjam/pinjam_views') ?>"><i class="fas fa-solid fa-book-medical"></i>&nbsp; Pinjam</a></li>
</ol>
<section class="h-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card card-registration my-4">
                    <div class="row g-0">
                        <div class="col-xl-6">
                            <div class="card-body p-md-5 text-black">
                                <!-- Tampilkan pesan error jika terdapat kesalahan validasi -->
                                <?php if (session()->has('error')) : ?>
                                    <div class="alert alert-danger">
                                        <?= session()->get('error') ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Tampilkan pesan success jika peminjaman berhasil -->
                                <?php if (session()->has('success')) : ?>
                                    <div class="alert alert-success">
                                        <?= session()->get('success') ?>
                                    </div>
                                <?php endif; ?>

                                <h3 class="mb-5 text-uppercase">Pinjam Buku</h3>
                                <form action="/pinjam/pinjamBuku" method="post">
                                    <?= csrf_field() ?>

                                    <div class="form-group">
                                        <input type="text" name="user_id" class="form-control" required>
                                        <label for="user_id">Anggota</label>
                                    </div>

                                    <label for="buku_id">Kode Buku</label>
                                    <div class="form-group">
                                        <select name="buku_id" class="form-control" required>
                                            <option value="">Pilih Kode Buku</option>
                                            <?php foreach ($buku as $buku) : ?>
                                                <option value="<?= $buku['id'] ?>"><?= $buku['id_buku'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <input type="text" name="jml_pinjam" class="form-control" required>
                                        <label for="jml_pinjam">Jumlah Pinjam</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="lama_pinjam" class="form-control" required>
                                        <label for="lama_pinjam">Lama Pinjam</label>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Pinjam</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>