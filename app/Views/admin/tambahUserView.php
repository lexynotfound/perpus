<?= $this->extend('layout/dashboard/index'); ?>
<?= $this->section('content'); ?>


<section class="vh-99">
    <div class="container py-5 h-99">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Tambah Anggota</h3>
                        <?= view('Myth\Auth\Views\_message_block') ?>
                        <br>
                        <form action="/admin/tambahUser" method="post" class="mx-1 mx-md-3" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-6 mb-4">

                                    <div class="form-group">
                                        <input type="text" id="nama" class="form-control form-control-lg" name="nama" required />
                                        <label class="form-label" for="nama">Nama</label>
                                    </div>

                                </div>
                                <div class="col-md-6 mb-4">

                                    <div class="form-group">
                                        <input type="text" id="username" class="form-control form-control-lg" name="username" required />
                                        <label class="form-label" for="username">Username</label>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4 d-flex align-items-center">
                                    <div class="form-group">
                                        <input type="text" id="tempatLahir" class="form-control form-control-lg" name="tempat_lahir" required />
                                        <label class="form-label" for="tempatLahir">Tempat Lahir</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">

                                    <h6 class="mb-2 pb-1">Jenis Kelamin: </h6>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenkel" id="jenkel-laki" value="Laki-Laki" />
                                        <label class="form-check-label" for="jenkel-laki">Laki-Laki</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenkel" id="jenkel-perempuan" value="Perempuan" />
                                        <label class="form-check-label" for="jenkel-perempuan">Perempuan</label>
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-group datepicker w-100">
                                        <input type="text" id="tgl_lahir" class="form-control form-control-lg" name="tgl_lahir" required />
                                        <label class="form-label" for="tgl_lahir">Tanggal Lahir</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4 pb-2">

                                    <div class="form-group">
                                        <input type="tel" id="telepon" class="form-control form-control-lg" name="telepon" required />
                                        <label class="form-label" for="telepon">Phone Number</label>
                                    </div>

                                </div>

                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-group">
                                        <textarea type="text" id="alamat" class="form-control form-control-lg" name="alamat" style="height: 60px;" required>
                                        </textarea>
                                        <label class="form-label" for="alamat">Alamat</label>
                                    </div>

                                </div>

                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-group">
                                        <input type="email" id="email" class="form-control form-control-lg" name="email" required />
                                        <label class="form-label" for="email">Email</label>
                                        <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-group">
                                        <input class="form-control" type="file" id="foto" name="foto" onchange="previewImg()">
                                        <label for="Foto" class="form-labels "></label>
                                    </div>

                                </div>

                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-group">
                                        <img src="/img/default.svg" class="img-thumbnail rounded float-end img-preview" alt="Foto Profile">
                                    </div>
                                </div>
                            </div>
                            <!-- 
                            <div class="row">
                                <div class="col-12">

                                    <select class="select form-control-lg">
                                        <option value="1" disabled>Choose option</option>
                                        <option value="2">Subject 1</option>
                                        <option value="3">Subject 2</option>
                                        <option value="4">Subject 3</option>
                                    </select>
                                    <label class="form-label select-label">Choose option</label>

                                </div>
                            </div> -->

                            <div class="mt-4 pt-2">
                                <input class="btn btn-primary btn-lg" type="submit" value="Submit" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>