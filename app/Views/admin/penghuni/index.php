<?= $this->extend('layout/admin') ?>

<?= $this->section('title') ?>
Manajemen Penghuni - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-3">Data Penghuni Aktif</h4>
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold">Daftar Penghuni</h6>
                <a href="<?= base_url('admin/penghuni/create') ?>" class="btn btn-primary btn-sm">+ Tambah Penghuni</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover m-0 align-middle w-100">
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
                                    <button type="button" class="btn btn-info text-white btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal<?= $p['id_profil_penghuni'] ?>">
                                        <i class="bi bi-eye"></i> Detail
                                    </button>
                                    <a href="<?= base_url('admin/penghuni/delete/' . $p['id_profil_penghuni']) ?>" class="btn btn-danger btn-sm tombol-hapus"><i class="bi bi-box-arrow-right"></i> Keluar</a>
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
<?php if(!empty($penghuni)): ?>
    <?php foreach($penghuni as $p): ?>
    <div class="modal fade" id="detailModal<?= $p['id_profil_penghuni'] ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $p['id_profil_penghuni'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light border-0">
                    <h5 class="modal-title fw-bold" id="detailModalLabel<?= $p['id_profil_penghuni'] ?>">Detail Lengkap Penghuni</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless table-sm mb-3">
                        <tr>
                            <td class="text-muted" width="140">Nama Lengkap</td>
                            <td class="fw-bold">: <?= $p['nama_lengkap'] ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Kamar</td>
                            <td>: No. <?= $p['no_kamar'] ?> (<?= $p['nama_tipe'] ?>)</td>
                        </tr>
                        <tr>
                            <td class="text-muted">No. WhatsApp</td>
                            <td>: <a href="https://wa.me/<?= preg_replace('/^0/', '62', $p['no_wa']) ?>" target="_blank" class="text-decoration-none text-success fw-bold"><i class="bi bi-whatsapp"></i> <?= $p['no_wa'] ?></a></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email</td>
                            <td>: <?= !empty($p['email']) ? $p['email'] : '-' ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Kontak Darurat</td>
                            <td>: <?= !empty($p['kontak_darurat']) ? $p['kontak_darurat'] : '<span class="text-danger small">Belum diisi</span>' ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tgl Bergabung</td>
                            <td>: <?= (!empty($p['created_at']) && $p['created_at'] != '0000-00-00 00:00:00') ? date('d M Y', strtotime($p['created_at'])) : '-' ?></td>
                        </tr>
                    </table>
                    
                    <div class="text-center">
                        <span class="d-block text-muted mb-2 small text-start">Foto KTP:</span>
                        <?php if(!empty($p['foto_ktp'])): ?>
                            <img src="<?= base_url('uploads/ktp/' . $p['foto_ktp']) ?>" alt="KTP <?= $p['nama_lengkap'] ?>" class="img-fluid rounded border shadow-sm" style="max-height: 200px; object-fit: contain;">
                        <?php else: ?>
                            <div class="p-3 border rounded bg-light text-danger small">
                                <i class="bi bi-exclamation-triangle"></i> Penghuni ini belum menyelesaikan proses Onboarding.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>

<script>
    <?php if(session()->getFlashdata('pesan')): ?>
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: '<?= session()->getFlashdata('pesan') ?>', showConfirmButton: false, timer: 2000 });
    <?php endif; ?>

    document.querySelectorAll('.tombol-hapus').forEach(tombol => {
        tombol.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Keluarkan Penghuni?',
                text: "Akun akan dihapus permanen dan status kamar kembali Tersedia.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Keluar!',
                cancelButtonText: 'Batal'
            }).then((result) => { if (result.isConfirmed) window.location.href = this.href; });
        });
    });
</script>
<?= $this->endSection() ?>