<?php
// Sertakan file koneksi database
include_once './config/database.php';

// Inisialisasi variabel
$action = $_POST['action'] ?? $_GET['action'] ?? '';
$id = $_POST['id'] ?? $_GET['id'] ?? '';
$nama_jurusan = $_POST['nama_jurusan'] ?? '';
$message = '';

try {
  // Logika CREATE
  if ($action == 'create' && !empty($nama_jurusan)) {
    $stmt = $koneksi->prepare("INSERT INTO jurusan (nama_jurusan) VALUES (?)");
    $stmt->bind_param("s", $nama_jurusan);
    if ($stmt->execute()) {
      $message = '<div class="alert alert-success">Jurusan baru berhasil ditambahkan.</div>';
    } else {
      throw new Exception($stmt->error);
    }
    $stmt->close();
  }
  // Logika UPDATE
  elseif ($action == 'update' && !empty($id) && !empty($nama_jurusan)) {
    $stmt = $koneksi->prepare("UPDATE jurusan SET nama_jurusan = ? WHERE id = ?");
    $stmt->bind_param("si", $nama_jurusan, $id);
    if ($stmt->execute()) {
      $message = '<div class="alert alert-success">Nama jurusan berhasil diperbarui.</div>';
    } else {
      throw new Exception($stmt->error);
    }
    $stmt->close();
  }
  // Logika DELETE
  elseif ($action == 'delete' && !empty($id)) {
    // Cek dulu apakah ada mahasiswa atau kurikulum yang terkait dengan jurusan ini
    $check_stmt_mhs = $koneksi->prepare("SELECT COUNT(*) FROM mahasiswa WHERE id_jurusan = ?");
    $check_stmt_mhs->bind_param("i", $id);
    $check_stmt_mhs->execute();
    $check_stmt_mhs->bind_result($count_mhs);
    $check_stmt_mhs->fetch();
    $check_stmt_mhs->close();

    $check_stmt_kur = $koneksi->prepare("SELECT COUNT(*) FROM kurikulum WHERE id_jurusan = ?");
    $check_stmt_kur->bind_param("i", $id);
    $check_stmt_kur->execute();
    $check_stmt_kur->bind_result($count_kur);
    $check_stmt_kur->fetch();
    $check_stmt_kur->close();

    if ($count_mhs > 0 || $count_kur > 0) {
      throw new Exception("Tidak dapat menghapus jurusan karena masih ada data mahasiswa atau kurikulum yang terkait.");
    }

    // Jika tidak ada data terkait, lanjutkan penghapusan
    $stmt = $koneksi->prepare("DELETE FROM jurusan WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
      $message = '<div class="alert alert-success">Jurusan berhasil dihapus.</div>';
    } else {
      throw new Exception($stmt->error);
    }
    $stmt->close();
  }
} catch (Exception $e) {
  $message = '<div class="alert alert-danger"><strong>Error:</strong> ' . $e->getMessage() . '</div>';
}

// Logika untuk mode edit
$edit_mode = false;
$edit_data = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
  $edit_mode = true;
  $stmt = $koneksi->prepare("SELECT * FROM jurusan WHERE id = ?");
  $stmt->bind_param("i", $_GET['id']);
  $stmt->execute();
  $result = $stmt->get_result();
  $edit_data = $result->fetch_assoc();
  $stmt->close();
}
?>

<div class="card shadow-sm">
  <div class="card-header bg-primary text-white">
    <h4 class="mb-0"><i class="fas fa-landmark me-2"></i>Kelola Jurusan</h4>
  </div>
  <div class="card-body">
    <?php echo $message; ?>

    <div class="card mb-4">
      <div class="card-header">
        <?php echo $edit_mode ? 'Edit Data Jurusan' : 'Tambah Jurusan Baru'; ?>
      </div>
      <div class="card-body">
        <form action="?page=jurusan" method="post">
          <input type="hidden" name="action" value="<?php echo $edit_mode ? 'update' : 'create'; ?>">
          <?php if ($edit_mode): ?>
            <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
          <?php endif; ?>

          <div class="input-group mb-3">
            <span class="input-group-text">Nama Jurusan</span>
            <input type="text" class="form-control" name="nama_jurusan" placeholder="Contoh: Teknik Informatika" value="<?php echo $edit_data['nama_jurusan'] ?? ''; ?>" required>
          </div>

          <button type="submit" class="btn btn-primary"><?php echo $edit_mode ? 'Update' : 'Simpan'; ?></button>
          <?php if ($edit_mode): ?>
            <a href="?page=jurusan" class="btn btn-secondary">Batal</a>
          <?php endif; ?>
        </form>
      </div>
    </div>

    <h5 class="mt-4">Daftar Jurusan</h5>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead class="table-primary">
          <tr>
            <th style="width: 10%;">No</th>
            <th>Nama Jurusan</th>
            <th style="width: 20%;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result = $koneksi->query("SELECT * FROM jurusan ORDER BY nama_jurusan ASC");
          $no = 1;
          if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
          ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['nama_jurusan']); ?></td>
                <td>
                  <a href="?page=jurusan&action=edit&id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <a href="?page=jurusan&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">
                    <i class="fas fa-trash"></i> Hapus
                  </a>
                </td>
              </tr>
            <?php
            endwhile;
          else:
            ?>
            <tr>
              <td colspan="3" class="text-center">Belum ada data jurusan.</td>
            </tr>
          <?php endif;
          $koneksi->close(); ?>
        </tbody>
      </table>
    </div>
  </div>
</div>