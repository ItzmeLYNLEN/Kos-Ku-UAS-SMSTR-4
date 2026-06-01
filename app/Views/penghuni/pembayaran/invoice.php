<?= $this->extend('layout/penghuni') ?>

<?= $this->section('title') ?>
Invoice - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-body p-sm-5 p-4">
                
                <div id="area-kwitansi" class="p-2">
                    <div class="text-center mb-4 pb-3 border-bottom">
                        <h6 class="text-muted mb-2">Kode Transaksi: <span class="text-dark fw-bold"><?= $pembayaran['kode_transaksi'] ?></span></h6>
                        
                        <?php if($pembayaran['status_transaksi'] == 'Success'): ?>
                            <div class="d-inline-block bg-success text-white px-4 py-2 rounded-pill mb-2 shadow-sm">
                                <h4 class="fw-bold m-0"><i class="bi bi-check-circle-fill"></i> LUNAS</h4>
                            </div>
                            <p class="text-muted m-0">Terima kasih, pembayaran tagihan Anda telah kami terima.</p>
                        <?php else: ?>
                            <div class="d-inline-block bg-warning text-dark px-4 py-2 rounded-pill mb-2 shadow-sm">
                                <h4 class="fw-bold m-0"><i class="bi bi-clock-history"></i> PENDING</h4>
                            </div>
                            <p class="text-muted m-0">Segera selesaikan pembayaran Anda sebelum batas waktu berakhir.</p>
                        <?php endif; ?>
                    </div>

                    <div class="row mb-4">
                        <div class="col-6">
                            <h6 class="text-muted small mb-1">Dibayar Oleh:</h6>
                            <p class="fw-bold mb-0 text-uppercase"><?= $p['nama_lengkap'] ?? session()->get('username') ?></p>
                            <p class="text-muted small">Kamar: No. <?= $p['no_kamar'] ?? '-' ?></p>
                        </div>
                        <div class="col-6 text-end">
                            <h6 class="text-muted small mb-1">Waktu Transaksi:</h6>
                            <p class="fw-bold mb-0"><?= date('d M Y, H:i', strtotime($pembayaran['created_at'])) ?> WIB</p>
                            
                            <?php if($pembayaran['status_transaksi'] == 'Success'): ?>
                                <h6 class="text-muted small mb-1 mt-2">Waktu Lunas:</h6>
                                <p class="fw-bold text-success mb-0"><?= date('d M Y, H:i', strtotime($pembayaran['updated_at'])) ?> WIB</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3 bg-light p-2 rounded px-3 border-start border-4 border-primary">Rincian Pembayaran</h6>
                    <div class="table-responsive mb-2">
                        <table class="table table-borderless table-sm m-0">
                            <tbody>
                                <?php foreach($detail as $d): ?>
                                <tr>
                                    <td class="py-2 text-muted">Tagihan Kos - <?= $d['bulan'] ?> <?= $d['tahun'] ?></td>
                                    <td class="py-2 text-end fw-bold text-dark">Rp <?= number_format($d['nominal_asal'], 0, ',', '.') ?></td>
                                </tr>
                                <?php if($d['nominal_denda'] > 0): ?>
                                <tr>
                                    <td class="py-2 text-muted">Denda Keterlambatan</td>
                                    <td class="py-2 text-end fw-bold text-danger">Rp <?= number_format($d['nominal_denda'], 0, ',', '.') ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="border-top">
                                <tr>
                                    <th class="pt-3">TOTAL DIBAYARKAN</th>
                                    <th class="pt-3 text-end fs-5 text-success">Rp <?= number_format($pembayaran['total_bayar'], 0, ',', '.') ?></th>
                                </tr>
                                <tr>
                                    <td class="text-muted pb-0">Metode Pembayaran</td>
                                    <td class="text-end fw-bold pb-0"><?= str_replace('VA_', 'Virtual Account ', $pembayaran['metode_bayar']) ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <?php if($pembayaran['status_transaksi'] != 'Success'): ?>
                    <div class="bg-light p-4 rounded text-center mb-4 border border-warning border-opacity-50 mt-4">
                        <?php if($pembayaran['metode_bayar'] == 'QRIS'): ?>
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=DUMMY_QRIS_SIKOS_<?= $pembayaran['kode_transaksi'] ?>" alt="QRIS" class="img-fluid mb-3 rounded shadow-sm border p-2 bg-white" style="max-width: 200px;">
                            <p class="text-muted m-0 small">Scan QRIS di atas menggunakan aplikasi M-Banking atau e-Wallet Anda.</p>
                        <?php else: ?>
                            <span class="d-block text-muted mb-2">Nomor <?= str_replace('VA_', 'Virtual Account ', $pembayaran['metode_bayar']) ?></span>
                            <h2 class="fw-bold m-0 text-primary" style="letter-spacing: 3px;"><?= rand(10000, 99999) ?> <?= rand(10000, 99999) ?></h2>
                        <?php endif; ?>
                    </div>

                    <div class="mt-4 text-center">
                        <p class="small text-danger mb-2"><i class="bi bi-info-circle"></i> Tombol di bawah ini hanya untuk simulasi penyelesaian tugas.</p>
                        <a href="<?= base_url('penghuni/pembayaran/simulate/' . $pembayaran['kode_transaksi']) ?>" class="btn btn-warning fw-bold rounded-pill px-5 shadow-sm">Simulasikan Bayar Berhasil</a>
                    </div>
                
                <?php else: ?>
                    <div class="text-center mt-5 pt-3 border-top">
                        <button id="btn-download" onclick="downloadPDF()" class="btn btn-primary fw-bold px-4 rounded-pill shadow-sm me-2">
                            <i class="bi bi-file-earmark-pdf"></i> Download PDF
                        </button>
                        <a href="<?= base_url('penghuni/tagihan') ?>" class="btn btn-outline-secondary fw-bold px-4 rounded-pill">
                            Kembali
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    function downloadPDF() {
        const element = document.getElementById('area-kwitansi');
        
        // Konfigurasi PDF
        const opt = {
            margin:       [0.5, 0.5, 0.5, 0.5], 
            filename:     'Kwitansi_<?= $pembayaran['kode_transaksi'] ?>.pdf', 
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, useCORS: true },
            jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
        };

        const btn = document.getElementById('btn-download');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Memproses...';
        btn.disabled = true;

        html2pdf().set(opt).from(element).save().then(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
        });
    }
</script>
<?= $this->endSection() ?>