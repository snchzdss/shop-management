<?php
include '../../api/common/sessions.php';
include '../../api/common/consts.php';
include '../../api/common/login_check.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin | Template</title>
    <?php
    include '../../api/common/imports.php';
    import_assets($system);
    ?>

    <style>
        .main-sidebar {
            background-color: #0a3d62;
        }

        .main-sidebar .nav-link {
            color: white;
        }

        .main-sidebar .nav-link.active,
        .main-sidebar .nav-link:hover {
            background-color: #1e90ff;
            color: white;
        }

        .brand-text {
            color: white !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php
        include '../../pages/reusable/admin/navbar.php';
        ?>

        <!--Sidebar-->
        <?php
        include '../../pages/reusable/admin/sidebar.php';
        ?>


        <!-- Main Content -->
        <div class="content-wrapper" style="min-height: 600px;">
            <!-- Page header -->
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="m-0 text-dark">Dashboard / Overview</h1>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <!-- Total Sales Today -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>₱0.00</h3>
                                    <p>Sales Today</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cash-register"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Monthly Sales -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>₱0.00</h3>
                                    <p>Sales This Month</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Products -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>0</h3>
                                    <p>Total Products</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Active Staff -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>0</h3>
                                    <p>Active Staff</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Charts Row -->
                    <div class="row">
                        <!-- Sales Chart -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Sales Overview</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="salesChart" style="height: 250px;"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Top Selling Products -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Top-Selling Products</h3>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li>Product 1</li>
                                        <li>Product 2</li>
                                        <li>Product 3</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Low Stock Alerts -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Low Stock Alerts</h3>
                                </div>
                                <div class="card-body">
                                    <p>No low stock items at the moment.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

        </div>

        <!-- Footer -->
        <?php
        include '../../pages/reusable/admin/footer.php';
        ?>


    </div>


    <script>
        document.querySelectorAll('a[href="../../api/auth/logout.php"]').forEach(el => {
            el.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will be logged out.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Yes, logout',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "../../api/auth/logout.php";
                    }
                });
            });
        });
    </script>


</body>

</html>