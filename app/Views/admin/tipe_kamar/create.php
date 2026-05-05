<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Tambah Tipe Kamar - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold">Tambah Tipe Kamar</h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('admin/tipe-kamar/store') ?>" method="post">
                    <div class="mb-3">
                        <label for="nama_tipe" class="form-label">Nama Tipe Kamar</label>
                        <input type="text" class="form-control" id="nama_tipe" name="nama_tipe" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_dasar" class="form-label">Harga Dasar (Bulan)</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="harga_dasar" name="harga_dasar" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="fasilitas" class="form-label">Fasilitas</label>
                        <textarea class="form-control" id="fasilitas" name="fasilitas" rows="3" required></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('admin/tipe-kamar') ?>" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>