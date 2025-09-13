<?php
header('Content-Type: application/json');

include '../common/sessions.php';
include '../common/consts.php';
include '../common/php_functions.php';

$username_input = trim($_POST['username'] ?? '');
$password_input = trim($_POST['password'] ?? '');

if (empty($username_input) || empty($password_input)) {
    echo json_encode([
        "status" => "error",
        "message" => "Username and password are required."
    ]);
    exit;
}

include '../common/db_connection.php';

try {
    $stmt = $conn->prepare("SELECT username, password, role FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username_input);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid user."
        ]);
        $conn = null;
        exit;
    }

    if ($password_input == $user['password']) {
        $_SESSION['user'] = [
            "username" => $user['username'],
            "role" => $user['role']
        ];

        echo json_encode([
            "status" => "success",
            "message" => "Login successful",
            "role" => $user['role'],
        ]);
        $conn = null;
        exit;
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid password."
        ]);
        $conn = null;
        exit;
    }
} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Database error: " . $e->getMessage()
    ]);
    $conn = null;
    exit;
}
