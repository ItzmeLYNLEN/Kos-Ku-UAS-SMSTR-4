<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Laporan Pembayaran - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-3">Laporan Pembayaran Penghuni</h4>
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold">Riwayat Transaksi</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover m-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">Tanggal Transaksi</th>
                                <th>Kode Invoice</th>
                                <th>Penghuni</th>
                                <th>Periode Dibayar</th>
                                <th>Metode</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($pembayaran)): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">Belum ada data pembayaran.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($pembayaran as $p): ?>
                                <tr>
                                    <td class="px-4"><?= date('d M Y, H:i', strtotime($p['created_at'])) ?></td>
                                    <td class="text-muted font-monospace small"><?= $p['kode_transaksi'] ?></td>
                                    <td class="fw-bold"><?= $p['nama_lengkap'] ?></td>
                                    <td><?= $p['bulan_dibayar'] ?></td>
                                    <td><?= $p['metode_bayar'] ?></td>
                                    <td class="text-success fw-bold">Rp <?= number_format($p['total_bayar'], 0, ',', '.') ?></td>
                                    <td>
                                        <?php if($p['status_transaksi'] == 'Success'): ?>
                                            <span class="badge bg-success">Berhasil</span>
                                        <?php elseif($p['status_transaksi'] == 'Pending'): ?>
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Kadaluarsa</span>
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