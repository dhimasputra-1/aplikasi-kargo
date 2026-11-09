<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<!-- isi konten Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h5 class="card-title">
                        <?= $title ?>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="buttons">
                        <a href="<?= site_url('konsumen/formtambah') ?>" class="btn btn-danger">Tambah Data</a>
                    </div>
                    <div class="table-responsive datatable-minimal mt-4">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Pelanggan</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>No HP</th>
                                    <th class="no-short">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px;">
        <div class="modal-content" style="background-color: #f4f4f2; border-radius: 20px;">
            <div class="modal-header"
                style="background-color: #131842; color: white; border-top-left-radius: 20px; border-top-right-radius: 20px;">
                <h5 class="modal-title" id="detailModalLabel">Detail Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white;">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detail-content" style="overflow-y: auto;">
                <!-- Detail konsumen akan dimuat melalui AJAX -->
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
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'konsumen/view',
            info: true,
            ordering: true,
            paging: true,
            responsive: true,
            order: [
                [0, 'desc']
            ],
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": ["no-short"]
            }],
        });

        $(document).on('click', '.btn-delete', function() {
            var idkonsumen = $(this).data('idkonsumen');

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
                        url: "<?php echo route_to('konsumen.delete'); ?>",
                        data: {
                            idkonsumen: idkonsumen
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
                                $('#myTable').DataTable().ajax.reload();
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
    });

    $(document).on('click', '.btn-edit', function() {
        var idkonsumen = $(this).data('idkonsumen');
        window.location.href = "<?php echo site_url('konsumen/edit/'); ?>" + idkonsumen;
    });

    $(document).on('click', '.btn-detail', function() {
        var idkonsumen = $(this).data('idkonsumen');
        $.ajax({
            type: "GET",
            url: "<?= site_url('konsumen/detail/') ?>" + idkonsumen,
            dataType: 'html',
            success: function(response) {
                $('#detail-content').html(response);
                $('#detailModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Gagal memuat detail konsumen');
            }
        });
    });
</script>
<?= $this->endSection() ?>