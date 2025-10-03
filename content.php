<?php
 $file_content="content-$halaman.php";
 if(file_exists($file_content)) {
    include $file_content;
 } else {
    echo "<main class='container my-5'><div class='alert-warning'>Halaman tidak ditemukan.</div></main>";
 }
?>