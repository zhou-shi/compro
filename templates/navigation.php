<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            <img src="images/polnep.png" alt="Logo Polnep" width="30" height="30" class="d-inline-block align-text-top me-2">
            POLNEP
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo (!isset($_GET['page']) || $_GET['page'] == 'beranda') ? 'active' : ''; ?>" href="index.php?page=beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'profil') ? 'active' : ''; ?>" href="index.php?page=profil">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'jurusan') ? 'active' : ''; ?>" href="index.php?page=jurusan">Jurusan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'mahasiswa') ? 'active' : ''; ?>" href="index.php?page=mahasiswa">Mahasiswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'informasi') ? 'active' : ''; ?>" href="index.php?page=informasi">Informasi</a>
                </li>
            </ul>
        </div>
    </div>
</nav>