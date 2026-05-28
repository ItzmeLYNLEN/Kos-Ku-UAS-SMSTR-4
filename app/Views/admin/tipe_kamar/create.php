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
                <form action="<?= base_url('admin/tipe-kamar/store') ?>" method="post" enctype="multipart/form-data">
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nama_tipe" class="form-label">Nama Tipe Kamar</label>
                            <input type="text" class="form-control" id="nama_tipe" name="nama_tipe" placeholder="Contoh: Standar A" required>
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0">
                            <label for="harga_dasar" class="form-label">Harga Dasar (Bulan)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="harga_dasar" name="harga_dasar" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="fasilitas" class="form-label">Fasilitas Singkat</label>
                        <textarea class="form-control" id="fasilitas" name="fasilitas" rows="2" placeholder="Pisahkan dengan koma. Cth: AC, Kasur, Lemari" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="form-label">Deskripsi Lengkap Kamar</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Tuliskan deskripsi yang menarik untuk landing page..."></textarea>
                    </div>

                    <h6 class="fw-bold border-bottom pb-2 mb-3">Foto Kamar (Opsional)</h6>
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label small">Foto Utama</label>
                            <input type="file" class="form-control form-control-sm" name="foto_1" accept="image/*">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small">Foto Tambahan 1</label>
                            <input type="file" class="form-control form-control-sm" name="foto_2" accept="image/*">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small">Foto Tambahan 2</label>
                            <input type="file" class="form-control form-control-sm" name="foto_3" accept="image/*">
                        </div>
                        <div class="form-text text-muted mt-2">Format disarankan: JPG/PNG landscape. Maksimal 2MB per foto.</div>
                    </div>

                    <div class="d-flex justify-content-between border-top pt-3">
                        <a href="<?= base_url('admin/tipe-kamar') ?>" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary fw-bold">Simpan Tipe Kamar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>