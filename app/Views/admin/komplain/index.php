<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Kelola Komplain - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-3">Laporan Komplain Penghuni</h4>
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold">Daftar Komplain</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover m-0 align-middle w-100">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">Tanggal</th>
                                <th>Pelapor (Kamar)</th>
                                <th>Deskripsi</th>
                                <th>Foto</th>
                                <th class="text-center">Update Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($komplain as $k): ?>
                            <tr>
                                <td class="px-4"><?= date('d M Y', strtotime($k['created_at'])) ?></td>
                                <td class="fw-bold">
                                    <?= $k['nama_lengkap'] ?> <br>
                                    <span class="badge bg-secondary">Kamar <?= $k['no_kamar'] ?></span>
                                </td>
                                <td><?= $k['deskripsi'] ?></td>
                                <td>
                                    <?php if($k['foto_bukti']): ?>
                                        <a href="<?= base_url('uploads/komplain/' . $k['foto_bukti']) ?>" target="_blank" class="btn btn-outline-secondary btn-sm">Lihat</a>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 text-center">
                                    <form action="<?= base_url('admin/komplain/update/' . $k['id_komplain']) ?>" method="post" class="d-flex align-items-center gap-2">
                                        <select name="status_perbaikan" class="form-select form-select-sm">
                                            <option value="Pending" <?= ($k['status_perbaikan'] == 'Pending') ? 'selected' : '' ?>>Pending</option>
                                            <option value="Proses" <?= ($k['status_perbaikan'] == 'Proses') ? 'selected' : '' ?>>Proses</option>
                                            <option value="Selesai" <?= ($k['status_perbaikan'] == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                    </form>
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
</script>
<?= $this->endSection() ?>