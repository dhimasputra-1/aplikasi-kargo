<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-lg"
            style="width: 100%; border-radius: 10px; background-color: #f4f4f2; text-align: center;">
            <div class="card-header" style="background-color: #131842; color: white; border-radius: 10px 10px 0 0;">
                <h4 class="card-title" style="font-family: Arial, sans-serif; font-weight: bold;">
                    Detail Satuan
                </h4>
            </div>
            <img src="<?= base_url() ?>/assets/img/logokargo.jpg" alt="Gambar Barber"
                style="width: 100%; height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-text" style="font-family: Arial, sans-serif; margin-bottom: 0.5rem; font-weight: bold;">
                    Nama Satuan
                </h5>
                <p class="card-text" style="font-family: Arial, sans-serif; margin-bottom: 0.5rem;">
                    <?= $satuan['namasatuan'] ?>
                </p>
                <h5 class="card-text" style="font-family: Arial, sans-serif; margin-bottom: 0.5rem; font-weight: bold;">
                    Harga
                </h5>
                <p class="card-text" style="font-family: Arial, sans-serif; margin-bottom: 0.5rem;">
                    Rp<?= number_format($satuan['harga'], 0, ',', '.') ?>
                </p>
            </div>
        </div>
    </div>
</div>