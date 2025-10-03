<?php
    include ("konektor.php");
?>

<h1 class=" my-5 text-center"> Informasi Kurikulum</h1>
<table class="table table-hover table-sm">
    <thead>
        <tr>
            <td>No</td>
            <td>Kode Makul</td>
            <td>Nama Makul</td>
            <td>SKS</td>
        </tr>
    </thead>

    <tbody class="table-group-divider">
        <?php
            $sql="select * from kurikulum";
            $query=mysqli_query($db, $sql);
            $total=mysqli_num_rows($query);

            $no=0;
            while($list=mysqli_fetch_array($query))
            {
                $no++;
                echo "<tr>";
                    echo "<td>$no</td>";
                    echo "<td>".$list['kode']."</td>";
                    echo "<td>".$list['nama']."</td>";
                    echo "<td>".$list['sks']."</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>