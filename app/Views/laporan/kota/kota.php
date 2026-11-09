<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card card-danger shadow-lg">
        <div class="card-header bg-gradient-danger">
            <h3 class="card-title"><i class="fas fa-users mr-2"></i> Laporan Data Cabang</h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="input-group">
                            <button class="btn btn-primary btn-lg mr-2 shadow" onclick="ViewLaporanSemua()">
                                <i class="fas fa-eye mr-2"></i>Lihat Laporan
                            </button>
                            <button class="btn btn-success btn-lg shadow" onclick="PrintLaporan()">
                                <i class="fas fa-print mr-2"></i>Cetak Laporan
                            </button>
                        </div>
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
                            <h3 class="font-weight-bold mt-4 mb-4">LAPORAN DATA CABANG KOTA SI-KARGO</h3>
                        </div>

                        <!-- Tabel Pelanggan dengan Animation -->
                        <div class="tabelPelanggan animate__animated animate__fadeIn">
                            <!-- Data akan dimuat disini -->
                        </div>

                        <!-- Tanda Tangan -->
                        <div class="row mt-5">
                            <div class="col-7">
                            </div>
                            <div class="col-5 text-center">
                                <?php $tanggal = date('d F Y'); ?>
                                <p>Padang, <?= $tanggal ?></p>
                                <p class="mb-5">Direktur PT. SI KARGO</p>
                                <div class="mt-4">
                                    <p class="font-weight-bold">(________________________)</p>
                                    <p>NIP. 19xxxxxxxxxxxxxx</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    function ViewLaporanSemua() {
        $('.tabelPelanggan').html('<div class="text-center"><i class="fas fa-spinner fa-spin fa-3x"></i><p class="mt-2">Memuat Data...</p></div>');

        $.ajax({
            type: "get",
            url: "<?= base_url('laporan/viewall-laporankota') ?>",
            dataType: "JSON",
            success: function(response) {
                if (response.data) {
                    $('.tabelPelanggan').hide().html(response.data).fadeIn('slow');
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Berhasil Dimuat!',
                        text: 'Laporan cabang kota telah berhasil ditampilkan',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat memuat data!'
                });
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