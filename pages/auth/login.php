<?php
include '../../api/common/sessions.php';
include '../../api/common/consts.php';

if (!empty($_SESSION['user'])) {
    if ($_SESSION['user']['role'] === 'admin') {
        header("Location: {$system}/pages/admin/index.php");
        exit();
    } elseif ($_SESSION['user']['role'] === 'user') {
        header("Location: {$system}/pages/cashier/index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
      include '../../api/common/imports.php';
      import_assets($system);
  ?>
  <title>Login - Shop Management</title>

<style>
  .signin-btn{
    background-color: #003566;
    color: white;
  }

  .signin-btn:hover {
  background-color: white;
  color: #003566;
  border: 2px solid #003566;
  }

  .signin-btn.active {
    background-color: #003566;
    color: white;
  }
</style>




</head>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo pt-3 mb-0 d-flex flex-column justify-content-center align-items-center">
    <img src="<?php echo $system . '../static/img/cashier.png'; ?>" class="mb-2" style="height:80px;">
    <h2 class="text-nowrap" style="font-size: 25px;"><b>SAMPLE SYSTEM <br> TEMPLATE</b></h2>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form id="loginForm">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-block signin-btn">Sign In</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>

<script>
$("#loginForm").on("submit", function(e) {
    e.preventDefault();

    $.ajax({
        url: "<?php echo $system; ?>/api/auth/login.php", 
        type: "POST",
        data: $(this).serialize(),
        dataType: "json",
        success: function(res) {
            if (res.status === "success") {
                Swal.fire({
                    icon: "success",
                    title: "Login Successful",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    if (res.role === "admin") {
                        window.location.href = "<?php echo $system;?>/pages/admin/index.php";
                    } else if (res.role === "user") {
                        window.location.href = "<?php echo $system;?>/pages/cashier/index.php";
                    } else {
                        window.location.href = "<?php echo $system;?>/pages/auth/login.php";
                    }
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: res.message
                });
            }
        },
        error: function(xhr) {
          Swal.fire({
              icon: "error",
              title: "Login failed",
              text: xhr.responseJSON?.message || "Something went wrong"
          });
        }

    });
});
</script>

</body>
</html>
