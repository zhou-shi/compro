<?php 
    // Tangkap menu dari URL, default "beranda"
    $menu = isset($_GET['menu']) ? $_GET['menu'] : 'beranda';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container">
        <a href="#" class="navbar-brand"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?= ($menu == 'beranda') ? 'active' : '' ?>">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?menu=profil" class="nav-link <?= ($menu == 'profil') ? 'active' : '' ?>">Profil</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?menu=informasi" class="nav-link <?= ($menu == 'informasi') ? 'active' : '' ?>">Informasi</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?menu=jurusan" class="nav-link <?= ($menu == 'jurusan') ? 'active' : '' ?>">Jurusan</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?menu=mahasiswa" class="nav-link <?= ($menu == 'mahasiswa') ? 'active' : '' ?>">Mahasiswa</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?menu=kontak" class="nav-link <?= ($menu == 'kontak') ? 'active' : '' ?>">Kontak</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?menu=login" class="nav-link <?= ($menu == 'login') ? 'active' : '' ?>">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
