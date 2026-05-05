<?= $this->extend('layout/penghuni') ?>

<?= $this->section('title') ?>
Buat Laporan Komplain - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold">Form Laporan Kerusakan</h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('penghuni/komplain/store') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Masalah</label>
                        <textarea class="form-control" name="deskripsi" rows="4" placeholder="Contoh: AC kamar bocor dan meneteskan air..." required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Foto Bukti (Opsional)</label>
                        <input class="form-control" type="file" name="foto_bukti" accept="image/png, image/jpeg, image/jpg">
                        <div class="form-text">Format yang diizinkan: JPG, JPEG, PNG.</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('penghuni/komplain') ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Kirim Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>