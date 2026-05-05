<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Manajemen Penghuni - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-3">Data Penghuni Aktif</h4>
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold">Daftar Penghuni</h6>
                <a href="<?= base_url('admin/penghuni/create') ?>" class="btn btn-primary btn-sm">+ Tambah Penghuni</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover m-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">Nama Lengkap</th>
                                <th>No. Kamar</th>
                                <th>Tipe</th>
                                <th>WhatsApp (Username)</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($penghuni as $p): ?>
                            <tr>
                                <td class="px-4 fw-bold"><?= $p['nama_lengkap'] ?></td>
                                <td><?= $p['no_kamar'] ?></td>
                                <td><?= $p['nama_tipe'] ?></td>
                                <td><?= $p['no_wa'] ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('admin/penghuni/delete/' . $p['id_profil_penghuni']) ?>" class="btn btn-danger btn-sm tombol-hapus">Hapus / Keluar</a>
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

    document.querySelectorAll('.tombol-hapus').forEach(tombol => {
        tombol.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Hapus Penghuni?',
                text: "Akun akan dihapus dan status kamar kembali Tersedia.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => { if (result.isConfirmed) window.location.href = this.href; });
        });
    });
</script>
<?= $this->endSection() ?>