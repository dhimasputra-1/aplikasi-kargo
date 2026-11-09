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
                        <a href="<?= site_url('pengiriman/tambah') ?>" class="btn btn-danger">Tambah Data</a>
                    </div>
                    <div class="table-responsive datatable-minimal mt-4">
                        <table class="table table-hover" id="TabelPengiriman" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Resi</th>
                                    <th>Nama Konsumen</th>
                                    <th>Tanggal</th>
                                    <th>Nama Penerima</th>
                                    <th>Alamat</th>
                                    <th>No HP</th>
                                    <th>Berat</th>
                                    <th>Total Biaya</th>
                                    <th>Status</th>
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
<!-- isi konten end -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        var table = $('#TabelPengiriman').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?= site_url("pengiriman/view") ?>',
            info: true,
            ordering: true,
            paging: true,
            responsive: true, // Menambahkan opsi responsive
            order: [
                [0, 'desc']
            ],
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": ["no-short"]
            }],
        });

        // Fungsi untuk membuat DataTable responsif ketika sidebar di-hide
        $('#sidebarToggle').on('click', function() {
            table.columns.adjust().responsive.recalc();
        });

        $(document).on('click', '.btn-delete', function() {
            var noresi = $(this).data('noresi');

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
                        url: "<?= route_to('noresi.delete') ?>",
                        data: {
                            noresi: noresi
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
                                $('#TabelPengiriman').DataTable().ajax.reload();
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
        $(document).on('click', '.btn-status', function() {
            var noresi = $(this).data('noresi');

            Swal.fire({
                title: 'Apakah Anda yakin ingin Mengubah Status ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ganti Status!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= site_url('pengiriman/ubahstatus') ?>",
                        data: {
                            noresi: noresi
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
                                $('#TabelPengiriman').DataTable().ajax.reload();
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.error,
                                    icon: 'error'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire({
                                title: 'Error!',
                                text: 'Gagal mengubah status',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
    });

    $(document).on('click', '.btn-edit', function() {
        var noresi = $(this).data('noresi');
        window.location.href = "<?= site_url('pengiriman/edit/') ?>" + noresi;
    });


    $(document).on('click', '.btn-detail', function() {
        var noresi = $(this).data('noresi');
        window.location.href = "<?= site_url('pengiriman/detail/') ?>" + noresi;
    });
</script>
<?= $this->endSection() ?>