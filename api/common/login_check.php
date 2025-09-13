<?php
if (empty($_SESSION['user'])) {

    $notification = [
        "icon" => "warning",
        "text" => "Login Required",
    ];

    $_SESSION['notification'] = json_encode($notification);

    header("Location: {$system}/pages/auth/login.php");
    exit();
}
?>
