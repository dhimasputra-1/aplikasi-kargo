<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<!-- isi konten Start -->
<div class="invoice p-4 mb-3 shadow-lg" style="background-color: #ffffff; color: #333; border-radius: 15px; width: 210mm; min-height: 297mm; margin: 0 auto;">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <img src="<?= base_url() ?>/assets/img/logokargo.jpg" alt="Logo" style="width: 180px;">
                </div>
                <div class="text-right">
                    <h2 class="font-weight-bold text-danger mb-1" style="font-size: 28px;">FAKTUR PENGIRIMAN</h2>
                    <div class="badge badge-danger p-2" style="font-size: 16px;">No. Resi: <?= $pengiriman['noresi'] ?></div>
                </div>
            </div>
            <hr class="my-4" style="border-top: 2px solid #dc3545;">
        </div>
    </div>

    <!-- Info Pengiriman -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card h-100 border-left border-danger" style="border-left-width: 5px !important;">
                <div class="card-body">
                    <h5 class="card-title text-danger mb-3" style="font-size: 20px;">Pengirim</h5>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-user-circle fa-2x text-danger mr-2"></i>
                        <span class="font-weight-bold" style="font-size: 18px;"><?= $pengiriman['pengirim']['nama'] ?></span>
                    </div>
                    <div class="text-muted" style="font-size: 16px;">
                        <small>Tanggal Pengiriman: <?= $pengiriman['tanggal'] ?></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 border-right border-danger" style="border-right-width: 5px !important;">
                <div class="card-body">
                    <h5 class="card-title text-danger mb-3" style="font-size: 20px;">Penerima</h5>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-user fa-2x text-danger mr-2"></i>
                        <span class="font-weight-bold" style="font-size: 18px;"><?= $pengiriman['penerima']['nama'] ?></span>
                    </div>
                    <div class="text-muted" style="font-size: 16px;">
                        <i class="fas fa-map-marker-alt mr-1"></i> <?= $pengiriman['penerima']['alamat'] ?><br>
                        <i class="fas fa-phone mr-1"></i> <?= $pengiriman['penerima']['nohp'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Pengiriman -->
    <div class="card mb-4">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0" style="font-size: 20px;">Detail Pengiriman</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <div class="border rounded p-3 h-100">
                        <i class="fas fa-truck fa-3x text-danger mb-3"></i>
                        <div class="font-weight-bold" style="font-size: 18px;"><?= $pengiriman['pengiriman']['layanan'] ?></div>
                        <small class="text-muted">Layanan</small>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="border rounded p-3 h-100">
                        <i class="fas fa-map-marked-alt fa-3x text-danger mb-3"></i>
                        <div class="font-weight-bold" style="font-size: 18px;"><?= $pengiriman['pengiriman']['kota_asal'] ?></div>
                        <small class="text-muted">Kota Asal</small>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="border rounded p-3 h-100">
                        <i class="fas fa-map-marked fa-3x text-danger mb-3"></i>
                        <div class="font-weight-bold" style="font-size: 18px;"><?= $pengiriman['pengiriman']['kota_tujuan'] ?></div>
                        <small class="text-muted">Kota Tujuan</small>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4 text-center mb-4">
                    <div class="border rounded p-3 h-100">
                        <i class="fas fa-weight fa-3x text-danger mb-3"></i>
                        <div class="font-weight-bold" style="font-size: 18px;"><?= $pengiriman['pengiriman']['berat'] ?></div>
                        <small class="text-muted">Berat</small>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="border rounded p-3 h-100">
                        <i class="fas fa-clock fa-3x text-danger mb-3"></i>
                        <div class="font-weight-bold" style="font-size: 18px;"><?= $pengiriman['pengiriman']['estimasi'] ?></div>
                        <small class="text-muted">Estimasi</small>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="border rounded p-3 h-100">
                        <i class="fas fa-info-circle fa-3x text-danger mb-3"></i>
                        <div class="font-weight-bold" style="font-size: 18px;"><?= $pengiriman['pengiriman']['status'] ?></div>
                        <small class="text-muted">Status</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total dan QR -->
    <div class="row">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="text-danger mb-3" style="font-size: 20px;">Lacak Pengiriman</h5>
                    <div class="qr-container p-3 bg-light rounded">
                        <img src="<?= $qrCode ?>" alt="Kode QR" style="width: 180px;">
                    </div>
                    <p class="mt-3 text-muted" style="font-size: 16px;">
                        <i class="fas fa-qrcode mr-1"></i>
                        Scan QR code untuk melacak status pengiriman
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="text-danger mb-3" style="font-size: 20px;">Ringkasan Biaya</h5>
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-3">
                        <h3 class="mb-0">Total</h3>
                        <h3 class="text-danger mb-0"><?= $pengiriman['pengiriman']['total'] ?></h3>
                    </div>
                    <div class="text-center mt-4">
                        <p class="mb-1" style="font-size: 16px;"><strong>Padang, <?= date('d F Y') ?></strong></p>
                        <img src="<?= base_url() ?>/assets/img/logokargo.jpg" alt="Tanda Tangan" style="width: 150px;">
                        <p class="mt-2 mb-0" style="font-size: 16px;"><strong>Pimpinan</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="row mt-4 no-print">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <button onclick="window.print();" class="btn btn-lg btn-danger">
                    <i class="fas fa-print mr-2"></i> Cetak Faktur
                </button>
                <a href="<?= base_url() ?>/pengiriman" class="btn btn-lg btn-danger">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<style>
    /* Atur ukuran A4 */
    .invoice {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        background: #fff;
    }

    @media print {

        /* Reset semua margin dan padding */
        * {
            margin: 0;
            padding: 0;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        html,
        body {
            width: 210mm;
            height: 297mm;
            margin: 0;
            padding: 0;
        }

        /* Sembunyikan elemen yang tidak perlu di print */
        .no-print,
        .main-header,
        .main-sidebar,
        .main-footer {
            display: none !important;
        }

        /* Atur ukuran kertas */
        @page {
            size: A4;
            margin: 0;
        }

        .invoice {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
            padding: 15mm !important;
        }

        /* Perbaikan layout grid */
        .row {
            display: flex;
            width: 100%;
            margin: 0 0 10mm 0;
            page-break-inside: avoid;
        }

        .col-md-6 {
            width: 50%;
            padding: 2mm;
        }

        .col-md-4 {
            width: 33.33%;
            padding: 2mm;
        }

        /* Perbaikan card */
        .card {
            border: 0.5pt solid #ddd;
            margin-bottom: 5mm;
            page-break-inside: avoid;
        }

        .card-body {
            padding: 3mm;
        }

        /* Perbaikan spacing */
        .mb-4 {
            margin-bottom: 5mm;
        }

        .mt-4 {
            margin-top: 10px !important;
        }

        /* Perbaikan gambar */
        img {
            max-width: 100%;
            height: auto;
        }

        /* Perbaikan warna */
        .bg-danger {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            background-color: #dc3545 !important;
            color: white !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .border-danger {
            border-color: #dc3545 !important;
        }

        /* Perbaikan font */
        body {
            font-size: 12pt;
            line-height: 1.3;
        }

        h2 {
            font-size: 18pt;
            margin-bottom: 3mm;
        }

        h5 {
            font-size: 14px !important;
            margin-bottom: 2mm;
        }

        p {
            font-size: 12px !important;
            margin-bottom: 2mm;
        }

        /* QR Code */
        .qr-container {
            text-align: center;
            margin: 5mm 0;
        }

        .qr-container img {
            width: 100px !important;
            height: 100px !important;
        }

        /* Total dan Tanda Tangan */
        .total-section {
            margin-top: 10mm;
            page-break-inside: avoid;
        }

        .signature-section {
            margin-top: 15mm;
            text-align: center;
            page-break-inside: avoid;
        }

        /* Border dan Shadow */
        .shadow-lg {
            box-shadow: none !important;
        }

        .border {
            border: 0.5pt solid #ddd !important;
        }

        /* Atur margin tanda tangan */
        .text-right {
            margin-top: 20px !important;
        }

        /* Pastikan tanda tangan tidak terpotong */
        .text-right img {
            height: 60px !important;
        }
    }
</style>

<script>
    function printInvoice() {
        window.print();
    }
</script>
<?= $this->endSection() ?>