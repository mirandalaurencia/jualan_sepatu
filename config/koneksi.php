<?php

    $server     = "localhost";
    $user       = "root";
    $pass       = "";
    $database   = "jualan_sepatu";

    $koneksi    = mysqli_connect($server, $user, $pass, $database);
    mysqli_select_db($koneksi,$database);


    if(!$koneksi)
    {
        die("gagal connect ke server" . mysqli_connect_error() );
    }
    //echo "koneksi berhasil";
?>