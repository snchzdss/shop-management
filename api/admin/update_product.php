<?php
require '../common/db_connection.php';

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$name = isset($_POST['name']) ? trim($_POST['name']) : null;
$category_id = isset($_POST['category_id']) ? (int)$_POST['category_id'] : null;
$price = isset($_POST['price']) ? (float)$_POST['price'] : 0;
$stock = isset($_POST['stock']) ? (int)$_POST['stock'] : 0;
$barcode = isset($_POST['barcode']) ? trim($_POST['barcode']) : null;

if ($id <= 0 || empty($name) || $price < 0 || $stock < 0) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid input'
    ]);
    exit();
}

try {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $current_product =  $stmt->fetch(PDO::FETCH_ASSOC);

    //check if the barcode is not null or changed
    if ($barcode !== null && $barcode !== $current_product['barcode']) {
        $barcode_check = $conn->prepare("SELECT COUNT(*) FROM products WHERE barcode = :barcode AND id != :id"); //check if the new barcode exists in other rows
        $barcode_check->execute([':barcode' => $barcode, ':id' => $id]);

        //returns the value of the first row that matches the condition
        if ($barcode_check->fetchColumn() > 0) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Barcode already exists.'
            ]);
            exit();
        }
    }

    $sql_update_product = "UPDATE products 
        SET name = :name, category_id = :category_id, price = :price, stock = :stock, barcode = :barcode 
        WHERE id = :id";
    $stmt = $conn->prepare($sql_update_product);
    $update_product = $stmt->execute([
        ':name' => $name,
        ':category_id' => $category_id,
        ':price' => $price,
        ':stock' => $stock,
        ':barcode' => $barcode,
        ':id' => $id
    ]);

    //check if there are any update
    if ($stmt->rowCount() === 0) {
        echo json_encode([
            'status' => 'error',
            'message' => 'No changes made.'
        ]);
        exit();
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'Product updated successfully.'
    ]);
    exit();
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Error : ' . $e->getMessage()
    ]);
}
