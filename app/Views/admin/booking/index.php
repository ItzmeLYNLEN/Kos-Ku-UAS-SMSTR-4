<?= $this->extend('layout/admin') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold m-0">Kelola Booking Masuk</h4>
    <button type="button" class="btn btn-outline-danger btn-sm fw-bold btn-bersihkan" data-url="<?= base_url('admin/booking/clear-cancelled') ?>">
        <i class="bi bi-trash"></i> Bersihkan Data Batal
    </button>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover m-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="px-4">Calon</th>
                        <th>Kamar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($booking)): ?>
                        <tr><td colspan="4" class="text-center py-4 text-muted">Data kosong.</td></tr>
                    <?php else: ?>
                        <?php foreach($booking as $b): ?>
                        <tr>
                            <td class="px-4">
                                <strong><?= $b['nama_calon'] ?></strong><br>
                                <small class="text-muted"><?= $b['no_wa'] ?></small>
                            </td>
                            <td>No. <?= $b['no_kamar'] ?></td>
                            <td>
                                <?php if($b['status_booking'] == 'Dibatalkan (Penuh)'): ?>
                                    <span class="badge bg-danger text-white">Dibatalkan</span>
                                <?php elseif($b['status_booking'] == 'Paid'): ?>
                                    <span class="badge bg-success">Paid</span>
                                <?php else: ?>
                                    <span class="badge bg-info text-dark"><?= $b['status_booking'] ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($b['status_booking'] == 'Menunggu Persetujuan'): ?>
                                    <a href="<?= base_url('admin/booking/approve/'.$b['id_booking']) ?>" class="btn btn-sm btn-primary">Setujui</a>
                                <?php elseif($b['status_booking'] == 'Paid'): ?>
                                    <a href="<?= base_url('admin/booking/create-account/'.$b['id_booking']) ?>" class="btn btn-sm btn-success">Buat Akun</a>
                                <?php else: ?>
                                    <button type="button" class="btn btn-sm btn-light text-danger btn-hapus" data-url="<?= base_url('admin/booking/delete/'.$b['id_booking']) ?>">
                                        <i class="bi bi-x-circle"></i> Hapus
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if(session()->getFlashdata('pesan')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?= session()->getFlashdata('pesan') ?>',
            timer: 2000,
            showConfirmButton: false
        });
    <?php endif; ?>

    $('.btn-hapus').on('click', function(e) {
        let url = $(this).data('url');
        Swal.fire({
            title: 'Hapus data ini?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });

    $('.btn-bersihkan').on('click', function(e) {
        let url = $(this).data('url');
        Swal.fire({
            title: 'Bersihkan Semua Sampah?',
            text: "Semua data dengan status 'Dibatalkan' akan dihapus permanen.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Sapu Bersih!',
            cancelButtonText: 'Jangan'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
</script>
<?= $this->endSection() ?>