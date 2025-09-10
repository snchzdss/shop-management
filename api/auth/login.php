<?php
header('Content-Type: application/json');

// enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// include dependencies
include '../common/db_connection.php';
include '../common/sessions.php';
include '../common/consts.php';
include '../common/php_functions.php';

// expected POST data
$post_expected = [
    "username" => null,
    "password" => null,
];

// sanitize input
foreach ($_POST as $key => $value) {
    if (array_key_exists($key, $post_expected)) {
        $post_expected[$key] = sanitize_input($value);
    }
}

// check credentials in database
$stmt = $pdo->prepare("
    SELECT id, username, password, role 
    FROM users 
    WHERE username = :username
");

$stmt->execute(["username" => $post_expected["username"]]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// ⚠️ Plain text password comparison (for testing only)
if ($user) {
    if ($post_expected["password"] === $user["password"]) {
        unset($user["password"]);
        $_SESSION["user"] = $user;
        http_response_code(200);
        echo json_encode([
            "status" => "success",
            "message" => "Login successful",
            "data" => $user
        ]);
        exit();
    } else {
        http_response_code(401);
        echo json_encode([
            "status" => "error",
            "message" => "Password mismatch",
            "debug_input" => $post_expected["password"],
            "debug_db" => $user["password"]
        ]);
        exit();
    }
} else {
    http_response_code(401);
    echo json_encode([
        "status" => "error",
        "message" => "User not found",
        "debug_username" => $post_expected["username"]
    ]);
    exit();
}
