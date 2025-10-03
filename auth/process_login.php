<?php
// Memulai session di awal file
session_start();

// Menyertakan file koneksi database
require_once '../config/database.php';

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Mengambil data dari form dan melindunginya dari SQL Injection
  $username = mysqli_real_escape_string($koneksi, $_POST['username']);
  $password = mysqli_real_escape_string($koneksi, $_POST['password']);

  // Query untuk mencari user berdasarkan username
  $query = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($koneksi, $query);

  // Memeriksa apakah user ditemukan
  if ($result && mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    // Verifikasi password menggunakan password_verify()
    if (password_verify($password, $user['password'])) {
      // Jika password cocok, set session dan redirect ke halaman admin
      // Kita hanya izinkan admin untuk login ke panel ini
      if ($user['role'] == 'admin') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        $_SESSION['admin_nama'] = $user['nama_lengkap'];
        $_SESSION['admin_role'] = $user['role'];
        header("Location: ../admin.php?page=dashboard");
        exit();
      } else {
        // Jika rolenya bukan admin
        $_SESSION['error_message'] = "Anda tidak memiliki hak akses admin.";
        header("Location: ../login.php");
        exit();
      }
    } else {
      // Jika password salah
      $_SESSION['error_message'] = "Username atau password salah.";
      header("Location: ../login.php");
      exit();
    }
  } else {
    // Jika username tidak ditemukan
    $_SESSION['error_message'] = "Username atau password salah.";
    header("Location: ../login.php");
    exit();
  }
} else {
  // Jika halaman diakses langsung tanpa POST, redirect ke login
  header("Location: ../login.php");
  exit();
}
