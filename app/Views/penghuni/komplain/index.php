<?= $this->extend('layout/penghuni') ?>

<?= $this->section('title') ?>
Komplain Fasilitas - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-3">Riwayat Komplain Saya</h4>
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold">Daftar Laporan</h6>
                <a href="<?= base_url('penghuni/komplain/create') ?>" class="btn btn-primary btn-sm">+ Buat Laporan</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover m-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">Tanggal</th>
                                <th>Deskripsi Laporan</th>
                                <th>Foto Bukti</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($komplain)): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Belum ada laporan komplain.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($komplain as $k): ?>
                                <tr>
                                    <td class="px-4"><?= date('d M Y, H:i', strtotime($k['created_at'])) ?></td>
                                    <td><?= $k['deskripsi'] ?></td>
                                    <td>
                                        <?php if($k['foto_bukti']): ?>
                                            <a href="<?= base_url('uploads/komplain/' . $k['foto_bukti']) ?>" target="_blank" class="btn btn-outline-secondary btn-sm">Lihat Foto</a>
                                        <?php else: ?>
                                            <span class="text-muted small">Tidak ada foto</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($k['status_perbaikan'] == 'Pending'): ?>
                                            <span class="badge bg-danger">Pending</span>
                                        <?php elseif($k['status_perbaikan'] == 'Proses'): ?>
                                            <span class="badge bg-warning text-dark">Diproses</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Selesai</span>
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
<script>
    <?php if(session()->getFlashdata('pesan')): ?>
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: '<?= session()->getFlashdata('pesan') ?>', showConfirmButton: false, timer: 2000 });
    <?php endif; ?>
</script>
<?= $this->endSection() ?>