<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Dashboard - Admin Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <h3 class="fw-bold m-0">Dashboard Admin</h3>
    <p class="text-muted">Selamat datang kembali, <?= session()->get('username') ?>!</p>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white border-0 shadow-sm p-4 h-100 rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="m-0 opacity-75 mb-2">Kelola Kamar</h6>
                    <h4 class="fw-bold m-0">Data Kamar</h4>
                </div>
                <i class="bi bi-door-closed fs-1 opacity-50"></i>
            </div>
            <a href="<?= base_url('admin/kamar') ?>" class="text-white text-decoration-none mt-3 fw-bold">Lihat Detail <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card bg-success text-white border-0 shadow-sm p-4 h-100 rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="m-0 opacity-75 mb-2">Penghuni Aktif</h6>
                    <h4 class="fw-bold m-0">Data Penghuni</h4>
                </div>
                <i class="bi bi-people fs-1 opacity-50"></i>
            </div>
            <a href="<?= base_url('admin/penghuni') ?>" class="text-white text-decoration-none mt-3 fw-bold">Lihat Detail <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-warning text-dark border-0 shadow-sm p-4 h-100 rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="m-0 opacity-75 mb-2">Booking Masuk</h6>
                    <h4 class="fw-bold m-0">Cek Booking</h4>
                </div>
                <i class="bi bi-journal-bookmark fs-1 opacity-50"></i>
            </div>
            <a href="<?= base_url('admin/booking') ?>" class="text-dark text-decoration-none mt-3 fw-bold">Lihat Detail <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>