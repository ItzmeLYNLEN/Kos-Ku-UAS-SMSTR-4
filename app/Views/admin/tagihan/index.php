<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Data Tagihan - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-3">Kelola Tagihan Bulanan</h4>
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold">Daftar Tagihan</h6>
                <a href="<?= base_url('admin/tagihan/create') ?>" class="btn btn-primary btn-sm">+ Buat Tagihan</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover m-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">Periode</th>
                                <th>Nama Penghuni</th>
                                <th>No. Kamar</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tagihan as $t): ?>
                            <tr>
                                <td class="px-4 fw-bold"><?= $t['bulan'] ?> <?= $t['tahun'] ?></td>
                                <td><?= $t['nama_lengkap'] ?></td>
                                <td><?= $t['no_kamar'] ?></td>
                                <td>Rp <?= number_format($t['nominal_asal'], 0, ',', '.') ?></td>
                                <td>
                                    <?php if($t['status_bayar'] == 'Lunas'): ?>
                                        <span class="badge bg-success">Lunas</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Belum Bayar</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if($t['status_bayar'] != 'Lunas'): ?>
                                        <a href="<?= base_url('admin/tagihan/lunasi/' . $t['id_tagihan']) ?>" class="btn btn-success btn-sm tombol-lunasi">Tandai Lunas</a>
                                    <?php else: ?>
                                        <span class="text-muted small">Selesai</span>
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

    document.querySelectorAll('.tombol-lunasi').forEach(tombol => {
        tombol.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Tandai Lunas?',
                text: "Pastikan penghuni sudah membayar tagihan ini.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                confirmButtonText: 'Ya, Lunas!'
            }).then((result) => { if (result.isConfirmed) window.location.href = this.href; });
        });
    });
</script>
<?= $this->endSection() ?>