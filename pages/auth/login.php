<?php
// start session BEFORE any HTML output
include '../../api/common/sessions.php';
include '../../api/common/consts.php';

// redirect if already logged in
if (!empty($_SESSION['user'])) {
    header("Location: {$self_address}/pages/admin/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        // load imports helper
        include '../../api/common/imports.php';
        // print all CSS/JS imports here
        import_assets($system);
    ?>
    <title>Login - Shop POS</title>
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    <b>Shop</b>POS
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form id="loginForm">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
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
        url: "<?php echo rtrim($self_address, '/'); ?>/api/auth/login.php",
        type: "POST",
        data: $(this).serialize(),
        success: function(res) {
            if (res.status === "success") {
                Swal.fire({
                    icon: "success",
                    title: "Login Successful",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = "<?php echo rtrim($self_address, '/'); ?>/pages/admin/index.php";
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
