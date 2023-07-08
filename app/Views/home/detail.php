<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images p-3">
                            <div class="text-center p-4"> <img id="main-image" src="<?= base_url('writable/uploads/' . $buku->sampul) ?>" width="250" /> </div>
                            <div class="thumbnail text-center"> <img onclick="change_image(this)" src="<?= base_url('writable/uploads/' . $buku->sampul) ?>" width="70"> <img onclick="change_image(this)" src="<?= base_url('writable/uploads/' . $buku->sampul) ?>" width="70"> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center"> <i class="fa fa-long-arrow-left"></i> <span class="ml-1">Back</span> </div> <i class="fa fa-shopping-cart text-muted"></i>
                            </div>
                            <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand"><?= $buku->pengarang; ?></span>
                                <h5 class="text-uppercase"><?= $buku->title; ?></h5>
                                <div class="price d-flex flex-row align-items-center">
                                    <span class="act-price me-1"><?= $buku->penerbit; ?></span>
                                    <div class="ml-2"> </small> | <span>
                                            <small class="price"><?= $buku->thn_buku; ?></small> | <span><?= $buku->isbn; ?></span>
                                    </div>
                                </div>

                            </div>
                            <!-- <p class="about">Shop from a wide range of t-shirt from orianz. Pefect for your everyday use, you could pair it with a stylish pair of jeans or trousers complete the look.</p> -->
                            <div class="sizes mt-5">
                                <h6 class="text-uppercase">Stok</h6> <label><?= $buku->jml; ?> </label>
                            </div>
                            <div class="cart mt-4 align-items-center">
                                <a href="<?= base_url() ?>" class="btn btn-danger text-uppercase mr-2 px-4">Kembali</a>
                                <!-- <i class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i> -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>