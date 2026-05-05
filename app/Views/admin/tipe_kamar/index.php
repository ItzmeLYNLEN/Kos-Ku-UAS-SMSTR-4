<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Kelola Tipe Kamar - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-3">Data Tipe Kamar</h4>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold">Daftar Tipe Kamar</h6>
                <a href="<?= base_url('admin/tipe-kamar/create') ?>" class="btn btn-primary btn-sm">+ Tambah Data</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless table-striped m-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="py-3">Nama Tipe</th>
                                <th class="py-3">Harga Dasar</th>
                                <th class="py-3">Fasilitas</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($tipe_kamar as $t): ?>
                            <tr>
                                <td class="px-4 py-3"><?= $i++ ?></td>
                                <td class="py-3 fw-semibold"><?= $t['nama_tipe'] ?></td>
                                <td class="py-3">Rp <?= number_format($t['harga_dasar'], 0, ',', '.') ?></td>
                                <td class="py-3"><?= $t['fasilitas'] ?></td>
                                <td class="px-4 py-3 text-center">
                                    <a href="<?= base_url('admin/tipe-kamar/edit/' . $t['id_tipe']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('admin/tipe-kamar/delete/' . $t['id_tipe']) ?>" class="btn btn-danger btn-sm tombol-hapus">Hapus</a>
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