<b>Bulan : <?= $bulan ?></b>
<b>Tahun : <?= $tahun ?></b>
<table class="table table-bordered" style="border: 1px solid; font-size: 13px;">
    <tr class="text-center">
        <th style="width: 15px;">No</th>
        <th>No Faktur</th>
        <th>Transaction ID</th>
        <th>Pembayaran</th>
        <th>Waktu Order</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Status</th>
        <th>Pelanggan</th>
        <th>Kendaraan</th>
        <th>Harga</th>
    </tr>
    <?php $no = 1;
    $grandtotal = 0; ?>
    <?php foreach ($order as $key => $value) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $value['kdboking'] ?></td>
            <td><?= $value['transaction_id'] ?></td>
            <td><?= $value['payment_type'] ?></td>
            <td><?= $value['transaction_time'] ?></td>
            <td><?= $value['tglmulai'] ?></td>
            <td><?= $value['tglakhir'] ?></td>
            <td><?= $value['status'] == '3' ? 'Selesai' : 'Sedang Jalan' ?></td>
            <td><?= $value['iduser'] ?></td>
            <td><?= $value['kdmotor'] ?></td>
            <td>Rp. <?= number_format($value['harga'], 0, ',', '.') ?></td>

        </tr>
        <?php $grandtotal += $value['harga']; ?>
    <?php
    } ?>
    <tr style="font-weight: bold;">
        <td colspan="10">Total</td>
        <td rowspan="4">Rp. <?= number_format($grandtotal, 0, ',', '.') ?></td>
    </tr>

</table>