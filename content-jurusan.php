<?php
    include ("konektor.php");
?>

<h1 class=" my-5 text-center"> Daftar Jurusan</h1>
<table class="table">
    <thead>
        <tr>
            <td>No</td>
            <td>Kode Jurusan</td>
            <td>Nama Jurusan</td>
            <td>Golongan</td>
        </tr>
    </thead>

    <tbody>
        <?php
            $sql="select * from jurusan";
            $query=mysqli_query($db, $sql);
            $total=mysqli_num_rows($query);

            $no=0;
            while($list=mysqli_fetch_object($query))
            {
                $no++;
                echo "<tr>";
                    echo "<td>$no</td>";
                    echo "<td>".$list->kode."</td>";
                    echo "<td>".$list->nama."</td>";
                    echo "<td>".$list->golongan."</td>";
                    echo "</tr>";
            }
        ?>
    </tbody>
</table>