                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card shadow-lg"
                            style="width: 100%; border-radius: 10px; background-color: #f4f4f2;">
                            <div class="card-header"
                                style="background-color: #131842; color: white; border-radius: 10px 10px 0 0;">
                                <h4 class="card-title" style="font-weight: bold;">
                                    Detail Pelanggan
                                </h4>
                            </div>
                            <img src="<?= base_url() ?>/assets/img/logokargo.jpg" alt="Gambar Barber"
                                style="width: 100%; height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title" style="margin-bottom: 0.5rem;">
                                    <strong>ID Pelanggan:</strong> <?= $konsumen['idkonsumen'] ?>
                                </h5>
                                <p class="card-text" style="margin-bottom: 0.5rem;">
                                    <strong>Nama Pelanggan:</strong> <?= $konsumen['nama'] ?>
                                </p>
                                <p class="card-text" style="margin-bottom: 0.5rem;">
                                    <strong>Jenis Kelamin:</strong>
                                    <?= $konsumen['jenkel'] == 'L' ? 'Laki-Laki' : 'Perempuan' ?>
                                </p>
                                <p class="card-text" style="margin-bottom: 0.5rem;">
                                    <strong>Alamat:</strong> <?= $konsumen['alamat'] ?>
                                </p>
                                <p class="card-text" style="margin-bottom: 0.5rem;">
                                    <strong>Nomor Handphone:</strong> <?= $konsumen['nohp'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>