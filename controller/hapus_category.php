<?php
    session_start();
    include("../config/koneksi.php");

    $hapus_id_cat = $_GET['category'];
    
    $sql = mysqli_query($koneksi,
                "DELETE FROM master_category 
                WHERE category_id = '$hapus_id_cat'");

    if ($sql == '1') {
        $_SESSION['message'] = "Your category has been deleted.";
        header("location:category.php");
    } else {
        $_SESSION['message'] = "Category not found by ID.";
        header("location:category.php");
    }
    
    exit();
?>