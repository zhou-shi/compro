<?php
// File: config/database.php
// Tempat untuk menyimpan semua konfigurasi koneksi database.

// Gunakan define() untuk membuat konstanta agar nilainya tidak bisa diubah di tempat lain.
// Ini adalah praktik yang baik untuk keamanan.

// Konfigurasi untuk koneksi ke database MySQL
define('DB_HOST', 'localhost');      // Host database, biasanya 'localhost'
define('DB_USER', 'root');           // Username database Anda (default Laragon adalah 'root')
define('DB_PASS', '');               // Password database Anda (default Laragon kosong)
define('DB_NAME', 'compro_db');      // Nama database yang akan kita gunakan

// Membuat koneksi ke database menggunakan fungsi mysqli_connect()
$koneksi = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Memeriksa apakah koneksi berhasil atau gagal
if (!$koneksi) {
  // Jika gagal, hentikan eksekusi script dan tampilkan pesan error.
  // mysqli_connect_error() akan memberikan detail kenapa koneksi gagal.
  die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Jika berhasil, variabel $koneksi akan siap digunakan di file lain yang menyertakan file ini.
