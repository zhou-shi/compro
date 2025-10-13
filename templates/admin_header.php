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
  <link rel="stylesheet" href="/assets/css/style.css">

  <title>Admin Dashboard | POLNEP</title>
</head>

<body class="d-flex flex-column min-vh-100">

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="admin.php?page=dashboard">
        <i class="fas fa-tachometer-alt me-2"></i> Admin Panel
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="adminNavbar">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'dashboard') ? 'active' : ''; ?>" href="admin.php?page=dashboard">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'jurusan') ? 'active' : ''; ?>" href="admin.php?page=jurusan">Jurusan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'mahasiswa') ? 'active' : ''; ?>" href="admin.php?page=mahasiswa">Mahasiswa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'kurikulum') ? 'active' : ''; ?>" href="admin.php?page=kurikulum">Kurikulum</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="auth/logout.php">
              <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>