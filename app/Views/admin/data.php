<?= $this->extend('layout/dashboard/index'); ?>
<?= $this->section('content'); ?>

<section class="content-header">
    <!-- Menampilkan Pesan -->
    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success" id="successMessage">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger" id="errorMessage">
            <?= session('error') ?>
        </div>
    <?php endif; ?>
    <!-- 
    <h1>
        <i class="fas fa-user ml-1" style="color:green"> </i> Daftar Data User
    </h1> -->
    <ol class="breadcrumb nav nav-tabs">
        <li class="nav-item nav-link"><a class="nav-link" href="<?= base_url('admin') ?>"><i class="fas fa-fw fa-tachometer-alt"></i></i>&nbsp; Dashboard</a></li>
        <li class="nav-item nav-link active"><a class="nav-link" href="<?= base_url('admin/data'); ?>"><i class="fas fa-regular fa-file"></i></i>&nbsp; Daftar Data Anggota</a></li>
        <li class="nav-item nav-link"><a class="nav-link" href="<?= base_url('admin/tambahUserView') ?>"><i class="fas fa-solid fa-user-plus"></i></i>&nbsp; Tambah Data Anggota</a></li>
    </ol>
</section>
<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>User</th>
            <th>Jenkel</th>
            <th>Telepon</th>
            <th>Level</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($users as $user) { ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $user->anggota; ?></td>
                <td>
                    <?php if (!empty($user->foto) && $user->foto !== "-") : ?>
                        <img src="<?= base_url('img/' . $user->foto); ?>" alt="#" class="img-responsive" style="height:auto;width:50px;" />
                    <?php else : ?>
                        <img src="<?= base_url('img/' . $user->foto); ?>" alt="#" class="img-responsive" style="height:auto;width:50px;" />
                    <?php endif; ?>

                </td>
                <td><?= $user->nama; ?></td>
                <td><?= $user->username; ?></td>
                <td><?= $user->jenkel; ?></td>
                <td><?= $user->telepon; ?></td>
                <td><?= $user->name; ?></td>
                <td><?= $user->alamat; ?></td>
                <td style="width:20%;">
                    <a href="<?= base_url('admin/edit/' . $user->userid); ?>" class="text-decoration-none"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                    <?php if (in_groups('anggota') || (in_groups('petugas') && $user->userid != user_id())) : ?>
                        <a href="<?= base_url('admin/delete/' . $user->userid); ?>" class="text-decoration-none" onclick="return confirm('Anda yakin ingin menghapus anggota <?= $user->nama ?>?');">
                            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </a>
                    <?php endif; ?>

                    <a href="<?= base_url('admin/' . $user->userid); ?>" target="_blank" class="text-decoration-none"><button class="btn btn-primary">
                            <i class="fa fa-print"></i></button></a>
                </td>
            </tr>
        <?php $no++;
        } ?>
    </tbody>
</table>

<!-- Hapus Modal -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus user <span id="namaUser"></span>?
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger" id="hapusLink" href="#">Hapus</a>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk mengisi nama pada modal dan menghapus data -->
<script>
    $(document).ready(function() {
        $('#hapusModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var nama = button.data('nama');
            var deleteUrl = button.data('url');
            $('#namaUser').text(nama);
            $('#hapusLink').attr('href', deleteUrl);
        });
    });
</script>

<!-- Script untuk menghilangkan pesan setelah beberapa detik -->
<script>
    setTimeout(function() {
        $('#successMessage, #errorMessage').fadeOut('slow');
    }, 3000); // Menghilangkan pesan setelah 3 detik (3000 milidetik)
</script>



<!-- End Of Section -->
<?= $this->endSection(); ?>