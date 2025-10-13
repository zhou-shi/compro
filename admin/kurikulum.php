<?php
// Sertakan file koneksi database
include_once './config/database.php';

// Logika untuk menangani form (Create, Update, Delete)
$action = $_POST['action'] ?? $_GET['action'] ?? '';
$id = $_POST['id'] ?? $_GET['id'] ?? '';
$kode_matkul = $_POST['kode_matkul'] ?? '';
$nama_matkul = $_POST['nama_matkul'] ?? '';
$sks = $_POST['sks'] ?? '';
$id_jurusan = $_POST['id_jurusan'] ?? '';

$message = '';

try {
  if ($action == 'create' && !empty($kode_matkul) && !empty($nama_matkul)) {
    $stmt = $koneksi->prepare("INSERT INTO kurikulum (kode_matkul, nama_matkul, sks, id_jurusan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $kode_matkul, $nama_matkul, $sks, $id_jurusan);
    if ($stmt->execute()) {
      $message = '<div class="alert alert-success">Data kurikulum berhasil ditambahkan.</div>';
    } else {
      throw new Exception($stmt->error);
    }
    $stmt->close();
  } elseif ($action == 'update' && !empty($id)) {
    $stmt = $koneksi->prepare("UPDATE kurikulum SET kode_matkul = ?, nama_matkul = ?, sks = ?, id_jurusan = ? WHERE id = ?");
    $stmt->bind_param("ssiii", $kode_matkul, $nama_matkul, $sks, $id_jurusan, $id);
    if ($stmt->execute()) {
      $message = '<div class="alert alert-success">Data kurikulum berhasil diperbarui.</div>';
    } else {
      throw new Exception($stmt->error);
    }
    $stmt->close();
  } elseif ($action == 'delete' && !empty($id)) {
    $stmt = $koneksi->prepare("DELETE FROM kurikulum WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
      $message = '<div class="alert alert-success">Data kurikulum berhasil dihapus.</div>';
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
  $stmt = $koneksi->prepare("SELECT * FROM kurikulum WHERE id = ?");
  $stmt->bind_param("i", $_GET['id']);
  $stmt->execute();
  $result = $stmt->get_result();
  $edit_data = $result->fetch_assoc();
  $stmt->close();
}
?>

<div class="card shadow-sm">
  <div class="card-header bg-primary text-white">
    <h4 class="mb-0"><i class="fas fa-sitemap me-2"></i>Kelola Kurikulum</h4>
  </div>
  <div class="card-body">
    <?php echo $message; ?>

    <div class="card mb-4">
      <div class="card-header">
        <?php echo $edit_mode ? 'Edit Data Kurikulum' : 'Tambah Kurikulum Baru'; ?>
      </div>
      <div class="card-body">
        <form action="?page=kurikulum" method="post">
          <input type="hidden" name="action" value="<?php echo $edit_mode ? 'update' : 'create'; ?>">
          <?php if ($edit_mode): ?>
            <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
          <?php endif; ?>
          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="kode_matkul" class="form-label">Kode Mata Kuliah</label>
              <input type="text" class="form-control" id="kode_matkul" name="kode_matkul" value="<?php echo $edit_data['kode_matkul'] ?? ''; ?>" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
              <input type="text" class="form-control" id="nama_matkul" name="nama_matkul" value="<?php echo $edit_data['nama_matkul'] ?? ''; ?>" required>
            </div>
            <div class="col-md-2 mb-3">
              <label for="sks" class="form-label">SKS</label>
              <input type="number" class="form-control" id="sks" name="sks" value="<?php echo $edit_data['sks'] ?? ''; ?>" required>
            </div>
            <div class="col-md-3 mb-3">
              <label for="id_jurusan" class="form-label">Jurusan</label>
              <select class="form-select" id="id_jurusan" name="id_jurusan" required>
                <option value="">Pilih Jurusan</option>
                <?php mysqli_data_seek($jurusan_result, 0); // Reset pointer result set 
                ?>
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
            <a href="?page=kurikulum" class="btn btn-secondary">Batal</a>
          <?php endif; ?>
        </form>
      </div>
    </div>

    <h5 class="mt-4">Daftar Kurikulum</h5>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead class="table-primary">
          <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Jurusan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT k.id, k.kode_matkul, k.nama_matkul, k.sks, j.nama_jurusan FROM kurikulum k JOIN jurusan j ON k.id_jurusan = j.id ORDER BY j.nama_jurusan, k.nama_matkul ASC";
          $result = $koneksi->query($query);
          $no = 1;
          if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
          ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['kode_matkul']); ?></td>
                <td><?php echo htmlspecialchars($row['nama_matkul']); ?></td>
                <td><?php echo htmlspecialchars($row['sks']); ?></td>
                <td><?php echo htmlspecialchars($row['nama_jurusan']); ?></td>
                <td>
                  <a href="?page=kurikulum&action=edit&id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <a href="?page=kurikulum&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                    <i class="fas fa-trash"></i> Hapus
                  </a>
                </td>
              </tr>
            <?php
            endwhile;
          else:
            ?>
            <tr>
              <td colspan="6" class="text-center">Belum ada data kurikulum.</td>
            </tr>
          <?php endif;
          $koneksi->close(); ?>
        </tbody>
      </table>
    </div>
  </div>
</div>