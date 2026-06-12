<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Tambah Penghuni Baru - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold">Form Penghuni Baru</h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('admin/penghuni/store') ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor WhatsApp (Akan menjadi Username)</label>
                        <input type="number" class="form-control" name="no_wa" placeholder="0812..." required>
                        <div class="form-text text-muted">Jika memasukkan No WA penghuni lama, sistem otomatis akan menambahkan kamar ke akun mereka tanpa mereset password.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Default</label>
                        <input type="text" class="form-control" name="password" value="anak_kos_<?= date('Y') ?>" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Pilih Kamar (Hanya Kamar Tersedia)</label>
                        <select class="form-select" name="id_kamar" required>
                            <option value="">-- Pilih Kamar --</option>
                            <?php foreach($kamar_tersedia as $k): ?>
                                <option value="<?= $k['id_kamar'] ?>">Kamar No. <?= $k['no_kamar'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('admin/penghuni') ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan & Buat Akun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>