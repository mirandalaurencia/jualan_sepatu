<?php
    session_start();
    include("../config/koneksi.php");

    # Call file navigation to load navigation
    include '../navigation.php';

    # Get id sepatu & name
    $sql = mysqli_query($koneksi, "SELECT *
                                   FROM master_sepatu s");
    $row = mysqli_fetch_all($sql, MYSQLI_ASSOC);

    if (isset($_GET['simpan_inventory']) == 'insert_data') {
        $sepatu_id = $_POST['id_sepatu'];
        $ukuran = $_POST['ukuran'];
        $stok = $_POST['stok'];
        
        # Cek ukuran nya ada atau tidak dulu
        $sql_check_ukuran = mysqli_query($koneksi,"SELECT * FROM master_stock 
                                                   WHERE sepatu_id = $sepatu_id
                                                   AND ukuran = $ukuran");
        $count_check_ukuran = mysqli_num_rows($sql_check_ukuran);

        # Jika ukurannya ADA maka di update
        if ($count_check_ukuran > 0) {
            $row = mysqli_fetch_array($sql_check_ukuran);
            $current_stok = $row['stok'];

            $stok = $stok + $current_stok;
            $sql = mysqli_query($koneksi, "UPDATE master_stock
                                        SET stok = $stok
                                        WHERE sepatu_id = $sepatu_id
                                        AND ukuran = $ukuran");
        } 

        # Jika ukurannya TIDAK ADA maka di insert
        else {
            $sql = mysqli_query($koneksi, "INSERT INTO master_stock(sepatu_id, ukuran, stok) 
                                        VALUES($sepatu_id, $ukuran, $stok)");
        }
                                        
        if ($sql) {
            $_SESSION['message'] = "Your inventory has been added.";
            header("location:../inventory.php");
        } else {
            $_SESSION['message'] = "Your inventory fail added.";
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
                <br><h2>Insert Size & Stock</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../../jualan_sepatu/inventory.php">Inventory</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Insert Size & Stock</li>
                    </ol>
                </nav>
                <br>
                <form method='POST' action="insert_stock.php?simpan_inventory=insert_data">
                    <table class="table table-borderless">
                        <tr>
                            <td> ID Product - Name </td>
                            <td> : </td>
                            <td>
                                <select name='id_sepatu' required>
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <?php foreach($row as $r) : ?>
                                        <option value="<?= $r['id_sepatu']; ?>"> <?php echo $r['id_sepatu'] . ' - ' .  $r['nama_sepatu']; ?> </option>
                                    <?php endforeach ?>
                                </select>
                            </td>
                        <tr>
                        <tr>
                            <td> Ukuran </td>
                            <td> : </td>
                            <td>
                                <select name='ukuran' required>
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <option value=37>37</option>
                                    <option value=38>38</option>
                                    <option value=38>39</option>
                                    <option value=38>40</option>
                                    <option value=38>41</option>
                                    <option value=38>42</option>
                                </select>
                            </td>
                        <tr>
                        <tr>
                            <td> Stock </td>
                            <td> : </td>
                            <td>
                                <input type='number' name='stok' required>
                            </td>
                        <tr>
                        <tr>
                            <td colspan='3'>
                                <input class="btn btn-primary" type='submit' name='insert_category' value="Submit">
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