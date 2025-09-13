<?php
include '../common/sessions.php';

session_unset();
session_destroy();

header("Location: ../../pages/auth/login.php");
exit();
