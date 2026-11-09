<div class="table-responsive datatable-minimal mt-4">
    <table class="table table-hover" id="tabelJenis">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Konsumen</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th class="no-short">Aksi</th>
            </tr>
        </thead>
    </table>
</div>
<script>
    $('#tabelJenis').DataTable({
        processing: true,
        serverSide: true,
        ajax: '<?= site_url("pengiriman/viewGetKonsumen") ?>',
        info: true,
        ordering: true,
        paging: true,
        order: [
            [0, 'desc']
        ],
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": ["no-short"]
        }],
    });

    $(document).ready(function() {
        $(document).on('click', '.btn-pilihkonsumen', function() {
            var idkonsumen = $(this).data('idkonsumen');
            var nama = $(this).data('nama');
            var nohp = $(this).data('nohp');

            $('#idkonsumen').val(idkonsumen);
            $('#nama').val(nama);
            $('#nohp').val(nohp);

            $('#modalKonsumen').modal('hide').on('hidden.bs.modal', function() {
                $('#namapenerima').focus();
            });
        });
    });
</script>