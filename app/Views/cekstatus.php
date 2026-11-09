<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI CARGO - Tracking</title>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>/assets/img/logokargo.jpg">

    <style>
        .hero-section {
            background: linear-gradient(rgba(220, 53, 69, 0.8), rgba(220, 53, 69, 0.9)),
                url('https://img.freepik.com/free-photo/delivery-concept-handsome-african-american-delivery-man-carrying-package-box-grocery-food-drink-from-store-isolated-grey-studio-background-copy-space_1258-1237.jpg?w=1380&t=st=1710601402~exp=1710602002~hmac=22f9b069f2f2e5f67bf3aa5b8528c10651c41b7d8f073c4519a6f7828aa7e054');
            background-size: cover;
            background-position: center;
            min-height: 400px;
            padding: 80px 0;
        }

        .search-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .search-option {
            cursor: pointer;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            transition: all 0.3s ease;
            background: #f8f9fa;
            border: 2px solid transparent;
        }

        .search-option:hover {
            transform: translateY(-5px);
        }

        .search-option.active {
            background: #dc3545;
            color: white;
            border-color: #dc3545;
        }

        .search-option i {
            font-size: 2em;
            margin-bottom: 10px;
        }

        #scanner-container {
            max-width: 500px;
            margin: 20px auto;
            display: none;
        }

        #manual-form {
            display: none;
        }

        .result-box {
            margin-top: -50px;
            position: relative;
            z-index: 1000;
        }

        .tracking-result {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            font-size: 1rem;
            padding: 8px 16px;
            border-radius: 30px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a href="<?= base_url() ?>" class="navbar-brand d-flex align-items-center">
                <img src="<?= base_url() ?>/assets/img/logokargo.jpg" alt="Logo" style="height: 40px; margin-right: 10px;">
                <span>SI CARGO</span>
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="search-box">
                        <h2 class="text-center mb-4">Lacak Pengiriman Anda</h2>

                        <!-- Search Options -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div id="manual-option" class="search-option active">
                                    <i class="fas fa-keyboard"></i>
                                    <h5 class="mt-2">Input Manual</h5>
                                    <p class="mb-0">Masukkan nomor resi</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="scan-option" class="search-option">
                                    <i class="fas fa-qrcode"></i>
                                    <h5 class="mt-2">Scan QR Code</h5>
                                    <p class="mb-0">Scan QR code resi Anda</p>
                                </div>
                            </div>
                        </div>

                        <!-- Manual Input Form -->
                        <div id="manual-form">
                            <form action="<?= base_url('cekstatus') ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="input-group">
                                    <input type="text"
                                        name="noresi"
                                        class="form-control form-control-lg"
                                        placeholder="Masukkan Nomor Resi"
                                        value="<?= old('noresi') ?>"
                                        required>
                                    <div class="input-group-append">
                                        <button class="btn btn-danger btn-lg" type="submit">
                                            <i class="fas fa-search"></i> Lacak
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <?php if (session()->getFlashdata('error')) : ?>
                                <div class="alert alert-danger mt-3">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- QR Scanner -->
                        <div id="scanner-container">
                            <div id="reader"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hasil Tracking -->
    <?php if (isset($data)) : ?>
        <div class="container result-box">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card tracking-result">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0">Detail Pengiriman</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>No. Resi:</strong> <?= $data->noresi ?></p>
                                    <p><strong>Pengirim:</strong> <?= $data->nama ?></p>
                                    <p><strong>Tanggal:</strong> <?= date('d-m-Y', strtotime($data->tglmasuk)) ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Status:</strong>
                                        <?php
                                        $badge_class = '';
                                        $status_text = '';
                                        switch ($data->status) {
                                            case 1:
                                                $badge_class = 'badge-warning';
                                                $status_text = 'Proses Pengiriman';
                                                break;
                                            case 2:
                                                $badge_class = 'badge-primary';
                                                $status_text = 'Paket Sampai Tujuan';
                                                break;
                                            case 3:
                                                $badge_class = 'badge-success';
                                                $status_text = 'Sudah Diterima';
                                                break;
                                        }
                                        ?>
                                        <span class="badge <?= $badge_class ?> status-badge"><?= $status_text ?></span>
                                    </p>
                                    <p><strong>Alamat:</strong> <?= $data->alamat ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Scripts -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>

    <script>
        $(document).ready(function() {
            // Show manual form by default
            $('#manual-form').show();

            // Toggle between manual and scan options
            $('#manual-option').click(function() {
                $(this).addClass('active');
                $('#scan-option').removeClass('active');
                $('#scanner-container').hide();
                $('#manual-form').show();
                if (html5QrcodeScanner) {
                    html5QrcodeScanner.clear();
                }
            });

            $('#scan-option').click(function() {
                $(this).addClass('active');
                $('#manual-option').removeClass('active');
                $('#manual-form').hide();
                $('#scanner-container').show();
                initializeScanner();
            });

            let html5QrcodeScanner = null;

            function initializeScanner() {
                if (html5QrcodeScanner === null) {
                    html5QrcodeScanner = new Html5QrcodeScanner(
                        "reader", {
                            fps: 10,
                            qrbox: 250,
                            rememberLastUsedCamera: true
                        }
                    );

                    html5QrcodeScanner.render((decodedText) => {
                        // Tambahkan fungsi untuk mengekstrak noresi dari URL
                        let noresi = decodedText;

                        // Jika hasil scan berupa URL, ambil noresi-nya saja
                        if (decodedText.includes('cekstatus/')) {
                            noresi = decodedText.split('cekstatus/').pop();
                        }

                        Swal.fire({
                            title: 'QR Code Terdeteksi!',
                            text: 'Nomor Resi: ' + noresi,
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#dc3545',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Lacak',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '<?= base_url('cekstatus/') ?>' + noresi;
                            }
                        });
                    });
                }
            }
        });
    </script>
</body>

</html>