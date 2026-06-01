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
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; overflow-x: hidden; }
        .sidebar-menu a { color: #adb5bd; text-decoration: none; padding: 12px 20px; display: block; border-left: 4px solid transparent; transition: 0.3s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { color: #fff; background: #0d6efd; border-left-color: #fff; }
        .top-navbar { background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }

        #sidebar {
            width: 260px;
            transition: margin 0.3s ease-in-out;
            z-index: 1040;
        }
        
        #sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1030;
            backdrop-filter: blur(2px);
        }

        @media (max-width: 991.98px) {
            #sidebar {
                position: fixed;
                height: 100vh;
                margin-left: -260px;
            }
            #sidebar.show {
                margin-left: 0;
            }
            #sidebar-overlay.show {
                display: block;
            }
        }

        /* --- FIX DATATABLES PADDING DI CARD P-0 --- */
        .dataTables_wrapper > .row:first-child {
            padding: 15px 24px 5px 24px;
            margin: 0;
        }
        .dataTables_wrapper > .row:last-child {
            padding: 5px 24px 15px 24px;
            margin: 0;
        }
        .dataTables_wrapper .table {
            margin-bottom: 0 !important;
            border-top: 1px solid #dee2e6;
            border-bottom: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <div id="sidebar-overlay"></div>

    <div class="d-flex flex-nowrap" style="min-height: 100vh;">
        
        <div id="sidebar" class="bg-dark text-white d-flex flex-column flex-shrink-0 shadow-lg">
            <div class="p-4 border-bottom border-secondary d-flex justify-content-between align-items-center">
                <h5 class="fw-bold m-0"><i class="bi bi-buildings text-primary"></i> Admin Si-Kos</h5>
                <button class="btn btn-sm btn-dark d-lg-none text-white border-0" id="btn-close-sidebar">
                    <i class="bi bi-x-lg fs-5"></i>
                </button>
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
            
            <nav class="navbar navbar-expand-lg top-navbar px-3 py-3 border-bottom d-flex align-items-center">
                <button class="btn btn-light border d-lg-none me-3" id="btn-toggle-sidebar">
                    <i class="bi bi-list fs-5"></i>
                </button>

                <div class="ms-auto d-flex align-items-center">
                    <img src="https://ui-avatars.com/api/?name=<?= session()->get('username') ?>&background=0d6efd&color=fff&bold=true" class="rounded-circle me-2 shadow-sm" width="35" height="35">
                    <span class="fw-bold text-dark me-3 d-none d-sm-inline"><?= session()->get('username') ?></span>
                    <a href="<?= base_url('logout') ?>" class="btn btn-danger btn-sm fw-bold rounded-pill px-3"><i class="bi bi-box-arrow-right"></i> <span class="d-none d-sm-inline">Logout</span></a>
                </div>
            </nav>

            <div class="container-fluid p-3 p-md-4">
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
            $('.table:not(.modal .table, .table-borderless)').DataTable({
                "language": { 
                    "search": "Cari Data:", 
                    "lengthMenu": "Tampilkan _MENU_ data", 
                    "info": "Tampil _START_ s/d _END_ dari _TOTAL_",
                    "zeroRecords": "Tidak ada data yang cocok.",
                    "infoEmpty": "Data kosong."
                },
                "ordering": false
            });

            $('#btn-toggle-sidebar').on('click', function() {
                $('#sidebar, #sidebar-overlay').addClass('show');
            });

            $('#sidebar-overlay, #btn-close-sidebar').on('click', function() {
                $('#sidebar, #sidebar-overlay').removeClass('show');
            });
        });
    </script>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>