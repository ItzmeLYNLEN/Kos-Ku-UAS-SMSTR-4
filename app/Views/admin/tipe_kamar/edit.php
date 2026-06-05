<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Edit Tipe Kamar - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold">Edit Tipe Kamar</h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('admin/tipe-kamar/update/' . $tipe['id_tipe']) ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama_tipe" class="form-label">Nama Tipe Kamar</label>
                        <input type="text" class="form-control" id="nama_tipe" name="nama_tipe" value="<?= $tipe['nama_tipe'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_dasar" class="form-label">Harga Dasar (Bulan)</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="harga_dasar" name="harga_dasar" value="<?= $tipe['harga_dasar'] ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= $tipe['deskripsi'] ?? '' ?></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="fasilitas" class="form-label">Fasilitas</label>
                        <textarea class="form-control" id="fasilitas" name="fasilitas" rows="3" required><?= $tipe['fasilitas'] ?></textarea>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-bold">Foto Kamar (Opsional)</label>
                        <div class="form-text mb-3">Biarkan kosong jika tidak ingin mengubah foto.</div>
                    </div>
                    <div class="row mb-4">
                        <?php for($i=1; $i<=3; $i++): ?>
                        <div class="col-md-4 mb-3">
                            <label class="form-label small fw-semibold">Foto <?= $i ?> <?= $i == 1 ? '(Utama)' : '' ?></label>
                            <?php if(!empty($tipe['foto_' . $i])): ?>
                                <img src="<?= base_url('uploads/kamar/' . $tipe['foto_' . $i]) ?>" class="img-thumbnail d-block w-100 object-fit-cover mb-2" style="height: 150px;" alt="Foto <?= $i ?>">
                            <?php else: ?>
                                <div class="bg-light border text-center text-muted mb-2 d-flex align-items-center justify-content-center w-100 rounded" style="height: 150px;">
                                    Belum ada foto
                                </div>
                            <?php endif; ?>
                            <input type="file" class="form-control form-control-sm" name="foto_<?= $i ?>" accept="image/*">
                        </div>
                        <?php endfor; ?>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('admin/tipe-kamar') ?>" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>