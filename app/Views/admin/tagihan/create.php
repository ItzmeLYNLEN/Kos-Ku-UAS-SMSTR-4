<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Buat Tagihan - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold">Buat Tagihan Baru</h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('admin/tagihan/store') ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label">Pilih Penghuni</label>
                        <select class="form-select" name="id_pengguna" required>
                            <option value="">-- Pilih Penghuni Aktif --</option>
                            <?php foreach($penghuni as $p): ?>
                                <option value="<?= $p['id_pengguna'] ?>">
                                    <?= $p['nama_lengkap'] ?> (Kamar <?= $p['no_kamar'] ?> - Tipe <?= $p['nama_tipe'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Bulan</label>
                            <select class="form-select" name="bulan" required>
                                <?php 
                                $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                foreach($bulan as $b): 
                                ?>
                                    <option value="<?= $b ?>" <?= (date('n')-1 == array_search($b, $bulan)) ? 'selected' : '' ?>><?= $b ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tahun</label>
                            <input type="number" class="form-control" name="tahun" value="<?= date('Y') ?>" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Nominal Tagihan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="nominal_asal" placeholder="Contoh: 1500000" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('admin/tagihan') ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Tagihan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>