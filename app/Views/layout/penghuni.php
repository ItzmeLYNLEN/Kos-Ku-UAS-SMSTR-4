<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?></title>
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= base_url('penghuni/dashboard') ?>">Si-Kos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavPenghuni">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavPenghuni">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('penghuni/dashboard') ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('penghuni/tagihan') ?>">Tagihan Saya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('penghuni/komplain') ?>">Komplain</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('penghuni/pembayaran') ?>">Bayar Tagihan</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <span class="navbar-text me-3 text-white">
                        Hai, <?= session()->get('username') ?>
                    </span>
                    <a href="<?= base_url('logout') ?>" class="btn btn-light btn-sm text-primary fw-bold">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?= $this->renderSection('content') ?>
    </div>

    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('js/sweetalert2.all.min.js') ?>"></script>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>