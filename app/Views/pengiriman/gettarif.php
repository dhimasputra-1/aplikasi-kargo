<div class="table-responsive datatable-minimal mt-4">
    <table class="table table-hover" id="tabelTarif">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tarif</th>
                <th>Kota Asal</th>
                <th>Kota Tujuan</th>
                <th>Tarif</th>
                <th>Layanan</th>
                <th>Estimasi</th>
                <th class="no-short">Aksi</th>
            </tr>
        </thead>
    </table>
</div>
<script>
    $('#tabelTarif').DataTable({
        processing: true,
        serverSide: true,
        ajax: '<?= site_url("pengiriman/viewGetTarif") ?>',
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
        $(document).on('click', '.btn-pilihtarif', function() {
            var idtarif = $(this).data('idtarif');
            var namatarif = $(this).data('namatarif');
            var kotaasal = $(this).data('kotaasal');
            var kotatujuan = $(this).data('kotatujuan');
            var tarif = $(this).data('tarif');
            var layanan = $(this).data('layanan');
            var estimasi = $(this).data('estimasi');

            $('#idtarif').val(idtarif);
            $('#namatarif').val(namatarif);
            $('#kotaasal').val(kotaasal);
            $('#kotatujuan').val(kotatujuan);
            $('#tarif').val(tarif);
            $('#layanan').val(layanan);
            $('#estimasi').val(estimasi);

            $('#modalTarif').modal('hide').on('hidden.bs.modal', function() {
                $('#berat').focus();
            });
        });
    });
</script>