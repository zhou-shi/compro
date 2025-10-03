<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0"><i class="fas fa-book me-2"></i>Data Jurusan</h4>
    </div>
    <div class="card-body">
        <p>Berikut adalah daftar jurusan yang tersedia di Politeknik Negeri Pontianak.</p>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Jurusan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mengambil semua data dari tabel jurusan
                    $query = "SELECT * FROM jurusan ORDER BY nama_jurusan ASC";
                    $result = mysqli_query($koneksi, $query);
                    $no = 1;

                    // Periksa apakah query menghasilkan baris data
                    if (mysqli_num_rows($result) > 0) {
                        // Looping untuk menampilkan setiap baris data
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama_jurusan']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // Tampilkan pesan jika tidak ada data
                        echo "<tr><td colspan='2' class='text-center'>Tidak ada data jurusan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>