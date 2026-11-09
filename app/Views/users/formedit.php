<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Edit Data User</h3>
            </div>

            <div class="card-body">
                <?= form_open('user/update', ['id' => 'formedituser', 'enctype' => 'multipart/form-data']) ?>
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="fullname">Nama Lengkap</label>
                            <input type="hidden" id="iduser" name="iduser" class="form-control" value="<?= $users->id ?>">
                            <input type="text" id="fullname" name="fullname" class="form-control" value="<?= $users->fullname ?>">
                            <div class="invalid-feedback error_fullname"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?= $users->email ?>">
                            <div class="invalid-feedback error_email"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control" value="<?= $users->username ?>">
                            <div class="invalid-feedback error_username"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password">Password (ubah jika ingin mengganti)</label>
                            <input type="password" id="password" name="password" class="form-control">
                            <div class="invalid-feedback error_password"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="">Pilih Role</option>
                                <option value="1" <?= $users->group_id == 1 ? 'selected' : '' ?>>Petugas</option>
                                <option value="2" <?= $users->group_id == 2 ? 'selected' : '' ?>>Kepala Kantor</option>
                            </select>
                            <div class="invalid-feedback error_role"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Card Preview -->
    <div class="col-md-4">
        <div class="card" style="padding-left: 10px; padding-right: 10px; height: 420px;">
            <div class="card-header">
                <h3 class="card-title">Foto</h3>
            </div>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="cover" name="cover" accept="image/*" onchange="previewCover()">
                    <label class="custom-file-label" for="cover"><?= $users->foto ?></label>
                    <div class="invalid-feedback error_cover"></div>
                </div>
            </div>
            <div class="card-body" style="overflow: hidden;">
                <img id="coverPreview" src="<?= base_url('assets/img/' . $users->foto) ?>" alt="Preview Cover" class="img-fluid" style="max-width: 100%; max-height: 100%; display: block;">
            </div>
        </div>
        <div class="card" style="padding-left: 10px; padding-right: 10px; display: flex; flex-direction: column; justify-content: center; height: 15%;">
            <div class="form-group" style="text-align: center;">
                <button type="submit" class="btn btn-success" id="tombolSimpan" style="margin-right: 1rem;">
                    <i class="fas fa-save"></i> SIMPAN
                </button>
                <a class="btn btn-danger" href="<?= base_url('user') ?>">Kembali</a>
            </div>
        </div>
    </div>
    <?= form_close() ?>

</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(function() {
        $('#formedituser').submit(function(e) {
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

                        if (err.error_fullname) {
                            $('#fullname').addClass('is-invalid').removeClass('is-valid');
                            $('.error_fullname').html(err.error_fullname);
                        } else {
                            $('#fullname').removeClass('is-invalid').addClass('is-valid');
                            $('.error_fullname').html('');
                        }

                        if (err.error_email) {
                            $('#email').addClass('is-invalid').removeClass('is-valid');
                            $('.error_email').html(err.error_email);
                        } else {
                            $('#email').removeClass('is-invalid').addClass('is-valid');
                            $('.error_email').html('');
                        }

                        if (err.error_username) {
                            $('#username').addClass('is-invalid').removeClass('is-valid');
                            $('.error_username').html(err.error_username);
                        } else {
                            $('#username').removeClass('is-invalid').addClass('is-valid');
                            $('.error_username').html('');
                        }

                        if (err.error_password) {
                            $('#password').addClass('is-invalid').removeClass('is-valid');
                            $('.error_password').html(err.error_password);
                        } else {
                            $('#password').removeClass('is-invalid').addClass('is-valid');
                            $('.error_password').html('');
                        }
                        if (err.error_role) {
                            $('#role').addClass('is-invalid').removeClass('is-valid');
                            $('.error_role').html(err.error_role);
                        } else {
                            $('#role').removeClass('is-invalid').addClass('is-valid');
                            $('.error_role').html('');
                        }
                        if (err.error_cover) {
                            $('#cover').addClass('is-invalid').removeClass('is-valid');
                            $('.error_cover').html(err.error_cover);
                        } else {
                            $('#cover').removeClass('is-invalid').addClass('is-valid');
                            $('.error_cover').html('');
                        }
                    }

                    if (response.sukses) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.sukses,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function() {
                            window.location.href = '<?= site_url('user') ?>';
                        }, 1500);
                    }
                },

                error: function(e) {
                    alert('Error \n' + e.responseText);
                }
            });

            return false;
        });
    });

    function previewCover() {
        const cover = document.querySelector('#cover');
        const coverPreview = document.querySelector('#coverPreview');
        const coverLabel = document.querySelector('label[for="cover"]');

        coverPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(cover.files[0]);

        oFReader.onload = function(oFREvent) {
            coverPreview.src = oFREvent.target.result;
        };

        coverLabel.textContent = cover.files[0].name;
    }
</script>
<?= $this->endSection() ?>