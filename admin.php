<?php
// Memulai session dan memeriksa status login admin
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header("Location: login.php");
  exit();
}

// Menyertakan header khusus admin
require_once 'templates/admin_header.php';
?>

<!-- Konten Utama Admin -->
<main class="container mt-4 mb-5 main-content">
  <?php
  // Router untuk halaman admin
  $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
  $file_path = 'admin/' . $page . '.php';

  if (file_exists($file_path)) {
    include $file_path;
  } else {
    echo '<div class="alert alert-danger">Halaman admin tidak ditemukan.</div>';
  }
  ?>
</main>
<!-- Akhir Konten Utama Admin -->

<?php
// Menyertakan footer umum
require_once 'templates/footer.php';
?>