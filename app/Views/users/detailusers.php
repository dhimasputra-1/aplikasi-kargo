<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row" style="justify-content: center;">
        <div class="col-md-4">
            <!-- Profile Image -->
            <div class="card card-success card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>assets\img\<?= $users->foto; ?>" alt="User profile picture" style="width: 100px; height: 100px; object-fit: cover;">
                    </div>

                    <h3 class="profile-username text-center"><?= $users->fullname; ?> (<?= $users->username; ?>)</h3>

                    <p class="text-muted text-center"><?= $users->email; ?></p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Status Akun</b>
                            <a class="float-right">
                                <?= $users->aktif == 1 ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Tidak Aktif</span>'; ?>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Role </b> <a class="float-right"><?= $users->name; ?></a>
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
<?= $this->endSection() ?>