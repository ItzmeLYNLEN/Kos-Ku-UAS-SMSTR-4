<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Dashboard Admin - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h4 class="fw-bold">Selamat Datang, Admin!</h4>
                <p class="text-muted mb-0">Gunakan menu navigasi di atas untuk mengelola kamar, tagihan bulanan, dan data penghuni.</p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>