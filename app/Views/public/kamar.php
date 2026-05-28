<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Kamar - Si-Kos</title>
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .card-kamar { transition: transform 0.2s; border: none; border-radius: 15px; display: flex; flex-direction: column; height: 100%; }
        .card-kamar:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .badge-vip { background-color: #ffc107; color: #000; }
        .badge-std { background-color: #0d6efd; color: #fff; }
        .carousel-item img { object-fit: cover; height: 300px; border-radius: 10px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= base_url('/') ?>"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
        </div>
    </nav>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Katalog Kamar Kos</h2>
            <p class="text-muted">Pilih kamar yang paling sesuai dengan kebutuhan Anda.</p>
        </div>
        
        <div class="row g-4">
            <?php if(empty($kamar_tersedia)): ?>
                <div class="col-12 text-center py-5">
                    <h5 class="text-muted">Maaf, saat ini semua kamar sedang penuh.</h5>
                </div>
            <?php else: ?>
                <?php foreach($kamar_tersedia as $k): 
                    $isVip = (stripos($k['nama_tipe'], 'vip') !== false);
                ?>
                <div class="col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
                    <div class="card card-kamar w-100 shadow-sm <?= $isVip ? 'border border-warning' : '' ?>">
                        <div class="bg-light text-center py-5 rounded-top border-bottom position-relative">
                             <?php if($isVip): ?>
                                <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-warning text-dark shadow-sm px-4 py-2" style="margin-top: 15px; font-size: 0.9rem;">
                                    <i class="bi bi-star-fill"></i> Kamar Eksklusif VIP
                                </span>
                            <?php endif; ?>
                            <h1 class="text-muted opacity-25 m-0 mt-3"><i class="bi bi-door-closed"></i> <?= $k['no_kamar'] ?></h1>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge <?= $isVip ? 'badge-vip' : 'badge-std' ?> px-3 py-2 rounded-pill"><?= $k['nama_tipe'] ?></span>
                            </div>
                            <h5 class="fw-bold text-success mb-3">Rp <?= number_format($k['harga_dasar'], 0, ',', '.') ?><span class="fs-6 text-muted fw-normal">/bln</span></h5>
                            
                            <h5 class="card-title fw-bold">Kamar No. <?= $k['no_kamar'] ?></h5>
                            <p class="card-text text-muted small mb-4">
                                <strong>Fasilitas Singkat:</strong><br>
                                <?= mb_strimwidth(nl2br($k['fasilitas']), 0, 50, '...') ?>
                            </p>
                            
                            <div class="mt-auto">
                                <button type="button" class="btn btn-outline-secondary w-100 fw-bold mb-2" data-bs-toggle="modal" data-bs-target="#detailModal<?= $k['id_kamar'] ?>">
                                    <i class="bi bi-images"></i> Detail Kamar
                                </button>
                                <button type="button" class="btn <?= $isVip ? 'btn-warning text-dark' : 'btn-outline-primary' ?> w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#bookingModal<?= $k['id_kamar'] ?>">
                                    Booking Kamar Ini
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="detailModal<?= $k['id_kamar'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 shadow">
                            <div class="modal-header bg-light border-0">
                                <h5 class="modal-title fw-bold">Detail Kamar No. <?= $k['no_kamar'] ?> <span class="badge <?= $isVip ? 'badge-vip' : 'badge-std' ?> ms-2"><?= $k['nama_tipe'] ?></span></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="row">
                                    <div class="col-md-7 mb-4 mb-md-0">
                                        <div id="carouselKamar<?= $k['id_kamar'] ?>" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner rounded shadow-sm">
                                                <div class="carousel-item active">
                                                    <img src="<?= !empty($k['foto_1']) ? base_url('uploads/kamar/'.$k['foto_1']) : 'https://via.placeholder.com/600x400?text=Foto+Kamar+1' ?>" class="d-block w-100" alt="Foto 1">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="<?= !empty($k['foto_2']) ? base_url('uploads/kamar/'.$k['foto_2']) : 'https://via.placeholder.com/600x400?text=Foto+Kamar+2' ?>" class="d-block w-100" alt="Foto 2">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="<?= !empty($k['foto_3']) ? base_url('uploads/kamar/'.$k['foto_3']) : 'https://via.placeholder.com/600x400?text=Foto+Kamar+3' ?>" class="d-block w-100" alt="Foto 3">
                                                </div>
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselKamar<?= $k['id_kamar'] ?>" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselKamar<?= $k['id_kamar'] ?>" data-bs-slide="next">
                                                <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-5">
                                        <h5 class="fw-bold text-success mb-3">Rp <?= number_format($k['harga_dasar'], 0, ',', '.') ?> <small class="text-muted fs-6">/ bulan</small></h5>
                                        
                                        <h6 class="fw-bold"><i class="bi bi-info-square text-primary"></i> Deskripsi</h6>
                                        <p class="text-muted small mb-4">
                                            <?= !empty($k['deskripsi']) ? nl2br($k['deskripsi']) : 'Kamar kos nyaman dan bersih dengan sirkulasi udara yang baik. Cocok untuk Anda yang membutuhkan ketenangan setelah beraktivitas seharian.' ?>
                                        </p>

                                        <h6 class="fw-bold"><i class="bi bi-ui-checks-grid text-primary"></i> Fasilitas Tersedia</h6>
                                        <ul class="text-muted small ps-3">
                                            <?php 
                                            $fasilitas_list = explode(',', $k['fasilitas']);
                                            foreach($fasilitas_list as $fas): 
                                            ?>
                                                <li class="mb-1"><?= trim($fas) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0 bg-light">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="button" class="btn <?= $isVip ? 'btn-warning text-dark' : 'btn-primary' ?> fw-bold" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#bookingModal<?= $k['id_kamar'] ?>">
                                    Lanjut Booking <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
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
                                    <button type="submit" class="btn btn-primary fw-bold">Kirim Pengajuan</button>
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