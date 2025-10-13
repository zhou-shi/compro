<?php
// Sertakan file koneksi database
include_once './config/database.php';

// Logika untuk menangani form (Create, Update, Delete)
$action = $_POST['action'] ?? $_GET['action'] ?? '';
$id = $_POST['id'] ?? $_GET['id'] ?? '';
$nama = $_POST['nama'] ?? '';
$nim = $_POST['nim'] ?? '';
$id_jurusan = $_POST['id_jurusan'] ?? '';

$message = '';

try {
  if ($action == 'create' && !empty($nama) && !empty($nim) && !empty($id_jurusan)) {
    $stmt = $koneksi->prepare("INSERT INTO mahasiswa (nama, nim, id_jurusan) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $nama, $nim, $id_jurusan);
    if ($stmt->execute()) {
      $message = '<div class="alert alert-success">Data mahasiswa berhasil ditambahkan.</div>';
    } else {
      throw new Exception($stmt->error);
    }
    $stmt->close();
  } elseif ($action == 'update' && !empty($id)) {
    $stmt = $koneksi->prepare("UPDATE mahasiswa SET nama = ?, nim = ?, id_jurusan = ? WHERE id = ?");
    $stmt->bind_param("ssii", $nama, $nim, $id_jurusan, $id);
    if ($stmt->execute()) {
      $message = '<div class="alert alert-success">Data mahasiswa berhasil diperbarui.</div>';
    } else {
      throw new Exception($stmt->error);
    }
    $stmt->close();
  } elseif ($action == 'delete' && !empty($id)) {
    $stmt = $koneksi->prepare("DELETE FROM mahasiswa WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
      $message = '<div class="alert alert-success">Data mahasiswa berhasil dihapus.</div>';
    } else {
      throw new Exception($stmt->error);
    }
    $stmt->close();
  }
} catch (Exception $e) {
  $message = '<div class="alert alert-danger">Terjadi kesalahan: ' . $e->getMessage() . '</div>';
}


// Ambil data jurusan untuk dropdown
$jurusan_result = $koneksi->query("SELECT * FROM jurusan");

// Logika untuk mode edit
$edit_mode = false;
$edit_data = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
  $edit_mode = true;
  $stmt = $koneksi->prepare("SELECT * FROM mahasiswa WHERE id = ?");
  $stmt->bind_param("i", $_GET['id']);
  $stmt->execute();
  $result = $stmt->get_result();
  $edit_data = $result->fetch_assoc();
  $stmt->close();
}
?>

<div class="card shadow-sm">
  <div class="card-header bg-primary text-white">
    <h4 class="mb-0"><i class="fas fa-user-graduate me-2"></i>Kelola Mahasiswa</h4>
  </div>
  <div class="card-body">
    <?php echo $message; ?>

    <div class="card mb-4">
      <div class="card-header">
        <?php echo $edit_mode ? 'Edit Data Mahasiswa' : 'Tambah Mahasiswa Baru'; ?>
      </div>
      <div class="card-body">
        <form action="?page=mahasiswa" method="post">
          <input type="hidden" name="action" value="<?php echo $edit_mode ? 'update' : 'create'; ?>">
          <?php if ($edit_mode): ?>
            <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
          <?php endif; ?>
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $edit_data['nama'] ?? ''; ?>" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="nim" class="form-label">NIM</label>
              <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $edit_data['nim'] ?? ''; ?>" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="id_jurusan" class="form-label">Jurusan</label>
              <select class="form-select" id="id_jurusan" name="id_jurusan" required>
                <option value="">Pilih Jurusan</option>
                <?php while ($jurusan = $jurusan_result->fetch_assoc()): ?>
                  <option value="<?php echo $jurusan['id']; ?>" <?php echo (isset($edit_data) && $edit_data['id_jurusan'] == $jurusan['id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($jurusan['nama_jurusan']); ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-primary"><?php echo $edit_mode ? 'Update' : 'Simpan'; ?></button>
          <?php if ($edit_mode): ?>
            <a href="?page=mahasiswa" class="btn btn-secondary">Batal</a>
          <?php endif; ?>
        </form>
      </div>
    </div>

    <h5 class="mt-4">Daftar Mahasiswa</h5>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead class="table-primary">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT m.id, m.nama, m.nim, j.nama_jurusan FROM mahasiswa m JOIN jurusan j ON m.id_jurusan = j.id ORDER BY m.nama ASC";
          $result = $koneksi->query($query);
          $no = 1;
          if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
          ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                <td><?php echo htmlspecialchars($row['nim']); ?></td>
                <td><?php echo htmlspecialchars($row['nama_jurusan']); ?></td>
                <td>
                  <a href="?page=mahasiswa&action=edit&id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <a href="?page=mahasiswa&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                    <i class="fas fa-trash"></i> Hapus
                  </a>
                </td>
              </tr>
            <?php
            endwhile;
          else:
            ?>
            <tr>
              <td colspan="5" class="text-center">Belum ada data mahasiswa.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>