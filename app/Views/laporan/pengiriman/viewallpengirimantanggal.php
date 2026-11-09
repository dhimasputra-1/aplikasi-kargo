<table class="table table-bordered" style="border: 1px solid black; font-size: 13px;">
    <thead>
        <tr class="text-center" style="border: 1px solid black;">
            <th style="border: 1px solid black;">No</th>
            <th style="border: 1px solid black;">No Faktur</th>
            <th style="border: 1px solid black;">Nama Pelanggan</th>
            <th style="border: 1px solid black;">Tanggal Masuk</th>
            <th style="border: 1px solid black;">Detail Cucian</th>
            <th style="border: 1px solid black;">Total Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        $grandtotal = 0;
        $fakturDisplayed = []; ?>
        <?php foreach ($order as $item) : ?>
            <?php
            $currentKey = $item['nofak'];
            if (!isset($fakturDisplayed[$currentKey])) {
                $fakturDisplayed[$currentKey] = true;
            ?>
                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;"><?= $no++ ?></td>
                    <td style="border: 1px solid black;"><?= $item['nofak'] ?></td>
                    <td style="border: 1px solid black;"><?= $item['nama'] ?></td>
                    <td style="border: 1px solid black;"><?= $item['tglmasuk'] ?></td>
                    <td style="border: 1px solid black;">
                        <table class="table mb-0" style="border: 1px solid black;">
                            <tr style="border: 1px solid black;">
                                <th style="border: 1px solid black;">Jenis Cucian</th>
                                <th style="border: 1px solid black;">Satuan</th>
                                <th style="border: 1px solid black;">Berat (Kg/Helai)</th>
                                <th style="border: 1px solid black;">Harga</th>
                            </tr>
                            <?php foreach ($order as $subitem) :
                                if ($subitem['nofak'] == $item['nofak']) { ?>
                                    <tr style="border: 1px solid black;">
                                        <td style="border: 1px solid black;"><?= $subitem['jenis'] ?></td>
                                        <td style="border: 1px solid black;"><?= $subitem['namasatuan'] ?></td>
                                        <td style="border: 1px solid black;"><?= $subitem['berat'] ?></td>
                                        <td style="border: 1px solid black;">Rp <?= number_format($subitem['total'], 0, ',', '.') ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            endforeach; ?>
                        </table>
                    </td>
                    <td style="text-align: center; font-weight: bold; border: 1px solid black;">Rp
                        <?= number_format($item['grandtotal'], 0, ',', '.') ?>
                    </td>
                </tr>
            <?php
            }
            $grandtotal += $item['grandtotal'];
            ?>
        <?php endforeach; ?>
        <tr class="font-weight-bold" style="border: 1px solid black;">
            <td colspan="4" style="border: 1px solid black;">Total Keseluruhan</td>
            <td colspan="2" style="text-align: right; border: 1px solid black;">Rp
                <?= number_format($grandtotal, 0, ',', '.') ?></td>
        </tr>
    </tbody>
</table>