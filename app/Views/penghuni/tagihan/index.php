<?= $this->extend('layout/penghuni') ?>

<?= $this->section('title') ?>
Tagihan Saya - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-3">Tagihan Bulanan Saya</h4>
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold">Riwayat Tagihan</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover m-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">Periode</th>
                                <th>Nominal Tagihan</th>
                                <th>Denda</th>
                                <th>Total Harus Dibayar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($tagihan)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Belum ada data tagihan.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($tagihan as $t): ?>
                                <tr>
                                    <td class="px-4 fw-bold"><?= $t['bulan'] ?> <?= $t['tahun'] ?></td>
                                    <td>Rp <?= number_format($t['nominal_asal'], 0, ',', '.') ?></td>
                                    <td>Rp <?= number_format($t['nominal_denda'], 0, ',', '.') ?></td>
                                    <td class="fw-bold text-primary">Rp <?= number_format($t['nominal_asal'] + $t['nominal_denda'], 0, ',', '.') ?></td>
                                    <td>
                                        <?php if($t['status_bayar'] == 'Lunas'): ?>
                                            <span class="badge bg-success">Lunas</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Belum Bayar</span>
                                        <?php endif; ?>
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
<?= $this->endSection() ?>