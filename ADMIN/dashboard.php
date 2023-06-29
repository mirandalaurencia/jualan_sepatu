<?php
                    //<center><h1>SELAMAT DATANG</h1><center>
                    
session_start();
if($_SESSION['login'] != 'YES'){
    header("location:admin/dashboard.php");
}

?>
<html>
<head>
    <style> 
        body {
            background-image: url('backgrounddashboard.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }
    </style>
</head>
    <div style='width:80%; 
                margin: auto;
                border-radius:5px;'>

        <div style='background-color: rgba(0,0,0,0.4);
                    backdrop-filter: blur(5px);;
                    padding:10px;
                    color:white;
                    margin:250;
                    border-radius:20px;'>
                    <center><h1>SELAMAT DATANG</h1><center>
               <h1> 
                <?php

                     echo $_SESSION['username'];

                ?> 
                </h1>
                    <a href='../select_sepatu.php'><button style=width:300px>Update sepatu</button></a>
                </br>
                    <a href='../logout.php'><button style=width:300px>Log Out</button></a>
        </div>
    </div>

</html>
