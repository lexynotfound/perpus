<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link rel="stylesheet" href="<?= base_url(); ?>/src/bootstrap/dist/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/bootstrap/dist/css/mystyle.css">
    <script src="<?= base_url(); ?>/src/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="<?= base_url(); ?>/src/bootstrap/dist/js/dropdown-hoover.js"></script>
</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <?= view('Myth\Auth\Views\_message_block') ?>
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4"><?= lang('Auth.loginTitle') ?></p>

                                    <form class="mx-1 mx-md-3" action="<?= url_to('login') ?>" method="post">
                                        <?= csrf_field() ?>

                                        <?php if ($config->validFields === ['email']) : ?>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <label class="form-label" ffor="login"><?= lang('Auth.email') ?></label>
                                                    <input type="email" id="form3Example3c" class="form-control" <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.login') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else : ?>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <label class="form-label" for="login"><?= lang('Auth.emailOrUsername') ?></label>
                                                    <input type="text" id="form3Example4c" class="form-control" <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.login') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="password"><?= lang('Auth.password') ?></label>
                                                <input type="password" name="password" id="form3Example4c" class="form-control" <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.password') ?>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if ($config->allowRemembering) : ?>
                                            <div class="form-check mb-3">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                                    <?= lang('Auth.rememberMe') ?>
                                                </label>
                                            </div>
                                        <?php endif; ?>

                                        <!--  <div class="form-check d-flex justify-content-center mb-1">
                                            <label class="form-check-label" for="form2Example3">
                                                <?php if ($config->activeResetter) : ?>
                                                    <p><a class="nav-link text-primary" href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></p>
                                                <?php endif; ?>
                                            </label>
                                        </div> -->

                                        <!--  <div class="form-check d-flex justify-content-center mb-5">
                                            <label class="form-check-label" for="form2Example3">
                                                <?php if ($config->allowRegistration) : ?>
                                                    <p><a class="nav-link text-primary" href="<?= url_to('register') ?>"><?= lang('Auth.needAnAccount') ?></a></p>
                                                <?php endif; ?>
                                            </label>
                                        </div> -->


                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block"><?= lang('Auth.loginAction') ?></button>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>