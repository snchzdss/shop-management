<?php
    require '../common/db_connection.php';

    $name = isset($_POST['name']) ? trim($_POST['name']) : null;
    $category_id = isset($_POST['category_id']) ? (int)$_POST['category_id'] : null;
    $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;
    $stock = isset($_POST['stock']) ? (int)$_POST['stock'] : 0;
    $barcode = isset($_POST['barcode']) ? trim($_POST['barcode']) : null;

    if(empty($name) || $price < 0 || $stock < 0){
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid input.'
        ]);
        exit();
    }

    try{
        $sql_create_product = "INSERT INTO products(name, category_id, price, stock, barcode)
        VALUES(:name, :category_id, :price, :stock, :barcode)";
        $stmt = $conn -> prepare($sql_create_product);
        $stmt -> execute([
            ':name' => $name, 
            ':category_id' => $category_id, 
            ':price' => $price, 
            ':stock' => $stock, 
            ':barcode' => $barcode
        ]);

        echo json_encode([
            'status' => 'success',
            'message' => 'Product added successfully.'
        ]);

    }

    catch(PDOException $e){
        echo json_encode([
            'status' => 'error',
            'message' => 'Error : ' . $e->getMessage()
        ]);
        exit();
    }


?>