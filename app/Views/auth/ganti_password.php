<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password - Si-Kos</title>
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <h4 class="text-center mb-3 fw-bold">Ganti Password</h4>
                        <p class="text-center text-muted small mb-4">Anda diwajibkan mengganti password bawaan demi keamanan.</p>
                        <form action="<?= base_url('ganti-password/process') ?>" method="post">
                            <div class="mb-4">
                                <label for="password_baru" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="password_baru" name="password_baru" required minlength="6">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-warning fw-bold">Simpan & Lanjutkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>