<?php
include("konektor.php");
?>

<h1 class="my-5 text-center">Mahasiswa</h1>

<div class="container">
    <table class="table table-hover table-sm">
        <thead>
            <tr>
                <td>No</td>
                <td>NIM</td>
                <td>Nama</td>
                <td>Nomor HP</td>
                <td>Jurusan</td>
                <td>Alamat</td>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
                $sql = "SELECT * FROM mahasiswa";
                $query = mysqli_query($db, $sql);

                $no = 0;
                while ($list = mysqli_fetch_object($query)) {
                    $no++;
                    echo "<tr>";
                        echo "<td>$no</td>";
                        echo "<td>".$list->nim."</td>";
                        echo "<td>".$list->nama."</td>";
                        echo "<td>".$list->no_hp."</td>";
                        echo "<td>".$list->jurusan."</td>";
                        echo "<td>".$list->alamat."</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>
