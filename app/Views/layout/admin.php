<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?? 'Admin Panel' ?></title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        /* Styling Sidebar */
        .sidebar-menu a { color: #adb5bd; text-decoration: none; padding: 12px 20px; display: block; border-left: 4px solid transparent; transition: 0.3s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { color: #fff; background: #0d6efd; border-left-color: #fff; }
        .top-navbar { background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <div class="d-flex flex-nowrap" style="min-height: 100vh;">
        
        <div class="bg-dark text-white d-flex flex-column flex-shrink-0 shadow-lg" style="width: 260px; z-index: 1000;">
            <div class="p-4 border-bottom border-secondary">
                <h5 class="fw-bold m-0"><i class="bi bi-buildings text-primary"></i> Admin Si-Kos</h5>
            </div>
            <div class="sidebar-menu flex-grow-1 py-3 overflow-auto">
                <a href="<?= base_url('admin/dashboard') ?>" class="<?= uri_string() == 'admin/dashboard' ? 'active' : '' ?>"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                
                <div class="px-4 mt-4 mb-2 text-uppercase text-muted small fw-bold">Manajemen Kos</div>
                <a href="<?= base_url('admin/tipe-kamar') ?>" class="<?= strpos(uri_string(), 'admin/tipe-kamar') !== false ? 'active' : '' ?>"><i class="bi bi-tags me-2"></i> Tipe Kamar</a>
                <a href="<?= base_url('admin/kamar') ?>" class="<?= strpos(uri_string(), 'admin/kamar') !== false && strpos(uri_string(), 'tipe') === false ? 'active' : '' ?>"><i class="bi bi-door-closed me-2"></i> Data Kamar</a>
                <a href="<?= base_url('admin/penghuni') ?>" class="<?= strpos(uri_string(), 'admin/penghuni') !== false ? 'active' : '' ?>"><i class="bi bi-people me-2"></i> Data Penghuni</a>
                <a href="<?= base_url('admin/booking') ?>" class="<?= strpos(uri_string(), 'admin/booking') !== false ? 'active' : '' ?>"><i class="bi bi-journal-bookmark me-2"></i> Booking Masuk</a>
                
                <div class="px-4 mt-4 mb-2 text-uppercase text-muted small fw-bold">Operasional</div>
                <a href="<?= base_url('admin/tagihan') ?>" class="<?= strpos(uri_string(), 'admin/tagihan') !== false ? 'active' : '' ?>"><i class="bi bi-receipt me-2"></i> Tagihan Kos</a>
                <a href="<?= base_url('admin/laporan') ?>" class="<?= strpos(uri_string(), 'admin/laporan') !== false ? 'active' : '' ?>"><i class="bi bi-bar-chart-line me-2"></i> Laporan Pembayaran</a>
                <a href="<?= base_url('admin/komplain') ?>" class="<?= strpos(uri_string(), 'admin/komplain') !== false ? 'active' : '' ?>"><i class="bi bi-chat-square-text me-2"></i> Komplain Fasilitas</a>
            </div>
        </div>

        <div class="flex-grow-1 d-flex flex-column" style="min-width: 0; overflow-x: hidden;">
            
            <nav class="navbar navbar-expand-lg top-navbar px-4 py-3 border-bottom">
                <div class="ms-auto d-flex align-items-center">
                    <img src="https://ui-avatars.com/api/?name=<?= session()->get('username') ?>&background=0d6efd&color=fff&bold=true" class="rounded-circle me-2 shadow-sm" width="35" height="35">
                    <span class="fw-bold text-dark me-4"><?= session()->get('username') ?></span>
                    <a href="<?= base_url('logout') ?>" class="btn btn-danger btn-sm fw-bold rounded-pill px-3"><i class="bi bi-box-arrow-right"></i> Logout</a>
                </div>
            </nav>

            <div class="container-fluid p-4">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function () {
            // KUNCINYA DI SINI: Selector diubah agar mengabaikan tabel di dalam modal
            $('.table:not(.modal .table)').DataTable({
                "language": { 
                    "search": "Cari Data:", 
                    "lengthMenu": "Tampilkan _MENU_ data", 
                    "info": "Tampil _START_ s/d _END_ dari _TOTAL_",
                    "zeroRecords": "Tidak ada data yang cocok.",
                    "infoEmpty": "Data kosong."
                },
                "ordering": false // Matikan auto-sort supaya urutan dari controller tidak diubah
            });
        });
    </script>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>