<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card card-danger shadow-lg">
        <div class="card-header bg-gradient-danger">
            <h3 class="card-title"><i class="fas fa-truck mr-2"></i> Laporan Data Pengiriman</h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-12">
                    <div class="btn-group mb-3">
                        <button class="btn btn-primary mr-2 shadow" onclick="ViewLaporanSemua()">
                            <i class="fas fa-eye mr-2"></i>Semua Data
                        </button>
                        <button class="btn btn-warning mr-2 shadow" onclick="ViewLaporanProses()">
                            <i class="fas fa-spinner mr-2"></i>Proses Pengiriman
                        </button>
                        <button class="btn btn-success mr-2 shadow" onclick="ViewLaporanSelesai()">
                            <i class="fas fa-check mr-2"></i>Pengiriman Selesai
                        </button>
                    </div>

                    <div class="row">
                        <!-- Filter Tanggal -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Filter berdasarkan Tanggal</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <input type="date" class="form-control" id="tglmulai">
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="date" class="form-control" id="tglakhir">
                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-info" onclick="ViewLaporanTanggal()">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Bulan -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Filter berdasarkan Bulan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <select class="form-control" id="bulan">
                                                <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                    <option value="<?= $i ?>"><?= date('F', mktime(0, 0, 0, $i, 1)) ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="form-control" id="tahun">
                                                <?php
                                                $currentYear = date('Y');
                                                for ($year = $currentYear; $year >= $currentYear - 5; $year--) :
                                                ?>
                                                    <option value="<?= $year ?>"><?= $year ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-info" onclick="ViewLaporanBulan()">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right mt-3">
                        <button class="btn btn-success btn-lg shadow" onclick="PrintLaporan()">
                            <i class="fas fa-print mr-2"></i>Cetak Laporan
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div id="printHalaman" class="p-4">
                        <!-- Kop Surat -->
                        <div class="text-center mb-4">
                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <img src="<?= base_url() ?>/assets/img/logokargo.jpg" alt="Logo" style="height: 120px;" class="mr-3">
                                <div>
                                    <h2 class="font-weight-bold mb-1">PT. SI KARGO</h2>
                                    <p class="mb-1">Jl. Olo Ladang No. 1, Padang Barat, Padang Sumatera Barat</p>
                                    <p class="mb-1">Telp: (0761) 123456 | Email: info@sikargo.com</p>
                                    <p>Website: www.sikargo.com</p>
                                </div>
                            </div>
                            <hr style="border: 2px solid black; margin: 10px 0;">
                            <h3 class="font-weight-bold mt-4 mb-4">LAPORAN DATA PENGIRIMAN</h3>
                            <div id="periode" class="mb-3"></div>
                        </div>

                        <!-- Tabel Pengiriman dengan Animation -->
                        <div class="tabelPengiriman animate__animated animate__fadeIn">
                            <!-- Data akan dimuat disini -->
                        </div>

                        <!-- Tanda Tangan -->
                        <div class="row mt-4">
                            <div class="col-7">
                            </div>
                            <div class="col-5 text-center">
                                <p class="mb-5">Padang, <?= date('d F Y') ?></p>
                                <p class="mb-0">Pimpinan</p>
                                <br><br><br>
                                <p class="mb-0"><u>(_______________________)</u></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function ViewLaporanSemua() {
        $.ajax({
            type: "get",
            url: "<?= base_url('laporan/viewall-laporanpengiriman') ?>",
            dataType: "JSON",
            success: function(response) {
                if (response.data) {
                    $('#periode').html('');
                    $('.tabelPengiriman').hide().html(response.data).fadeIn('slow');
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Berhasil Dimuat!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            }
        });
    }

    function ViewLaporanProses() {
        $.ajax({
            type: "get",
            url: "<?= base_url('laporan/viewall-laporanpengirimanproses') ?>",
            dataType: "JSON",
            success: function(response) {
                if (response.data) {
                    $('#periode').html('<h4>Status: Proses Pengiriman</h4>');
                    $('.tabelPengiriman').hide().html(response.data).fadeIn('slow');
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Berhasil Dimuat!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            }
        });
    }

    function ViewLaporanSelesai() {
        $.ajax({
            type: "get",
            url: "<?= base_url('laporan/viewall-laporanpengirimanselesai') ?>",
            dataType: "JSON",
            success: function(response) {
                if (response.data) {
                    $('#periode').html('<h4>Status: Pengiriman Selesai</h4>');
                    $('.tabelPengiriman').hide().html(response.data).fadeIn('slow');
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Berhasil Dimuat!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            }
        });
    }

    function ViewLaporanTanggal() {
        let tglmulai = $('#tglmulai').val();
        let tglakhir = $('#tglakhir').val();

        if (!tglmulai || !tglakhir) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Mohon pilih tanggal mulai dan tanggal akhir!'
            });
            return;
        }

        $.ajax({
            type: "post",
            url: "<?= base_url('laporan/viewall-laporanpengirimantanggal') ?>",
            data: {
                tglmulai: tglmulai,
                tglakhir: tglakhir
            },
            dataType: "JSON",
            success: function(response) {
                if (response.data) {
                    $('#periode').html(`<h4>Periode: ${tglmulai} s/d ${tglakhir}</h4>`);
                    $('.tabelPengiriman').hide().html(response.data).fadeIn('slow');
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Berhasil Dimuat!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            }
        });
    }

    function ViewLaporanBulan() {
        let bulan = $('#bulan').val();
        let tahun = $('#tahun').val();

        $.ajax({
            type: "post",
            url: "<?= base_url('laporan/viewall-laporanpengirimanperbulan') ?>",
            data: {
                bulan: bulan,
                tahun: tahun
            },
            dataType: "JSON",
            success: function(response) {
                if (response.data) {
                    let namaBulan = new Date(tahun, bulan - 1).toLocaleString('id-ID', {
                        month: 'long'
                    });
                    $('#periode').html(`<h4>Periode: ${namaBulan} ${tahun}</h4>`);
                    $('.tabelPengiriman').hide().html(response.data).fadeIn('slow');
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Berhasil Dimuat!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            }
        });
    }

    function PrintLaporan() {
        Swal.fire({
            title: 'Mencetak Laporan',
            text: 'Apakah Anda yakin ingin mencetak laporan ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Cetak!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                var printContent = document.getElementById('printHalaman');
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContent.innerHTML;
                window.print();
                document.body.innerHTML = originalContents;
            }
        });
    }
</script>
<?= $this->endSection() ?>