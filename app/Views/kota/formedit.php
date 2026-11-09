<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-danger">
            <div class="card-header text-center">
                <h3 class="card-title">Edit Data Kota</h3>
            </div>
            <div class="card-body">
                <?= form_open('kota/save', ['id' => 'formedit', 'enctype' => 'multipart/form-data']) ?>
                <?= csrf_field() ?>

                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="namakota">Nama Kota</label>
                            <input type="hidden" id="idkota" name="idkota" class="form-control" value="<?= $kota['idkota'] ?>">
                            <input type="text" id="namakota" name="namakota" class="form-control" value="<?= $kota['namakota'] ?>">
                            <div class="invalid-feedback error_namakota"></div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="notelp">Nomor Telp</label>
                            <input type="text" id="notelp" name="notelp" class="form-control" value="<?= $kota['notelp'] ?>">
                            <div class="invalid-feedback error_notelp"></div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat" class="form-control" value="<?= $kota['alamat'] ?>"></textarea>
                            <div class="invalid-feedback error_alamat"></div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success" id="tombolSimpan">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a class="btn btn-danger" href="<?= base_url('mobil') ?>">Kembali</a>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
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

                        if (err.error_namakota) {
                            $('#namakota').addClass('is-invalid').removeClass('is-valid');
                            $('.error_namakota').html(err.error_namakota);
                        } else {
                            $('#namakota').removeClass('is-invalid').addClass('is-valid');
                            $('.error_namakota').html('');
                        }
                        if (err.error_notelp) {
                            $('#notelp').addClass('is-invalid').removeClass('is-valid');
                            $('.error_notelp').html(err.error_notelp);
                        } else {
                            $('#notelp').removeClass('is-invalid').addClass('is-valid');
                            $('.error_notelp').html('');
                        }
                        if (err.error_alamat) {
                            $('#alamat').addClass('is-invalid').removeClass('is-valid');
                            $('.error_alamat').html(err.error_alamat);
                        } else {
                            $('#alamat').removeClass('is-invalid').addClass('is-valid');
                            $('.error_alamat').html('');
                        }

                    }

                    if (response.sukses) {
                        Swal.fire({
                            title: "Data Kota Berhasil Di Update!",
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
                                window.location.href = '<?= site_url('kota') ?>';
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