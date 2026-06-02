<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Kamar - Si-Kos</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #1e293b; padding-top: 80px; overflow-x: hidden; }
        a { text-decoration: none; }
        
        .navbar-custom { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); box-shadow: 0 1px 10px rgba(0,0,0,0.05); padding: 15px 0; }
        .navbar-custom .navbar-brand { font-size: 20px; font-weight: 700; color: #0d6efd; transition: 0.3s; }
        .navbar-custom .navbar-brand:hover { color: #0b5ed7; }
        
        .page-title { font-size: 36px; font-weight: 800; color: #0f172a; margin-bottom: 15px; }
        .page-subtitle { font-size: 18px; color: #64748b; margin-bottom: 50px; }

        .kamar-card { border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; background: white; transition: 0.3s; display: flex; flex-direction: column; height: 100%; }
        .kamar-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); border-color: #0d6efd; }
        .kamar-img-wrapper { position: relative; height: 220px; }
        .kamar-img-wrapper img { width: 100%; height: 100%; object-fit: cover; }
        .kamar-badge-top { position: absolute; top: 15px; right: 15px; background: rgba(0,0,0,0.6); color: white; backdrop-filter: blur(4px); border-radius: 50px; padding: 6px 15px; font-size: 12px; font-weight: 700; border: 1px solid rgba(255,255,255,0.2); }
        .kamar-badge-vip { position: absolute; top: 15px; left: 15px; background: #ffc107; color: #000; border-radius: 50px; padding: 6px 15px; font-size: 12px; font-weight: 800; box-shadow: 0 4px 10px rgba(0,0,0,0.2); }
        .kamar-body { padding: 25px; flex-grow: 1; display: flex; flex-direction: column; }
        .kamar-tipe { color: #0d6efd; font-weight: 800; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; }
        .kamar-harga { font-size: 24px; font-weight: 800; color: #0f172a; margin-bottom: 15px; }
        .kamar-harga span { font-size: 14px; font-weight: 500; color: #64748b; }
        .kamar-fasilitas { color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1; }
        
        .badge-vip-modal { background-color: #ffc107; color: #000; }
        .badge-std-modal { background-color: #0d6efd; color: #fff; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>"><i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Beranda</a>
        </div>
    </nav>

    <div class="container py-5 mt-4">
        <div class="text-center">
            <h1 class="page-title">Katalog Kamar Kos</h1>
            <p class="page-subtitle">Daftar lengkap seluruh unit kamar kami yang siap untuk ditempati.</p>
        </div>
        
        <div class="row g-4">
            <?php if(empty($kamar_tersedia)): ?>
                <div class="col-12 text-center py-5">
                    <i class="fa-solid fa-bed fs-1 text-muted mb-3"></i>
                    <h5 class="text-muted fw-bold">Maaf, saat ini semua kamar sedang penuh.</h5>
                </div>
            <?php else: ?>
                <?php foreach($kamar_tersedia as $k): 
                    $isVip = (stripos($k['nama_tipe'], 'vip') !== false);
                    $imgPlaceholder = 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&q=80&w=500';
                ?>
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="kamar-card w-100 <?= $isVip ? 'border-warning' : '' ?>">
                        <div class="kamar-img-wrapper">
                            <?php if($isVip): ?>
                                <div class="kamar-badge-vip"><i class="fa-solid fa-star"></i> VIP</div>
                            <?php endif; ?>
                            <div class="kamar-badge-top">Kamar <?= $k['no_kamar'] ?></div>
                            <img src="<?= !empty($k['foto_1']) ? base_url('uploads/kamar/' . $k['foto_1']) : $imgPlaceholder ?>" alt="<?= $k['nama_tipe'] ?>">
                        </div>
                        <div class="kamar-body">
                            <div class="kamar-tipe"><?= $k['nama_tipe'] ?></div>
                            <div class="kamar-harga">Rp <?= number_format($k['harga_dasar'], 0, ',', '.') ?><span>/bln</span></div>
                            <div class="kamar-fasilitas">
                                <i class="fa-solid fa-check text-success me-2"></i> <?= mb_strimwidth(nl2br($k['fasilitas']), 0, 40, '...') ?>
                            </div>
                            <div class="d-flex gap-2 mt-auto">
                                <button type="button" class="btn btn-outline-primary w-50 fw-bold" data-bs-toggle="modal" data-bs-target="#detailModal<?= $k['id_kamar'] ?>">Detail</button>
                                <button type="button" class="btn btn-primary w-50 fw-bold <?= $isVip ? 'btn-warning text-dark border-warning' : '' ?>" data-bs-toggle="modal" data-bs-target="#bookingModal<?= $k['id_kamar'] ?>">Booking</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Modal -->
                <div class="modal fade" id="detailModal<?= $k['id_kamar'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 shadow" style="border-radius: 16px; overflow: hidden;">
                            <div class="modal-header bg-light border-0 py-4 px-4">
                                <h4 class="modal-title fw-bold text-dark">Kamar No. <?= $k['no_kamar'] ?> <span class="badge <?= $isVip ? 'badge-vip-modal' : 'badge-std-modal' ?> ms-2 fs-6 align-middle"><?= $k['nama_tipe'] ?></span></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="row g-4">
                                    <div class="col-md-7">
                                        <div id="carouselKamar<?= $k['id_kamar'] ?>" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner rounded-4 shadow-sm" style="height: 300px;">
                                                <div class="carousel-item active h-100">
                                                    <img src="<?= !empty($k['foto_1']) ? base_url('uploads/kamar/' . $k['foto_1']) : $imgPlaceholder ?>" class="d-block w-100 h-100 object-fit-cover" alt="Foto 1">
                                                </div>
                                                <?php if(!empty($k['foto_2'])): ?>
                                                <div class="carousel-item h-100">
                                                    <img src="<?= base_url('uploads/kamar/' . $k['foto_2']) ?>" class="d-block w-100 h-100 object-fit-cover" alt="Foto 2">
                                                </div>
                                                <?php endif; ?>
                                                <?php if(!empty($k['foto_3'])): ?>
                                                <div class="carousel-item h-100">
                                                    <img src="<?= base_url('uploads/kamar/' . $k['foto_3']) ?>" class="d-block w-100 h-100 object-fit-cover" alt="Foto 3">
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselKamar<?= $k['id_kamar'] ?>" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselKamar<?= $k['id_kamar'] ?>" data-bs-slide="next">
                                                <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <h3 class="fw-bold text-primary mb-3">Rp <?= number_format($k['harga_dasar'], 0, ',', '.') ?> <span class="fs-6 text-muted fw-normal">/ bulan</span></h3>
                                        
                                        <h6 class="fw-bold mb-2"><i class="fa-solid fa-align-left text-primary me-2"></i>Deskripsi</h6>
                                        <p class="text-muted small mb-4 bg-light p-3 rounded-3">
                                            <?= !empty($k['deskripsi']) ? nl2br($k['deskripsi']) : 'Kamar kos nyaman dan bersih. Cocok untuk Anda.' ?>
                                        </p>
                                        
                                        <h6 class="fw-bold mb-2"><i class="fa-solid fa-list-check text-primary me-2"></i>Fasilitas</h6>
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
                            <div class="modal-footer border-0 bg-light p-4">
                                <button type="button" class="btn btn-light border px-4 fw-bold" data-bs-dismiss="modal">Tutup</button>
                                <button type="button" class="btn <?= $isVip ? 'btn-warning text-dark' : 'btn-primary' ?> px-5 fw-bold" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#bookingModal<?= $k['id_kamar'] ?>">
                                    Lanjut Booking <i class="fa-solid fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Modal -->
                <div class="modal fade" id="bookingModal<?= $k['id_kamar'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow" style="border-radius: 16px; overflow: hidden;">
                            <div class="modal-header bg-primary text-white border-0 py-3 px-4">
                                <h5 class="modal-title fw-bold">Booking Kamar <?= $k['no_kamar'] ?></h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="<?= base_url('submitBooking') ?>" method="post">
                                <div class="modal-body p-4">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id_kamar" value="<?= $k['id_kamar'] ?>">
                                    <div class="alert bg-primary bg-opacity-10 border border-primary border-opacity-25 text-primary mb-4 rounded-3 d-flex align-items-center">
                                        <i class="fa-solid fa-tag fs-4 me-3"></i>
                                        <div>
                                            <div class="small fw-bold">Total Harga</div>
                                            <div class="fs-5 fw-bold">Rp <?= number_format($k['harga_dasar'], 0, ',', '.') ?> / bln</div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold small text-muted">Nama Lengkap</label>
                                        <input type="text" class="form-control form-control-lg fs-6" name="nama_calon" required placeholder="Sesuai KTP">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold small text-muted">Nomor WhatsApp</label>
                                        <input type="number" class="form-control form-control-lg fs-6" name="no_wa" required placeholder="08...">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label fw-bold small text-muted">Alamat Email</label>
                                        <input type="email" class="form-control form-control-lg fs-6" name="email" required placeholder="email@contoh.com">
                                        <div class="form-text text-danger mt-2"><i class="fa-solid fa-circle-exclamation"></i> Pastikan email aktif untuk pengiriman akun login.</div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light border-0 p-4">
                                    <button type="button" class="btn btn-light border px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success px-5 fw-bold"><i class="fa-solid fa-paper-plane me-2"></i> Kirim Pengajuan</button>
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
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: '<?= session()->getFlashdata('pesan_sukses') ?>', confirmButtonColor: '#0d6efd' });
        <?php endif; ?>
        <?php if(session()->getFlashdata('pesan_error')): ?>
            Swal.fire({ icon: 'error', title: 'Mohon Maaf', text: '<?= session()->getFlashdata('pesan_error') ?>', confirmButtonColor: '#dc3545' });
        <?php endif; ?>
    </script>
</body>
</html>