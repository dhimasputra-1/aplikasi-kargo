<table class="table table-bordered" style="border: 1px solid black;">
    <thead>
        <tr class="text-center bg-light">
            <th style="width: 50px;">No</th>
            <th>No. Resi</th>
            <th>Tanggal</th>
            <th>Pengirim</th>
            <th>Penerima</th>
            <th>Rute</th>
            <th>Layanan</th>
            <th>Berat (Kg)</th>
            <th>Total Biaya</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $total = 0;
        foreach ($pengiriman as $row):
            $total += $row['totalbiaya'];
        ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $row['noresi'] ?></td>
                <td><?= date('d/m/Y', strtotime($row['tgl'])) ?></td>
                <td><?= $row['nama'] ?></td>
                <td>
                    <?= $row['namapenerima'] ?><br>
                    <small><?= $row['alamatpenerima'] ?></small><br>
                    <small>Telp: <?= $row['nohppenerima'] ?></small>
                </td>
                <td><?= $row['kota_asal'] ?> → <?= $row['kota_tujuan'] ?></td>
                <td><?= $row['layanan'] ?></td>
                <td class="text-center"><?= number_format($row['berat'], 1) ?></td>
                <td class="text-right">Rp <?= number_format($row['totalbiaya'], 0, ',', '.') ?></td>
                <td class="text-center">
                    <?php
                    $badge_class = '';
                    $status_text = '';
                    switch ($row['status']) {
                        case 1:
                            $badge_class = 'badge-warning';
                            $status_text = 'Proses';
                            break;
                        case 2:
                            $badge_class = 'badge-primary';
                            $status_text = 'Sampai';
                            break;
                        case 3:
                            $badge_class = 'badge-success';
                            $status_text = 'Diterima';
                            break;
                    }
                    ?>
                    <span class="badge <?= $badge_class ?>"><?= $status_text ?></span>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr class="font-weight-bold bg-light">
            <td colspan="8" class="text-right">Total Keseluruhan:</td>
            <td class="text-right">Rp <?= number_format($total, 0, ',', '.') ?></td>
            <td></td>
        </tr>
    </tbody>
</table>