<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Profil - Si-Kos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f6f9; }
        .card-onboarding { border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
    </style>
</head>
<body class="d-flex align-items-center min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <div class="card card-onboarding">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold text-primary">Selamat Datang! 🎉</h3>
                            <p class="text-muted">Sebelum masuk ke aplikasi Si-Kos, mari amankan akunmu dan lengkapi data profil terlebih dahulu.</p>
                        </div>

                        <?php if(session()->getFlashdata('pesan_error')): ?>
                            <div class="alert alert-danger small"><?= session()->getFlashdata('pesan_error') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('onboarding/submit') ?>" method="post" enctype="multipart/form-data">
                            
                            <h6 class="fw-bold mb-3"><i class="bi bi-shield-lock"></i> 1. Amankan Akun</h6>
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="form-label small">Password Baru</label>
                                    <input type="password" name="password_baru" class="form-control" placeholder="Min. 6 karakter" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small">Ulangi Password</label>
                                    <input type="password" name="konfirmasi_password" class="form-control" placeholder="Ketik ulang" required>
                                </div>
                            </div>

                            <h6 class="fw-bold mb-3"><i class="bi bi-person-vcard"></i> 2. Lengkapi Identitas</h6>
                            <div class="mb-3">
                                <label class="form-label small">Nomor Kontak Darurat (Keluarga/Kerabat)</label>
                                <input type="number" name="kontak_darurat" class="form-control" placeholder="Contoh: 08123456789" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small">Upload Foto KTP</label>
                                <input type="file" name="foto_ktp" class="form-control" accept="image/png, image/jpeg, image/jpg" required>
                                <div class="form-text text-muted" style="font-size: 0.8rem;">Format JPG/PNG, maksimal ukuran file 2MB.</div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 fw-bold py-2">
                                Simpan & Lanjutkan ke Dashboard <i class="bi bi-arrow-right"></i>
                            </button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>