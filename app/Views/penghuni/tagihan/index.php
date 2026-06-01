<?= $this->extend('layout/penghuni') ?>

<?= $this->section('title') ?>
Tagihan Saya - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php 
    $tagihan_aktif = [];
    $tagihan_lunas = [];
    foreach($tagihan as $t) {
        if($t['status_bayar'] == 'Lunas') {
            $tagihan_lunas[] = $t;
        } else {
            $tagihan_aktif[] = $t;
        }
    }
?>

<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-4">Informasi Tagihan</h4>
        
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white pt-3 pb-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tagihanTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold text-dark" id="aktif-tab" data-bs-toggle="tab" data-bs-target="#aktif" type="button" role="tab">
                            <i class="bi bi-exclamation-circle text-danger me-1"></i> Belum Dibayar
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold text-dark" id="lunas-tab" data-bs-toggle="tab" data-bs-target="#lunas" type="button" role="tab">
                            <i class="bi bi-check2-circle text-success me-1"></i> Riwayat Lunas
                        </button>
                    </li>
                </ul>
            </div>
            
            <div class="card-body p-0">
                <div class="tab-content" id="tagihanTabsContent">
                    
                    <div class="tab-pane fade show active" id="aktif" role="tabpanel">
                        <div class="table-responsive p-3">
                            <table class="table table-hover m-0 w-100 tabel-data">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4">Periode</th>
                                        <th>Tagihan Dasar</th>
                                        <th>Denda</th>
                                        <th>Total Harus Dibayar</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($tagihan_aktif as $t): ?>
                                    <tr>
                                        <td class="px-4 fw-bold"><?= $t['bulan'] ?> <?= $t['tahun'] ?></td>
                                        <td>Rp <?= number_format($t['nominal_asal'], 0, ',', '.') ?></td>
                                        <td class="<?= $t['nominal_denda'] > 0 ? 'text-danger' : '' ?>">Rp <?= number_format($t['nominal_denda'], 0, ',', '.') ?></td>
                                        <td class="fw-bold text-primary fs-6">Rp <?= number_format($t['nominal_asal'] + $t['nominal_denda'], 0, ',', '.') ?></td>
                                        <td><span class="badge bg-danger">Belum Bayar</span></td>
                                        <td>
                                            <a href="<?= base_url('penghuni/pembayaran') ?>" class="btn btn-sm btn-primary fw-bold">Bayar Sekarang</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="lunas" role="tabpanel">
                        <div class="table-responsive p-3">
                            <table class="table table-hover m-0 w-100 tabel-data">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4">Periode</th>
                                        <th>Total Dibayar</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Metode</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($tagihan_lunas as $t): ?>
                                    <tr>
                                        <td class="px-4 fw-bold text-muted"><?= $t['bulan'] ?> <?= $t['tahun'] ?></td>
                                        <td class="fw-bold text-success">Rp <?= number_format($t['nominal_asal'] + $t['nominal_denda'], 0, ',', '.') ?></td>
                                        <td>
                                            <i class="bi bi-calendar-check text-muted me-1"></i> 
                                            <?= (!empty($t['updated_at'])) ? date('d M Y', strtotime($t['updated_at'])) : '-' ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border"><i class="bi bi-credit-card"></i> <?= $t['metode_bayar'] ?? 'Transfer' ?></span>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('penghuni/pembayaran/invoice/'.$t['id_tagihan']) ?>" class="btn btn-sm btn-outline-secondary">
                                                <i class="bi bi-printer"></i> Kwitansi
                                            </a>
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
<script>
    <?php if(session()->getFlashdata('pesan_error')): ?>
        Swal.fire({ 
            icon: 'error', 
            title: 'Tidak Ada Kwitansi', 
            text: '<?= session()->getFlashdata('pesan_error') ?>' 
        });
    <?php endif; ?>

    $(document).ready(function() {
        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
        });
    });
</script>
<?= $this->endSection() ?>