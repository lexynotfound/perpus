<?= $this->extend('layout/dashboard/index'); ?>
<?= $this->section('content'); ?>

<!-- Tambahkan stylesheet untuk datepicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

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

    <h1></h1>
    <ol class="breadcrumb nav nav-tabs">
        <li class="nav-item nav-link"><a class="nav-link" href="<?= base_url('admin') ?>"><i class="fas fa-fw fa-tachometer-alt"></i>&nbsp; Dashboard</a></li>
        <li class="nav-item nav-link active"><a class="nav-link" href="<?= base_url('laporanDenda'); ?>"><i class="fas fa-solid fa-book"></i>&nbsp; Daftar Data Laporan Denda</a></li>
    </ol>
    <!-- Download-->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="<?= base_url('laporandenda/generatePdf') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="generateReportBtn">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
    </div>

    <!-- Form -->
    <form id="searchForm" method="post" action="<?= base_url('laporandenda/date') ?>">
        <?= csrf_field() ?>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="startDate">Start Date</label>
                <div class="form-group">
                    <input type="text" id="startDate" name="startDate" class="form-control datepicker" placeholder="MM/DD/YYYY">
                </div>
            </div>
            <div class="col-md-4">
                <label for="endDate">End Date</label>
                <div class="form-group">
                    <input type="text" id="endDate" name="endDate" class="form-control datepicker" placeholder="MM/DD/YYYY">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>&nbsp;</label><br>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
    </form>

</section>

<div id="tableContainer">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>ID Laporan</th>
                <th>Judul Laporan</th>
                <th>ID Buku</th>
                <th>Judul Buku</th>
                <th>Stok</th>
                <th>Jenis Laporan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($laporandenda as $lp) {
            ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= date('m/d/Y', strtotime($lp->tgl_laporan)); ?></td>
                    <td><?= $lp->id_laporan_denda; ?></td>
                    <td><?= $lp->judul_laporan; ?></td>
                    <td><?= $lp->id_denda; ?></td>
                    <td><?= $lp->denda; ?></td>
                    <td><?= $lp->status; ?></td>
                    <td><?= $lp->jenis_laporan; ?></td>
                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>

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

<!-- Tambahkan script untuk datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>


<!-- JavaScript -->
<script>
    $(document).ready(function() {
        // Inisialisasi datepicker pada input tanggal
        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true
        });

        var table = $('#example').DataTable({
            // Konfigurasi DataTables lainnya
            // ...
        });

        // Fungsi untuk melakukan pencarian berdasarkan tanggal
        function searchByDate(startDate, endDate) {
            table.columns(1).search(startDate + ' - ' + endDate).draw();
        }

        // Event listener untuk form pencarian
        $('#searchForm').on('submit', function(e) {
            e.preventDefault(); // Mencegah form dari pengiriman standar

            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            searchByDate(startDate, endDate);

            // Mengubah URL query string saat melakukan pencarian
            var url = new URL(window.location.href);
            url.searchParams.set('startDate', startDate);
            url.searchParams.set('endDate', endDate);
            window.history.replaceState({}, '', url);

            // Mengganti isi tabel dengan data yang baru
            $.ajax({
                url: '<?= base_url('laporandenda/date') ?>',
                type: 'POST',
                data: {
                    startDate: startDate,
                    endDate: endDate,
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    var html = '';
                    var no = 1;
                    for (var i = 0; i < data.length; i++) {
                        html += '<tr>';
                        html += '<td>' + no + '</td>';
                        html += '<td>' + data[i].tgl_laporan + '</td>';
                        html += '<td>' + data[i].id_laporan_denda + '</td>';
                        html += '<td>' + data[i].judul_laporan + '</td>';
                        html += '<td>' + data[i].id_denda + '</td>';
                        html += '<td>' + data[i].denda + '</td>';
                        html += '<td>' + data[i].status + '</td>';
                        html += '<td>' + data[i].jenis_laporan + '</td>';
                        html += '</tr>';
                        no++;
                    }
                    $('#example tbody').html(html);
                }
            });
        });

        // Event listener untuk datepicker
        $('.datepicker').on('changeDate', function() {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            searchByDate(startDate, endDate);
        });

        // Mendapatkan nilai awal startDate dan endDate dari URL query string
        var urlParams = new URLSearchParams(window.location.search);
        var startDateParam = urlParams.get('startDate');
        var endDateParam = urlParams.get('endDate');

        // Mengatur nilai awal pada input tanggal
        if (startDateParam && endDateParam) {
            $('#startDate').val(startDateParam);
            $('#endDate').val(endDateParam);
        }

        // Memanggil fungsi pencarian dengan nilai awal saat halaman dimuat
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        searchByDate(startDate, endDate);
    });
</script>

<!-- End Of Section -->
<?= $this->endSection(); ?>