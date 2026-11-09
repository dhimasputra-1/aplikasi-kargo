<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI CARGO - Login</title>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/dist/css/adminlte.min.css">
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>/assets/img/logokargo.jpg">

    <style>
        body {
            background: linear-gradient(rgba(220, 53, 69, 0.8), rgba(220, 53, 69, 0.9)),
                url('https://img.freepik.com/free-photo/delivery-concept-handsome-african-american-delivery-man-carrying-package-box-grocery-food-drink-from-store-isolated-grey-studio-background-copy-space_1258-1237.jpg?w=1380&t=st=1710601402~exp=1710602002~hmac=22f9b069f2f2e5f67bf3aa5b8528c10651c41b7d8f073c4519a6f7828aa7e054');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }

        .login-box {
            margin-top: 0;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .card.card-outline {
            border-top: 3px solid #dc3545;
        }

        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-primary:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .icheck-primary>input:first-child:checked+label::before {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .login-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .login-logo img {
            height: 60px;
            margin-right: 15px;
        }

        .input-group-text {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline">
            <div class="card-header text-center">
                <div class="login-logo">
                    <img src="<?= base_url() ?>/assets/img/logokargo.jpg" alt="Logo">
                    <a href="<?= base_url() ?>" class="h1">
                        <b>SI</b> CARGO
                    </a>
                </div>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Silahkan login untuk melanjutkan</p>
                <?= view('Myth\Auth\Views\_message_block') ?>

                <form action="<?= url_to('login') ?>" method="post">
                    <?= csrf_field() ?>
                    <?php if ($config->validFields === ['email']) : ?>
                        <div class="input-group mb-3">
                            <input type="email"
                                class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                                name="login" placeholder="<?= lang('Auth.email') ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                <?= session('errors.login') ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="input-group mb-3">
                            <input type="text"
                                class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                                name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                <?= session('errors.login') ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="input-group mb-3">
                        <input type="password" name="password"
                            class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                            placeholder="<?= lang('Auth.password') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            <?= session('errors.password') ?>
                        </div>
                    </div>

                    <div class="row">
                        <?php if ($config->allowRemembering) : ?>
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" name="remember"
                                        <?php if (old('remember')) : ?> checked <?php endif ?>>
                                    <label for="remember">
                                        Ingat Saya
                                    </label>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/assets/dist/js/adminlte.min.js"></script>
</body>

</html>