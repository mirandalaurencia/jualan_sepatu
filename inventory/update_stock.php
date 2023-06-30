<?php
    session_start();
    include("../config/koneksi.php");

    # Call file navigation to load navigation
    include '../navigation.php';

    if (isset($_GET['id']) && isset($_GET['ukuran'])) {
        $id_sepatu = $_GET['id'];
        $ukuran = $_GET['ukuran'];

        $sql_stock = mysqli_query($koneksi,"SELECT s.*, st.*, c.*
                                            FROM master_sepatu s
                                            JOIN master_stock st
                                            ON s.id_sepatu = st.sepatu_id
                                            JOIN master_category c
                                            ON s.category_sepatu = c.category_id
                                            WHERE st.sepatu_id = '$id_sepatu'
                                            AND st.ukuran = '$ukuran'");
        $row_stock = mysqli_fetch_array($sql_stock);
    }

    if (isset($_GET['simpan_inventory']) == 'update_data') {
        $sepatu_id = $_POST['sepatu_id'];
        $ukuran = $_POST['ukuran'];
        $stok = $_POST['stok'];

        $sql = mysqli_query($koneksi, "UPDATE master_stock
                                        SET stok = $stok
                                        WHERE sepatu_id = $sepatu_id
                                        AND ukuran = $ukuran");
                                        
        if ($sql) {
            $_SESSION['message'] = "Your stock has been updated.";
            header("location:../inventory.php");
        } else {
            $_SESSION['message'] = "Your stock fail updated.";
            header("location:../inventory.php");
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
        <link rel="icon" href="../images/iconcategory.png">

        <!-- Bootstrap core CSS -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../css/dashboard.css" rel="stylesheet">

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
                <br><h2>Update Inventory</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../../jualan_sepatu/inventory.php">Inventory</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Inventory</li>
                    </ol>
                </nav>
                <br>
                <form method='POST' action="update_stock.php?simpan_inventory=update_data">
                    <table class="table table-borderless">
                        <tr>
                            <td> Product Name </td>
                            <td> : </td>
                            <td>
                                <input type='hidden' name='sepatu_id' value="<?php echo $row_stock['sepatu_id'] ?>">
                                <input type='hidden' name='ukuran' value="<?php echo $row_stock['ukuran'] ?>">
                                <input type='text' name='nama_sepatu' value="<?php echo $row_stock['nama_sepatu']?>" disabled>
                            </td>
                        <tr>
                        <tr>
                            <td> Category </td>
                            <td> : </td>
                            <td>
                                <input type='text' name='category_name' value="<?php echo $row_stock['category_name']?>" disabled>
                            </td>
                        <tr>
                        <tr>
                            <td> Size </td>
                            <td> : </td>
                            <td>
                                <input type='text' name='ukuran' value="<?php echo $row_stock['ukuran']?>" disabled>
                            </td>
                        <tr>
                        <tr>
                            <td> Stock </td>
                            <td> : </td>
                            <td>
                                <input type='number' name='stok' value="<?php echo $row_stock['stok']?>" required>
                            </td>
                        <tr>
                        <tr>
                            <td colspan='3'>
                                <input class="btn btn-primary" type='submit' name='update_stok' value="Submit">
                            </td>
                        </tr>
                    </table>
                </form>
            </main>
        </div>
        
        <!-- Script  -->
        <script src="../admin/assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
        <script src="../admin/css/dashboard.js"></script>
    </body>
</html>