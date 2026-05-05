<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Edit Kamar - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold">Edit Data Kamar</h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('admin/kamar/update/' . $kamar['id_kamar']) ?>" method="post">
                    <div class="mb-3">
                        <label for="no_kamar" class="form-label">Nomor Kamar</label>
                        <input type="text" class="form-control" id="no_kamar" name="no_kamar" value="<?= $kamar['no_kamar'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_tipe" class="form-label">Tipe Kamar</label>
                        <select class="form-select" id="id_tipe" name="id_tipe" required>
                            <?php foreach($tipe_kamar as $t): ?>
                                <option value="<?= $t['id_tipe'] ?>" <?= ($kamar['id_tipe'] == $t['id_tipe']) ? 'selected' : '' ?>>
                                    <?= $t['nama_tipe'] ?> (Rp <?= number_format($t['harga_dasar'], 0, ',', '.') ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="status_kamar" class="form-label">Status Kamar</label>
                        <select class="form-select" id="status_kamar" name="status_kamar" required>
                            <option value="Tersedia" <?= ($kamar['status_kamar'] == 'Tersedia') ? 'selected' : '' ?>>Tersedia</option>
                            <option value="Terisi" <?= ($kamar['status_kamar'] == 'Terisi') ? 'selected' : '' ?>>Terisi</option>
                            <option value="Perbaikan" <?= ($kamar['status_kamar'] == 'Perbaikan') ? 'selected' : '' ?>>Perbaikan</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('admin/kamar') ?>" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>