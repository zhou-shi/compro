<?php
    $server="localhost";
    $user="root";
    $password="";
    $database="sipolnep";
    $port="3307";

    $db=mysqli_connect($server, $user, $password, $database, $port);

    if(!$db)
    {
        die("Gagal terhubung dengan database: " . mysqli_connect_error());
    }
?>