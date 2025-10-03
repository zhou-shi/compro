<?php
// Memulai session untuk menangani pesan error atau status login
session_start();
?>
<!doctype html>
<html lang="id">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome (untuk ikon) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/style.css">

  <title>Admin Login | POLNEP</title>
</head>

<body class="bg-light">

  <div class="login-container">
    <div class="card shadow-lg">
      <div class="card-body p-5">
        <div class="text-center mb-4">
          <img src="images/polnep.png" alt="Logo Polnep" width="72">
          <h1 class="h3 mb-3 mt-3 fw-normal">Admin Login</h1>
        </div>

        <?php
        // Menampilkan pesan error jika ada
        if (isset($_SESSION['error_message'])) {
          echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
          // Hapus pesan setelah ditampilkan agar tidak muncul lagi
          unset($_SESSION['error_message']);
        }
        ?>

        <form action="auth/process_login.php" method="POST">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            <label for="username">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <label for="password">Password</label>
          </div>

          <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
          <p class="mt-4 mb-1 text-muted text-center">&copy; 2025 POLNEP</p>
          <p class="text-center"><a href="index.php">Kembali ke Beranda</a></p>
        </form>
      </div>
    </div>
  </div>

  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>