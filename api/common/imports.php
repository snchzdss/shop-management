<?php
// imports.php — does NOT echo on include; caller must call import_assets($system)
// Do NOT override $system here; assume consts.php provides it.

if (!function_exists('import_assets')) {
    function import_assets($system) {
        $version = time();
        echo <<<HTML
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="{$system}/static/img/device_issuance.png" type="image/x-icon">
<link rel="stylesheet" href="{$system}/static/css/font.min.css">
<link rel="stylesheet" href="{$system}/static/css/global.css">
<link rel="stylesheet" href="{$system}/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="{$system}/static/css/adminlte.css">
<link rel="stylesheet" href="{$system}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<link rel="stylesheet" href="{$system}/plugins/sweetalert2/dist/sweetalert2.min.css">
<link rel="stylesheet" href="{$system}/plugins/datatables/datatables.min.css">
<link rel="stylesheet" href="{$system}/plugins/ui-editor/toastui-editor.min.css">
<link rel="stylesheet" href="{$system}/plugins/toaster/toastr.scss">
<link rel="stylesheet" href="{$system}/plugins/apexcharts.js-5.3.0/dist/apexcharts.css">

<script src="{$system}/plugins/jquery-min/jquery-3.7.1.min.js"></script>
<script src="{$system}/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="{$system}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{$system}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="{$system}/static/js/adminlte.js"></script>
<script src="{$system}/static/js/popup_center.js"></script>
<script src="{$system}/static/js/export_csv.js"></script>
<script src="{$system}/static/js/serialize.js"></script>
<script src="{$system}/plugins/datatables/datatables.min.js"></script>
<script src="{$system}/plugins/ui-editor/toastui-editor-all.min.js"></script>
<script src="{$system}/plugins/custom-file-input/bs-custom-file-input.min.js"></script>
<script src="{$system}/plugins/typejs/typed.umd.js"></script>
<script src="{$system}/plugins/qr_code/qrcode.min.js"></script>
<script src="{$system}/plugins/particles.js-master/particles.js"></script>
<script src="{$system}/plugins/toaster/toastr.js"></script>
<script src="{$system}/plugins/apexcharts.js-5.3.0/dist/apexcharts.js"></script>
<script src="{$system}/static/js/global.js?v={$version}"></script>
HTML;
    }
}
