<?php
    # Session start   
    error_reporting(0);   
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
                <br><h2>Master Products</h2><br>
                <div class="d-flex justify-content-end">
                    <a  class="pull-right" href='product.php?sepatu=insert'>
                        <input class='btn btn-primary' type='button' name='insert_sepatu' value='Add Product'>
                    </a>
                </div>
                <br>
                <div class="table-responsive">
                    <?php
                        error_reporting(0);
                        include("config/koneksi.php");

                        $id_sepatu = $_POST['id_sepatu'];

                        $sql = mysqli_query($koneksi,"SELECT s.*, c.* 
                                                      FROM master_sepatu s
                                                      JOIN master_category c
                                                      ON s.category_sepatu = c.category_id
                                                      ORDER BY s.id_sepatu");
                
                        echo "<table class='table text-center table-striped table-sm'width='100%'> ";
                            echo "<thead class=thead-dark>";
                            echo"<tr>";
                                echo "<th align=center>ID SEPATU</th>";
                                echo "<th align=center>KATEGORI SEPATU</th>";
                                echo "<th align=center>NAMA SEPATU</th>";
                                echo"<th align=center>ACTION</th>";
                            echo"</tr>";
                            echo "</thead>";

                        while( $row = mysqli_fetch_array($sql) )
                        {
                            $id_sepatu = $row['id_sepatu'];
                            echo"<tr>";
                                echo "<td align=center>".$row['id_sepatu']."</td>";
                                echo "<td align=center>".$row['category_name']."</td>";
                                echo "<td align=center>".$row['nama_sepatu']."</td>";
                                echo "<td align=center>";
                                echo "<a href=update_sepatu.php?sepatu=$id_sepatu>
                                        <input class='btn btn-warning' type='button' name='update_sepatu' value='Update Product'></a>";
                                echo "<button type='button' class='first btn btn-danger' style='margin-left:12px;' name='hapus_sepatu' value='Delete Product' onClick='delete_click($id_sepatu)'>Delete Product</button>";
                                echo "</td>";
                            echo"</tr>";
                        }

                        echo "</table>";

                        if (isset($_GET['sepatu']) == 'insert') {
                            echo" <form action='insert_sepatu.php' method='POST'>
                                ID SEPATU
                                </br>
                                <input type='text' name='id_sepatu'>
                                <form action='insert_sepatu.php' method='POST'>
                                </br>
                                NAMA SEPATU
                                </br>
                                <input type='text' name='nama_sepatu'>
                                <form action='insert_sepatu.php' method='POST'>
                                </br>
                                JENIS SEPATU
                                </br>
                                <input type='text' name='jenis_sepatu'>
                                </br>
                                <input type='submit' name ='simpan_sepatu' value='Simpan Sepatu'>
                            </form>";
                        }
                    ?>
                </div>
            </main>
        </div>
        
        <!-- Modal confirmation -->
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                    </div>
                
                    <div class="modal-body">
                        <p>You are about to delete one product, this procedure is irreversible.</p>
                        <p>Do you want to proceed?</p>
                        <p class="debug-url"></p>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="close btn btn-default" data-dismiss="modal">Cancel</button>
                        <a class="btn-delete btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script  -->
        <script src="admin/assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
        <script src="admin/css/dashboard.js"></script>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <script>
            $(function() {
                $('button.close').on('click', function(){
                    $('#confirm-delete').modal('hide');
                });
            });

            function delete_click(id) {
                var link = 'hapus_sepatu.php?sepatu=' + id;

                $('#confirm-delete').modal('show');

                $("a.btn-delete").attr("href", link);
            };
        </script>
    </body>
</html>
