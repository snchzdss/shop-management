<?php
include '../../api/common/sessions.php';
include '../../api/common/consts.php';

if (!empty($_SESSION['user'])) {
    if ($_SESSION['user']['role'] === 'admin') {
        header("Location: {$system}/pages/admin/index.php");
        exit();
    } elseif ($_SESSION['user']['role'] === 'cashier') {
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
    body{
      height: 100vh;
      background: #e0e1dd !important;
    }

    .card{
      overflow: hidden;
      border: 0 !important;
      border-radius: 20px !important;
      box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
      max-width: 900px;
      width: 100%;
    }

    .img-left {
        width: 45%;
        background: linear-gradient(135deg, #a6d1ffff, #0056b3);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }


    .card-body{
      padding: 2rem;
    }

    .title{
      margin-bottom: 2rem;
    }

    .form-input{
      position: relative;
    }

    .form-input input{
      width: 100%;
      height: 45px;
      padding-left: 40px;
      margin-bottom: 20px;
      box-sizing: border-box;
      box-shadow: none;
      border: 1px solid #00000020;
      border-radius: 50px;
      outline: none;
      background: transparent;
    }

    .form-input span{
      position: absolute;
      top: 10px;
      padding-left: 15px;
      color: #007bff;
    }

    .form-input input::placeholder{
      color: black;
      padding-left: 0px;
    }

    .form-input input:focus, .form-input input:valid{
      border: 2px solid #007bff;
    }

    .form-input input:focus::placeholder{
      color: #454b69;
    }

    .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before{
      background-color: #007bff !important;
      border: 0px;
    }

    .form-box button[type="submit"]{
      margin-top: 10px;
      border: none;
      cursor: pointer;
      border-radius: 50px;
      background: #007bff;
      color: #fff;
      font-size: 90%;
      font-weight: bold;
      letter-spacing: .1rem;
      transition: 0.5s;
      padding: 12px;
    }

    .form-box button[type="submit"]:hover{
      background: #0069d9;
    }

    .forget-link, .register-link{
      color: #007bff;
      font-weight: bold;
    }

    .forget-link:hover, .register-link:hover{
      color: #0069d9;
      text-decoration: none;
    }

    .form-box .btn-social{
      color: white !important;
      border: 0;
      font-weight: bold;
    }

    .form-box .btn-facebook{
      background: #4866a8;
    }

    .form-box .btn-google{
      background: #da3f34;
    }

    .form-box .btn-twitter{
      background: #33ccff;
    }

    .form-box .btn-facebook:hover{
      background: #3d578f;
    }

    .form-box .btn-google:hover{
      background: #bf3b31;
    }

    .form-box .btn-twitter:hover{
      background: #2eb7e5;
    }
  </style>
</head>
<body>
  <div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="row w-100 justify-content-center">
      <div class="col-lg-10 col-xl-9">
        <div class="card flex-row mx-auto px-0">
            <div class="img-left d-none d-md-flex flex-column align-items-center justify-content-center text-white p-4">
                <img src="<?php echo $system . '../static/img/penguin.png'; ?>" alt="Logo" class="mb-3" style="max-width: 200px;">
                <h3 class="font-weight-bold">Sample Website Template</h3>
                <p class="text-center">just for fun</p>
            </div>

          <div class="card-body">
            <h4 class="title text-center mt-4">Login into account</h4>
            <form id="loginForm" class="form-box px-3">
              
              <div class="form-input">
                <span><i class="fa fa-user"></i></span>
                <input type="text" name="username" placeholder="Username" required autofocus>
              </div>

              <div class="form-input">
                <span><i class="fa fa-key"></i></span>
                <input type="password" name="password" placeholder="Password" required>
              </div>

              <div class="mb-3">
                <button type="submit" class="btn btn-block text-uppercase">Login</button>
              </div>
            </form>
          </div>
        </div>
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
                    } else if (res.role === "cashier") {
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
