<?= $this->extend('layout/admin') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-3">Laporan Pembayaran</h4>
        
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form action="<?= base_url('admin/laporan') ?>" method="get" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Pilih Bulan</label>
                        <select name="bulan" class="form-select">
                            <?php foreach($list_bulan as $b): ?>
                                <option value="<?= $b ?>" <?= ($filter_bulan == $b) ? 'selected' : '' ?>><?= $b ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Tahun</label>
                        <input type="number" name="tahun" class="form-select" value="<?= $filter_tahun ?>">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary px-4"><i class="bi bi-search"></i> Filter</button>
                        <a href="<?= base_url("admin/laporan/export?bulan=$filter_bulan&tahun=$filter_tahun") ?>" class="btn btn-success px-4">
                            <i class="bi bi-file-earmark-excel"></i> Export Excel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover m-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">No</th>
                                <th>Nama Penghuni</th>
                                <th>No Kamar</th>
                                <th>Bulan Tagihan</th>
                                <th>Tanggal Bayar</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($laporan)): ?>
                                <tr><td colspan="6" class="text-center py-4 text-muted">Tidak ada data pembayaran untuk periode ini.</td></tr>
                            <?php else: ?>
                                <?php $no = 1; $total = 0; foreach($laporan as $l): ?>
                                <?php 
                                    // Hitung nominal + denda jika ada
                                    $total_bayar = $l['nominal_asal'] + $l['nominal_denda']; 
                                ?>
                                <tr>
                                    <td class="px-4"><?= $no++ ?></td>
                                    <td class="fw-bold"><?= $l['nama_lengkap'] ?></td>
                                    <td>No. <?= $l['no_kamar'] ?></td>
                                    <td><?= $l['bulan'] ?> <?= $l['tahun'] ?></td>
                                    <td><?= date('d M Y', strtotime($l['updated_at'])) ?></td>
                                    <td class="text-success fw-bold">Rp <?= number_format($total_bayar, 0, ',', '.') ?></td>
                                </tr>
                                <?php $total += $total_bayar; endforeach; ?>
                                <tr class="table-light fw-bold">
                                    <td colspan="5" class="text-end px-4">TOTAL PENDAPATAN:</td>
                                    <td class="text-primary fs-5">Rp <?= number_format($total, 0, ',', '.') ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>