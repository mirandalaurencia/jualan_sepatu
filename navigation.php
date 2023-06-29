<!doctype html>
<html lang="en">
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Kutsuku</a>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href='logout.php'>Sign out</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <?php $activePage = basename($_SERVER['PHP_SELF']); ?>
        
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php if($activePage == 'dashboard.php'){ echo ' active"';}?>" aria-current="page" href="../jualan_sepatu/dashboard.php">
                            <span data-feather="home"></span>
                            Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($activePage == 'product.php'){ echo ' active"';}?>" href="../jualan_sepatu/product.php">
                            <span data-feather="database"></span>
                            Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($activePage == 'category.php'){ echo ' active"';}?>" href="../jualan_sepatu/category.php">
                            <span data-feather="file"></span>
                            Category
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($activePage == 'customer.php'){ echo ' active"';}?>" href="#">
                            <span data-feather="users"></span>
                            Customers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($activePage == 'report.php'){ echo ' active"';}?>" href="#">
                            <span data-feather="bar-chart-2"></span>
                            Reports
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</html>