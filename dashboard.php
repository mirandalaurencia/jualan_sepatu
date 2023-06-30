<?php            
    # Session start
    session_start();
    include("config/koneksi.php");

    if($_SESSION['login'] != 'YES'){
        header("location:dashboard.php");
    }
    
    # Call file navigation to load navigation & header
    include 'navigation.php';

    # Get category
    $sql_category = mysqli_query($koneksi,"SELECT * FROM master_category");
    $count_category = mysqli_num_rows($sql_category);

    # Get product
    $sql_product = mysqli_query($koneksi,"SELECT * FROM master_sepatu");
    $count_product = mysqli_num_rows($sql_product);

    # Get total inventory
    $sql_inv = mysqli_query($koneksi,"SELECT SUM(stok) as stok FROM master_stock");
    $count_inv = mysqli_fetch_array($sql_inv);
    $total_stok = $count_inv['stok'];

    # Get customer
    $sql_customer = mysqli_query($koneksi,"SELECT * FROM master_user");
    $count_customer = mysqli_num_rows($sql_customer);
?>
<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Kutsuku</title>

        <!-- Custom icon -->
        <link rel="icon" type="image/png" href="images/iconsepatu.png">

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
                <br><h2>Dashboard</h2><br>
                <div class="card mb-3" style="width: 100%; height: 50%;">
                    <img class="card-img-top img-fluid" src="css/backgroundsepatu.jpg" alt="Card image cap" style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Welcome to Kutsuku</h5>
                        <p class="card-text">Kutsuku' is a foot fashion brand focusing on universal's casual footwear, striving to bring a fresh approach in fashion through our products and values. Our spirit, we believe every woman deserves to express herself fearlessly. Kutsuku' takes you to the destination of self expression.</p>
                    </div>
                </div>
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-sm-3">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="images/category.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Category</h5>
                                    <p class="card-text"><?= $count_category ?>
                                        <span><small class="text-muted">categories</small></span>
                                    </p>
                                    <a href="../jualan_sepatu/category.php" class="btn btn-primary">Go to Category</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="images/iconsepatu.png" alt="Card image cap" style="background-color: black;">
                                <div class="card-body">
                                    <h5 class="card-title">Product</h5>
                                    <p class="card-text"><?= $count_product ?>
                                        <span><small class="text-muted">products</small></span>
                                    </p>
                                    <a href="../jualan_sepatu/product.php" class="btn btn-primary">Go to Product</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="images/inventory.png" alt="Card image cap" style="background-color: black;">
                                <div class="card-body">
                                    <h5 class="card-title">Inventory</h5>
                                    <p class="card-text"><?= $total_stok ?>
                                        <span><small class="text-muted">all stocks</small></span>
                                    </p>
                                    <a href="../jualan_sepatu/inventory.php" class="btn btn-primary">Go to Inventory</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="images/customer.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Customer</h5>
                                    <p class="card-text"><?= $count_customer ?>
                                        <span><small class="text-muted">customers</small></span>
                                    </p>
                                    <a href="../jualan_sepatu/customer.php" class="btn btn-primary">Go to Customer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <h2>Products</h2>
                <div class="table-responsive">
                    <?php
                        error_reporting(0);
                        include("config/koneksi.php");

                        $sql = mysqli_query($koneksi,"SELECT s.*, c.* 
                                                      FROM master_sepatu s
                                                      JOIN master_category c
                                                      ON s.category_sepatu = c.category_id
                                                      WHERE c.category_status = 'A'
                                                      ORDER BY s.id_sepatu");
                
                        echo "<table class='table text-center table-striped table-sm'width='100%'> ";
                            echo "<thead class=thead-dark>";
                            echo"<tr>";
                                echo "<th align=center>ID SEPATU</th>";
                                echo "<th align=center>KATEGORI SEPATU</th>";
                                echo "<th align=center>NAMA SEPATU</th>";
                                echo "<th align=center>HARGA</th>";
                            echo"</tr>";
                            echo "</thead>";

                        while( $row = mysqli_fetch_array($sql) )
                        {
                            echo"<tr>";
                                echo "<td align=center>".$row['id_sepatu']."</td>";
                                echo "<td align=center>".$row['category_name']."</td>";
                                echo "<td align=center>".$row['nama_sepatu']."</td>";
                                echo "<td align=center>".$row['harga_sepatu']."</td>";
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
