<table class="table table-bordered" style="border: 1px solid black;">
    <tr class="text-center" style="border: 1px solid black;">
        <th style="width: 15px; border: 1px solid black;">No</th>
        <th style="border: 1px solid black;">Nama Tarif</th>
        <th style="border: 1px solid black;">Kota Asal</th>
        <th style="border: 1px solid black;">Kota Tujuan</th>
        <th style="border: 1px solid black;">Tarif</th>
        <th style="border: 1px solid black;">Layanan</th>
        <th style="border: 1px solid black;">Estimasi</th>
    </tr>
    <?php $no = 1; ?>
    <?php foreach ($tarif as $value) { ?>
        <tr style="border: 1px solid black;">
            <td style="border: 1px solid black;"><?= $no++ ?></td>
            <td style="border: 1px solid black;"><?= $value['namatarif'] ?></td>
            <td style="border: 1px solid black;"><?= $value['kota_asal'] ?></td>
            <td style="border: 1px solid black;"><?= $value['kota_tujuan'] ?></td>
            <td style="border: 1px solid black;">Rp <?= number_format($value['tarif'], 0, ',', '.') ?></td>
            <td style="border: 1px solid black;"><?= $value['layanan'] ?></td>
            <td style="border: 1px solid black;"><?= $value['estimasi'] ?> hari</td>
        </tr>
    <?php } ?>
</table>