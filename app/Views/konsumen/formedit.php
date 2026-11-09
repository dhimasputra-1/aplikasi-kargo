<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="row" style="justify-content: center;">
    <div class="col-md-8">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Edit Data Konsumen</h3>
            </div>

            <div class="card-body">
                <?= form_open('konsumen/update', ['id' => 'formeditkonsumen']) ?>
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="idkonsumen">ID Konsumen</label>
                            <input type="text" id="idkonsumen" name="idkonsumen" class="form-control"
                                value="<?= $konsumen['idkonsumen'] ?>" readonly>
                            <div class="invalid-feedback error_idkonsumen"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nama">Nama Konsumen</label>
                            <input type="text" id="nama" name="nama" class="form-control"
                                value="<?= $konsumen['nama'] ?>">
                            <div class="invalid-feedback error_nama"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="jenkel">Jenis Kelamin</label>
                            <select id="jenkel" name="jenkel" class="form-control">
                                <option value="">Pilih</option>
                                <option value="L" <?= $konsumen['jenkel'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= $konsumen['jenkel'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                            <div class="invalid-feedback error_jenkel"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea type="text" id="alamat" name="alamat"
                                class="form-control"><?= $konsumen['alamat'] ?></textarea>
                            <div class="invalid-feedback error_alamat"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nohp">Nomor Handphone</label>
                            <input type="number" id="nohp" name="nohp" class="form-control"
                                value="<?= $konsumen['nohp'] ?>">
                            <div class="invalid-feedback error_nohp"></div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn" style="background-color: #131842; color: white;" id="tombolSimpan"
                    style="margin-right: 1rem;">
                    <i class="fas fa-save"></i> Update
                </button>
                <a class="btn btn-danger" href="<?= base_url('konsumen') ?>">Kembali</a>
            </div>
        </div>
    </div>

    <?= form_close() ?>

</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(function() {
        $('#formeditkonsumen').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                beforeSend: function() {
                    $('#tombolSimpan').html('<i class="fas fa-spin fa-spinner"></i> Tunggu');
                    $('#tombolSimpan').prop('disabled', true);
                },

                complete: function() {
                    $('#tombolSimpan').html('<i class="fas fa-save"></i> Update');
                    $('#tombolSimpan').prop('disabled', false);
                },

                success: function(response) {
                    if (response.error) {
                        let err = response.error;

                        if (err.error_idkonsumen) {
                            $('#idkonsumen').addClass('is-invalid').removeClass('is-valid');
                            $('.error_idkonsumen').html(err.error_idkonsumen);
                        } else {
                            $('#idkonsumen').removeClass('is-invalid').addClass('is-valid');
                            $('.error_idkonsumen').html('');
                        }
                        if (err.error_nama) {
                            $('#nama').addClass('is-invalid').removeClass('is-valid');
                            $('.error_nama').html(err.error_nama);
                        } else {
                            $('#nama').removeClass('is-invalid').addClass('is-valid');
                            $('.error_nama').html('');
                        }

                        if (err.error_jenkel) {
                            $('#jenkel').addClass('is-invalid').removeClass('is-valid');
                            $('.error_jenkel').html(err.error_jenkel);
                        } else {
                            $('#jenkel').removeClass('is-invalid').addClass('is-valid');
                            $('.error_jenkel').html('');
                        }
                        if (err.error_alamat) {
                            $('#alamat').addClass('is-invalid').removeClass('is-valid');
                            $('.error_alamat').html(err.error_alamat);
                        } else {
                            $('#alamat').removeClass('is-invalid').addClass('is-valid');
                            $('.error_alamat').html('');
                        }
                        if (err.error_nohp) {
                            $('#nohp').addClass('is-invalid').removeClass('is-valid');
                            $('.error_nohp').html(err.error_nohp);
                        } else {
                            $('#nohp').removeClass('is-invalid').addClass('is-valid');
                            $('.error_nohp').html('');
                        }

                    }

                    if (response.sukses) {
                        Swal.fire({
                            title: "Update Data Berhasil!",
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
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location.href = '<?= site_url('konsumen') ?>';
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