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

    <h1>

    </h1>
    <ol class="breadcrumb nav nav-tabs">
        <li class="nav-item nav-link"><a class="nav-link" href="<?= base_url('admin') ?>"><i class="fas fa-fw fa-tachometer-alt"></i>&nbsp; Dashboard</a></li>
        <li class="nav-item nav-link active"><a class="nav-link" href="<?= base_url('denda'); ?>"><i class="fas fa-solid fa-book"></i>&nbsp; Daftar Data Denda</a></li>

    </ol>
</section>
<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Denda</th>
            <th>ID Pinjaman</th>
            <th>Denda</th>
            <th>Lama Peminjaman</th>
            <th>Tanggal Denda</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($denda as $item) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $item->id_denda ?></td>
                <td><?= $item->id_pinjam ?></td>
                <td><?= $item->denda ?></td>
                <td><?= $item->lama_waktu ?> Hari</td>
                <td><?= $item->tgl_denda ?></td>
                <td><?= $item->status ?></td>
            </tr>
        <?php endforeach; ?>
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
                Apakah Anda yakin ingin menghapus buku <span id="namaBuku"></span>?
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
            $('#namaBuku').text(nama);
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