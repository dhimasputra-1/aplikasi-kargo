<table class="table table-bordered" style="border: 1px solid black;">
    <tr class="text-center" style="border: 1px solid black;">
        <th style="width: 15px; border: 1px solid black;">No</th>
        <th style="border: 1px solid black;">Nama Kota</th>
        <th style="border: 1px solid black;">Alamat</th>
        <th style="border: 1px solid black;">No Telp Cabang</th>
    </tr>
    <?php $no = 1;
    $grandtotal = 0; ?>
    <?php foreach ($kota as $key => $value) { ?>
        <tr style="border: 1px solid black;">
            <td style="border: 1px solid black;"><?= $no++ ?></td>
            <td style="border: 1px solid black;" hidden><?= $value['idkota'] ?></td>
            <td style="border: 1px solid black;"><?= $value['namakota'] ?></td>
            <td style="border: 1px solid black;"><?= $value['alamat'] ?></td>
            <td style="border: 1px solid black;"><?= $value['notelp'] ?></td>
        </tr>
    <?php
    } ?>
</table>