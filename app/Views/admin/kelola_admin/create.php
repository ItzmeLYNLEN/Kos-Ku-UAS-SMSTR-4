<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Tambah Admin - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4 class="fw-bold mb-4">Tambah Admin Baru</h4>
        
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="<?= base_url('admin/kelola-admin/store') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" required placeholder="Cth: Budi Santoso">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">No. WhatsApp</label>
                            <input type="text" class="form-control" name="no_wa" placeholder="0812xxxxxx">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">Username Login</label>
                            <input type="text" class="form-control" name="username" required placeholder="Cth: admin_budi">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control" name="password" required placeholder="Masukkan password kuat">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between border-top pt-4">
                        <a href="<?= base_url('admin/kelola-admin') ?>" class="btn btn-outline-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-primary fw-bold px-4">Simpan Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    <?php if(session()->getFlashdata('pesan_error')): ?>
        Swal.fire({ icon: 'error', title: 'Gagal!', text: '<?= session()->getFlashdata('pesan_error') ?>' });
    <?php endif; ?>
</script>
<?= $this->endSection() ?>