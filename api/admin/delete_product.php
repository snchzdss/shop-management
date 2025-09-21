<?php
    require '../common/db_connection.php';

    $id = isset($_POST['id']) ? (int)$_POST['id'] : null;

    if($id <= 0){
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid product id.'
        ]);
    }

    try{
        $sql_delete_product = "DELETE FROM products WHERE id = :id";
        $stmt = $conn -> prepare($sql_delete_product);
        $delete_product = $stmt -> execute([':id' => $id]); 

        echo json_encode([
            'status' => 'success',
            'message' => 'Product successfully deleted.'
        ]);
        exit();
    }
    catch(PDOException $e){
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid product id.'
        ]);
        exit();
    }

?>