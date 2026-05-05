<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Si-Kos</title>
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4 fw-bold">Si-Kos</h3>
                        <?php if(session()->getFlashdata('msg')): ?>
                            <div class="alert alert-danger py-2"><?= session()->getFlashdata('msg') ?></div>
                        <?php endif; ?>
                        <form action="<?= base_url('login/process') ?>" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username / No HP</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Masuk</button>
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