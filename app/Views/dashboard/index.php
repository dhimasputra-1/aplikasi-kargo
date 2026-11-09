<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-chart-line text-danger mr-2"></i>
                    Dashboard Eksekutif
                </h1>
            </div>
            <div class="col-sm-6">
                <div class="float-sm-right">
                    <span class="badge badge-danger">
                        <i class="far fa-clock mr-1"></i>
                        Update Terakhir: <?= date('d M Y H:i') ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-gradient-danger elevation-1">
                    <i class="fas fa-box"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pengiriman</span>
                    <span class="info-box-number">
                        <?= number_format($total_pengiriman ?? 0, 0, ',', '.') ?>
                        <small class="text-success ml-2">
                            <i class="fas fa-arrow-up"></i> 12%
                        </small>
                    </span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-gradient-warning elevation-1">
                    <i class="fas fa-truck"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Dalam Pengiriman</span>
                    <span class="info-box-number">
                        <?= number_format($dalam_pengiriman ?? 0, 0, ',', '.') ?>
                        <small class="text-warning ml-2">
                            <i class="fas fa-sync fa-spin"></i>
                        </small>
                    </span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-warning"
                            style="width: <?= ($dalam_pengiriman / ($total_pengiriman ?: 1)) * 100 ?>%">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-gradient-success elevation-1">
                    <i class="fas fa-check-circle"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Terkirim</span>
                    <span class="info-box-number">
                        <?= number_format($terkirim ?? 0, 0, ',', '.') ?>
                        <small class="text-success ml-2">
                            <i class="fas fa-arrow-up"></i> 8%
                        </small>
                    </span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success"
                            style="width: <?= ($terkirim / ($total_pengiriman ?: 1)) * 100 ?>%">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-gradient-info elevation-1">
                    <i class="fas fa-users"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pelanggan</span>
                    <span class="info-box-number">
                        <?= number_format($total_pelanggan ?? 0, 0, ',', '.') ?>
                        <small class="text-success ml-2">
                            <i class="fas fa-arrow-up"></i> 5%
                        </small>
                    </span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-info" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Row -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h3 class="card-title">
                        <i class="fas fa-chart-area text-danger mr-2"></i>
                        Tren Pengiriman
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="pengirimanChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h3 class="card-title">
                        <i class="fas fa-list-alt text-danger mr-2"></i>
                        Status Pengiriman Terkini
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="height: 300px;">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No Resi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($recent_shipments)) : ?>
                                    <?php foreach ($recent_shipments as $shipment) : ?>
                                        <tr>
                                            <td>
                                                <i class="fas fa-barcode text-muted mr-1"></i>
                                                <?= $shipment->noresi ?>
                                            </td>
                                            <td>
                                                <?php
                                                $badge_class = '';
                                                $status_text = '';
                                                $icon = '';
                                                switch ($shipment->status) {
                                                    case 1:
                                                        $badge_class = 'badge-warning';
                                                        $status_text = 'Proses';
                                                        $icon = 'fa-sync fa-spin';
                                                        break;
                                                    case 2:
                                                        $badge_class = 'badge-info';
                                                        $status_text = 'Sampai';
                                                        $icon = 'fa-truck';
                                                        break;
                                                    case 3:
                                                        $badge_class = 'badge-success';
                                                        $status_text = 'Diterima';
                                                        $icon = 'fa-check-circle';
                                                        break;
                                                }
                                                ?>
                                                <span class="badge <?= $badge_class ?>">
                                                    <i class="fas <?= $icon ?> mr-1"></i>
                                                    <?= $status_text ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>/assets/plugins/chart.js/Chart.min.js"></script>
<script>
    $(function() {
        // Pengiriman Chart
        var ctx = document.getElementById('pengirimanChart').getContext('2d');
        var gradientFill = ctx.createLinearGradient(0, 0, 0, 300);
        gradientFill.addColorStop(0, 'rgba(220, 53, 69, 0.3)');
        gradientFill.addColorStop(1, 'rgba(220, 53, 69, 0)');

        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($chart_labels ?? []) ?>,
                datasets: [{
                    label: 'Jumlah Pengiriman',
                    data: <?= json_encode($chart_data ?? []) ?>,
                    borderColor: '#dc3545',
                    backgroundColor: gradientFill,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#dc3545',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>