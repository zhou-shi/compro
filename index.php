<?php
 include ("header.php");
 include ("navigation.php");
 $halaman='beranda';
 if(!empty($_GET['menu']))
 {
    $halaman=$_GET['menu'];
 }
 include ("content.php");
 include ("footer.php");
?>