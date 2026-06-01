<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Profil Admin - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4 class="fw-bold mb-4">Pengaturan Profil Admin</h4>
        
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="<?= base_url('admin/profil/update') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" value="<?= $admin['nama_lengkap'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">No. WhatsApp</label>
                            <input type="text" class="form-control" name="no_wa" value="<?= $admin['no_wa'] ?? '' ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username Login</label>
                        <input type="text" class="form-control" name="username" value="<?= $admin['username'] ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Ganti Password (Opsional)</label>
                        <input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                    </div>

                    <button type="submit" class="btn btn-primary fw-bold px-4 w-100">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    <?php if(session()->getFlashdata('pesan')): ?>
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: '<?= session()->getFlashdata('pesan') ?>', showConfirmButton: false, timer: 2000 });
    <?php endif; ?>
</script>
<?= $this->endSection() ?>