<?php
require '../common/db_connection.php';

$name = isset($_POST['name']) ? trim($_POST['name']) : null;

if (empty($name)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Category name is required.'
    ]);
    exit();
}

try {
    $sql = "INSERT INTO categories (name) VALUES (:name)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':name' => $name]);

    echo json_encode([
        'status' => 'success',
        'message' => 'Category added successfully.'
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
