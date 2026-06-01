<?= $this->extend('layout/penghuni') ?>

<?= $this->section('title') ?>
Profil Saya - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4 class="fw-bold mb-4">Profil Saya</h4>
        
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="<?= base_url('penghuni/profil/update') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" value="<?= $profil['nama_lengkap'] ?? '' ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" name="email" value="<?= $pengguna['email'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">No. WhatsApp</label>
                            <input type="text" class="form-control" name="no_hp" value="<?= $profil['no_hp'] ?? '' ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kontak Darurat</label>
                            <input type="text" class="form-control" name="kontak_darurat" value="<?= $profil['kontak_darurat'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kamar Saat Ini</label>
                            <input type="text" class="form-control bg-light" value="No. <?= $profil['no_kamar'] ?? '-' ?> (<?= $profil['nama_tipe'] ?? '-' ?>)" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ganti Password (Opsional)</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan password baru jika ingin ganti">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Update Foto KTP (Opsional)</label>
                        <input type="file" class="form-control" name="foto_ktp" accept="image/*">
                        <?php if(!empty($profil['foto_ktp'])): ?>
                            <div class="mt-2">
                                <img src="<?= base_url('uploads/ktp/' . $profil['foto_ktp']) ?>" alt="KTP" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary fw-bold px-4">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    <?php if(session()->getFlashdata('pesan')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?= session()->getFlashdata('pesan') ?>',
            showConfirmButton: false,
            timer: 2000
        });
    <?php endif; ?>
</script>
<?= $this->endSection() ?>