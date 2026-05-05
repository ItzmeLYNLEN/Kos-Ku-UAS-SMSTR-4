<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Kelola Data Kamar - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-3">Data Kamar</h4>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold">Daftar Kamar</h6>
                <a href="<?= base_url('admin/kamar/create') ?>" class="btn btn-primary btn-sm">+ Tambah Data</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless table-striped m-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="py-3">No Kamar</th>
                                <th class="py-3">Tipe Kamar</th>
                                <th class="py-3">Harga Dasar</th>
                                <th class="py-3">Status</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($kamar as $k): ?>
                            <tr>
                                <td class="px-4 py-3"><?= $i++ ?></td>
                                <td class="py-3 fw-semibold"><?= $k['no_kamar'] ?></td>
                                <td class="py-3"><?= $k['nama_tipe'] ?></td>
                                <td class="py-3">Rp <?= number_format($k['harga_dasar'], 0, ',', '.') ?></td>
                                <td class="py-3">
                                    <?php if($k['status_kamar'] == 'Tersedia'): ?>
                                        <span class="badge bg-success">Tersedia</span>
                                    <?php elseif($k['status_kamar'] == 'Terisi'): ?>
                                        <span class="badge bg-primary">Terisi</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Perbaikan</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="<?= base_url('admin/kamar/edit/' . $k['id_kamar']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('admin/kamar/delete/' . $k['id_kamar']) ?>" class="btn btn-danger btn-sm tombol-hapus">Hapus</a>
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
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?= session()->getFlashdata('pesan') ?>',
            showConfirmButton: false,
            timer: 2000
        });
    <?php endif; ?>

    const tombolHapus = document.querySelectorAll('.tombol-hapus');
    tombolHapus.forEach(tombol => {
        tombol.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>