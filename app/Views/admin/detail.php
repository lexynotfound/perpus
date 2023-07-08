<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <section class="vh-100 gradients-custom" style="background-color: #f4f5f7;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-6 mb-4 mb-lg-0">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"></h1>
                        <a href="<?= base_url('admin/generatePDF/' . $user->userid); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="generateReportBtn">
                            <i class="fas fa-download fa-sm text-white-50"></i> Cetak
                        </a>

                    </div>
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 bg-info-rgb text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem; --bs-bg-opacity: 5;
                                background-color: rgba(var(--bs-info-rgb), var(--bs-bg-opacity)) !important;">
                                <img src="<?= base_url('/img/' . $user->foto); ?>" alt="Avatar" class="img-fluid my-5" style="width: 90px;" />
                                <h5><?= $user->nama; ?></h5>
                                <h6><?= $user->jenkel; ?></h6>
                                <span class="badge bg-<?= ($user->name == 'petugas') ? 'warning' : 'dark'; ?> ">
                                    <?= $user->name; ?>
                                </span>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Information</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Email</h6>
                                            <p class="text-muted"><?= $user->email; ?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Address</h6>
                                            <p class="text-muted"><?= $user->alamat; ?></p>
                                        </div>
                                    </div>
                                    <h6>Card Member</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>ID Card</h6>
                                            <p class="text-muted"><?= $user->anggota; ?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Date</h6>
                                            <p class="text-muted"><?= $user->tgl_bergabung; ?></p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-start">
                                        <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                                        <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                        <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- 
<script>
    document.getElementById('generateReportBtn').addEventListener('click', function(e) {
        e.preventDefault();

        // Send request to generate PDF
        fetch('<?= base_url('admin/generatePdf') ?>')
            .then(response => response.blob())
            .then(blob => {
                // Create a temporary URL for the generated PDF
                const url = window.URL.createObjectURL(blob);

                // Create a temporary link element
                const link = document.createElement('a');
                link.href = url;
                link.download = 'kartu.pdf';

                // Simulate a click on the link to trigger the download
                link.click();

                // Clean up the temporary URL and link element
                window.URL.revokeObjectURL(url);
                link.remove();
            });
    });
</script> -->

<?= $this->endSection(); ?>