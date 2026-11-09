<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI CARGO - Solusi Pengiriman Terpercaya</title>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/dist/css/adminlte.min.css">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>/assets/img/logokargo.jpg">

    <style>
        .hero-section {
            background: linear-gradient(rgba(220, 53, 69, 0.8), rgba(220, 53, 69, 0.9)),
                url('https://img.freepik.com/free-photo/delivery-concept-handsome-african-american-delivery-man-carrying-package-box-grocery-food-drink-from-store-isolated-grey-studio-background-copy-space_1258-1237.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
        }

        .feature-box {
            padding: 30px;
            border-radius: 15px;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            height: 100%;
        }

        .feature-box:hover {
            transform: translateY(-10px);
        }

        .service-icon {
            font-size: 3rem;
            color: #dc3545;
            margin-bottom: 1rem;
        }

        .counter-box {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            backdrop-filter: blur(5px);
            color: white;
        }

        .counter-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0;
        }

        .testimonial-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            margin: 15px;
        }

        .client-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }

        .scroll-down {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            text-align: center;
            cursor: pointer;
        }

        .scroll-down i {
            font-size: 2rem;
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

        .tracking-section {
            background: #f8f9fa;
            padding: 100px 0;
        }

        .contact-section {
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),
                url('https://img.freepik.com/free-photo/contact-us-communication-support-service-concept_53876-128103.jpg');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: white;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top">
        <div class="container">
            <a href="<?= base_url() ?>" class="navbar-brand d-flex align-items-center">
                <img src="<?= base_url() ?>/assets/img/logokargo.jpg" alt="Logo" style="height: 40px; margin-right: 10px;">
                <span>SI CARGO</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="#layanan" class="nav-link">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tracking" class="nav-link">Tracking</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tentang" class="nav-link">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a href="#kontak" class="nav-link">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard') ?>" class="nav-link">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <h1 class="display-4 mb-4 text-white">Pengiriman Cepat & Terpercaya</h1>
                    <p class="lead mb-4 text-white">Solusi logistik terbaik untuk bisnis dan personal Anda. Kirim paket dengan aman dan pantau status pengiriman secara real-time.</p>
                    <a href="#tracking" class="btn btn-light btn-lg mr-3">
                        Lacak Pengiriman
                        <i class="fas fa-search ml-2"></i>
                    </a>
                    <a href="#layanan" class="btn btn-outline-light btn-lg">
                        Layanan Kami
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="scroll-down">
            <p>Scroll Down</p>
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5" id="layanan">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-4 mb-3">Layanan Kami</h2>
                <p class="lead text-muted">Solusi pengiriman yang disesuaikan dengan kebutuhan Anda</p>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-box">
                        <i class="fas fa-truck service-icon"></i>
                        <h4>Regular Delivery</h4>
                        <p>Layanan pengiriman standar dengan harga terjangkau dan estimasi waktu yang pasti.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-box">
                        <i class="fas fa-bolt service-icon"></i>
                        <h4>Express Delivery</h4>
                        <p>Pengiriman kilat untuk kebutuhan mendesak dengan jaminan sampai di hari yang sama.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-box">
                        <i class="fas fa-box service-icon"></i>
                        <h4>Cargo Service</h4>
                        <p>Layanan kargo untuk pengiriman dalam jumlah besar dengan harga spesial.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tracking Section -->
    <section class="tracking-section" id="tracking">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" data-aos="fade-up">
                    <h2 class="display-4 mb-4">Lacak Pengiriman</h2>
                    <p class="lead mb-5">Pantau status pengiriman Anda secara real-time</p>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <form action="<?= base_url('cekstatus') ?>" method="post">
                                <div class="input-group input-group-lg">
                                    <input type="text" class="form-control" placeholder="Masukkan nomor resi..." name="noresi">
                                    <div class="input-group-append">
                                        <button class="btn btn-danger" type="submit">
                                            <i class="fas fa-search mr-2"></i>
                                            Lacak
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5" id="tentang">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <img src="<?= base_url() ?>/assets/img/logokargo.jpg"
                        alt="About Us" class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <h2 class="display-4 mb-4">Tentang Kami</h2>
                    <p class="lead">SI CARGO adalah perusahaan ekspedisi terpercaya dengan pengalaman lebih dari 5 tahun dalam industri logistik.</p>
                    <p>Kami berkomitmen untuk memberikan layanan terbaik dengan:</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-danger mr-2"></i> Jaminan keamanan paket</li>
                        <li><i class="fas fa-check text-danger mr-2"></i> Tracking system real-time</li>
                        <li><i class="fas fa-check text-danger mr-2"></i> Customer service 24/7</li>
                        <li><i class="fas fa-check text-danger mr-2"></i> Harga kompetitif</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="kontak">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" data-aos="fade-up">
                    <h2 class="display-4 mb-4">Hubungi Kami</h2>
                    <p class="lead mb-5">Kami siap membantu Anda 24/7</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center">
                        <i class="fas fa-map-marker-alt fa-3x mb-3"></i>
                        <h4>Alamat</h4>
                        <p>Jl. Olo Ladang No. 1, Padang Barat, Padang Sumatera Barat</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center">
                        <i class="fas fa-phone fa-3x mb-3"></i>
                        <h4>Telepon</h4>
                        <p>(0761) 123456</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center">
                        <i class="fas fa-envelope fa-3x mb-3"></i>
                        <h4>Email</h4>
                        <p>info@sicargo.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h5>SI CARGO</h5>
                    <p>Solusi pengiriman terpercaya untuk segala kebutuhan Anda.</p>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <p>© 2024 SI CARGO. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>