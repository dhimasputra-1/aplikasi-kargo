<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-danger">
            <div class="card-header text-center">
                <h3 class="card-title">Edit Data Tarif</h3>
            </div>

            <div class="card-body">
                <?= form_open('tarif/update', ['id' => 'formedit', 'enctype' => 'multipart/form-data']) ?>
                <?= csrf_field() ?>
                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="namatarif">Nama Tarif</label>
                            <input type="text" id="namatarif" name="namatarif" class="form-control" value="<?= $tarif['namatarif'] ?>">
                            <div class="invalid-feedback error_namatarif"></div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="idkotaasal">Kota Asal</label>
                            <select name="idkotaasal" id="idkotaasal" class="form-control">
                                <option value="">--Pilih Kota Asal--</option>
                                <?php foreach ($kota as $row) : ?>
                                    <option value="<?= $row->idkota ?>"><?= $row->namakota ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback error_idkotaasal"></div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="idkotatujuan">Kota Tujuan</label>
                            <select name="idkotatujuan" id="idkotatujuan" class="form-control">
                                <option value="">--Pilih Kota Tujuan--</option>
                                <?php foreach ($kota as $row) : ?>
                                    <option value="<?= $row->idkota ?>"><?= $row->namakota ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback error_idkotatujuan"></div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="tarif">Tarif/Kg</label>
                            <input type="number" id="tarif" name="tarif" class="form-control" value="<?= $tarif['tarif'] ?>">
                            <div class="invalid-feedback error_tarif"></div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="layanan">Layanan</label>
                            <select name="layanan" id="layanan" class="form-control">
                                <option value="">--Pilih Layanan--</option>
                                <option value="express">Express</option>
                                <option value="reguler">Reguler</option>
                            </select>
                            <div class="invalid-feedback error_layanan"></div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="estimasi">Estimasi</label>
                            <input type="number" id="estimasi" name="estimasi" class="form-control" value="<?= $tarif['estimasi'] ?>">
                            <div class="invalid-feedback error_estimasi"></div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success" id="tombolSimpan">
                        <i class="fas fa-save"></i> SIMPAN
                    </button>
                    <a class="btn btn-danger" href="<?= base_url('tarif') ?>">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(function() {
        $('#formedit').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this); // Menggunakan FormData untuk mendukung file upload
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: formData, // Menggunakan formData untuk mendukung file upload
                contentType: false, // Menunjukkan tidak adanya konten
                processData: false, // Menunjukkan tidak adanya proses data
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

                        if (err.error_namatarif) {
                            $('#namatarif').addClass('is-invalid').removeClass('is-valid');
                            $('.error_namatarif').html(err.error_namatarif);
                        } else {
                            $('#namatarif').removeClass('is-invalid').addClass('is-valid');
                            $('.error_namatarif').html('');
                        }
                        if (err.error_idkotaasal) {
                            $('#idkotaasal').addClass('is-invalid').removeClass('is-valid');
                            $('.error_idkotaasal').html(err.error_idkotaasal);
                        } else {
                            $('#idkotaasal').removeClass('is-invalid').addClass('is-valid');
                            $('.error_idkotaasal').html('');
                        }
                        if (err.error_idkotatujuan) {
                            $('#idkotatujuan').addClass('is-invalid').removeClass('is-valid');
                            $('.error_idkotatujuan').html(err.error_idkotatujuan);
                        } else {
                            $('#idkotatujuan').removeClass('is-invalid').addClass('is-valid');
                            $('.error_idkotatujuan').html('');
                        }
                        if (err.error_tarif) {
                            $('#tarif').addClass('is-invalid').removeClass('is-valid');
                            $('.error_tarif').html(err.error_tarif);
                        } else {
                            $('#tarif').removeClass('is-invalid').addClass('is-valid');
                            $('.error_tarif').html('');
                        }
                        if (err.error_layanan) {
                            $('#layanan').addClass('is-invalid').removeClass('is-valid');
                            $('.error_layanan').html(err.error_layanan);
                        } else {
                            $('#layanan').removeClass('is-invalid').addClass('is-valid');
                            $('.error_layanan').html('');
                        }
                        if (err.error_estimasi) {
                            $('#estimasi').addClass('is-invalid').removeClass('is-valid');
                            $('.error_estimasi').html(err.error_estimasi);
                        } else {
                            $('#estimasi').removeClass('is-invalid').addClass('is-valid');
                            $('.error_estimasi').html('');
                        }

                    }

                    if (response.sukses) {
                        Swal.fire({
                            title: "Data Tarif Berhasil Diupdate!",
                            html: "Tunggu Sebentar.",
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                                const timer = Swal.getPopup().querySelector("b");
                                timerInterval = setInterval(() => {
                                    timer.textContent =
                                        `${Swal.getTimerLeft()}`;
                                }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            }
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location.href = '<?= site_url('tarif') ?>';
                            }
                        });
                    }
                },

                error: function(e) {
                    alert('Error \n' + e.responseText);
                }
            });

            return false;
        });
    });
</script>
<?= $this->endSection() ?>