<?= $this->extend('layout/penghuni') ?>

<?= $this->section('title') ?>
Bayar Tagihan - Si-Kos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-3">Pilih Tagihan</h4>
        
        <form action="<?= base_url('penghuni/pembayaran/checkout') ?>" method="post">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover m-0 align-middle w-100">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3" width="5%">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                    </th>
                                    <th>Periode</th>
                                    <th>Nominal</th>
                                    <th>Denda</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($tagihan as $t): ?>
                                <tr>
                                    <td class="px-4">
                                        <input class="form-check-input checkItem" type="checkbox" name="id_tagihan[]" value="<?= $t['id_tagihan'] ?>" data-harga="<?= $t['nominal_asal'] + $t['nominal_denda'] ?>">
                                    </td>
                                    <td class="fw-bold"><?= $t['bulan'] ?> <?= $t['tahun'] ?></td>
                                    <td>Rp <?= number_format($t['nominal_asal'], 0, ',', '.') ?></td>
                                    <td>Rp <?= number_format($t['nominal_denda'], 0, ',', '.') ?></td>
                                    <td class="text-primary fw-bold">Rp <?= number_format($t['nominal_asal'] + $t['nominal_denda'], 0, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?php if(!empty($tagihan)): ?>
            <div class="row justify-content-end">
                <div class="col-md-5">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">Metode Pembayaran</h6>
                            <select name="metode_bayar" class="form-select mb-3" required>
                                <option value="QRIS">QRIS (OVO, Gopay, Dana, dll)</option>
                                <option value="VA_BCA">Virtual Account BCA</option>
                                <option value="VA_MANDIRI">Virtual Account Mandiri</option>
                            </select>
                            
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span class="fw-bold">Total Pembayaran:</span>
                                <h4 class="fw-bold text-success m-0" id="totalBayar">Rp 0</h4>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Checkout Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </form>
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

    document.addEventListener('DOMContentLoaded', function() {
        const checkAll = document.getElementById('checkAll');
        const checkItems = document.querySelectorAll('.checkItem');
        const totalBayarEl = document.getElementById('totalBayar');

        function hitungTotal() {
            let total = 0;
            checkItems.forEach(item => {
                if (item.checked) {
                    total += parseInt(item.getAttribute('data-harga')) || 0;
                }
            });
            if (totalBayarEl) {
                totalBayarEl.innerHTML = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
            }
        }

        if(checkAll) {
            checkAll.addEventListener('change', function() {
                checkItems.forEach(item => item.checked = this.checked);
                hitungTotal();
            });
        }

        checkItems.forEach(item => {
            item.addEventListener('change', hitungTotal);
        });

        hitungTotal();
    });
</script>
<?= $this->endSection() ?>