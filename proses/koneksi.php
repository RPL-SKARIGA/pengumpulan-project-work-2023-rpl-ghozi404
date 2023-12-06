<?php
    $server = "localhost";
    $database = "tokopc";
    $user = "root";
    $password = "";

    $conn = mysqli_connect($server, $user, $password, $database);

    if (!$conn) {
        die("Koneksi Gagal : " . mysqli_connect_error());
    }else{
        echo "";
    }
    return $conn;
    ?>