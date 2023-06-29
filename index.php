<?php
    error_reporting(0);
    session_start();

    # If login success
    if ($_SESSION['login'] == 'YES') {
        header("location:dashboard.php");
    }

    # If login failed
    if (isset($_SESSION['message'])) {
        echo '<script type="text/javascript">alert("' . $_SESSION['message'] . '");</script>';
        unset($_SESSION['message']);
    }
?>

<html>
    <head>
        <title>Kutsuku</title>

        <!-- Custom icon -->
        <link rel="icon" href="images/iconsepatu.png">

        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div class="container">
            <div class="blur">
                <div class="log-in">
                    <img src="images/iconsepatu.png" height="100" width="100" />
                    <h1 >LOG IN</h1>
                </div>

                <form method='POST' action="login.php">
                    <input 
                        type='Text' 
                        placeholder='Masukkan Username'
                        name='username'
                    />

                    <input 
                        type='PASSWORD' 
                        placeholder='Masukkan Password' 
                        name='password'
                    />

                    <input 
                        id='btn-input'
                        type='SUBMIT'
                        value='Sign In'
                        name='signin'
                    />
                </form>
            </div>
        </div>
    </body>
</html>