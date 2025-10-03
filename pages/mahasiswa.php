<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0"><i class="fas fa-users me-2"></i>Data Mahasiswa</h4>
    </div>
    <div class="card-body">
        <p>Data berikut adalah contoh daftar mahasiswa yang terdaftar di berbagai jurusan.</p>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Jurusan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk menggabungkan (JOIN) tabel mahasiswa dan jurusan
                    $query = "SELECT m.nim, m.nama, j.nama_jurusan 
                              FROM mahasiswa m
                              JOIN jurusan j ON m.id_jurusan = j.id
                              ORDER BY m.nama ASC";

                    $result = mysqli_query($koneksi, $query);
                    $no = 1;

                    // Periksa apakah query menghasilkan baris data
                    if (mysqli_num_rows($result) > 0) {
                        // Looping untuk menampilkan setiap baris data
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['nim']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama_jurusan']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // Tampilkan pesan jika tidak ada data
                        echo "<tr><td colspan='4' class='text-center'>Tidak ada data mahasiswa.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>