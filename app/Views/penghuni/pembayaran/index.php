<?= $this->extend('layout/penghuni') ?>

<?= $this->section('title') ?>
Bayar Tagihan - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-3">Daftar Tagihan Belum Dibayar</h4>
        
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover m-0 align-middle w-100">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">Periode</th>
                                <th>Nominal</th>
                                <th>Denda</th>
                                <th>Subtotal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tagihan as $t): ?>
                            <tr>
                                <td class="px-4 fw-bold"><?= $t['bulan'] ?> <?= $t['tahun'] ?></td>
                                <td>Rp <?= number_format($t['nominal_asal'], 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($t['nominal_denda'], 0, ',', '.') ?></td>
                                <td class="text-primary fw-bold">Rp <?= number_format($t['nominal_asal'] + $t['nominal_denda'], 0, ',', '.') ?></td>
                                <td class="text-center">
                                    <form action="<?= base_url('penghuni/pembayaran/checkout') ?>" method="post">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id_tagihan" value="<?= $t['id_tagihan'] ?>">
                                        <button type="submit" class="btn btn-sm btn-primary fw-bold px-3 shadow-sm">
                                            Bayar via Midtrans
                                        </button>
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
    <?php if(session()->getFlashdata('pesan_error')): ?>
        if (typeof Swal !== 'undefined') {
            Swal.fire({ icon: 'error', title: 'Oops...', text: '<?= session()->getFlashdata('pesan_error') ?>' });
        } else {
            alert('<?= session()->getFlashdata('pesan_error') ?>');
        }
    <?php endif; ?>
</script>
<?= $this->endSection() ?>