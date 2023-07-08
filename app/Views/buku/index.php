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
        <li class="nav-item nav-link active"><a class="nav-link" href="<?= base_url('buku'); ?>"><i class="fas fa-solid fa-book"></i>&nbsp; Daftar Data Buku</a></li>
        <li class="nav-item nav-link"><a class="nav-link" href="<?= base_url('buku/create') ?>"><i class="fas fa-solid fa-book-medical"></i>&nbsp; Tambah Data Buku</a></li>
    </ol>
</section>
<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Buku</th>
            <th>Sampul</th>
            <th>Judul</th>
            <th>Penerbit</th>
            <th>Pengarang</th>
            <th>ISBN</th>
            <th>Tahun Buku</th>
            <th>Jumlah</th>
            <th>Tanggal Masuk</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($buku as $item) { ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $item->id_buku; ?></td>
                <td>
                    <center>
                        <?php if (!empty($item->sampul) && file_exists(FCPATH . 'writable/uploads' . $item->sampul)) : ?>
                            <img src="<?= base_url('writable/uploads/' . $item->sampul) ?>" class="card-img-top img-fluid rounded" alt="Gambar">
                        <?php else : ?>
                            <img src="<?= base_url('writable/uploads/' . $item->sampul) ?>" class="card-img-top img-fluid rounded" alt="Gambar Default">
                        <?php endif; ?>
                    </center>
                </td>
                <td><?= $item->title; ?></td>
                <td><?= $item->penerbit; ?></td>
                <td><?= $item->pengarang; ?></td>
                <td><?= $item->isbn; ?></td>
                <td><?= $item->thn_buku; ?></td>
                <td><?= $item->jml; ?></td>
                <td><?= $item->tgl_masuk; ?></td>
                <td><?= $item->nama_kategori; ?></td>
                <td style="width:20%;">
                    <a href="<?= base_url('buku/edit/' . $item->bukuid); ?>" class="text-decoration-none"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                    <a href="<?= base_url('buku/delete/' . $item->bukuid); ?>" class="text-decoration-none" onclick="return confirm('Anda yakin ingin menghapus buku <?= $item->title ?>?');">
                        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </a>
                    <a href="<?= base_url('buku/detail/' . $item->bukuid); ?>" target="_blank" class="text-decoration-none"><button class="btn btn-primary">
                            <i class="fas fa-regular fa-book"></i></button></a>
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