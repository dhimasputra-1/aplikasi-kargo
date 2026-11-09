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
                        <a href="<?= site_url('tarif/formtambah') ?>" class="btn btn-danger">Tambah Data</a>
                    </div>
                    <div class="table-responsive datatable-minimal mt-4">
                        <table class="table table-hover" id="tabelAset">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Tarif</th>
                                    <th>Kota Asal</th>
                                    <th>Kota Tujuan</th>
                                    <th>Harga</th>
                                    <th>Layanan</th>
                                    <th>Estimasi</th>
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
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px;">
        <div class="modal-content" style="background-color: #f4f4f2; border-radius: 20px;">
            <div class="modal-header"
                style="background-color: #131842; color: white; border-top-left-radius: 20px; border-top-right-radius: 20px;">
                <h5 class="modal-title" id="detailModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white;">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detail-content" style="overflow-y: auto;">
                <!-- Detail pelanggan akan dimuat melalui AJAX -->
            </div>
        </div>
    </div>
</div>
<!-- isi konten end -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $('#tabelAset').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/tarif/view',
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
            var idtarif = $(this).data('idtarif');

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
                        url: "<?php echo route_to('tarif.delete'); ?>",
                        data: {
                            idtarif: idtarif
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
                                $('#tabelAset').DataTable().ajax.reload();
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
        var idtarif = $(this).data('idtarif');
        window.location.href = "<?php echo site_url('tarif/edit/'); ?>" + idtarif;
    });

    $(document).on('click', '.btn-detail', function() {
        var idtarif = $(this).data('idtarif');
        $.ajax({
            type: "GET",
            url: "<?= site_url('tarif/detail/') ?>" + idtarif,
            dataType: 'html',
            success: function(response) {
                $('#detail-content').html(response);
                $('#detailModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
</script>
<?= $this->endSection() ?>