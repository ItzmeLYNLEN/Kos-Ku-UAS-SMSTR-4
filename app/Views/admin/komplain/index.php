<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Kelola Komplain - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
    $pending = array_filter($komplain, function($k) { return $k['status_perbaikan'] == 'Pending'; });
    $proses = array_filter($komplain, function($k) { return $k['status_perbaikan'] == 'Proses'; });
    $selesai = array_filter($komplain, function($k) { return $k['status_perbaikan'] == 'Selesai'; });
?>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold m-0">Laporan Komplain Penghuni</h4>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white pt-3 pb-0 border-bottom-0">
                <ul class="nav nav-tabs border-bottom-0" id="komplainTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold text-danger" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">
                            Belum Diproses <span class="badge bg-danger ms-1"><?= count($pending) ?></span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold text-warning" id="proses-tab" data-bs-toggle="tab" data-bs-target="#proses" type="button" role="tab">
                            Sedang Diproses <span class="badge bg-warning text-dark ms-1"><?= count($proses) ?></span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold text-success" id="selesai-tab" data-bs-toggle="tab" data-bs-target="#selesai" type="button" role="tab">
                            Sudah Selesai <span class="badge bg-success ms-1"><?= count($selesai) ?></span>
                        </button>
                    </li>
                </ul>
            </div>
            
            <div class="card-body p-0 border-top">
                <div class="tab-content" id="komplainTabsContent">
                    <div class="tab-pane fade show active" id="pending" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover m-0 align-middle w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4">Tanggal</th>
                                        <th>Pelapor (Kamar)</th>
                                        <th>Deskripsi</th>
                                        <th>Foto</th>
                                        <th class="text-center">Aksi / Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($pending as $k): ?>
                                    <tr>
                                        <td class="px-4"><?= date('d M Y', strtotime($k['created_at'])) ?></td>
                                        <td>
                                            <strong><?= $k['nama_lengkap'] ?></strong><br>
                                            <small class="text-muted">Kamar: <?= $k['no_kamar'] ?></small>
                                        </td>
                                        <td><?= nl2br(htmlspecialchars($k['deskripsi'])) ?></td>
                                        <td>
                                            <?php if($k['foto_bukti']): ?>
                                                <a href="<?= base_url('uploads/komplain/' . $k['foto_bukti']) ?>" target="_blank" class="btn btn-outline-secondary btn-sm">Lihat</a>
                                            <?php else: ?>
                                                <span class="text-muted small">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-4 text-center">
                                            <form action="<?= base_url('admin/komplain/update/' . $k['id_komplain']) ?>" method="post" class="form-update-status d-flex align-items-center justify-content-center gap-2">
                                                <select name="status_perbaikan" class="form-select form-select-sm" style="width: auto;">
                                                    <option value="Pending" selected>Pending</option>
                                                    <option value="Proses">Proses</option>
                                                    <option value="Selesai">Selesai</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm btn-simpan">Simpan</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="proses" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover m-0 align-middle w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4">Tanggal</th>
                                        <th>Pelapor (Kamar)</th>
                                        <th>Deskripsi</th>
                                        <th>Foto</th>
                                        <th class="text-center">Aksi / Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($proses as $k): ?>
                                    <tr>
                                        <td class="px-4"><?= date('d M Y', strtotime($k['created_at'])) ?></td>
                                        <td>
                                            <strong><?= $k['nama_lengkap'] ?></strong><br>
                                            <small class="text-muted">Kamar: <?= $k['no_kamar'] ?></small>
                                        </td>
                                        <td><?= nl2br(htmlspecialchars($k['deskripsi'])) ?></td>
                                        <td>
                                            <?php if($k['foto_bukti']): ?>
                                                <a href="<?= base_url('uploads/komplain/' . $k['foto_bukti']) ?>" target="_blank" class="btn btn-outline-secondary btn-sm">Lihat</a>
                                            <?php else: ?>
                                                <span class="text-muted small">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-4 text-center">
                                            <form action="<?= base_url('admin/komplain/update/' . $k['id_komplain']) ?>" method="post" class="form-update-status d-flex align-items-center justify-content-center gap-2">
                                                <select name="status_perbaikan" class="form-select form-select-sm" style="width: auto;">
                                                    <option value="Pending">Pending</option>
                                                    <option value="Proses" selected>Proses</option>
                                                    <option value="Selesai">Selesai</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm btn-simpan">Simpan</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="selesai" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover m-0 align-middle w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4">Tanggal</th>
                                        <th>Pelapor (Kamar)</th>
                                        <th>Deskripsi</th>
                                        <th>Foto</th>
                                        <th class="text-center">Aksi / Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($selesai as $k): ?>
                                    <tr>
                                        <td class="px-4"><?= date('d M Y', strtotime($k['created_at'])) ?></td>
                                        <td>
                                            <strong><?= $k['nama_lengkap'] ?></strong><br>
                                            <small class="text-muted">Kamar: <?= $k['no_kamar'] ?></small>
                                        </td>
                                        <td><?= nl2br(htmlspecialchars($k['deskripsi'])) ?></td>
                                        <td>
                                            <?php if($k['foto_bukti']): ?>
                                                <a href="<?= base_url('uploads/komplain/' . $k['foto_bukti']) ?>" target="_blank" class="btn btn-outline-secondary btn-sm">Lihat</a>
                                            <?php else: ?>
                                                <span class="text-muted small">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-4 text-center">
                                            <form action="<?= base_url('admin/komplain/update/' . $k['id_komplain']) ?>" method="post" class="form-update-status d-flex align-items-center justify-content-center gap-2">
                                                <select name="status_perbaikan" class="form-select form-select-sm" style="width: auto;">
                                                    <option value="Pending">Pending</option>
                                                    <option value="Proses">Proses</option>
                                                    <option value="Selesai" selected>Selesai</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm btn-simpan">Simpan</button>
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
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if(session()->getFlashdata('pesan')): ?>
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: '<?= session()->getFlashdata('pesan') ?>', showConfirmButton: false, timer: 2000 });
    <?php endif; ?>

    $('.btn-simpan').on('click', function(e) {
        e.preventDefault();
        let form = $(this).closest('form');
        Swal.fire({
            title: 'Update Status Komplain?',
            text: "Status perbaikan akan diperbarui ke sistem.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => { 
            if (result.isConfirmed) form.submit(); 
        });
    });
</script>
<?= $this->endSection() ?>