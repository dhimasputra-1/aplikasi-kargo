<table class="table table-bordered" style="border: 1px solid black;">
    <tr class="text-center" style="border: 1px solid black;">
        <th style="width: 15px; border: 1px solid black;">No</th>
        <th style="border: 1px solid black;">ID Pelanggan</th>
        <th style="border: 1px solid black;">Nama Pelanggan</th>
        <th style="border: 1px solid black;">Jenis Kelamin</th>
        <th style="border: 1px solid black;">Alamat</th>
        <th style="border: 1px solid black;">No Hp</th>
    </tr>
    <?php $no = 1;
    $grandtotal = 0; ?>
    <?php foreach ($pelanggan as $key => $value) { ?>
        <tr style="border: 1px solid black;">
            <td style="border: 1px solid black;"><?= $no++ ?></td>
            <td style="border: 1px solid black;"><?= $value['idkonsumen'] ?></td>
            <td style="border: 1px solid black;"><?= $value['nama'] ?></td>
            <td style="border: 1px solid black;"><?= $value['jenkel'] == 'L' ? 'Laki-Laki' : 'Perempuan' ?></td>
            <td style="border: 1px solid black;"><?= $value['alamat'] ?></td>
            <td style="border: 1px solid black;"><?= $value['nohp'] ?></td>
        </tr>
    <?php
    } ?>
</table>