<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Kelola Tagihan - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold m-0">Kelola Tagihan Penghuni</h4>
            <div class="d-flex gap-2">
                <form action="<?= base_url('admin/tagihan/bulk-generate') ?>" method="post">
                    <button type="submit" class="btn btn-warning btn-sm fw-bold text-dark btn-magic">
                        <i class="bi bi-magic"></i> Generate Tagihan Bulan Ini
                    </button>
                </form>
                <a href="<?= base_url('admin/tagihan/create') ?>" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg"></i> Buat Manual
                </a>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover m-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">No</th>
                                <th>Penghuni</th>
                                <th>Periode</th>
                                <th>Tagihan</th>
                                <th>Denda</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($tagihan)): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">Belum ada data tagihan.</td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach($tagihan as $t): ?>
                                <tr>
                                    <td class="px-4"><?= $no++ ?></td>
                                    <td>
                                        <strong><?= $t['nama_lengkap'] ?></strong><br>
                                        <small class="text-muted">Kamar: <?= $t['no_kamar'] ?? '-' ?></small>
                                    </td>
                                    <td><?= $t['bulan'] ?> <?= $t['tahun'] ?></td>
                                    <td>Rp <?= number_format($t['nominal_asal'], 0, ',', '.') ?></td>
                                    <td class="<?= $t['nominal_denda'] > 0 ? 'text-danger' : '' ?>">
                                        Rp <?= number_format($t['nominal_denda'], 0, ',', '.') ?>
                                    </td>
                                    <td>
                                        <?php if($t['status_bayar'] == 'Lunas'): ?>
                                            <span class="badge bg-success">Lunas</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Belum Bayar</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($t['status_bayar'] == 'Belum Bayar'): ?>
                                            <a href="<?= base_url('admin/tagihan/lunasi/'.$t['id_tagihan']) ?>" class="btn btn-sm btn-success btn-lunasi">
                                                <i class="bi bi-check-circle"></i> Lunasi
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted small"><i class="bi bi-check2-all"></i> Selesai</span>
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
            showConfirmButton: false, 
            timer: 2500 
        });
    <?php endif; ?>

    <?php if(session()->getFlashdata('pesan_error')): ?>
        Swal.fire({ 
            icon: 'error', 
            title: 'Oops...', 
            text: '<?= session()->getFlashdata('pesan_error') ?>' 
        });
    <?php endif; ?>

    $('.btn-magic').on('click', function(e) {
        e.preventDefault();
        let form = $(this).closest('form');
        Swal.fire({
            title: 'Generate Tagihan?',
            text: "Sistem akan membuat tagihan bulan ini untuk semua penghuni aktif.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Generate!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    $('.btn-lunasi').on('click', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        Swal.fire({
            title: 'Tandai Lunas?',
            text: "Pastikan penghuni sudah membayar tagihan ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Lunas!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
</script>
<?= $this->endSection() ?>