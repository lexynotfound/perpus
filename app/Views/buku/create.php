<?= $this->extend('layout/dashboard/index'); ?>
<?= $this->section('content'); ?>


<section class="h-100">
  <div class="container py-5 h-100">
    <ol class="breadcrumb nav nav-tabs">
      <li class="nav-item nav-link"><a class="nav-link" href="<?= base_url('admin') ?>"><i class="fas fa-fw fa-tachometer-alt"></i>&nbsp; Dashboard</a></li>
      <li class="nav-item nav-link"><a class="nav-link" href="<?= base_url('buku'); ?>"><i class="fas fa-solid fa-book"></i>&nbsp; Daftar Data Buku</a></li>
      <li class="nav-item nav-link active"><a class="nav-link" href="<?= base_url('buku/create') ?>"><i class="fas fa-solid fa-book-medical"></i>&nbsp; Tambah Data Buku</a></li>
    </ol>
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card card-registration my-4">
          <div class="row g-0">
            <div class="col-xl-6 d-none d-xl-block mt-5 text-center ">
              <img src="/img/defaults.svg" alt="Sampul Buku" for="foto" class="img-fluid img-thumbnail mx-auto d-block rounded img-preview" style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
              <!-- <img src="/img/defaults.svg" class="img-thumbnail rounded float-end img-preview" alt="Foto Profile"> -->
            </div>
            <div class="col-xl-6">
              <div class="card-body p-md-5 text-black">
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
                <h3 class="mb-5 text-uppercase">Tambah Daftar Buku</h3>
                <form action="/buku/store" method="post" enctype="multipart/form-data">
                  <?= csrf_field() ?>
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" id="form3Example1m" class="form-control form-control-lg" name="title" />
                        <label class="form-label" for="form3Example1m">Judul Buku</label>
                      </div>
                    </div>

                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" id="form3Example1n" class="form-control form-control-lg" name="id_buku" />
                        <label class="form-label" for="form3Example1n">Kode Buku</label>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" id="form3Example1m1" class="form-control form-control-lg" name="pengarang" />
                        <label class="form-label" for="form3Example1m1">Pengarang</label>
                      </div>
                    </div>

                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" id="form3Example1n1" class="form-control form-control-lg" name="penerbit" />
                        <label class="form-label" for="form3Example1n1">Penerbit</label>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" id="form3Example1m1" class="form-control form-control-lg" name="isbn" />
                        <label class="form-label" for="form3Example1m1">ISBN</label>
                      </div>
                    </div>

                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" id="form3Example1n1" class="form-control form-control-lg" name="thn_buku" />
                        <label class="form-label" for="form3Example1n1">Tahun Buku</label>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <select class="select" name="kategori_id">
                        <option value="">Kategori</option>
                        <?php foreach ($kategori as $row) : ?>
                          <option value="<?= $row['id']; ?>"><?= $row['nama_kategori']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="col-md-6 mb-4">
                      <select class="select" name="rak_id">
                        <option value="">Rak Buku</option>
                        <?php foreach ($rak as $row) : ?>
                          <option value="<?= $row['id']; ?>"><?= $row['nama_rak']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="text" id="form3Example8" class="form-control form-control-lg" name="jml" />
                    <label class="form-label" for="form3Example8">Jumlah Buku</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input class="form-control" type="file" id="foto" name="sampul" onchange="previewImg()">
                    <label for="foto" class="form-labels ">Upload Sampul Buku</label>
                  </div>

                  <div class="d-flex justify-content-end pt-3">
                    <button type="button" class="btn btn-light btn-lg">Batal</button>
                    <button type="submit" class="btn btn-warning btn-lg ms-2">Tambah Buku</button>
                  </div>

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