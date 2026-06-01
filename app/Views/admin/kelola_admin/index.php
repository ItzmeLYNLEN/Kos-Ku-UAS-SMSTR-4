<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Kelola Admin - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-3">Kelola Akun Admin</h4>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold">Daftar Administrator</h6>
                <a href="<?= base_url('admin/kelola-admin/create') ?>" class="btn btn-primary btn-sm">+ Tambah Admin</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped m-0 w-100">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="py-3">Nama Lengkap</th>
                                <th class="py-3">Username</th>
                                <th class="py-3">No. WA</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($admins as $a): ?>
                            <tr>
                                <td class="px-4 py-3"><?= $i++ ?></td>
                                <td class="py-3 fw-semibold"><?= $a['nama_lengkap'] ?? '<span class="text-muted fst-italic">Belum diatur</span>' ?></td>
                                <td class="py-3 text-primary">@<?= $a['username'] ?></td>
                                <td class="py-3"><?= $a['no_wa'] ?? '-' ?></td>
                                <td class="px-4 py-3 text-center">
                                    <?php if($a['id_pengguna'] != session()->get('id_pengguna')): ?>
                                        <a href="<?= base_url('admin/kelola-admin/delete/' . $a['id_pengguna']) ?>" class="btn btn-danger btn-sm tombol-hapus">Hapus</a>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Anda (Aktif)</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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
    <?php if(session()->getFlashdata('pesan_error')): ?>
        Swal.fire({ icon: 'error', title: 'Gagal!', text: '<?= session()->getFlashdata('pesan_error') ?>' });
    <?php endif; ?>

    const tombolHapus = document.querySelectorAll('.tombol-hapus');
    tombolHapus.forEach(tombol => {
        tombol.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            Swal.fire({ title: 'Hapus Admin?', text: "Semua data profil admin ini akan terhapus!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#3085d6', confirmButtonText: 'Ya, hapus!' }).then((result) => {
                if (result.isConfirmed) { window.location.href = href; }
            });
        });
    });
</script>
<?= $this->endSection() ?>