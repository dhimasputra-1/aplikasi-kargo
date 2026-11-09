<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Mohon Maaf Halaman Tidak Ditemukan | SI - CARGO</title>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/dist/css/adminlte.min.css">
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>/assets/img/logokargo.jpg">

    <style>
        body {
            background: #f4f6f9;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .error-page {
            max-width: 600px;
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-page h1 {
            font-size: 8rem;
            font-weight: 700;
            margin: 0;
            background: linear-gradient(45deg, #dc3545, #fd7e14);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1;
        }

        .error-page h2 {
            font-size: 2rem;
            color: #343a40;
            margin: 20px 0;
        }

        .error-page p {
            color: #6c757d;
            margin-bottom: 30px;
            font-size: 1.1rem;
        }

        .btn-danger {
            background: linear-gradient(45deg, #dc3545, #fd7e14);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        .delivery-icon {
            font-size: 5rem;
            color: #dc3545;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-30px);
            }

            60% {
                transform: translateY(-15px);
            }
        }

        .navigation-links {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
        }

        .navigation-links a {
            color: #6c757d;
            margin: 0 10px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .navigation-links a:hover {
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="error-page">
        <i class="fas fa-truck delivery-icon"></i>
        <h1>404</h1>
        <h2>Oops! Halaman Tidak Ditemukan</h2>
        <p>
            <?php if (ENVIRONMENT !== 'production') : ?>
                <?= nl2br(esc($message)) ?>
            <?php else : ?>
                Maaf, halaman yang Anda cari tidak dapat ditemukan. Mungkin halaman telah dipindahkan atau dihapus.
            <?php endif; ?>
        </p>
        <a href="<?= base_url() ?>" class="btn btn-danger">
            <i class="fas fa-home mr-2"></i>Kembali ke Beranda
        </a>
        <div class="navigation-links">
            <a href="<?= base_url('cekstatus') ?>">
                <i class="fas fa-search mr-1"></i>Lacak Pengiriman
            </a>
            <a href="<?= base_url('#kontak') ?>">
                <i class="fas fa-envelope mr-1"></i>Hubungi Kami
            </a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>