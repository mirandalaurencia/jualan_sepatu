<?php
    session_start();
    include("../config/koneksi.php");

    $change_id_cat = $_GET['category'];
    
    $sql = mysqli_query($koneksi,
                            "SELECT category_status FROM master_category 
                            WHERE category_id = '$change_id_cat'");
    $row = mysqli_fetch_all($sql, MYSQLI_ASSOC);
    
    $status = '';
    if ($row[0]['category_status'] == 'A') {
        $status = 'N';
    } else {
        $status = 'A';
    }

    $sql_update = mysqli_query($koneksi,
                                    "UPDATE master_category
                                    SET category_status = '$status'
                                    WHERE category_id = '$change_id_cat'");
    
    if ($sql) {
        $_SESSION['message'] = "Your category status has been updated.";
        header("location:../category.php");
    } else {
        $_SESSION['message'] = "Category not found by ID.";
        header("location:../category.php");
    }
    
    exit();
?>