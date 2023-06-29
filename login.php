<?php
    # Membuat session
    session_start();
    include("config/koneksi.php");

    if (isset($_POST["username"]) && isset($_POST["password"]))
    {   
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = mysqli_query($koneksi,"SELECT *  
                                FROM master_admin
                                WHERE 
                                    admin_username = '$username' and 
                                    admin_password = '$password' and
                                    admin_status= 1");
        $row = mysqli_num_rows($sql);

        if ($row > 0){
            # Set session user and login
            $_SESSION['username'] = $username;
            $_SESSION['login'] = 'YES';
            
            # Direct to select_sepatu
            header("location:dashboard.php");
        } else {
            $_SESSION['message'] = "Login failed!";
            header("location:index.php");
        }
    } else {
        header("location:index.php");
    }
?>