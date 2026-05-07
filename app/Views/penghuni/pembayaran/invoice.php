<?= $this->extend('layout/penghuni') ?>

<?= $this->section('title') ?>
Invoice - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-body text-center p-5">
                <h6 class="text-muted mb-1">Kode Transaksi: <?= $pembayaran['kode_transaksi'] ?></h6>
                <h3 class="fw-bold text-primary mb-4">Menunggu Pembayaran</h3>
                
                <?php if($pembayaran['metode_bayar'] == 'QRIS'): ?>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=DUMMY_QRIS_SIKOS_<?= $pembayaran['kode_transaksi'] ?>" alt="QRIS" class="img-fluid mb-3 rounded">
                    <p class="text-muted">Scan QRIS di atas menggunakan aplikasi M-Banking atau e-Wallet Anda.</p>
                <?php else: ?>
                    <div class="p-3 bg-light rounded mb-4">
                        <span class="d-block text-muted">Nomor Virtual Account (<?= str_replace('VA_', '', $pembayaran['metode_bayar']) ?>)</span>
                        <h2 class="fw-bold m-0 tracking-widest"><?= rand(10000, 99999) ?> <?= rand(10000, 99999) ?></h2>
                    </div>
                <?php endif; ?>

                <div class="d-flex justify-content-between border-top pt-3 mt-4">
                    <span class="fw-bold">Total Tagihan:</span>
                    <h4 class="fw-bold text-success m-0">Rp <?= number_format($pembayaran['total_bayar'], 0, ',', '.') ?></h4>
                </div>

                <div class="mt-5">
                    <hr>
                    <p class="small text-muted mb-2">Tombol di bawah ini hanya untuk keperluan uji coba (Dummy).</p>
                    <a href="<?= base_url('penghuni/pembayaran/simulate/' . $pembayaran['kode_transaksi']) ?>" class="btn btn-success w-100">Simulasikan Pembayaran Berhasil</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>