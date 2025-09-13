<?php
    include '../../api/common/consts.php';
    include '../../api/common/sessions.php';
    include '../../api/common/login_check.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cashier | Shop Management</title>
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
        include '../../pages/reusable/cashier/navbar.php';
        ?>

        <!-- Sidebar -->
        <?php
        include '../../pages/reusable/cashier/sidebar.php';
        ?>


        <!-- main content -->
        <div class="content-wrapper" style="min-height: 600px;">
            <!-- Page header -->
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
            </div>


                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <p>Welcome to the Cashier dashboard. Start processing sales!</p>
                    </div>
                </section>
        </div>

        <!-- Footer -->
         <?php
        include '../../pages/reusable/cashier/footer.php';
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
