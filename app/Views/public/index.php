<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Si-Kos</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #1e293b; overflow-x: hidden; }
        a { text-decoration: none; }
        
        .navbar-custom { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); box-shadow: 0 1px 10px rgba(0,0,0,0.05); padding: 15px 0; }
        .navbar-custom .navbar-brand { font-size: 24px; font-weight: 800; color: #0f172a; }
        .navbar-custom .navbar-brand i { color: #0d6efd; }
        .navbar-custom .nav-link { color: #1e293b; font-weight: 600; margin-left: 20px; transition: 0.3s; }
        .navbar-custom .nav-link:hover { color: #0d6efd; }
        .nav-cta { background: #0d6efd; color: white !important; padding: 10px 24px; border-radius: 50px; font-weight: 700 !important; transition: 0.3s; }
        .nav-cta:hover { background: #0b5ed7; }

        .hero { background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%); min-height: 100vh; display: flex; align-items: center; position: relative; overflow: hidden; padding-top: 80px; }
        .hero::after { content: ''; position: absolute; width: 600px; height: 600px; background: radial-gradient(circle, rgba(13,110,253,0.4) 0%, transparent 70%); top: -200px; right: -100px; border-radius: 50%; }
        .hero-badge { background: rgba(255,255,255,0.1); padding: 8px 16px; border-radius: 50px; font-size: 14px; font-weight: 600; display: inline-block; margin-bottom: 24px; border: 1px solid rgba(255,255,255,0.2); color: white; }
        .hero-title { font-size: 56px; line-height: 1.2; margin-bottom: 24px; font-weight: 800; color: white; }
        .hero-title span { color: #60a5fa; }
        .hero-desc { font-size: 18px; color: #cbd5e1; line-height: 1.6; margin-bottom: 40px; }
        .hero-img { width: 100%; max-width: 500px; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.4); border: 4px solid rgba(255,255,255,0.1); transform: rotate(2deg); }
        
        .btn-white { background: white; color: #0d6efd; padding: 14px 28px; border-radius: 8px; font-size: 16px; font-weight: 700; transition: all 0.3s; border: none; }
        .btn-white:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); background: white; color: #0b5ed7; }
        .btn-outline-light-custom { background: transparent; color: white; border: 1px solid rgba(255,255,255,0.3); padding: 14px 28px; border-radius: 8px; font-size: 16px; font-weight: 600; transition: all 0.3s; }
        .btn-outline-light-custom:hover { background: rgba(255,255,255,0.1); border-color: white; color: white; }

        .section-title { font-size: 36px; font-weight: 800; margin-bottom: 20px; color: #0f172a; }
        .section-subtitle { font-size: 18px; color: #64748b; max-width: 700px; margin: 0 auto 50px; line-height: 1.6; }
        .feature-card { background: white; padding: 40px 30px; border-radius: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border: 1px solid #e2e8f0; transition: 0.3s; height: 100%; }
        .feature-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); border-color: #0d6efd; }
        .icon-box { width: 60px; height: 60px; background: #eff6ff; color: #0d6efd; display: flex; align-items: center; justify-content: center; font-size: 24px; border-radius: 12px; margin-bottom: 24px; }
        
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
        
        .cta-section { background: #0d6efd; color: white; padding: 80px 5%; border-radius: 24px; margin: 0 auto; text-align: center; }
        .badge-vip-modal { background-color: #ffc107; color: #000; }
        .badge-std-modal { background-color: #0d6efd; color: #fff; }

        @media (max-width: 991px) {
            .hero { text-align: center; }
            .hero-img { display: none; }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>"><i class="fa-solid fa-house-chimney"></i> Si-Kos</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#fasilitas">Keunggulan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kamar">Pilihan Kamar</a></li>
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0"><a href="<?= base_url('login') ?>" class="nav-link nav-cta">Masuk / Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-text" style="z-index: 2;">
                    <div class="hero-badge">✨ Hunian Eksklusif & Strategis</div>
                    <h1 class="hero-title">Temukan Kenyamanan Seperti <span>Di Rumah Sendiri.</span></h1>
                    <p class="hero-desc">Si-Kos menawarkan fasilitas lengkap, lingkungan aman, dan kemudahan pembayaran digital. Tinggal bawa koper dan nikmati hunian terbaik untuk Anda.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#kamar" class="btn btn-white"><i class="fa-solid fa-magnifying-glass me-2"></i> Cari Kamar</a>
                        <a href="<?= base_url('login') ?>" class="btn btn-outline-light-custom"><i class="fa-solid fa-right-to-bracket me-2"></i> Masuk</a>
                    </div>
                </div>
                <div class="col-lg-6 text-end d-none d-lg-block" style="z-index: 2;">
                    <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&q=80&w=800" class="hero-img" alt="Kamar Kos">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 my-5" id="fasilitas">
        <div class="container text-center">
            <h2 class="section-title">Kenapa Memilih Si-Kos?</h2>
            <p class="section-subtitle">Kami mengutamakan kenyamanan, keamanan, dan kepraktisan untuk mendukung segala aktivitas harian Anda.</p>
            
            <div class="row g-4 text-start">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box"><i class="fa-solid fa-shield-halved"></i></div>
                        <h3 class="fs-4 fw-bold mb-3">Keamanan 24 Jam</h3>
                        <p class="text-muted m-0">Dilengkapi dengan CCTV di berbagai sudut area dan akses kunci elektronik yang hanya bisa digunakan oleh penghuni resmi.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box"><i class="fa-solid fa-wifi"></i></div>
                        <h3 class="fs-4 fw-bold mb-3">Internet Cepat</h3>
                        <p class="text-muted m-0">Tidak perlu khawatir koneksi terputus. Kami menyediakan akses Wi-Fi gratis unlimited yang stabil di seluruh area kos.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box"><i class="fa-solid fa-wallet"></i></div>
                        <h3 class="fs-4 fw-bold mb-3">Pembayaran Digital</h3>
                        <p class="text-muted m-0">Lacak tagihan dan lakukan pembayaran dengan mudah melalui sistem aplikasi cerdas kami menggunakan QRIS atau Transfer Bank.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light" id="kamar">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Pilihan Kamar Tersedia</h2>
                <p class="section-subtitle">Pilih kamar yang sesuai dengan preferensi Anda. Unit sangat terbatas, segera amankan kamar Anda hari ini.</p>
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
<<<<<<< HEAD
=======
                        $baseUrlRaw = rtrim(base_url(), '/');
                        $imgDir = (strpos($baseUrlRaw, 'public') !== false) ? '/uploads/kamar/' : '/public/uploads/kamar/';
>>>>>>> 9e56b391a6e6e77db399b989c072f7fe1426b1e0
                        $imgPlaceholder = 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&q=80&w=500';
                    ?>
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="kamar-card w-100 <?= $isVip ? 'border-warning' : '' ?>">
                            <div class="kamar-img-wrapper">
                                <?php if($isVip): ?>
                                    <div class="kamar-badge-vip"><i class="fa-solid fa-star"></i> VIP</div>
                                <?php endif; ?>
                                <div class="kamar-badge-top">Kamar <?= $k['no_kamar'] ?></div>
<<<<<<< HEAD
                                <img src="<?= !empty($k['foto_1']) ? base_url('uploads/kamar/' . $k['foto_1']) : $imgPlaceholder ?>" alt="<?= $k['nama_tipe'] ?>">
=======
                                <img src="<?= !empty($k['foto_1']) ? $baseUrlRaw . $imgDir . $k['foto_1'] : $imgPlaceholder ?>" alt="<?= $k['nama_tipe'] ?>">
>>>>>>> 9e56b391a6e6e77db399b989c072f7fe1426b1e0
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

<<<<<<< HEAD
                    <!-- Detail Modal -->
=======
>>>>>>> 9e56b391a6e6e77db399b989c072f7fe1426b1e0
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
                                            <div id="carouselHome<?= $k['id_kamar'] ?>" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner rounded-4 shadow-sm" style="height: 300px;">
                                                    <div class="carousel-item active h-100">
<<<<<<< HEAD
                                                        <img src="<?= !empty($k['foto_1']) ? base_url('uploads/kamar/' . $k['foto_1']) : $imgPlaceholder ?>" class="d-block w-100 h-100 object-fit-cover" alt="Foto 1">
                                                    </div>
                                                    <?php if(!empty($k['foto_2'])): ?>
                                                    <div class="carousel-item h-100">
                                                        <img src="<?= base_url('uploads/kamar/' . $k['foto_2']) ?>" class="d-block w-100 h-100 object-fit-cover" alt="Foto 2">
=======
                                                        <img src="<?= !empty($k['foto_1']) ? $baseUrlRaw . $imgDir . $k['foto_1'] : $imgPlaceholder ?>" class="d-block w-100 h-100 object-fit-cover" alt="Foto 1">
                                                    </div>
                                                    <?php if(!empty($k['foto_2'])): ?>
                                                    <div class="carousel-item h-100">
                                                        <img src="<?= $baseUrlRaw . $imgDir . $k['foto_2'] ?>" class="d-block w-100 h-100 object-fit-cover" alt="Foto 2">
>>>>>>> 9e56b391a6e6e77db399b989c072f7fe1426b1e0
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if(!empty($k['foto_3'])): ?>
                                                    <div class="carousel-item h-100">
<<<<<<< HEAD
                                                        <img src="<?= base_url('uploads/kamar/' . $k['foto_3']) ?>" class="d-block w-100 h-100 object-fit-cover" alt="Foto 3">
=======
                                                        <img src="<?= $baseUrlRaw . $imgDir . $k['foto_3'] ?>" class="d-block w-100 h-100 object-fit-cover" alt="Foto 3">
>>>>>>> 9e56b391a6e6e77db399b989c072f7fe1426b1e0
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselHome<?= $k['id_kamar'] ?>" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselHome<?= $k['id_kamar'] ?>" data-bs-slide="next">
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

<<<<<<< HEAD
                    <!-- Booking Modal -->
=======
>>>>>>> 9e56b391a6e6e77db399b989c072f7fe1426b1e0
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

            <?php if(!empty($kamar_tersedia)): ?>
            <div class="text-center mt-5 pt-4">
                <a href="<?= base_url('kamar') ?>" class="btn btn-primary fw-bold px-5 py-3 rounded-pill shadow-sm fs-5">
                    Lihat Seluruh Kamar <i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="cta-section shadow-lg">
                <h2 class="fw-bold mb-3">Jangan Tunggu Sampai Kehabisan!</h2>
                <p class="mb-4">Jadilah bagian dari keluarga Si-Kos. Pesan kamar impianmu sekarang dan nikmati pengalaman kos yang modern dan bebas repot.</p>
                <a href="<?= base_url('kamar') ?>" class="btn btn-white px-5 rounded-pill shadow-sm">
                    Pesan Sekarang <i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

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