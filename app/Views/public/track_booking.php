<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Booking - Si-Kos</title>
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0 text-center p-4">
                    
                    <?php if(empty($b)): ?>
                        <div class="py-4">
                            <h2 class="text-success mb-3"><i class="bi bi-check-circle-fill"></i></h2>
                            <h4 class="fw-bold">Booking Selesai!</h4>
                            <p class="text-muted">Proses booking Anda telah diselesaikan oleh Admin dan kamar Anda sudah resmi terdaftar.</p>
                            <div class="alert alert-success small">
                                Silakan periksa pesan WhatsApp/Email dari Admin kami untuk mendapatkan <strong>Username</strong> dan <strong>Password</strong> akun Anda.
                            </div>
                            <hr>
                            <a href="<?= base_url('login') ?>" class="btn btn-primary w-100 fw-bold">Menuju Halaman Login</a>
                        </div>
                    <?php else: ?>
                        <h4 class="fw-bold">Status Booking Kamar <?= $b['no_kamar'] ?></h4>
                        <p class="text-muted">Halo, <?= $b['nama_calon'] ?></p>
                        <hr>

                        <?php if($b['status_booking'] == 'Menunggu Persetujuan'): ?>
                            <div class="alert alert-info">Permintaan Anda sedang ditinjau oleh Admin.</div>
                        <?php elseif($b['status_booking'] == 'Menunggu DP'): ?>
                            <div class="alert alert-warning">Booking Disetujui! Silakan bayar DP 50%.</div>
                            <h2 class="fw-bold text-success mb-3">Rp <?= number_format($b['nominal_dp'], 0, ',', '.') ?></h2>
                           <a href="<?= base_url('pay-dp/'.$b['id_booking']) ?>" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                             Lanjut Bayar via Midtrans <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        <?php elseif($b['status_booking'] == 'Paid'): ?>
                            <div class="alert alert-success">DP Berhasil Dibayar! Mohon tunggu, Admin sedang mengaktifkan akun Anda.</div>
                        <?php endif; ?>

                        <a href="<?= base_url('/') ?>" class="btn btn-link mt-3 text-decoration-none">Kembali ke Katalog</a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</body>
</html>