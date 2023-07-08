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

    <ol class="breadcrumb nav nav-tabs">
        <li class="nav-item nav-link"><a class="nav-link" href="<?= base_url('admin') ?>"><i class="fas fa-fw fa-tachometer-alt"></i></i>&nbsp; Dashboard</a></li>
        <li class="nav-item nav-link active"><a class="nav-link" href="<?= base_url('kategori'); ?>"><i class="fas fa-regular fa-list"></i></i>&nbsp; Kategori Buku</a></li>
        <li class="nav-item nav-link"><a class="nav-link" href="<?= base_url('kategori/createkt') ?>"><i class="fas fa-solid fa-book-medical"></i></i>&nbsp; Tambah Kategori Baru</a></li>
    </ol>
</section>
<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Judul</th>
            <th>Cover</th>
            <th>Jumlah Buku</th>
            <th>Dibuat</th>
            <th>Perubahan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($kategori as $kt) { ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $kt->nama_kategori; ?></td>
                <td><?= $kt->title; ?></td>
                <td>
                    <center>
                        <?php if (!empty($kt->sampul) && file_exists(FCPATH . 'writable/uploads' . $kt->sampul)) : ?>
                            <img src="<?= base_url('writable/uploads/' . $kt->sampul) ?>" class="card-img-top rounded" alt="Gambar">
                        <?php else : ?>
                            <img src="<?= base_url('writable/uploads/' . $kt->sampul) ?>" class="card-img-top rounded" alt="Gambar Default">
                        <?php endif; ?>
                    </center>
                </td>
                <td><?= $kt->jml; ?></td>
                <td><?= $kt->created_at; ?></td>
                <td><?= $kt->updated_at; ?></td>
                <td style="width:20%;">
                    <a href="<?= base_url('kategori/edit/' . $kt->kategoriid); ?>" class="text-decoration-none"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                    <a href="<?= base_url('kategori/delete/' . $kt->kategoriid); ?>" class="text-decoration-none" onclick="return confirm('Anda yakin ingin menghapus kategori buku <?= $kt->nama_kategori ?>?');">
                        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </a>
                    <!-- <a href="<?= base_url('kategori/' . $kt->kategoriid); ?>" target="_blank" class="text-decoration-none"><button class="btn btn-primary">
                            <i class="fas fa-regular fa-book"></i></button></a> -->
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

<?= $this->endSection(); ?>