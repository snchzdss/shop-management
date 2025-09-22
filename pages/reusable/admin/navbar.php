<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Terminal Labeling</title>

  <link rel="icon" href="../../dist/img/logo.png" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="../../dist/css/font.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome7.0/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="../../plugins/sweetalert2/dist/sweetalert2.min.css">
  <style>
    .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #536A6D;
      width: 50px;
      height: 50px;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
    }

    .btn-file {
      position: relative;
      overflow: hidden;
    }

    .navbar {
      background-color: #0a3d62;
    }

    .main-header {
      background-color: #0a3d62 !important;
      /* your blue color */
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1030;
      /* above content */
      transition: margin-left 0.3s ease;
    }

    /* Match AdminLTE sidebar width when expanded */
    .sidebar-open .main-header,
    .layout-fixed.sidebar-mini .main-header {
      margin-left: 250px;
      /* Expanded sidebar */
    }

    /* Match AdminLTE sidebar width when collapsed */
    .sidebar-collapse .main-header {
      margin-left: 80px;
      /* Collapsed sidebar */
    }

    body {
      margin: 0;
      padding-top: 60px;
      /* Push content down so it doesn't hide under navbar */
    }


    .btn-file input[type=file] {
      position: absolute;
      top: 0;
      right: 0;
      min-width: 100%;
      min-height: 100%;
      font-size: 100px;
      text-align: right;
      filter: alpha(opacity=0);
      opacity: 0;
      outline: none;
      cursor: inherit;
      display: block;
    }

    .table th,
    .table td {
      padding: 15px !important;
      vertical-align: middle;
    }

    .table tbody tr td {
      padding: 8px 15px;
    }


    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(1080deg);
      }
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../../static/img/penguinicon.png" alt="logo" height="60" width="60">
      <noscript>
        <br>
        <span>We are facing <strong>Script</strong> issues. Kindly enable <strong>JavaScript</strong>!!!</span>
        <br>
        <span>Call IT Personnel Immediately!!! They will fix it right away.</span>
      </noscript>
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-blue navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color:white;">
          <i class="fas fa-bars"></i>
        </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button" style="color:white;">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
    </nav>
    <!-- /.navbar -->
