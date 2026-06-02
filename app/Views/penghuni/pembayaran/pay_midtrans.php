<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Tagihan - Si-Kos</title>
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= getenv('MIDTRANS_CLIENT_KEY') ?>"></script>
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-lg border-0" style="width: 100%; max-width: 400px; border-radius: 16px;">
        <div class="card-body p-5 text-center">
            <h4 class="fw-bold mb-1">Tagihan Kos</h4>
            <p class="text-muted small mb-4">Bulan <?= $tagihan['bulan'] ?> Tahun <?= $tagihan['tahun'] ?></p>
            
            <h1 class="text-primary fw-bold mb-4">Rp <?= number_format($total_bayar, 0, ',', '.') ?></h1>
            
            <button id="pay-button" class="btn btn-success w-100 py-3 fw-bold rounded-pill shadow-sm fs-5">
                Bayar Tagihan
            </button>
            <a href="<?= base_url('penghuni/tagihan') ?>" class="btn btn-link text-muted mt-3 w-100">Kembali</a>
        </div>
    </div>

    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        window.snap.pay('<?= $snapToken ?>', {
          onSuccess: function(result){
            window.location.href = "<?= base_url('penghuni/pembayaran/success/' . $tagihan['id_tagihan']) ?>";
          },
          onPending: function(result){
            alert("Menunggu pembayaran Anda!"); console.log(result);
          },
          onError: function(result){
            alert("Pembayaran gagal!"); console.log(result);
          },
          onClose: function(){
            alert('Anda menutup popup sebelum menyelesaikan pembayaran');
          }
        })
      };
    </script>
</body>
</html>