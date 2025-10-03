<div class="p-5 mb-4 bg-light rounded-3">
  <div class="container-fluid py-5">
    <h1 class="display-5 fw-bold">Selamat Datang, <?php echo htmlspecialchars($_SESSION['admin_nama']); ?>!</h1>
    <p class="col-md-8 fs-4">Anda login sebagai <strong><?php echo ucfirst($_SESSION['admin_role']); ?></strong>. Gunakan menu navigasi di atas untuk mengelola konten website.</p>
  </div>
</div>