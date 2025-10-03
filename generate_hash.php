<?php
/*
|--------------------------------------------------------------------------
| File Generator Hash Password
|--------------------------------------------------------------------------
|
| File ini HANYA digunakan untuk membuat hash password yang aman.
| Cara Penggunaan:
| 1. Buka file ini di browser Anda (contoh: localhost/compro/generate_hash.php).
| 2. Salin (copy) hasil hash yang muncul di layar.
| 3. Buka phpMyAdmin, masuk ke tabel 'users'.
| 4. Edit baris user 'admin', dan tempel (paste) hash yang sudah Anda salin ke kolom 'password'.
| 5. Simpan perubahan di phpMyAdmin.
| 6. HAPUS FILE INI dari server Anda setelah selesai untuk keamanan.
|
*/

// Password yang ingin di-hash. Ubah sesuai keinginan Anda.
$passwordToHash = 'admin123';

// Membuat hash menggunakan algoritma default yang kuat (BCRYPT)
$hashedPassword = password_hash($passwordToHash, PASSWORD_DEFAULT);

// Menampilkan hasilnya agar bisa disalin
echo "<h1>Password Hash Generator</h1>";
echo "<p>Password asli: <strong>" . htmlspecialchars($passwordToHash) . "</strong></p>";
echo "<p>Password Hash (salin kode ini):</p>";
echo "<textarea rows='3' cols='80' readonly>" . $hashedPassword . "</textarea>";

?>
