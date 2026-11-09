<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-12">
        <?= form_open('/pengiriman/updatedata', ['id' => 'formtambah', 'enctype' => 'multipart/form-data']) ?>
        <?= csrf_field() ?>

        <!-- Card Nomor Resi -->
        <div class="card card-olive mb-3">
            <div class="card-header">
                <h3 class="card-title">Informasi Pengiriman</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="noresi">Nomor Resi</label>
                            <input type="text" id="noresi" name="noresi" class="form-control" value="<?= $noresi ?>" readonly>
                            <div class="invalid-feedback error_noresi"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="tgl">Tanggal</label>
                            <input type="date" id="tgl" name="tgl" class="form-control" value="<?= $pengiriman['tgl'] ?>">
                            <div class="invalid-feedback error_tgl"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Data Konsumen -->
        <div class="card card-maroon mb-3">
            <div class="card-header">
                <h3 class="card-title">Data Konsumen</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nama">Nama Pengirim</label>
                            <div class="input-group">
                                <input type="hidden" id="idkonsumen" name="idkonsumen" value="<?= $pengiriman['idkonsumen'] ?>">
                                <input type="text" id="nama" name="nama" class="form-control" value="<?= $pengiriman['nama_pengirim'] ?>" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modalKonsumen">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                                <div class="invalid-feedback error_nama"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nohp">No. HP Pengirim</label>
                            <input type="text" id="nohp" name="nohp" class="form-control" value="<?= $pengiriman['nohp_pengirim'] ?>" readonly>
                            <div class="invalid-feedback error_nohp"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="namapenerima">Nama Penerima</label>
                            <input type="text" id="namapenerima" name="namapenerima" class="form-control" value="<?= $pengiriman['namapenerima'] ?>">
                            <div class="invalid-feedback error_namapenerima"></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="nohppenerima">No. HP Penerima</label>
                            <input type="text" id="nohppenerima" name="nohppenerima" class="form-control">
                            <div class="invalid-feedback error_nohppenerima"></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="alamatpenerima">Alamat Penerima</label>
                            <textarea type="text" id="alamatpenerima" name="alamatpenerima" class="form-control"></textarea>
                            <div class="invalid-feedback error_alamatpenerima"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Data Pengiriman -->
        <div class="card card-pink mb-3">
            <div class="card-header">
                <h3 class="card-title">Data Pengiriman</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="idtarif">Tarif</label>
                            <div class="input-group">
                                <input type="hidden" id="idtarif" name="idtarif" class="form-control">
                                <input type="text" id="namatarif" name="namatarif" class="form-control" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalTarif">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                                <div class="invalid-feedback error_namatarif"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="kotaasal">Kota Asal</label>
                            <input type="text" id="kotaasal" name="kotaasal" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="kotatujuan">Kota Tujuan</label>
                            <input type="text" id="kotatujuan" name="kotatujuan" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="layanan">Layanan</label>
                            <input type="text" id="layanan" name="layanan" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="estimasi">Estimasi</label>
                            <input type="text" id="estimasi" name="estimasi" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="tarif">Tarif /Kg</label>
                            <input type="number" id="tarif" name="tarif" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="berat">Berat (Kg)</label>
                            <input type="number" id="berat" name="berat" class="form-control">
                            <div class="invalid-feedback error_berat"></div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="totalbiaya">Total Biaya</label>
                            <input type="hidden" id="totalbiaya" name="totalbiaya">
                            <input type="text" id="totalbiaya_tampil" class="form-control text-right font-weight-bold text-success" readonly>
                            <div class="invalid-feedback error_totalbiaya"></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary" id="tombolSimpan">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="<?= base_url() ?>cucianmasuk" class="btn btn-danger">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <?= form_close() ?>

        <!-- Modal Tarif -->
        <div class="modal fade" id="modalTarif" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Tarif</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Konsumen -->
        <div class="modal fade" id="modalKonsumen" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Konsumen</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(function() {
        // Form Submit Handler
        $('#formtambah').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    noresi: $('#noresi').val(),
                    tgl: $('#tgl').val(),
                    idkonsumen: $('#idkonsumen').val(),
                    namapenerima: $('#namapenerima').val(),
                    nohppenerima: $('#nohppenerima').val(),
                    alamatpenerima: $('#alamatpenerima').val(),
                    idtarif: $('#idtarif').val(),
                    berat: $('#berat').val(),
                    totalbiaya: $('#totalbiaya').val(),
                },
                dataType: "json",
                beforeSend: function() {
                    $('#tombolSimpan').html('<i class="fas fa-spin fa-spinner"></i> Tunggu');
                    $('#tombolSimpan').prop('disabled', true);
                },
                complete: function() {
                    $('#tombolSimpan').html('<i class="fas fa-save"></i> Simpan');
                    $('#tombolSimpan').prop('disabled', false);
                },
                success: function(response) {
                    if (response.error) {
                        let err = response.error;

                        // Handle validation errors
                        handleValidation('noresi', err.error_noresi);
                        handleValidation('tgl', err.error_tgl);
                        handleValidation('namapenerima', err.error_namapenerima);
                        handleValidation('nohppenerima', err.error_nohppenerima);
                        handleValidation('alamatpenerima', err.error_alamatpenerima);
                        handleValidation('idtarif', err.error_idtarif);
                        handleValidation('berat', err.error_berat);
                        handleValidation('totalbiaya', err.error_totalbiaya);
                    }

                    if (response.sukses) {
                        Swal.fire({
                            title: "Berhasil",
                            width: 600,
                            padding: "3em",
                            color: "#716add",
                            background: "#fff url(<?= base_url('assets/img/nyan-cat.gif') ?>)",
                            backdrop: `
                                rgba(0,0,123,0.4)
                                url("<?= base_url('assets/img/nyan-cat.gif') ?>")
                                left top
                                no-repeat
                            `
                        });

                        setTimeout(function() {
                            window.location.href = '<?= site_url('/pengiriman/detail/' . $noresi) ?>';
                        }, 1500);
                    }
                },
                error: function(e) {
                    alert('Error \n' + e.responseText);
                }
            });
        });

        // Modal Handlers
        $('#modalKonsumen').on('show.bs.modal', function() {
            if (!$(this).data('loaded')) {
                showLoader($(this));
                loadModalContent($(this), '<?= base_url() ?>/pengiriman/getkonsumen');
                $(this).data('loaded', true);
            }
        });

        $('#modalTarif').on('show.bs.modal', function() {
            showLoader($(this));
            // Tunggu sebentar sebelum memuat konten untuk menghindari konflik
            setTimeout(() => {
                loadModalContent($(this), '<?= base_url() ?>/pengiriman/gettarif');
            }, 100);
        });

        // Helper Functions
        function handleValidation(field, error) {
            if (error) {
                $(`#${field}`).addClass('is-invalid').removeClass('is-valid');
                $(`.error_${field}`).html(error);
            } else {
                $(`#${field}`).removeClass('is-invalid').addClass('is-valid');
                $(`.error_${field}`).html('');
            }
        }

        function showLoader(modal) {
            modal.find('.modal-body').html(
                '<div class="d-flex justify-content-center">' +
                '<div class="spinner-border" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div></div>'
            );
        }

        function loadModalContent(modal, url) {
            $.get(url, function(data) {
                modal.find('.modal-body').html(data);
            });
        }

        // Tambahkan fungsi format rupiah
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(angka);
        }

        // Tambahkan event listener untuk input berat
        $('#berat').on('input', function() {
            hitungTotal();
        });

        // Tambahkan fungsi hitung total
        function hitungTotal() {
            var tarif = parseFloat($('#tarif').val()) || 0;
            var berat = parseFloat($('#berat').val()) || 0;

            var total = tarif * berat;

            // Update hidden input untuk database
            $('#totalbiaya').val(total);

            // Update tampilan dengan format rupiah
            $('#totalbiaya_tampil').val(formatRupiah(total));
        }
    });
</script>
<?= $this->endSection() ?>