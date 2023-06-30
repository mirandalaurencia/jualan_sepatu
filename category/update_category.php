<?php
    session_start();
    include("../config/koneksi.php");

    # Call file navigation to load navigation
    include '../navigation.php';

    if (isset($_GET['category'])) {
        $id_cat = $_GET['category'];

        $sql_cat = mysqli_query($koneksi,"SELECT * 
                                         FROM master_category
                                         WHERE category_id = '$id_cat'");
        $row_cat = mysqli_fetch_array($sql_cat);
    }

    if (isset($_GET['simpan_category']) == 'update_data') {
        $category_id    = $_POST['category_id'];
        $category_name = $_POST['category_name'];
        $category_status  = $_POST['category_status'];

        $sql = mysqli_query($koneksi, "UPDATE master_category
                                        SET category_name = '$category_name',
                                            category_status = '$category_status'
                                        WHERE category_id = '$category_id'");
                                        
        if ($sql == '1') {
            $_SESSION['message'] = "Your category has been updated.";
            header("location:../category.php");
        } else {
            $_SESSION['message'] = "Category not found by ID.";
            header("location:../category.php");
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
                <br><h2>Update Categories</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../../jualan_sepatu/category.php">Master Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Category</li>
                    </ol>
                </nav>
                <br>
                <form method='POST' action="update_category.php?simpan_category=update_data">
                    <table class="table table-borderless">
                        <tr>
                            <td> Category Name </td>
                            <td> : </td>
                            <td>
                                <input type='hidden' name='category_id' value="<?php echo $row_cat['category_id'] ?>">
                                <input type='text' name='category_name' value="<?php echo $row_cat['category_name']?>" required>
                            </td>
                        <tr>
                        <tr>
                            <td> Status </td>
                            <td> : </td>
                            <td>
                                <select name='category_status' required>
                                    <option value='A' <?= $row_cat['category_status'] == 'A' ? ' selected="selected"' : '';?>>Active</option>
                                    <option value='N' <?= $row_cat['category_status'] == 'N' ? ' selected="selected"' : '';?>>Nonactive</option>
                                </select>
                            </td>
                        <tr>
                        <tr>
                            <td colspan='3'>
                                <input class="btn btn-primary" type='submit' name='update_category' value="Submit">
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