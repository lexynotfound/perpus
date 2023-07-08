<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="main-body">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('admin/profile') ?>">User</a></li>
                <!-- <li class="breadcrumb-item "><a href="user/profile/edit">Edit User Profile</a></li> -->
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <!-- Tambahkan kode berikut pada tampilan admin/edit -->
        <?php if (isset($errors)) : ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/edit/' . $user->userid); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <label for="foto-upload" class="upload-wrapper">
                                    <?php if ($user->foto) : ?>
                                        <div class="rounded-circle overflow-hidden" style="width: 150px; height: 150px;">
                                            <img src="<?= base_url('/img/' . $user->foto); ?>" alt="Admin" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    <?php else : ?>
                                        <div class="rounded-circle bg-secondary text-light d-flex align-items-center justify-content-center" style="width: 150px; height: 150px;">
                                            <span class="fs-2">Upload Foto</span>
                                        </div>
                                    <?php endif; ?>
                                    <input type="file" id="foto-upload" name="foto" style="display: none;">
                                </label>
                                <div class="mt-3">
                                    <h4><?= $user->nama; ?></h4>
                                    <p class="text-secondary  font-size-xl mb-1">
                                        <span class="badge bg-<?= ($user->name == 'petugas') ? 'info' : 'dark'; ?> ">
                                            <?= $user->name; ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <a class="btn btn-outline-primary mb-2" href="<?= base_url('admin/data'); ?>">Kembali</a>
                        <!-- <a class="btn btn-outline-primary" href="<?= base_url('logout'); ?>">Keluar</a> -->
                        <button type="submit" class="btn btn-primary px-4">Update</button>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <?php if (session()->getFlashdata('message')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('message'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <h5>Username</h5>
                                <input type="text" name="username" value="<?= $user->username; ?>" class="form-control <?php if (isset($errors['username'])) echo 'is-invalid'; ?>" required>
                                <?php if (isset($errors['username'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['username']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <h5>Fullname</h5>
                                <input type="text" name="nama" value="<?= $user->nama; ?>" class="form-control <?php if (isset($errors['nama'])) echo 'is-invalid'; ?>" required>
                                <?php if (isset($errors['nama'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['nama']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <h5>Gender</h5>
                                <select name="jenkel" class="form-select <?php if (isset($errors['jenkel'])) echo 'is-invalid'; ?>" required>
                                    <option value="Laki-laki" <?= ($user->jenkel == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="Perempuan" <?= ($user->jenkel == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                                <?php if (isset($errors['jenkel'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['jenkel']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <h5>Email</h5>
                                <input type="email" name="email" value="<?= $user->email; ?>" class="form-control <?php if (isset($errors['email'])) echo 'is-invalid'; ?>" required>
                                <?php if (isset($errors['email'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['email']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <h5>Birthday</h5>
                                <input type="text" name="tgl_lahir" value="<?= $user->tgl_lahir; ?>" class="form-control <?php if (isset($errors['tgl_lahir'])) echo 'is-invalid'; ?>" required>
                                <?php if (isset($errors['tgl_lahir'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['tgl_lahir']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <h5>Mobile Phone</h5>
                                <input type="text" name="telepon" value="<?= $user->telepon; ?>" class="form-control <?php if (isset($errors['telepon'])) echo 'is-invalid'; ?>" required>
                                <?php if (isset($errors['telepon'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['telepon']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <h5>Alamat</h5>
                                <textarea type="text" name="alamat" rows="10" class="form-control <?php if (isset($errors['alamat'])) echo 'is-invalid'; ?>" required><?= $user->alamat; ?></textarea>
                                <?php if (isset($errors['alamat'])) : ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['alamat']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>