<?php
    include("config/koneksi.php");

    $id_sepatu = $_POST['id_sepatu'];

    $nama_sepatu = $_POST['nama_sepatu'];

    $jenis_sepatu = $_POST['jenis_sepatu'];

    $sql = mysqli_query($koneksi, "INSERT INTO master_sepatu(id_sepatu,nama_sepatu,jenis_sepatu) VALUES('$id_sepatu','$nama_sepatu','$jenis_sepatu')");
    
    if($sql) {
        header("location:select_sepatu.php");
        exit();
    }
    else{
        echo"Terjadi Kesalahan:" . mysqli_error($koneksi);
        exit();
    }
?>
