<?php
require '../common/db_connection.php';

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$name = isset($_POST['name']) ? trim($_POST['name']) : null;

if ($id <= 0 || empty($name)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid input.'
    ]);
    exit();
}

try {
    $sql = "UPDATE categories SET name = :name WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':name' => $name, ':id' => $id]);

    if ($stmt->rowCount() === 0) {
        echo json_encode([
            'status' => 'error',
            'message' => 'No changes made.'
        ]);
        exit();
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'Category updated successfully.'
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
