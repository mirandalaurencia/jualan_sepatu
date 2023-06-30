<?php
    session_start();
    include("config/koneksi.php");

    # Call file navigation to load navigation
    include 'navigation.php';

    # Get category
    $sql_category = mysqli_query($koneksi,"SELECT * FROM master_category");
    $row_category = mysqli_fetch_all($sql_category, MYSQLI_ASSOC);

    if (isset($_GET['simpan_sepatu']) == 'insert_data') {
        $nama_sepatu = $_POST['nama_sepatu'];
        $jenis_sepatu = $_POST['category_sepatu'];
        $harga_sepatu = $_POST['harga_sepatu'];

        $sql = mysqli_query($koneksi, 
                                "INSERT INTO master_sepatu(nama_sepatu, category_sepatu, harga_sepatu) 
                                VALUES('$nama_sepatu', '$jenis_sepatu', '$harga_sepatu')");
        
        if($sql) {
            $_SESSION['message'] = "Your product has been added.";
            header("location:product.php");
        }
        else{
            $_SESSION['message'] = "Your product fail added.";
            header("location:product.php");
        }
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
                <br><h2>Insert Products</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../jualan_sepatu/product.php">Master Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Insert Product</li>
                    </ol>
                </nav>
                <br>
                <form method='POST' action="insert_sepatu.php?simpan_sepatu=insert_data">
                    <table class="table table-borderless">
                        <tr>
                            <td> Nama </td>
                            <td> : </td>
                            <td>
                                <input type='text' name='nama_sepatu' required>
                            </td>
                        <tr>
                        <tr>
                            <td> Jenis </td>
                            <td> : </td>
                            <td>
                                <select name='category_sepatu' required>
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <?php foreach($row_category as $cat) : ?>
                                        <option value="<?= $cat['category_id']; ?>"> <?php echo $cat['category_name']; ?> </option>
                                    <?php endforeach ?>
                                </select>
                            </td>
                        <tr>
                        <tr>
                            <td> Harga </td>
                            <td> : </td>
                            <td>
                                <input type='number' name='harga_sepatu' required>
                            </td>
                        <tr>
                        <tr>
                            <td colspan='3'>
                                <input class="btn btn-primary" type='submit' name='insert_sepatu' value="Submit">
                            </td>
                        </tr>
                    </table>
                </form>
            </main>
        </div>
        
        <!-- Script  -->
        <script src="admin/assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
        <script src="admin/css/dashboard.js"></script>
    </body>
</html>
