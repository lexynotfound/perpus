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
        <li class="nav-item nav-link active"><a class="nav-link" href="<?= base_url('pinjam'); ?>"><i class="fas fa-solid fa-book"></i>&nbsp; Daftar Data Peminjaman</a></li>
        <li class="nav-item nav-link"><a class="nav-link" href="<?= base_url('pinjam/pinjam_views') ?>"><i class="fas fa-solid fa-book-medical"></i>&nbsp; Pinjam</a></li>
    </ol>
</section>
<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Peminjaman</th>
            <th>Peminjam</th>
            <th>Kode Buku</th>
            <th>Judul</th>
            <th>Sampul</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Balik</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($pinjam as $pj) { ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $pj->id_pinjam; ?></td>
                <td><?= $pj->anggota; ?></td>
                <td><?= $pj->id_buku; ?></td>
                <td><?= $pj->title; ?></td>
                <td>
                    <center>
                        <?php if (!empty($pj->sampul) && file_exists(FCPATH . 'writable/uploads' . $pj->sampul)) : ?>
                            <img src="<?= base_url('writable/uploads/' . $pj->sampul) ?>" class="card-img-top img-fluid rounded" alt="Gambar">
                        <?php else : ?>
                            <img src="<?= base_url('writable/uploads/' . $pj->sampul) ?>" class="card-img-top img-fluid rounded" alt="Gambar Default">
                        <?php endif; ?>
                    </center>
                </td>
                <td><?= $pj->tgl_pinjam; ?></td>
                <td><?= $pj->tgl_balik; ?></td>
                <td><span class="badge bg-<?= ($pj->status == 'Di Pinjam') ? 'danger' : 'dark'; ?>">
                        <?= ($pj->status == 'Di Pinjam') ? 'pinjam' : $pj->status; ?>
                    </span></td>
                <td style="width:20%;">
                        <a href="<?= base_url('pinjam/kembaliBuku/' . $pj->pinjamid); ?>" class="text-decoration-none" onclick="return confirm('Anda yakin ingin melakukan pengembalian buku <?= $pj->title ?>?');">
                            <button class="btn btn-danger"><i class="fa fa-solid fa-file-invoice"></i> Pengembalian </button>
                        </a>
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