<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<!-- isi konten Start -->
<div class="card card-danger">
    <div class="card-header">
        <h5 class="card-title">
            <?= $title ?>
        </h5>
    </div>
    <div class="card-body">
        <div class="buttons">
            <a href="<?= site_url('user/formtambah') ?>" class="btn btn-danger">Tambah Data</a>
        </div>
        <div class="table-responsive datatable-minimal mt-4">
            <table class="table table-hover" id="tabelUser" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="no-short">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detail-content">
                <!-- Detail users akan dimuat melalui AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- isi konten end -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $('#tabelUser').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'user/view',
            info: true,
            ordering: true,
            responsive: true, // Menambahkan opsi responsive

            paging: true,
            order: [
                [0, 'desc']
            ],
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": ["no-short"]
            }],
        });
    });

    $(document).on('click', '.btn-detail', function() {
        var iduser = $(this).data('iduser');
        window.location.href = "<?php echo site_url('user/detail/'); ?>" + iduser;
    });

    $(document).on('click', '.btn-edit', function() {
        var iduser = $(this).data('iduser');
        window.location.href = "<?php echo site_url('user/edit/'); ?>" + iduser;
    });


    $(document).on('click', '.btn-delete', function() {
        var iduser = $(this).data('iduser');

        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo route_to('user.delete'); ?>",
                    data: {
                        iduser: iduser
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                title: 'Sukses!',
                                text: response.sukses,
                                icon: 'success'
                            });
                            // Refresh DataTable
                            $('#tabelUser').DataTable().ajax.reload();
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Gagal menghapus data',
                                icon: 'error'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Gagal menghapus data',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });
</script>
<?= $this->endSection() ?>