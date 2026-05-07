<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Kamar - Si-Kos</title>
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .hero { background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%); color: white; padding: 80px 0; }
        .card-kamar { transition: transform 0.2s; border: none; border-radius: 15px; }
        .card-kamar:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= base_url('/') ?>">Si-Kos</a>
            <div class="ms-auto">
                <a href="<?= base_url('login') ?>" class="btn btn-light btn-sm fw-bold text-primary px-4 rounded-pill">Login Penghuni</a>
            </div>
        </div>
    </nav>

    <div class="hero text-center">
        <div class="container">
            <h1 class="fw-bold display-5 mb-3">Temukan Kamar Kos Nyamanmu</h1>
            <p class="lead mb-0 opacity-75">Lokasi strategis, fasilitas lengkap, dan pembayaran super mudah.</p>
        </div>
    </div>

    <div class="container py-5">
        <h4 class="fw-bold mb-4">Kamar Tersedia Saat Ini</h4>
        
        <div class="row g-4">
            <?php if(empty($kamar_tersedia)): ?>
                <div class="col-12 text-center py-5">
                    <h5 class="text-muted">Maaf, saat ini semua kamar sedang penuh.</h5>
                </div>
            <?php else: ?>
                <?php foreach($kamar_tersedia as $k): ?>
                <div class="col-md-4 col-sm-6">
                    <div class="card card-kamar h-100 shadow-sm">
                        <div class="bg-light text-center py-5 rounded-top border-bottom">
                            <h1 class="text-muted opacity-25 m-0"><i class="bi bi-door-closed"></i> <?= $k['no_kamar'] ?></h1>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-primary px-3 py-2 rounded-pill"><?= $k['nama_tipe'] ?></span>
                                <h5 class="fw-bold text-success m-0">Rp <?= number_format($k['harga_dasar'], 0, ',', '.') ?><span class="fs-6 text-muted fw-normal">/bln</span></h5>
                            </div>
                            <h5 class="card-title fw-bold mt-2">Kamar No. <?= $k['no_kamar'] ?></h5>
                            <p class="card-text text-muted small flex-grow-1">
                                <strong>Fasilitas:</strong><br>
                                <?= nl2br($k['fasilitas']) ?>
                            </p>
                            <button type="button" class="btn btn-outline-primary w-100 fw-bold mt-3" data-bs-toggle="modal" data-bs-target="#bookingModal<?= $k['id_kamar'] ?>">
                                Booking Kamar Ini
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="bookingModal<?= $k['id_kamar'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow">
                            <div class="modal-header bg-primary text-white border-0">
                                <h5 class="modal-title fw-bold">Booking Kamar <?= $k['no_kamar'] ?></h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="<?= base_url('booking/submit') ?>" method="post">
                                <div class="modal-body p-4">
                                    <input type="hidden" name="id_kamar" value="<?= $k['id_kamar'] ?>">
                                    
                                    <div class="alert alert-light border border-primary text-primary mb-4">
                                        Harga: <strong>Rp <?= number_format($k['harga_dasar'], 0, ',', '.') ?> / bulan</strong>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama_calon" required placeholder="Masukkan nama sesuai KTP">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nomor WhatsApp</label>
                                        <input type="number" class="form-control" name="no_wa" required placeholder="08...">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Alamat Email</label>
                                        <input type="email" class="form-control" name="email" required placeholder="email@contoh.com">
                                        <div class="form-text text-danger">Pastikan email aktif untuk menerima detail akun login.</div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary fw-bold">Kirim Pengajuan Booking</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if(session()->getFlashdata('pesan_sukses')): ?>
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: '<?= session()->getFlashdata('pesan_sukses') ?>' });
        <?php endif; ?>
        <?php if(session()->getFlashdata('pesan_error')): ?>
            Swal.fire({ icon: 'error', title: 'Mohon Maaf', text: '<?= session()->getFlashdata('pesan_error') ?>' });
        <?php endif; ?>
    </script>
</body>
</html>