<?php
    # Session start      
    session_start();
    if ($_SESSION['login'] != 'YES') {
        header("location:index.php");
    }

    # Call file navigation to load navigation
    include 'navigation.php';

    if (isset($_SESSION['message'])) {
        echo '<script type="text/javascript">alert("' . $_SESSION['message'] . '");</script>';
        unset($_SESSION['message']);
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Kutsuku</title>

        <!-- Custom icon -->
        <link rel="icon" href="images/iconsepatu.png">

        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/dashboard.css" rel="stylesheet">

        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                font-size: 3.5rem;
                }
            }
        </style>
    </head>
    
    <body>
        <div class="container-fluid">
            <!-- Main -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <br><h2>Master Categories</h2><br>
                <div class="d-flex justify-content-end">
                    <a  class="pull-right" href='category/insert_category.php'>
                        <input class='btn btn-primary' type='button' name='insert_category' value='Add Category'>
                    </a>
                </div>
                <br>
                <div class="table-responsive">
                    <?php
                        error_reporting(0);
                        include("config/koneksi.php");

                        $category_id = $_POST['category_id'];

                        $sql = mysqli_query($koneksi,"SELECT * FROM master_category");
                
                        echo "<table class='table text-center table-striped table-sm'width='100%'> ";
                            echo "<thead class=thead-dark>";
                            echo"<tr>";
                                echo "<th align=center>ID CATEGORY</th>";
                                echo "<th align=center>NAMA CATEGORY</th>";
                                echo "<th align=center>STATUS CATEGORY</th>";
                                echo"<th align=center>ACTION</th>";
                            echo"</tr>";
                            echo "</thead>";

                        while( $row = mysqli_fetch_array($sql) )
                        {
                            $category_id = $row['category_id'];
                            echo"<tr>";
                                echo "<td align=center>".$row['category_id']."</td>";
                                echo "<td align=center>".$row['category_name']."</td>";
                                if ($row['category_status'] == 'A') {
                                    echo "<td align=center>"."Active"."</td>";
                                } else {
                                    echo "<td align=center>"."Nonactive"."</td>";
                                }

                                // Update, Change status, Delete
                                echo "<td align=center>
                                        <a href=category/update_category.php?category=$category_id><input class='btn btn-secondary' type='button' name='update_category' value='Update Category'></a>
                                        
                                        <a href=category/change_status.php?category=$category_id><input class='btn btn-warning' type='button' name='hapus_category' value='Change Status'></a>
                                    </td>";
                            echo"</tr>";
                        }
                        echo "</table>";
                    ?>
                </div>
            </main>
        </div>
        
        <!-- Script  -->
        <script src="admin/assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
        <script src="admin/css/dashboard.js"></script>
    </body>
</html>
