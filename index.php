<?php
// File: index.php
// Bertindak sebagai router utama untuk aplikasi.

session_start();
require_once 'config/database.php';
require_once 'templates/header.php';
require_once 'templates/navigation.php';

?>

<!-- Konten Utama yang bisa "tumbuh" -->
<main class="container mt-4 mb-5 main-content">
   <div class="row">
      <div class="col-md-12">
         <?php
         // Logika routing sederhana
         $page = isset($_GET['page']) ? $_GET['page'] : 'beranda';
         $file_path = 'pages/' . $page . '.php';

         if (file_exists($file_path)) {
            include $file_path;
         } else {
            echo '<div class="alert alert-danger" role="alert">';
            echo '<h1>404 - Halaman Tidak Ditemukan</h1>';
            echo '<p>Maaf, halaman yang Anda cari tidak ada.</p>';
            echo '</div>';
         }
         ?>
      </div>
   </div>
</main>
<!-- Akhir Konten Utama -->

<?php
// Menyertakan file footer.
require_once 'templates/footer.php';
?>