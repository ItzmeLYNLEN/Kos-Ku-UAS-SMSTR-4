<?= $this->extend('layout/penghuni') ?>

<?= $this->section('title') ?>
Dashboard Penghuni - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <h3 class="fw-bold m-0">Dashboard Penghuni</h3>
    <p class="text-muted">Selamat datang kembali, <?= session()->get('username') ?>! Di sini Anda bisa memantau tagihan dan melaporkan keluhan kos.</p>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white border-0 shadow-sm p-4 h-100 rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="m-0 opacity-75 mb-2">Tagihan Bulanan</h6>
                    <h4 class="fw-bold m-0">Riwayat Tagihan</h4>
                </div>
                <i class="bi bi-receipt fs-1 opacity-50"></i>
            </div>
            <a href="<?= base_url('penghuni/tagihan') ?>" class="text-white text-decoration-none mt-3 fw-bold">Lihat Detail <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card bg-success text-white border-0 shadow-sm p-4 h-100 rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="m-0 opacity-75 mb-2">Belum Lunas?</h6>
                    <h4 class="fw-bold m-0">Bayar Tagihan</h4>
                </div>
                <i class="bi bi-wallet2 fs-1 opacity-50"></i>
            </div>
            <a href="<?= base_url('penghuni/pembayaran') ?>" class="text-white text-decoration-none mt-3 fw-bold">Lihat Detail <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-warning text-dark border-0 shadow-sm p-4 h-100 rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="m-0 opacity-75 mb-2">Punya Keluhan?</h6>
                    <h4 class="fw-bold m-0">Buat Komplain</h4>
                </div>
                <i class="bi bi-chat-square-text fs-1 opacity-50"></i>
            </div>
            <a href="<?= base_url('penghuni/komplain') ?>" class="text-dark text-decoration-none mt-3 fw-bold">Lihat Detail <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>