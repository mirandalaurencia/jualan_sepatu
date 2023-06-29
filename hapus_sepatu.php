<?php
    session_start();
    include("config/koneksi.php");

    $hapus_id_sepatu = $_GET['sepatu'];
    
    $sql = mysqli_query($koneksi,
                "DELETE FROM master_sepatu 
                WHERE id_sepatu = '$hapus_id_sepatu'");

    if ($sql == '1') {
        $_SESSION['message'] = "Your product has been deleted.";
        header("location:product.php");
    } else {
        $_SESSION['message'] = "Product not found by ID.";
        header("location:product.php");
    }
    
    exit();
?>